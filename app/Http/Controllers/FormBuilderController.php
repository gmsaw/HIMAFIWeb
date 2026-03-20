<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\DynamicForm;
use App\Models\FormSubmission;
use Illuminate\Support\Str;

class FormBuilderController extends Controller
{
    // ==========================================
    // 1. DASBOR & PEMBUATAN FORMULIR
    // ==========================================

    // Menampilkan Halaman Dasbor Manajemen Formulir
    public function index()
    {
        // Hanya ambil formulir milik user yang sedang login
        $forms = DynamicForm::where('user_id', Auth::id())
                            ->withCount('submissions')
                            ->latest()
                            ->get();
                            
        // Hitung sisa kuota
        $formCount = $forms->count();
        $maxForms = 10;
        
        return view('pages.forms.index', compact('forms', 'formCount', 'maxForms'));
    }

    // Menampilkan Halaman Pembuat Formulir
    public function create()
    {
        // Cek Kuota sebelum mengizinkan pembuatan
        $formCount = DynamicForm::where('user_id', Auth::id())->count();
        
        if ($formCount >= 10) {
            return redirect()->route('form.index')
                             ->with('error', 'Batas maksimal tercapai! Anda hanya dapat membuat hingga 10 formulir. Silakan hapus formulir lama untuk membuat yang baru.');
        }

        return view('pages.forms.create');
    }

    // Memproses dan Menyimpan Formulir Baru ke Database
    public function store(Request $request)
    {
        // Proteksi Ganda (Backend)
        if (DynamicForm::where('user_id', Auth::id())->count() >= 10) {
            return redirect()->route('form.index')->with('error', 'Batas kuota formulir habis.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fields' => 'required|array|min:1',
            'fields.*.label' => 'required|string',
            'fields.*.type' => 'required|in:text,email,textarea,signature,radio,checkbox,image_link,date,datetime-local', 
        ]);

        $fields = collect($request->fields)->map(function ($field) {
            return [
                'label' => $field['label'],
                'name' => Str::slug($field['label'], '_'), 
                'type' => $field['type'],
                'required' => isset($field['required']) ? true : false,
                // Jika tipenya radio/checkbox, pecah teks opsi menjadi array
                'options' => isset($field['options']) ? array_map('trim', explode(',', $field['options'])) : [],
            ];
        })->toArray();

        $form = DynamicForm::create([
            'user_id' => Auth::id(), // Simpan ID Pembuat
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . substr(uniqid(), -5),
            'description' => $request->description,
            'fields' => $fields,
            'is_active' => true,
        ]);

        return redirect()->route('form.show', $form->slug)
                         ->with('success', 'Voila! Formulir berhasil dibuat dan siap disebarkan.');
    }


    // ==========================================
    // 2. MANAJEMEN RESPONDEN & EXPORT DATA
    // ==========================================

    // Halaman Melihat Tabel Hasil Jawaban
    public function responses($id)
    {
        // Pastikan hanya pemilik form yang bisa melihat hasilnya
        $form = DynamicForm::where('user_id', Auth::id())->findOrFail($id);
        $submissions = FormSubmission::where('dynamic_form_id', $id)->latest()->get();
        
        return view('pages.forms.responses', compact('form', 'submissions'));
    }

    // Fitur Download Hasil ke CSV / Excel
    public function download($id)
    {
        // Proteksi kepemilikan
        $form = DynamicForm::where('user_id', Auth::id())->findOrFail($id);
        $submissions = FormSubmission::where('dynamic_form_id', $id)->latest()->get();

        $fileName = $form->slug . '-responses.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = collect($form->fields)->pluck('label')->toArray();
        array_unshift($columns, 'Waktu Submit');

        $callback = function() use($submissions, $form, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($submissions as $submission) {
                $row = [$submission->created_at->format('d-m-Y H:i:s')];
                
                foreach ($form->fields as $field) {
                    $name = $field['name'];
                    $val = $submission->answers[$name] ?? '';
                    
                    // Rapikan jika hasil berupa array (Contoh dari input Checkbox)
                    if (is_array($val)) {
                        $val = implode(', ', $val);
                    }
                    
                    // Jangan print string base64 gambar TTE ke Excel agar file tidak korup/lag
                    if ($field['type'] == 'signature' && !empty($val) && $val !== '-') {
                        $val = '[Tanda Tangan Tersimpan di Sistem]';
                    }
                    
                    $row[] = $val;
                }
                fputcsv($file, $row); 
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Fitur Cetak Formulir Individual ke PDF
    public function downloadPdf($submissionId)
    {
        $submission = FormSubmission::with('dynamicForm')->findOrFail($submissionId);
        $form = $submission->dynamicForm;

        // Keamanan ekstra: Cek apakah submission ini milik form user yang sedang login
        if ($form->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Anda tidak diizinkan mencetak dokumen ini.');
        }

        $pdf = Pdf::loadView('pages.forms.pdf', compact('form', 'submission'));
        $fileName = Str::slug($form->title) . '-respon-' . $submission->id . '.pdf';

        return $pdf->download($fileName);
    }

    // Fitur Cetak SEMUA Respon ke dalam 1 File PDF (Format Tabel Landscape)
    public function downloadAllPdf($id)
    {
        // Proteksi kepemilikan
        $form = DynamicForm::where('user_id', Auth::id())->findOrFail($id);
        $submissions = FormSubmission::where('dynamic_form_id', $id)->oldest()->get();

        $pdf = Pdf::loadView('pages.forms.pdf_all', compact('form', 'submissions'))
                  ->setPaper('a4', 'landscape'); 
        
        $fileName = Str::slug($form->title) . '-semua-respon.pdf';

        return $pdf->download($fileName);
    }
    
    
    // ==========================================
    // 3. FITUR HAPUS
    // ==========================================

    // Menghapus Formulir (Akan menghapus semua submission juga secara otomatis via Cascade)
    public function destroy($id)
    {
        // Proteksi: Hanya user pemilik form yang bisa menghapus
        $form = DynamicForm::where('user_id', Auth::id())->findOrFail($id);
        $form->delete();
        
        return back()->with('success', 'Formulir beserta semua jawabannya berhasil dihapus secara permanen.');
    }
}