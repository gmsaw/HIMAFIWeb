<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DynamicForm;
use App\Models\FormSubmission;

class PublicFormController extends Controller
{
    // Menampilkan Form ke Publik berdasarkan URL (Slug)
    public function show($slug)
    {
        $form = DynamicForm::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('pages.forms.show', compact('form'));
    }

    // Memproses Kiriman dari Publik
    public function submit(Request $request, $slug)
    {
        $form = DynamicForm::where('slug', $slug)->firstOrFail();
        
        // Mengambil semua input kecuali token CSRF
        $data = $request->except('_token');

        // Simpan ke database
        FormSubmission::create([
            'dynamic_form_id' => $form->id,
            'answers' => $data // Disimpan otomatis sebagai JSON
        ]);

        return back()->with('success', 'Formulir berhasil dikirim! Terima kasih.');
    }
}