<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FungsionarisController extends Controller
{
    public function index()
    {
        $data = [
            'inti' => [
                'title' => 'INTI HIMAFI',
                'description' => 'Lebih dari sekadar pemimpin, Pengurus Inti adalah rumah bagi setiap aspirasi mahasiswa Fisika. Kami hadir untuk mendengar, merangkul, dan menggali setiap potensi yang ada. Tugas kami adalah memastikan HIMAFI bukan hanya menjadi tempat berorganisasi, tapi juga menjadi keluarga yang hangat dan suportif bagi semua.',
                'members' => [
                    [
                        'image' => 'img/public/fungsionaris/inti/ketua.png',
                        'name' => 'MAHENDRA',
                        'position' => 'Ketua HIMAFI',
                        'size' => 'large'
                    ],
                    [
                        'image' => 'img/public/fungsionaris/inti/wakil.png',
                        'name' => 'FADHIL',
                        'position' => 'Wakil Ketua<br>HIMAFI',
                        'size' => 'large'
                    ],
                    [
                        'image' => 'img/public/fungsionaris/inti/sekre1.png',
                        'name' => 'ANA',
                        'position' => 'Sekretaris I<br>HIMAFI',
                        'size' => 'medium'
                    ],
                    [
                        'image' => 'img/public/fungsionaris/inti/sekre2.png',
                        'name' => 'RESTI',
                        'position' => 'Sekretaris II<br>HIMAFI',
                        'size' => 'medium'
                    ],
                    [
                        'image' => 'img/public/fungsionaris/inti/benda1.png',
                        'name' => 'DION',
                        'position' => 'Bendahara I<br>HIMAFI',
                        'size' => 'medium'
                    ],
                    [
                        'image' => 'img/public/fungsionaris/inti/benda2.png',
                        'name' => 'SASA',
                        'position' => 'Bendahara II<br>HIMAFI',
                        'size' => 'medium'
                    ],
                ]
            ],
            'bidang' => [
                [
                    'title' => 'BIDANG KEROHANIAN',
                    'description' => 'Benteng moral HIMAFI. Bidang ini bertanggung jawab membangun karakter mahasiswa yang tidak hanya unggul dalam akademis, tetapi juga luhur dalam budi pekerti. Melalui syiar kebaikan dan penanaman nilai religius, kami berupaya mencetak fisikawan muda yang beretika dan bertakwa.',
                    'color' => 'blue-600',
                    'members' => [
                        [
                            'image' => 'img/public/fungsionaris/bidang1/kepala.png',
                            'name' => 'YUNI',
                            'position' => 'Kepala Bidang 1',
                            'size' => 'large'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang1/wakil.png',
                            'name' => 'HAYA',
                            'position' => 'Wakil Kepala<br>Bidang 1',
                            'size' => 'large'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang1/anggota1.png',
                            'name' => 'Valen',
                            'position' => 'Anggota Bidang 1',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang1/anggota2.png',
                            'name' => 'Ghaniel',
                            'position' => 'Anggota Bidang 1',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang1/anggota3.png',
                            'name' => 'Fina',
                            'position' => 'Anggota Bidang 1',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang1/anggota4.png',
                            'name' => 'Satya',
                            'position' => 'Anggota Bidang 1',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang1/anggota5.png',
                            'name' => 'Desy',
                            'position' => 'Anggota Bidang 1',
                            'size' => 'medium'
                        ],
                        
                    ]
                ],
                [
                    'title' => 'BIDANG PENDIDIKAN DAN INOVASI',
                    'description' => 'Bertanggung jawab dalam eskalasi potensi akademik dan budaya ilmiah di lingkungan Fisika. Kami berkomitmen menciptakan atmosfer belajar yang kondusif melalui mentoring sebaya, serta mendorong semangat kompetisi mahasiswa di ajang perlombaan dan penelitian. Visi kami adalah mencetak fisikawan muda yang unggul secara kognitif dan adaptif terhadap perkembangan zaman.',
                    'color' => 'blue-600',
                    'members' => [
                        [
                            'image' => 'img/public/fungsionaris/bidang2/ketua.png',
                            'name' => 'Aisyah',
                            'position' => 'Kepala Bidang 2',
                            'size' => 'large'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang2/wakabid.png',
                            'name' => 'Nabila',
                            'position' => 'Wakil Kepala<br>Bidang 2',
                            'size' => 'large'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang2/anggota1.png',
                            'name' => 'Ari Widya',
                            'position' => 'Anggota Bidang 2',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang2/anggota2.png',
                            'name' => 'Parama Nandana',
                            'position' => 'Anggota Bidang 2',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang2/anggota3.png',
                            'name' => 'Hairul',
                            'position' => 'Anggota Bidang 2',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang2/anggota4.png',
                            'name' => 'Desak',
                            'position' => 'Anggota Bidang 2',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang2/anggota5.png',
                            'name' => 'Happy',
                            'position' => 'Anggota Bidang 2',
                            'size' => 'medium'
                        ],
                    ]
                ],
                [
                    'title' => 'BIDANG MINAT DAN BAKAT',
                    'description' => 'Berdedikasi untuk menggali dan memfasilitasi potensi mahasiswa di luar ruang kuliah. Bidang ini bertanggung jawab mengelola klub hobi, komunitas olahraga, dan delegasi seni. Visi kami adalah mencetak mahasiswa yang well-rounded: cerdas secara intelektual, sehat secara fisik, dan peka secara artistik.',
                    'color' => 'blue-600',
                    'members' => [
                        [
                            'image' => 'img/public/fungsionaris/bidang3/ketua.png',
                            'name' => 'Alvi',
                            'position' => 'Kepala Bidang 3',
                            'size' => 'large'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang3/wakil.png',
                            'name' => 'Ribka',
                            'position' => 'Wakil Kepala<br>Bidang 3',
                            'size' => 'large'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang3/anggota1.png',
                            'name' => 'Tobi',
                            'position' => 'Anggota Bidang 3',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang3/anggota2.png',
                            'name' => 'Torik',
                            'position' => 'Anggota Bidang 3',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang3/anggota3.png',
                            'name' => 'Desika',
                            'position' => 'Anggota Bidang 3',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang3/anggota4.png',
                            'name' => 'Ade Rasya',
                            'position' => 'Anggota Bidang 3',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang3/anggota5.png',
                            'name' => 'Gita Saraswati',
                            'position' => 'Anggota Bidang 3',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang3/anggota6.png',
                            'name' => 'Desta Dwiyana',
                            'position' => 'Anggota Bidang 3',
                            'size' => 'medium'
                        ],
                    ]
                ],
                [
                    'title' => 'BIDANG ADVOKASI DAN PENGEMBANGAN SUMBER DAYA MAHASISWA',
                    'description' => 'Bidang ini mensinergikan fungsi pelayanan dan pendidikan karakter. Kami berdiri di garis depan untuk memperjuangkan setiap aspirasi dan kenyamanan mahasiswa, sekaligus menjadi mentor yang mendampingi proses pendewasaan diri. Tugas kami adalah merawat tunas (kaderisasi) dan menjaga tanahnya agar tetap subur (advokasi).',
                    'color' => 'blue-600',
                    'members' => [
                        [
                            'image' => 'img/public/fungsionaris/bidang4/kepala.png',
                            'name' => 'Abel',
                            'position' => 'Kepala Bidang 4',
                            'size' => 'large'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang4/wakil.png',
                            'name' => 'Harva',
                            'position' => 'Wakil Kepala<br>Bidang 4',
                            'size' => 'large'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang4/anggota1.png',
                            'name' => 'Abdullah',
                            'position' => 'Anggota Bidang 4',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang4/anggota2.png',
                            'name' => 'Amelia',
                            'position' => 'Anggota Bidang 4',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang4/anggota3.png',
                            'name' => 'Maria Gracella',
                            'position' => 'Anggota Bidang 4',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang4/anggota4.png',
                            'name' => 'Mei Alvred',
                            'position' => 'Anggota Bidang 4',
                            'size' => 'medium'
                        ],
                    ]
                ],
                [
                    'title' => 'BIDANG PENGABDIAN MASYARAKAT',
                    'description' => 'Bertanggung jawab penuh dalam merealisasikan dharma ketiga perguruan tinggi: Pengabdian kepada Masyarakat. Kami merancang program yang berkelanjutan untuk memberdayakan masyarakat dan meningkatkan taraf hidup melalui pendekatan saintifik. Visi kami adalah menghadirkan HIMAFI sebagai organisasi yang inklusif, peka sosial, dan berdampak positif bagi lingkungan luas.',
                    'color' => 'blue-600',
                    'members' => [
                        [
                            'image' => 'img/public/fungsionaris/bidang5/kepala.png',
                            'name' => 'Widnyana',
                            'position' => 'Kepala Bidang 5',
                            'size' => 'large'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang5/wakil.png',
                            'name' => 'Sisil',
                            'position' => 'Wakil Kepala<br>Bidang 5',
                            'size' => 'large'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang5/anggota1.png',
                            'name' => 'Rama',
                            'position' => 'Anggota Bidang 5',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang5/anggota2.png',
                            'name' => 'Bintang Meilan',
                            'position' => 'Anggota Bidang 5',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang5/anggota3.png',
                            'name' => 'Nadin',
                            'position' => 'Anggota Bidang 5',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang5/anggota4.png',
                            'name' => 'Weda nanda',
                            'position' => 'Anggota Bidang 5',
                            'size' => 'medium'
                        ],
                    ]
                ],
                [
                    'title' => 'BIDANG EKONOMI KREATIF',
                    'description' => 'Membangun kemandirian HIMAFI melalui kekuatan ide dan kreativitas. Kami tidak hanya berfokus pada pencarian dana, tetapi juga membangun ekosistem kewirausahaan bagi mahasiswa. Dengan mengelola official merchandise, kemitraan strategis, dan proyek kreatif, kami bertujuan menciptakan stabilitas finansial sekaligus menjadi wadah belajar bisnis yang nyata bagi fisikawan muda.',
                    'color' => 'blue-600',
                    'members' => [
                        [
                            'image' => 'img/public/fungsionaris/bidang6/kepala.png',
                            'name' => 'Raka',
                            'position' => 'Kepala Bidang 6',
                            'size' => 'large'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang6/wakil.png',
                            'name' => 'Lidya',
                            'position' => 'Wakil Kepala<br>Bidang 6',
                            'size' => 'large'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang6/anggota1.png',
                            'name' => 'Siska',
                            'position' => 'Anggota Bidang 6',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang6/anggota2.png',
                            'name' => 'Jelita',
                            'position' => 'Anggota Bidang 6',
                            'size' => 'medium'
                        ],
                        [
                            'image' => 'img/public/fungsionaris/bidang6/anggota3.png',
                            'name' => 'Fina',
                            'position' => 'Anggota Bidang 6',
                            'size' => 'medium'
                        ],
                    ]
                ],
            ]
        ];

        return view('pages.fungsionaris', [
            'inti' => $data['inti'],
            'bidang' => $data['bidang'],
            'activePage' => 'divisi'
        ]);}}