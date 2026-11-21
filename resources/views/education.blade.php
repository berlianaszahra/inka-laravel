<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pusat Edukasi HKI | INKA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fff9ef] font-sans text-[#493627]">
    @php
        $lessons = [
            'dasar-hki' => [
                'title' => 'Mengenal Kekayaan Intelektual',
                'intro' => 'Pahami jenis HKI dan manfaatnya bagi karya serta bisnis kreatif.',
                'concept' => 'Hak Kekayaan Intelektual atau HKI berkaitan dengan hasil olah pikir manusia. Jenis perlindungannya bergantung pada aset yang ingin dilindungi.',
                'points' => [
                    'Merek membantu membedakan barang atau jasa.',
                    'Hak cipta berkaitan dengan karya seperti tulisan, foto, dan ilustrasi.',
                    'Satu usaha bisa memiliki beberapa aset dengan jenis perlindungan berbeda.',
                ],
                'case' => 'Pemilik kedai kopi memiliki nama usaha, ilustrasi kemasan, dan foto produk. Nama usaha membantu pelanggan mengenali kedainya, sedangkan ilustrasi dan foto merupakan karya kreatif.',
                'question' => 'Jenis HKI apa yang berkaitan dengan nama kedai sebagai pembeda barang atau jasa?',
                'choices' => ['Paten', 'Merek', 'Hak cipta', 'Rahasia dagang'],
                'answer' => 1,
                'feedback' => 'Nama usaha yang berfungsi sebagai tanda pembeda berkaitan dengan merek.',
            ],
            'merek' => [
                'title' => 'Perlindungan Merek',
                'intro' => 'Kenali fungsi nama, logo, dan identitas usaha.',
                'concept' => 'Merek adalah tanda yang membantu pelanggan membedakan barang atau jasa suatu usaha dari usaha lain.',
                'points' => [
                    'Nama dan logo dapat berfungsi sebagai tanda pembeda.',
                    'Tentukan barang atau jasa yang memakai merek tersebut.',
                    'Penelusuran merek membantu mengenali potensi kemiripan.',
                ],
                'case' => 'Sebuah UMKM hendak memakai nama baru untuk produk camilannya. Sebelum mencetak kemasan, pemilik usaha ingin tahu apakah ada merek yang mirip untuk produk sejenis.',
                'question' => 'Apa langkah awal yang tepat untuk mengecek potensi kemiripan merek?',
                'choices' => [
                    'Langsung mencetak semua kemasan',
                    'Mengganti warna logo saja',
                    'Menelusuri merek yang sudah ada',
                    'Mengikuti nama pesaing',
                ],
                'answer' => 2,
                'feedback' => 'Penelusuran membantu pemilik usaha mengenali nama yang mirip sebelum menggunakannya.',
            ],
            'hak-cipta' => [
                'title' => 'Hak Cipta atas Karya Kreatif',
                'intro' => 'Kenali perlindungan karya foto, ilustrasi, dan desain.',
                'concept' => 'Hak cipta berkaitan dengan karya kreatif yang memenuhi syarat perlindungan, seperti tulisan, ilustrasi, dan fotografi.',
                'points' => [
                    'Bedakan karya kreatif dan tanda pembeda usaha.',
                    'Periksa izin atau lisensi saat memakai karya orang lain.',
                    'Sepakati penggunaan hasil karya dalam kerja sama kreatif.',
                ],
                'case' => 'Seorang freelancer membuat ilustrasi untuk kemasan klien. Sebelum ilustrasi digunakan, keduanya mendiskusikan apakah desain boleh dipakai ulang untuk produk lain.',
                'question' => 'Apa yang sebaiknya disepakati oleh freelancer dan klien?',
                'choices' => [
                    'Ruang lingkup penggunaan ilustrasi',
                    'Jumlah pengikut akun media sosial',
                    'Warna kemasan pesaing',
                    'Harga semua produk klien',
                ],
                'answer' => 0,
                'feedback' => 'Kesepakatan penggunaan karya membantu kedua pihak memahami di mana dan untuk apa ilustrasi boleh dipakai.',
            ],
        ];

        $lesson = isset($topic) ? $lessons[$topic] : null;
        $steps = ['konsep' => 'Kenali Konsep', 'kasus' => 'Contoh Kasus', 'latihan' => 'Latihan Singkat'];
        $home = auth()->check() ? route('dashboard') : url('/');
        $primary = 'inline-flex items-center justify-center rounded-xl bg-[#315b37] px-5 py-3 font-bold text-white hover:bg-[#284a2d]';
        $secondary = 'inline-flex items-center justify-center rounded-xl border border-[#ddd2c3] bg-white px-5 py-3 font-bold text-[#315b37] hover:border-[#315b37]';
    @endphp

    <div class="mx-auto max-w-[1334px] px-5 py-7 sm:px-8">
        <header class="flex min-h-[72px] flex-wrap items-center justify-between gap-4">
            <a href="{{ $home }}" class="flex items-center gap-2 text-[30px] font-bold">
                <img src="{{ asset('images/inka/education/leaf.svg') }}" alt="">
                INKA.
            </a>

            <nav aria-label="Navigasi utama" class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm font-semibold sm:text-base">
                <a href="{{ $home }}" class="hover:underline">Beranda</a>
                <a href="{{ route('education.index') }}" class="font-bold text-[#315b37] hover:underline">Edukasi HKI</a>
                <a href="{{ $home }}#kalkulator-hpp" class="hover:underline">Kalkulator HPP</a>
                <a href="{{ route('quiz.index') }}" class="hover:underline">Kuis</a>
                <a href="{{ auth()->check() ? route('profile.show') : route('login') }}" class="hover:underline">
                    {{ auth()->check() ? 'Profil' : 'Masuk' }}
                </a>
            </nav>
        </header>

        <main class="mt-6">
            @if (!$lesson)
                <section class="rounded-[22px] bg-[#dce8cc] p-6 sm:p-8">
                    <p class="inline-block rounded-full bg-[#f4c84e] px-3 py-2 text-xs font-bold text-[#315b37]">
                        PUSAT EDUKASI HKI
                    </p>
                    <h1 class="mt-4 text-3xl leading-tight font-bold sm:text-[36px]">
                        Kreativitasmu punya nilai. Yuk, lindungi!
                    </h1>
                    <p class="mt-3 text-lg text-[#756a5b]">
                        Pelajari konsep HKI lewat materi singkat, studi kasus UMKM, dan latihan interaktif.
                    </p>
                </section>

                <section aria-label="Ringkasan materi" class="mt-6 grid gap-4 sm:grid-cols-3">
                    @foreach ([
                        [count($lessons), 'Topik pembelajaran'],
                        [count($steps), 'Tahap per materi'],
                        ['5–10 menit', 'Estimasi per materi'],
                    ] as [$value, $label])
                        <div class="rounded-2xl bg-white p-5">
                            <p class="text-[28px] font-bold text-[#315b37]">{{ $value }}</p>
                            <p class="mt-1 text-[#756a5b]">{{ $label }}</p>
                        </div>
                    @endforeach
                </section>

                <section class="mt-7" aria-labelledby="lesson-list-title">
                    <h2 id="lesson-list-title" class="text-[28px] font-bold">Mau belajar tentang apa hari ini?</h2>
                    <p class="mt-1 text-[#756a5b]">Pilih topik yang relevan dengan karya atau usahamu.</p>

                    <div class="mt-6 grid gap-5 md:grid-cols-3">
                        @foreach ($lessons as $slug => $item)
                            <article class="flex flex-col items-start rounded-2xl p-6 {{ $loop->iteration === 2 ? 'bg-[#f9e7ad]' : 'bg-white' }}">
                                <p class="rounded-full bg-[#dce8cc] px-3 py-2 text-xs font-bold text-[#315b37]">
                                    MATERI {{ sprintf('%02d', $loop->iteration) }}
                                </p>
                                <h3 class="mt-4 text-[23px] leading-tight font-bold">{{ $item['title'] }}</h3>
                                <p class="mt-3 mb-5 text-[#756a5b]">{{ $item['intro'] }}</p>
                                <a href="{{ route('education.lesson', ['topic' => $slug]) }}" class="{{ $primary }} mt-auto">
                                    {{ $loop->first ? 'Mulai Belajar' : 'Pilih Materi' }} →
                                </a>
                            </article>
                        @endforeach
                    </div>
                </section>
            @else
                @php
                    $position = array_search($step, array_keys($steps), true) + 1;
                @endphp

                <a href="{{ route('education.index') }}" class="font-bold text-[#315b37] hover:underline">
                    ← Pusat Edukasi
                </a>
                <h1 class="mt-4 text-3xl leading-tight font-bold sm:text-[36px]">{{ $lesson['title'] }}</h1>
                <p class="mt-2 text-[#756a5b]">{{ $lesson['intro'] }}</p>

                <div class="mt-6 flex items-center justify-between gap-3 text-sm font-bold text-[#315b37]">
                    <span>{{ $steps[$step] }}</span>
                    <span>Langkah {{ $position }} dari {{ count($steps) }}</span>
                </div>
                <div role="progressbar" aria-label="Tahap materi" aria-valuemin="0"
                    aria-valuemax="{{ count($steps) }}" aria-valuenow="{{ $position }}"
                    class="mt-3 h-2.5 overflow-hidden rounded-full bg-[#dce8cc]">
                    <div class="h-full rounded-full bg-[#315b37]" style="width: {{ $position / count($steps) * 100 }}%"></div>
                </div>

                <nav aria-label="Tahapan materi" class="mt-3 grid gap-2 sm:grid-cols-3">
                    @foreach ($steps as $slug => $label)
                        <a href="{{ route('education.lesson', ['topic' => $topic, 'step' => $slug]) }}"
                            @if ($step === $slug) aria-current="step" @endif
                            class="rounded-xl px-4 py-3 font-semibold {{ $step === $slug ? 'bg-[#315b37] text-white' : 'bg-[#dce8cc] text-[#315b37]' }}">
                            {{ sprintf('%02d', $loop->iteration) }} &nbsp; {{ $label }}
                        </a>
                    @endforeach
                </nav>

                <div class="mt-6 grid items-center gap-5 lg:grid-cols-[minmax(0,1.7fr)_minmax(0,1fr)]">
                    <article class="rounded-[22px] bg-white p-6 sm:p-8">
                        @if ($step === 'konsep')
                            <h2 class="text-2xl font-bold">Kenali konsep dasar</h2>
                            <p class="mt-4 text-lg text-[#756a5b]">{{ $lesson['concept'] }}</p>

                            <div class="mt-5 rounded-2xl bg-[#dce8cc] p-5">
                                <h3 class="text-xl font-bold">Tiga hal yang perlu diingat</h3>
                                <ul class="mt-3 list-disc space-y-2 pl-5">
                                    @foreach ($lesson['points'] as $point)
                                        <li>{{ $point }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif ($step === 'kasus')
                            <h2 class="text-2xl font-bold">Contoh dekat dengan usahamu</h2>
                            <p class="mt-4 text-lg leading-relaxed text-[#756a5b]">{{ $lesson['case'] }}</p>
                        @else
                            <form id="education-exercise" data-answer="{{ $lesson['answer'] }}">
                                <fieldset>
                                    <legend class="text-2xl font-bold">{{ $lesson['question'] }}</legend>

                                    <div class="mt-5 grid gap-3">
                                        @foreach ($lesson['choices'] as $index => $choice)
                                            <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-[#ddd2c3] p-4 has-[:checked]:border-[#315b37] has-[:checked]:bg-[#edf3e3]">
                                                <input type="radio" name="answer" value="{{ $index }}" required class="accent-[#315b37]">
                                                <span>{{ $choice }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </fieldset>

                                <button type="submit" class="{{ $primary }} mt-5">Cek Jawaban →</button>

                                <div id="education-feedback" role="status" hidden class="mt-5 rounded-xl bg-[#dce8cc] p-4">
                                    <p id="feedback-title" class="font-bold text-[#315b37]"></p>
                                    <p class="mt-2">{{ $lesson['feedback'] }}</p>
                                </div>
                            </form>
                        @endif
                    </article>

                    <aside class="rounded-[22px] bg-[#f9e7ad] p-6">
                        <h2 class="text-xl font-bold">Coba hubungkan dengan usahamu</h2>
                        <p class="mt-3 text-[#756a5b]">
                            Pilih satu aset yang kamu punya, seperti nama usaha, foto produk, atau ilustrasi.
                            Pikirkan jenis perlindungan yang relevan dengan aset itu.
                        </p>
                    </aside>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    @if ($step === 'konsep')
                        <a href="{{ route('education.index') }}" class="{{ $secondary }}">← Kembali ke Topik</a>
                        <a href="{{ route('education.lesson', ['topic' => $topic, 'step' => 'kasus']) }}" class="{{ $primary }}">
                            Lanjut ke Contoh Kasus →
                        </a>
                    @elseif ($step === 'kasus')
                        <a href="{{ route('education.lesson', ['topic' => $topic]) }}" class="{{ $secondary }}">← Kembali ke Konsep</a>
                        <a href="{{ route('education.lesson', ['topic' => $topic, 'step' => 'latihan']) }}" class="{{ $primary }}">
                            Lanjut ke Latihan →
                        </a>
                    @else
                        <a href="{{ route('education.lesson', ['topic' => $topic, 'step' => 'kasus']) }}" class="{{ $secondary }}">
                            ← Kembali ke Contoh Kasus
                        </a>
                        <a href="{{ route('education.index') }}" class="{{ $primary }}">Pilih Materi Lain →</a>
                    @endif
                </div>
            @endif
        </main>

        <footer class="mt-8 flex flex-wrap justify-between gap-3 text-sm text-[#756a5b]">
            <p>© 2026 INKA · Edukasi HKI untuk UMKM dan kreator</p>
            <a href="{{ route('faq.index') }}" class="font-semibold text-[#315b37] hover:underline">Pusat Bantuan</a>
        </footer>
    </div>

    @if ($lesson && $step === 'latihan')
        <script>
            const exercise = document.querySelector('#education-exercise');
            const feedback = document.querySelector('#education-feedback');
            const feedbackTitle = document.querySelector('#feedback-title');

            exercise.addEventListener('change', () => {
                feedback.hidden = true;
            });

            exercise.addEventListener('submit', (event) => {
                event.preventDefault();

                const selected = new FormData(exercise).get('answer');
                feedbackTitle.textContent = selected === exercise.dataset.answer
                    ? 'Jawaban tepat!'
                    : 'Belum tepat. Coba lagi.';
                feedback.hidden = false;
            });
        </script>
    @endif
</body>
</html>