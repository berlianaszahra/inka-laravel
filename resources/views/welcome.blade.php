<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INKA | Belajar HKI dan HPP</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fff9ef] font-[Inter,Arial,sans-serif] text-[#493627]">
    @php
        $navigation = [
            ['Edukasi HKI', '#edukasi-hki'],
            ['Panduan HKI', '#panduan-hki'],
            ['Kalkulator HPP', '#kalkulator-hpp'],
            ['Kuis', '#kuis'],
            ['Bantuan', '#bantuan'],
        ];

        $challenges = [
            ['Karya mudah ditiru', 'Kurangnya pemahaman HKI dapat menghambat perlindungan merek dan karya kreatif.', '422f9', 'bg-[#e8efd9]'],
            ['Harga terlalu rendah', 'Biaya produksi yang tidak dihitung dengan baik bisa membuat usaha mengalami kerugian.', '8f2f2', 'bg-[#f9e7ad]'],
            ['Materi terasa rumit', 'Istilah hukum dan finansial sulit dipahami tanpa contoh yang dekat dengan kegiatan UMKM.', '4c7f8', 'bg-[#efe5d6]'],
        ];

        $features = [
            ['edukasi-hki', 'Pusat Edukasi HKI', 'Penjelasan merek, hak cipta, artikel, dan FAQ seputar kekayaan intelektual.', 'adb3c', 'bg-[#e8efd9]'],
            ['kalkulator-hpp', 'Kalkulator HPP', 'Hitung bahan baku, tenaga kerja, overhead, dan biaya per produk.', 'b4509', 'bg-[#f9e7ad]'],
            ['panduan-hki', 'Panduan Pengurusan HKI', 'Persiapan dokumen, checklist usaha, dan akses ke layanan resmi.', '2c4f3', 'bg-[#efe5d6]'],
            ['fitur-kuis', 'Kuis HAKI & HPP', 'Pelajari submateri, jawab 10 soal, lihat pembahasan, dan ulangi.', '03336', 'bg-[#efe5d6]'],
            ['laporan-hpp', 'Riwayat & Laporan HPP', 'Simpan hasil, bandingkan biaya, dan unduh laporan perhitungan.', '91dc9', 'bg-[#e8efd9]'],
            ['pusat-bantuan', 'Pusat Bantuan', 'Temukan jawaban melalui FAQ atau kirim pertanyaan dan masukan.', '997de', 'bg-[#f9e7ad]'],
        ];

        $quizSteps = [
            ['Pilih submateri', 'HAKI atau HPP'],
            ['Baca ringkasan', 'Pahami konsep inti'],
            ['Kerjakan 10 soal', 'Lihat progres soal'],
            ['Hasil & ulangi', 'Nilai dan pembahasan'],
        ];

        $gettingStarted = [
            ['Buat akun', 'Daftar dan masuk ke ruang belajar INKA.'],
            ['Pilih fitur', 'Pelajari HKI, gunakan kalkulator, atau buka panduan.'],
            ['Latihan & evaluasi', 'Kerjakan kuis, lihat nilai, dan coba kembali.'],
        ];

        $faqs = [
            ['Apa itu INKA dan siapa yang bisa menggunakannya?', 'INKA adalah platform edukasi HKI dan HPP untuk pelaku UMKM serta freelancer kreatif, terutama yang baru memulai usaha.'],
            ['Apakah INKA bisa mendaftarkan merek secara langsung?', 'INKA menyediakan materi, daftar persiapan, dan tautan layanan resmi. Pengajuan tetap dilakukan melalui layanan instansi berwenang.'],
            ['Apa yang bisa dihitung dengan Kalkulator HPP?', 'Kamu dapat memasukkan biaya bahan baku, tenaga kerja, overhead, dan jumlah produk untuk mengetahui perkiraan HPP per unit.'],
            ['Apakah hasil perhitungan HPP dapat disimpan?', 'Melalui fitur Riwayat dan Laporan HPP, pengguna dapat melihat perhitungan sebelumnya, membandingkan biaya, dan mengunduh laporan.'],
            ['Bagaimana cara menggunakan kuis HAKI dan HPP?', 'Pilih kategori dan submateri, kerjakan 10 soal, lalu lihat hasil serta pembahasan. Kuis dapat dikerjakan ulang.'],
        ];
    @endphp

    <div class="mx-auto max-w-[1264px] px-5 sm:px-8">
        <header class="flex flex-wrap items-center justify-between gap-x-6 gap-y-4 py-[18px]">
            <a href="{{ url('/') }}" class="text-[32px] font-bold tracking-tight">INKA.</a>

            <nav aria-label="Navigasi utama"
                class="order-last flex w-full flex-wrap gap-x-5 gap-y-2 font-bold lg:order-none lg:w-auto lg:justify-center xl:gap-7 xl:text-[18px]">
                <a href="{{ url('/') }}" aria-current="page" class="text-[#315b37]">Beranda</a>
                @foreach ($navigation as [$label, $href])
                    <a href="{{ $href }}" class="hover:text-[#315b37] hover:underline">{{ $label }}</a>
                @endforeach
            </nav>

            <div class="flex items-center gap-5">
                <a href="{{ route('login') }}" class="text-lg font-bold text-[#315b37] hover:underline">Masuk</a>
                <a href="{{ route('register') }}"
                    class="rounded-xl bg-[#f4c84e] px-5 py-2.5 text-lg font-bold hover:bg-[#eab941]">
                    Daftar
                </a>
            </div>
        </header>

        <main>
            <section aria-labelledby="hero-title" class="flex flex-col items-center gap-5 py-12 text-center sm:py-[54px]">
                <p class="flex items-center justify-center gap-2 text-base font-bold text-[#315b37] sm:text-[19px]">
                    <img src="{{ asset('images/inka/landing/0febc.svg') }}" alt="">
                    Ruang belajar untuk UMKM dan kreator
                    <img src="{{ asset('images/inka/landing/0febc.svg') }}" alt="">
                </p>

                <div class="relative isolate flex h-[400px] w-full max-w-[620px] items-center justify-center sm:h-[426px]" aria-hidden="true">
                    <div class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_center,#b7edc8,transparent_68%)]"></div>

                    <div class="relative h-[350px] w-[230px] -rotate-7 rounded-[35px] border-[7px] border-[#09251f] bg-[#103d35] px-[15px] pt-[48px] text-white shadow-[0_30px_25px_rgba(22,78,67,0.19)]">
                        <div class="absolute top-4 left-1/2 h-[18px] w-20 -translate-x-1/2 rounded-full bg-[#071e1a]"></div>
                        <div class="flex justify-between text-[10px]">
                            <span>9:41</span>
                            <span>•••</span>
                        </div>
                        <p class="mt-3 text-[15px] text-[#a6b8ad]">Halo, Kreator</p>
                        <div class="mt-4 space-y-1 rounded-[17px] bg-[#1d6554] p-[18px]">
                            <p class="text-[10px] text-[#bce7d2]">Total biaya produksi</p>
                            <p class="text-[23px] font-bold">Rp 450.000</p>
                            <p class="text-[10px] text-[#a4edbd]">+ Catatan terbaru</p>
                        </div>
                        <div class="mt-5 flex justify-between text-[9px]">
                            @foreach ([['+', 'Tambah'], ['≡', 'Materi'], ['✓', 'Kuis']] as [$symbol, $label])
                                <div class="grid justify-items-center gap-1">
                                    <span class="grid size-[30px] place-items-center rounded-full bg-[#79dfa0] font-bold text-[#103d35]">
                                        {{ $symbol }}
                                    </span>
                                    {{ $label }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="absolute top-4 right-0 -rotate-[18deg] rounded-2xl bg-white p-3 text-left text-[#103d35] shadow-lg sm:right-9 sm:p-4">
                        <p class="mb-2 text-center text-[11px] font-bold">Aktivitas belajar</p>
                        <p class="border-b border-[#dce8cc] pb-1 text-[9px]">Dasar perlindungan merek ✓</p>
                        <p class="pt-1 text-[9px]">Kalkulator biaya produksi →</p>
                    </div>

                    <div class="absolute top-[44%] left-0 -rotate-4 rounded-2xl bg-white p-3 text-left text-[#103d35] shadow-lg sm:left-12 sm:p-4">
                        <p class="text-[10px]">Perhitungan HPP</p>
                        <p class="my-1 text-sm font-bold sm:text-base">Rp 9.000 / unit</p>
                        <p class="text-[10px] text-[#398c5b]">● Hasil tersimpan</p>
                    </div>

                    <div class="absolute right-0 bottom-10 rotate-6 rounded-2xl bg-white p-3 text-left text-[#103d35] shadow-lg sm:right-12 sm:p-4">
                        <p class="text-[10px]">Progres belajar</p>
                        <p class="my-1 text-sm font-bold sm:text-base">72% selesai</p>
                        <p class="text-[10px] text-[#398c5b]">Terus berkembang!</p>
                    </div>
                </div>

                <h1 id="hero-title" class="text-[42px] leading-[1.1] font-extrabold tracking-tight sm:text-[64px] lg:text-[76px]">
                    Karya terlindungi.<br>
                    Usaha lebih
                    <span class="inline-flex flex-col items-center align-top font-serif font-bold text-[#315b37] italic">
                        pasti.
                        <img src="{{ asset('images/inka/landing/c5b85.svg') }}" alt="" class="max-w-full">
                    </span>
                </h1>

                <p class="max-w-[760px] text-lg text-[#756a5b] sm:text-[21px]">
                    Punya karya? Lindungi identitasmu. Punya usaha? Pahami biaya sebenarnya.
                    INKA membantumu belajar HKI dan HPP dengan cara yang lebih sederhana.
                </p>

                <div class="flex flex-wrap justify-center gap-2 sm:gap-3">
                    <span class="rounded-full bg-[#e8efd9] px-4 py-2 text-sm font-semibold">01 &nbsp; Lindungi karya</span>
                    <span class="rounded-full bg-[#efe5d6] px-4 py-2 text-sm font-semibold">02 &nbsp; Pahami biaya</span>
                    <span class="rounded-full bg-[#f9e7ad] px-4 py-2 text-sm font-semibold">03 &nbsp; Latih kemampuan</span>
                </div>

                <div class="flex flex-wrap justify-center gap-3">
                    <a href="{{ route('register') }}"
                        class="rounded-xl bg-[#315b37] px-7 py-4 text-lg font-bold text-white hover:bg-[#284a2d]">
                        Mulai Belajar
                    </a>
                    <a href="#fitur"
                        class="rounded-xl border border-[#493627] px-7 py-4 text-lg font-bold hover:bg-[#efe5d6]">
                        Jelajahi Fitur
                    </a>
                </div>
            </section>

            <section aria-labelledby="preview-title" class="rounded-3xl bg-[#315b37] p-5 sm:p-8">
                <h2 id="preview-title" class="mb-5 flex items-center gap-3 text-xl font-bold text-[#fff9ef]">
                    <img src="{{ asset('images/inka/landing/8e44e.svg') }}" alt="">
                    Ruang Belajar INKA
                </h2>

                <div class="grid gap-4 lg:grid-cols-2">
                    <div class="rounded-2xl bg-[#fff9ef] p-5 sm:p-6">
                        <h3 class="text-2xl font-bold sm:text-3xl">Semua kebutuhan usahamu, satu tempat</h3>
                        <div class="mt-4 flex flex-wrap gap-4 text-sm font-semibold text-[#315b37]">
                            <span class="flex items-center gap-2">
                                <img src="{{ asset('images/inka/landing/422f9.svg') }}" alt="">
                                Perlindungan HKI
                            </span>
                            <span class="flex items-center gap-2">
                                <img src="{{ asset('images/inka/landing/8f2f2.svg') }}" alt="">
                                Perhitungan HPP
                            </span>
                        </div>

                        <div class="mt-4 flex items-center justify-between gap-3 rounded-xl bg-[#e8efd9] p-4">
                            <div>
                                <p class="text-xl font-bold">3 dari 5 topik</p>
                                <p class="text-sm text-[#756a5b]">Teruskan perjalanan belajarmu</p>
                            </div>
                            <p class="text-2xl font-bold text-[#315b37]">60%</p>
                        </div>

                        <div class="mt-3 grid grid-cols-2 gap-2 text-sm font-bold">
                            <p class="rounded-lg bg-[#e8efd9] p-2">03 &nbsp; Panduan HKI</p>
                            <p class="rounded-lg bg-[#f9e7ad] p-2">04 &nbsp; Kuis HAKI & HPP</p>
                            <p class="rounded-lg bg-[#e8efd9] p-2">05 &nbsp; Laporan HPP</p>
                            <p class="rounded-lg bg-[#f9e7ad] p-2">06 &nbsp; Pusat Bantuan</p>
                        </div>
                    </div>

                    <div class="rounded-2xl bg-[#fff9ef] p-5 sm:p-6">
                        <h3 class="text-2xl font-bold sm:text-3xl">Apa manfaat perlindungan merek bagi UMKM?</h3>
                        <ol class="mt-4 space-y-2 text-sm sm:text-base">
                            <li class="rounded-lg bg-[#e8efd9] p-3 font-semibold text-[#315b37]">A. Memberikan posisi dan perlindungan hukum</li>
                            <li class="rounded-lg border border-[#ddd2c3] bg-white p-3">B. Menentukan semua biaya produksi</li>
                            <li class="rounded-lg border border-[#ddd2c3] bg-white p-3">C. Menghilangkan kewajiban usaha</li>
                        </ol>
                    </div>
                </div>
            </section>

            <section class="mt-16 sm:mt-20" aria-labelledby="why-title">
                <p class="font-bold text-[#315b37]">KENAPA INKA ADA?</p>
                <h2 id="why-title" class="mt-2 text-3xl font-bold tracking-tight sm:text-[42px]">Kreatif saja belum cukup.</h2>
                <p class="mt-2 text-lg text-[#756a5b]">
                    Ide bagus perlu perlindungan dan perhitungan usaha yang jelas agar dapat berkembang.
                </p>

                <div class="mt-6 grid gap-4 md:grid-cols-3">
                    @foreach ($challenges as [$title, $description, $icon, $background])
                        <article class="rounded-2xl p-6 {{ $background }}">
                            <img src="{{ asset('images/inka/landing/' . $icon . '.svg') }}" alt="">
                            <h3 class="mt-4 text-2xl font-bold">{{ $title }}</h3>
                            <p class="mt-2 text-[#756a5b]">{{ $description }}</p>
                        </article>
                    @endforeach
                </div>
            </section>

            <section id="fitur" class="mt-16 scroll-mt-8 sm:mt-20" aria-labelledby="features-title">
                <h2 id="features-title" class="text-3xl font-bold tracking-tight sm:text-[42px]">
                    Belajar, hitung, dan lindungi usaha.
                </h2>
                <p class="mt-2 text-lg text-[#756a5b]">
                    Semua fitur INKA dirancang saling melengkapi tanpa membuat proses belajar terasa berat.
                </p>

                <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($features as [$id, $title, $description, $icon, $background])
                        <article id="{{ $id }}" class="flex scroll-mt-8 flex-col rounded-2xl p-6 {{ $background }}">
                            <div class="flex items-start justify-between gap-4">
                                <img src="{{ asset('images/inka/landing/' . $icon . '.svg') }}" alt="">
                                <span aria-hidden="true" class="text-sm font-bold text-[#315b37]">0{{ $loop->iteration }}</span>
                            </div>
                            <h3 class="mt-4 text-2xl leading-tight font-bold sm:text-[28px]">{{ $title }}</h3>
                            <p class="mt-3 mb-5 text-[#756a5b]">{{ $description }}</p>
                            <button type="button" data-feature="{{ $id }}"
                                class="mt-auto inline-flex items-center gap-2 self-start text-left font-bold text-[#315b37] hover:underline">
                                Pelajari lebih lanjut
                                <img src="{{ asset('images/inka/landing/04fb7.svg') }}" alt="">
                            </button>
                        </article>
                    @endforeach
                </div>
            </section>

            <section id="kuis" aria-labelledby="quiz-title"
                class="mt-14 grid scroll-mt-8 items-center gap-8 rounded-3xl bg-[#315b37] p-6 text-[#fff9ef] sm:p-10 lg:grid-cols-2">
                <div>
                    <p class="font-bold text-[#f4c84e]">LATIHAN INTERAKTIF</p>
                    <h2 id="quiz-title" class="mt-3 text-3xl leading-tight font-bold sm:text-[42px]">
                        Belajar singkat.<br>Ukur pemahamanmu.
                    </h2>
                    <p class="mt-4 max-w-md text-lg">
                        Kuis dibuat untuk memperkuat materi HAKI dan HPP. Setiap topik berisi 10 soal, dengan hasil, pembahasan, dan kesempatan mengulang.
                    </p>
                    <button type="button" data-feature="fitur-kuis"
                        class="mt-6 rounded-xl bg-[#f4c84e] px-6 py-3 font-bold text-[#493627] hover:bg-[#eab941]">
                        Mulai Kuis
                    </button>
                </div>

                <div class="rounded-2xl bg-[#fff9ef] p-4 text-[#493627] sm:p-6">
                    <h3 class="mb-3 font-bold text-[#315b37]">ALUR KUIS INKA</h3>
                    <ol class="space-y-2">
                        @foreach ($quizSteps as [$title, $description])
                            <li class="grid grid-cols-[auto_1fr_auto] items-center gap-3 rounded-xl p-3 {{ $loop->last ? 'bg-[#e8efd9]' : 'bg-[#f5eee3]' }}">
                                <span class="font-bold text-[#315b37]">0{{ $loop->iteration }}</span>
                                <div>
                                    <p class="font-bold">{{ $title }}</p>
                                    <p class="text-sm text-[#756a5b]">{{ $description }}</p>
                                </div>
                                <span class="text-xs font-bold text-[#315b37]">{{ $loop->last ? 'SELESAI' : 'LANJUT' }}</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </section>

            <section id="cara-kerja" class="mt-14 rounded-3xl bg-[#e8efd9] p-6 sm:p-10" aria-labelledby="steps-title">
                <p class="font-bold text-[#315b37]">CARA KERJANYA</p>
                <h2 id="steps-title" class="mt-2 text-3xl font-bold tracking-tight sm:text-[42px]">
                    Tiga langkah, lebih banyak pemahaman.
                </h2>
                <p class="mt-2 text-lg text-[#756a5b]">
                    Mulai dari mana pun sesuai kebutuhanmu. Tidak perlu langsung menguasai semua materi.
                </p>

                <ol class="mt-6 grid gap-4 md:grid-cols-3">
                    @foreach ($gettingStarted as [$title, $description])
                        <li class="rounded-2xl bg-[#fff9ef] p-5">
                            <span class="text-4xl font-bold text-[#315b37]">0{{ $loop->iteration }}</span>
                            <h3 class="mt-2 text-xl font-bold">{{ $title }}</h3>
                            <p class="mt-2 text-[#756a5b]">{{ $description }}</p>
                        </li>
                    @endforeach
                </ol>
            </section>

            <section id="bantuan" class="mt-14 scroll-mt-8" aria-labelledby="faq-title">
                <p class="font-bold text-[#315b37]">FAQ</p>
                <h2 id="faq-title" class="mt-2 text-3xl font-bold tracking-tight sm:text-[42px]">
                    Yang perlu kamu tahu tentang INKA.
                </h2>

                <dl class="mt-4 divide-y divide-[#ddd2c3]">
                    @foreach ($faqs as [$question, $answer])
                        <div class="py-4">
                            <dt class="text-xl font-bold">{{ $question }}</dt>
                            <dd class="mt-2 max-w-4xl text-[#756a5b] sm:text-lg">{{ $answer }}</dd>
                        </div>
                    @endforeach
                </dl>
            </section>
        </main>

        <footer class="mt-12 rounded-t-3xl bg-[#315b37] px-6 pt-8 text-[#fff9ef] sm:px-10">
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-[1.5fr_1fr_1fr_1fr]">
                <div>
                    <a href="{{ url('/') }}" class="text-3xl font-bold text-[#f4c84e]">INKA.</a>
                    <p class="mt-2 max-w-[250px]">Edukasi HKI dan HPP untuk UMKM dan pekerja kreatif pemula.</p>
                </div>

                <div>
                    <h2 class="mb-3 font-bold">Edukasi</h2>
                    <ul class="space-y-2">
                        <li><a href="#edukasi-hki" class="hover:underline">Pusat Edukasi HKI</a></li>
                        <li><a href="#panduan-hki" class="hover:underline">Panduan HKI</a></li>
                        <li><a href="#kuis" class="hover:underline">Kuis HAKI & HPP</a></li>
                    </ul>
                </div>

                <div>
                    <h2 class="mb-3 font-bold">Layanan</h2>
                    <ul class="space-y-2">
                        <li><a href="#kalkulator-hpp" class="hover:underline">Kalkulator HPP</a></li>
                        <li><a href="#laporan-hpp" class="hover:underline">Riwayat & Laporan</a></li>
                        <li><button type="button" data-feature="profil" class="text-left hover:underline">Profil Akun</button></li>
                    </ul>
                </div>

                <div>
                    <h2 class="mb-3 font-bold">Dukungan</h2>
                    <ul class="space-y-2">
                        <li><a href="#bantuan" class="hover:underline">FAQ</a></li>
                        <li><a href="#pusat-bantuan" class="hover:underline">Pusat Bantuan</a></li>
                        <li>
                            <a href="{{ route('login') }}" class="hover:underline">Masuk</a>
                            /
                            <a href="{{ route('register') }}" class="hover:underline">Daftar</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-7 flex flex-wrap justify-between gap-2 border-t border-white/25 py-5 text-sm">
                <p>© 2026 INKA. Seluruh hak dilindungi.</p>
                <p>Dibuat untuk pelaku usaha kreatif Indonesia.</p>
            </div>
        </footer>
    </div>

    <dialog id="feature-dialog" aria-labelledby="feature-dialog-title"
        class="m-auto w-[calc(100%_-_2rem)] max-w-md rounded-3xl bg-[#fff9ef] p-7 text-[#493627] shadow-xl backdrop:bg-black/50">
        <h2 id="feature-dialog-title" class="text-2xl font-bold"></h2>
        <p id="feature-dialog-description" class="mt-3 text-[#756a5b]"></p>

        <form method="dialog" class="mt-6">
            <button class="w-full rounded-xl bg-[#315b37] px-5 py-3 font-bold text-white hover:bg-[#284a2d]">
                Tutup
            </button>
        </form>
    </dialog>

    <script>
        const features = {{ \Illuminate\Support\Js::from($features) }};
        const featureDetails = new Map(
            features.map(([id, title, description]) => [id, { title, description }])
        );
        featureDetails.set('profil', {
            title: 'Profil Akun',
            description: 'Halaman profil sedang disiapkan.'
        });

        const dialog = document.querySelector('#feature-dialog');
        const dialogTitle = document.querySelector('#feature-dialog-title');
        const dialogDescription = document.querySelector('#feature-dialog-description');

        for (const button of document.querySelectorAll('[data-feature]')) {
            button.addEventListener('click', () => {
                const feature = featureDetails.get(button.dataset.feature);
                dialogTitle.textContent = feature.title;
                dialogDescription.textContent = feature.description;
                dialog.showModal();
            });
        }
    </script>
</body>
</html>