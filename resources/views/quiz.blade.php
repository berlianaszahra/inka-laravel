<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kuis HAKI & HPP | INKA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .inka-quiz {
            width: min(1260px, calc(100% - 40px));
            margin-inline: auto;
            padding: 27px 0 30px;
            font-family: Inter, "Instrument Sans", Arial, sans-serif;
        }

        .inka-quiz[data-quiz-screen="kategori"] { max-width: 1270px; }
        .inka-quiz[data-quiz-screen="soal"] { max-width: 1250px; }

        .inka-quiz > header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .inka-quiz > main { margin-top: 28px; }
        .inka-quiz[data-quiz-screen="soal"] > main { margin-top: 25px; }
        .inka-quiz .quiz-footer { margin-top: 24px; }

        .quiz-progress-track {
            height: 10px;
            margin-top: 24px;
            margin-right: 20px;
            overflow: hidden;
            border-radius: 999px;
            background: #e3e2d8;
        }

        .quiz-progress-fill {
            display: block;
            height: 100%;
            border-radius: inherit;
            background: #315b37;
        }

        #question-form {
            display: grid;
            gap: 18px;
            margin-top: 24px;
            padding: 30px;
            border-radius: 20px;
            background: #fff;
        }

        #question-form[hidden], #quiz-result[hidden], #quiz-review[hidden], #quiz-position[hidden] {
            display: none;
        }

        #question-number { margin: 0; font-weight: 700; color: #315b37; }
        #question-title { margin: 0; font-size: clamp(26px, 3vw, 34px); line-height: 1.2; }
        #question-form fieldset { margin: 0; min-width: 0; }
        #question-form legend { color: #76695a; font-size: 19px; }

        #question-options {
            display: grid;
            gap: 18px;
            margin-top: 18px;
        }

        .quiz-choice {
            position: relative;
            display: flex;
            min-height: 77px;
            align-items: center;
            gap: 18px;
            padding: 13px 17px;
            border: 1.5px solid #ddd1c2;
            border-radius: 13px;
            background: #fff;
            cursor: pointer;
            font-size: 21px;
            line-height: 1.3;
        }

        .quiz-choice input {
            position: absolute;
            width: 1px;
            height: 1px;
            opacity: 0;
        }

        .quiz-choice-letter {
            display: grid;
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            place-items: center;
            border-radius: 10px;
            background: #dce8cc;
            color: #315b37;
            font-weight: 700;
        }

        .quiz-choice:hover { background: #fff9ef; }

        .quiz-choice:has(input:checked) {
            border-color: #315b37;
            background: #edf3e3;
            box-shadow: inset 0 0 0 1px #315b37;
            font-weight: 600;
        }

        .quiz-choice input:checked + .quiz-choice-letter {
            background: #315b37;
            color: #fff;
        }

        .quiz-choice:has(input:focus-visible) {
            outline: 2px solid #315b37;
            outline-offset: 3px;
        }

        .quiz-actions {
            display: grid;
            grid-template-columns: minmax(0, 245px) 1fr minmax(0, 280px);
            align-items: center;
            gap: 16px;
        }

        .quiz-actions > p { display: block; text-align: center; color: #76695a; }
        .quiz-actions > button { min-height: 60px; width: 100%; font-size: 19px; }
        .quiz-actions > button:disabled { opacity: .5; cursor: default; }

        .quiz-result-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(270px, 395px);
            gap: 28px;
        }

        .quiz-result-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
            margin-top: 30px;
        }

        @media (max-width: 700px) {
            .inka-quiz { width: calc(100% - 32px); }
            #question-form { padding: 20px; }
            .quiz-choice { min-height: 66px; font-size: 17px; gap: 12px; }
            .quiz-actions { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
            .quiz-actions > p { display: none; }
            .quiz-actions > button { font-size: 16px; }
            .quiz-result-hero, .quiz-result-stats { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body class="min-h-screen bg-[#fff9ef] font-sans text-[#493627]">
    @php
        $icon = fn ($file) => asset("images/inka/quiz/{$file}.svg");

        $categories = [
            'haki' => [
                'label' => 'HAKI',
                'intro' => 'Dasar HKI, perlindungan merek, dan hak cipta bagi kreator.',
                'heading' => 'Kenali hak di balik setiap karya.',
                'description' => 'Mulai dari pengertian HKI, merek, hingga hak cipta. Tiap topik dilengkapi materi ringkas.',
                'icon' => '40ce0',
                'topic_icon' => 'topic-haki',
                'color' => 'bg-[#dce8cc]',
                'topics' => [
                    [
                        'Dasar-Dasar HKI',
                        'Jenis hak kekayaan intelektual dan manfaat perlindungannya.',
                        'HKI mencakup beberapa jenis hak, seperti merek dan hak cipta. Mulai dengan mengenali apa yang ingin kamu lindungi, misalnya nama usaha, logo, tulisan, atau karya visual.',
                    ],
                    [
                        'Merek untuk UMKM',
                        'Fungsi merek, kelas barang atau jasa, dan identitas usaha.',
                        'Merek membantu pelanggan membedakan barang atau jasa satu usaha dari usaha lain. Saat menyiapkan pendaftaran, tentukan merek dan kelompok barang atau jasa yang relevan.',
                    ],
                    [
                        'Hak Cipta bagi Kreator',
                        'Karya yang dilindungi dan hak pencipta.',
                        'Hak cipta berkaitan dengan karya seperti tulisan, ilustrasi, dan fotografi. Saat memakai karya orang lain, cek izin dan ketentuan penggunaannya.',
                    ],
                ],
            ],
            'hpp' => [
                'label' => 'HPP',
                'intro' => 'Komponen produksi, menghitung HPP, dan contoh biaya jasa kreatif.',
                'heading' => 'Pahami biaya, tetapkan harga lebih bijak.',
                'description' => 'Pelajari komponen biaya produksi dan perhitungan HPP melalui contoh usaha dan pekerjaan kreatif.',
                'icon' => 'bb910',
                'topic_icon' => 'topic-hpp',
                'color' => 'bg-[#f8e6b2]',
                'topics' => [
                    [
                        'Komponen HPP',
                        'Biaya bahan baku, tenaga kerja, dan overhead.',
                        'Total biaya produksi mencakup bahan baku, tenaga kerja langsung, dan overhead produksi. Catat ketiganya agar biaya seperti listrik produksi ikut diperhitungkan.',
                    ],
                    [
                        'Perhitungan HPP',
                        'Menghitung HPP per unit dari total biaya produksi.',
                        'Bagi total biaya produksi dengan jumlah unit yang dihasilkan. Jika total biaya Rp450.000 dan hasilnya 50 unit, HPP per unit adalah Rp9.000.',
                    ],
                    [
                        'HPP Jasa Kreatif',
                        'Menghitung biaya waktu, operasional, dan revisi jasa desain.',
                        'Perkirakan waktu kerja dan biaya langsung untuk menyelesaikan satu proyek. Masukkan biaya operasional yang relevan dan waktu revisi sesuai lingkup pekerjaan.',
                    ],
                ],
            ],
        ];

        $selected = $categories[$category ?? ''] ?? null;
        $screen = $stage ?? ($selected ? 'submateri' : 'kategori');
        $firstName = \Illuminate\Support\Str::before(trim(auth()->user()->name), ' ');
    @endphp

    <div class="inka-quiz" data-quiz-screen="{{ $screen }}">
        <header class="flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-[10px] text-[30px] font-bold">
                <img src="{{ $icon($selected ? 'subtopics-brand' : '894e7') }}" alt="">
                INKA.
            </a>

            @if ($screen === 'soal')
                <a id="quiz-header-context" href="{{ route('quiz.category', ['category' => $category]) }}"
                    class="font-semibold text-[#315b37] hover:underline">
                    Kuis {{ $selected['label'] }} &nbsp;/&nbsp; {{ $firstName }}
                </a>
            @elseif ($selected)
                <nav aria-label="Navigasi kuis" class="flex flex-wrap items-center gap-x-6 gap-y-2 font-semibold">
                    <a href="{{ route('dashboard') }}" class="hover:underline">Beranda</a>
                    <a href="{{ route('dashboard') }}#edukasi-hki" class="hover:underline">Edukasi HKI</a>
                    <a href="{{ route('dashboard') }}#kalkulator-hpp" class="hover:underline">Kalkulator HPP</a>
                    <a href="{{ route('quiz.index') }}" class="font-bold text-[#315b37] hover:underline">Kuis</a>
                    <a href="{{ route('profile.show') }}" class="hover:underline">Profil</a>
                </nav>

                <a href="{{ route('profile.show') }}"
                    class="rounded-full bg-[#f4c84e] px-4 py-2 text-sm font-bold uppercase">
                    {{ \Illuminate\Support\Str::before(trim(auth()->user()->name), ' ') }}
                </a>
            @else
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-[10px] font-bold text-[#315b37] hover:underline sm:text-[19px]">
                    <img src="{{ $icon('b61f6') }}" alt="">
                    Kembali ke Dashboard
                </a>
            @endif
        </header>

        <main class="mt-[29px]">
            @if (isset($stage))
                @include('quiz-lesson')
            @elseif (!$selected)
                <section aria-labelledby="quiz-title"
                    class="flex flex-col gap-6 rounded-[22px] bg-[#f9e8ae] p-6 sm:flex-row sm:items-center sm:p-[30px]">
                    <div class="grid size-[92px] shrink-0 place-items-center rounded-[20px] bg-white">
                        <img src="{{ $icon('1ea2a') }}" alt="">
                    </div>
                    <div>
                        <p class="font-bold text-[#315b37]">FITUR INKA</p>
                        <h1 id="quiz-title" class="mt-1 text-[37px] leading-tight font-bold sm:text-[47px]">
                            Kuis HAKI & HPP
                        </h1>
                        <p class="mt-2 text-lg text-[#756a5b] sm:text-[21px]">
                            Latihan sepuluh soal dengan materi ringkas dan tinjauan jawaban.
                        </p>
                    </div>
                </section>

                <div class="mx-auto mt-[29px] grid max-w-[1120px] gap-5 md:grid-cols-2">
                    @foreach ($categories as $key => $item)
                        <article class="flex flex-col items-start rounded-[19px] p-[26px] {{ $item['color'] }}">
                            <img src="{{ $icon($item['icon']) }}" alt="">
                            <h2 class="mt-4 text-[32px] leading-tight font-bold">Kuis {{ $item['label'] }}</h2>
                            <p class="mt-3 text-lg leading-snug text-[#756a5b]">{{ $item['intro'] }}</p>
                            <p class="mt-5 mb-5 px-3 text-sm font-bold text-[#315b37]">10 SOAL / KATEGORI</p>

                            <a href="{{ route('quiz.category', ['category' => $key]) }}"
                                class="mt-auto inline-flex min-h-[60px] w-full items-center justify-center gap-3 rounded-xl bg-[#315b37] px-6 text-lg font-bold text-white hover:bg-[#284a2d] sm:w-[235px]">
                                Pilih {{ $item['label'] }}
                                <img src="{{ $icon('39d05') }}" alt="">
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <section aria-labelledby="quiz-title">
                    <p class="font-bold text-[#315b37]">DAFTAR SUBMATERI / {{ $selected['label'] }}</p>
                    <h1 id="quiz-title" class="mt-3 text-[36px] leading-tight font-bold sm:text-[48px]">
                        {{ $selected['heading'] }}
                    </h1>
                    <p class="mt-3 text-lg text-[#756a5b] sm:text-[21px]">{{ $selected['description'] }}</p>

                    <div class="mt-8 grid max-w-[1170px] gap-6 md:grid-cols-3">
                        @foreach ($selected['topics'] as [$title, $description])
                            <article class="flex flex-col rounded-[20px] bg-white p-6">
                                <div class="flex items-center justify-between gap-3">
                                    <p class="rounded-full px-4 py-2 text-sm font-bold text-[#315b37] {{ $loop->iteration === 2 ? 'bg-[#dce8cc]' : 'bg-[#f8e6b2]' }}">
                                        0{{ $loop->iteration }} / {{ $selected['label'] }}
                                    </p>
                                    <img src="{{ $icon($selected['topic_icon']) }}" alt="">
                                </div>

                                <h2 class="mt-5 text-[27px] leading-tight font-bold">{{ $title }}</h2>
                                <p class="mt-4 mb-5 text-lg leading-snug text-[#756a5b]">{{ $description }}</p>

                                <div class="mt-auto mb-4 flex flex-wrap justify-between gap-3">
                                    <span class="font-bold text-[#315b37]">10 soal kategori</span>
                                    <span class="text-[#756a5b]">± 8 menit</span>
                                </div>

                                <a href="{{ route('quiz.material', ['category' => $category, 'topic' => $loop->iteration]) }}"
                                    class="inline-flex min-h-[62px] items-center justify-center rounded-xl bg-[#315b37] px-5 text-lg font-bold text-white hover:bg-[#284a2d]">
                                    Baca Materi
                                </a>
                            </article>
                        @endforeach
                    </div>

                    <p class="mt-10 flex items-center gap-3 text-lg font-semibold text-[#315b37]">
                        <img src="{{ $icon('topic-book') }}" alt="">
                        Pilih submateri, pahami poin penting, lalu kerjakan 10 pertanyaan.
                    </p>
                </section>
            @endif
        </main>

        <footer class="quiz-footer mt-[29px] flex flex-wrap justify-between gap-3 text-sm text-[#756a5b]">
            <p>© 2026 INKA{{ $screen === 'soal' ? '' : ($selected ? ' · Belajar HKI dan HPP dengan percaya diri' : ' · Dashboard pengguna') }}</p>

            @if ($screen === 'soal')
                <p>Pembelajaran dan evaluasi</p>
            @elseif ($selected)
                <div class="flex gap-3">
                    <a href="{{ route('dashboard') }}#bantuan" class="hover:underline">Pusat Bantuan</a>
                    <span aria-hidden="true">/</span>
                    <a href="{{ route('profile.show') }}" class="hover:underline">Profil</a>
                </div>
            @endif
        </footer>
    </div>
</body>
</html>