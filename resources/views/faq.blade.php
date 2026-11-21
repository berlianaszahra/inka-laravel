<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pusat Bantuan &amp; FAQ | INKA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fdfaf3] font-sans text-[#493627]">
    @php
        $dashboardUrl = auth()->check() ? route('dashboard') : url('/');
        $backLabel = auth()->check() ? 'Kembali ke Dashboard' : 'Kembali ke Beranda';

        $features = [
            'hki' => ['Edukasi HKI', $dashboardUrl . '#edukasi-hki'],
            'panduan' => ['Panduan HKI', $dashboardUrl . '#panduan-hki'],
            'hpp' => ['Kalkulator HPP', $dashboardUrl . '#kalkulator-hpp'],
            'kuis' => [
                'Kuis Interaktif',
                \Illuminate\Support\Facades\Route::has('quiz.index')
                    ? route('quiz.index')
                    : url('/') . '#kuis',
            ],
        ];

        $questions = [
            1 => [
                'hki', 'Bagaimana cara belajar HKI di INKA?',
                'Buka Edukasi HKI, pilih topik, lalu baca ringkasannya.',
                ['Buka menu Edukasi HKI.', 'Pilih topik yang relevan dengan karya atau usahamu.', 'Baca rangkuman materi yang tersedia.'],
            ],
            2 => [
                'panduan', 'Apakah INKA mendaftarkan merek langsung?',
                'Pengajuan merek dilakukan melalui kanal resmi DJKI. INKA menyediakan panduan untuk membantu kamu menyiapkannya.',
                ['Buka Panduan Pengurusan HKI.', 'Siapkan identitas merek dan klasifikasi barang atau jasa.', 'Lakukan pengajuan melalui kanal resmi DJKI.'],
            ],
            3 => [
                'hpp', 'Apakah hasil perhitungan HPP dapat disimpan?',
                'Hasil HPP dapat disimpan ke riwayat jika fitur penyimpanan sudah tersedia.',
                ['Buka Kalkulator HPP.', 'Masukkan komponen biaya dan lakukan perhitungan.', 'Pilih Simpan ke Riwayat jika tombolnya tersedia.'],
            ],
            4 => [
                'kuis', 'Bisakah kuis dikerjakan berulang?',
                'Ya. Setelah melihat skor dan jawaban, kamu bisa mengerjakan ulang latihan HAKI atau HPP.',
                ['Buka Kuis Interaktif dan pilih kategori.', 'Kerjakan soal lalu buka pembahasan.', 'Klik Ulangi Kuis untuk mencoba lagi.'],
            ],
        ];

        $search = request()->query('q');
        $search = is_string($search) ? trim($search) : '';
        $filter = request()->query('category');
        $filter = is_string($filter) && isset($features[$filter]) ? $filter : '';

        $visibleQuestions = array_filter(
            $questions,
            fn ($item) => ($filter === '' || $item[0] === $filter)
                && ($search === '' || mb_stripos($item[1] . ' ' . $item[2], $search) !== false)
        );

        $headings = [
            'list' => ['Pusat Bantuan & FAQ', 'Temukan informasi fitur INKA atau ajukan pertanyaan.'],
            'answer' => ['Detail Jawaban FAQ', 'Panduan singkat untuk menggunakan fitur INKA.'],
            'form' => ['Ajukan Pertanyaan', 'Isi formulir jika jawabanmu belum ada di FAQ.'],
            'confirmation' => ['Konfirmasi Pertanyaan', 'Cek ringkasan pertanyaan yang kamu isi.'],
        ];

        [$heading, $intro] = $headings[$screen];
        $primary = 'inline-flex items-center justify-center rounded-xl bg-[#315b37] px-5 py-3 font-bold text-white hover:bg-[#284a2d]';
        $secondary = 'inline-flex items-center justify-center rounded-xl border border-[#ded3c4] bg-white px-5 py-3 font-bold text-[#315b37] hover:bg-[#fdfaf3]';
        $input = 'w-full rounded-xl border border-[#ded3c4] bg-white px-4 py-3 font-normal focus:ring-2 focus:ring-[#315b37]';
    @endphp

    <div class="mx-auto max-w-[1344px] px-5 py-8 sm:px-10 lg:py-16">
        <header class="flex flex-wrap items-center justify-between gap-4">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-[30px] font-bold">
                <img src="{{ asset('images/inka/profile/894e7.svg') }}" alt="">
                INKA.
            </a>
            <a href="{{ $dashboardUrl }}" class="inline-flex items-center gap-2 font-bold text-[#315b37] hover:underline">
                <img src="{{ asset('images/inka/profile/b61f6.svg') }}" alt="">
                {{ $backLabel }}
            </a>
        </header>

        <main class="mt-7">
            <section class="rounded-[20px] bg-[#e3dbcc] p-6">
                <p class="text-xs font-bold text-[#315b37]">FITUR INKA</p>
                <h1 class="mt-2 text-3xl font-bold sm:text-[36px]">{{ $heading }}</h1>
                <p class="mt-2 text-[#756a5b]">{{ $intro }}</p>
            </section>

            @if ($screen === 'list')
                <form action="{{ route('faq.index') }}" method="get" class="mt-7 flex gap-3">
                    @if ($filter !== '')
                        <input type="hidden" name="category" value="{{ $filter }}">
                    @endif
                    <input type="search" name="q" value="{{ $search }}" aria-label="Cari pertanyaan"
                        placeholder="Cari pertanyaan, topik, atau fitur INKA..." class="{{ $input }}">
                    <button type="submit" class="{{ $primary }}">Cari</button>
                </form>

                <nav aria-label="Kategori FAQ" class="mt-5 flex flex-wrap gap-2">
                    @foreach (['' => 'Semua Pertanyaan'] + array_map(fn ($item) => $item[0], $features) as $key => $label)
                        <a href="{{ route('faq.index', ['category' => $key, 'q' => $search]) }}"
                            @if ($filter === $key) aria-current="page" @endif
                            class="rounded-lg px-3 py-2 text-sm font-semibold text-[#315b37] {{ $filter === $key ? 'bg-[#f4e6af]' : 'bg-[#dce8cc]' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </nav>
            @endif

            <div class="mt-7 grid items-start gap-6 lg:grid-cols-[minmax(0,2.4fr)_minmax(0,1fr)]">
                @if ($screen === 'list')
                    <section aria-labelledby="questions-heading">
                        <h2 id="questions-heading" class="mb-4 text-2xl font-bold">Pertanyaan yang sering diajukan</h2>
                        <div class="grid gap-4">
                            @forelse ($visibleQuestions as $id => [$key, $title, $answer])
                                <a href="{{ route('faq.answer', ['number' => $id]) }}"
                                    class="flex items-center gap-4 rounded-2xl border border-[#e5ddce] bg-white p-4 hover:border-[#315b37]">
                                    <span class="grid size-[54px] shrink-0 place-items-center rounded-xl font-bold text-[#315b37] {{ $id % 2 ? 'bg-[#f4e6af]' : 'bg-[#dce8cc]' }}">
                                        {{ sprintf('%02d', $id) }}
                                    </span>
                                    <span class="min-w-0 flex-1">
                                        <strong class="block text-lg">{{ $title }}</strong>
                                        <span class="mt-1 block text-sm text-[#756a5b]">{{ $answer }}</span>
                                    </span>
                                    <span aria-hidden="true" class="text-xl text-[#315b37]">→</span>
                                </a>
                            @empty
                                <p class="rounded-2xl bg-white p-5">Belum ada hasil. Coba kata kunci atau kategori lain.</p>
                            @endforelse
                        </div>
                    </section>

                    <aside class="grid gap-4">
                        <section class="rounded-2xl bg-[#dce8cc] p-6">
                            <h2 class="text-xl font-bold">Butuh bantuan lain?</h2>
                            <p class="my-3 text-[#756a5b]">Kirim pertanyaan melalui formulir bantuan.</p>
                            <a href="{{ route('faq.ask') }}" class="{{ $primary }}">Ajukan Pertanyaan →</a>
                        </section>
                        <section class="rounded-2xl border border-[#e5ddce] bg-white p-6">
                            <h2 class="text-xl font-bold">Jelajahi fitur INKA</h2>
                            <ul class="mt-3 grid gap-2">
                                @foreach ($features as [$label, $href])
                                    <li>
                                        <a href="{{ $href }}" class="font-semibold text-[#315b37] hover:underline">
                                            {{ sprintf('%02d', $loop->iteration) }} &nbsp; {{ $label }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                        <section class="rounded-2xl bg-[#f4e6af] p-6">
                            <h2 class="text-lg font-bold">Tips mencari jawaban</h2>
                            <p class="mt-2 text-[#756a5b]">Coba kata kunci seperti merek, HPP, atau kuis.</p>
                        </section>
                    </aside>
                @elseif ($screen === 'answer')
                    @php
                        [$key, $title, $answer, $steps] = $questions[$number];
                        [$featureLabel, $featureUrl] = $features[$key];
                    @endphp

                    <article class="rounded-2xl border border-[#e5ddce] bg-white p-6 sm:p-8">
                        <span class="inline-block rounded-lg bg-[#f4e6af] px-3 py-2 text-sm font-bold">
                            FAQ {{ sprintf('%02d', $number) }}
                        </span>
                        <h2 class="mt-4 text-2xl font-bold">{{ $title }}</h2>
                        <p class="mt-3 text-lg text-[#756a5b]">{{ $answer }}</p>

                        <h3 class="mt-6 text-xl font-bold">Langkah-langkah yang bisa dilakukan</h3>
                        <ol class="mt-3 grid gap-3">
                            @foreach ($steps as $step)
                                <li class="flex gap-3 rounded-xl bg-[#fdfaf3] p-4">
                                    <span class="font-bold text-[#315b37]">{{ sprintf('%02d', $loop->iteration) }}</span>
                                    {{ $step }}
                                </li>
                            @endforeach
                        </ol>

                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('faq.index') }}" class="{{ $secondary }}">← Kembali ke FAQ</a>
                            <a href="{{ route('faq.ask') }}" class="{{ $primary }}">Ajukan Pertanyaan →</a>
                        </div>
                    </article>

                    <aside class="grid gap-4">
                        <section class="rounded-2xl bg-[#dce8cc] p-6">
                            <p class="text-sm font-bold text-[#315b37]">MATERI TERKAIT</p>
                            <h2 class="mt-2 text-xl font-bold">{{ $featureLabel }}</h2>
                            <a href="{{ $featureUrl }}" class="{{ $primary }} mt-4">Lihat Fitur →</a>
                        </section>

                        <section class="rounded-2xl border border-[#e5ddce] bg-white p-6">
                            <h2 class="text-xl font-bold">Pertanyaan Lainnya</h2>
                            <ul class="mt-3 grid gap-3">
                                @foreach ($questions as $id => $item)
                                    @continue($id === $number)
                                    <li>
                                        <a href="{{ route('faq.answer', ['number' => $id]) }}"
                                            class="font-semibold text-[#315b37] hover:underline">
                                            {{ $item[1] }} →
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    </aside>
                @elseif ($screen === 'form')
                    <form method="post" action="{{ route('faq.send') }}"
                        class="grid gap-4 rounded-2xl border border-[#e5ddce] bg-white p-6 sm:p-8">
                        @csrf
                        <div>
                            <h2 class="text-2xl font-bold">Ceritakan pertanyaanmu</h2>
                            <p class="mt-2 text-[#756a5b]">Lengkapi formulir agar pertanyaanmu mudah dipahami.</p>
                        </div>

                        @if ($errors->any())
                            <ul role="alert" class="list-disc rounded-xl bg-[#f4e6af] py-3 pr-4 pl-9">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <label class="grid gap-2 font-semibold">
                            Nama lengkap
                            <input name="name" value="{{ old('name', auth()->user()?->name) }}" autocomplete="name"
                                maxlength="120" required class="{{ $input }}">
                        </label>

                        <label class="grid gap-2 font-semibold">
                            Alamat email
                            <input name="email" type="email" value="{{ old('email', auth()->user()?->email) }}"
                                autocomplete="email" maxlength="255" required class="{{ $input }}">
                        </label>

                        <label class="grid gap-2 font-semibold">
                            Kategori pertanyaan
                            <select name="category" required class="{{ $input }}">
                                <option value="">Pilih kategori bantuan</option>
                                @foreach ($features as $key => [$label])
                                    <option value="{{ $key }}" @selected(old('category') === $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </label>

                        <label class="grid gap-2 font-semibold">
                            Judul pertanyaan
                            <input name="title" value="{{ old('title') }}" maxlength="150" required class="{{ $input }}">
                        </label>

                        <label class="grid gap-2 font-semibold">
                            Deskripsi pertanyaan
                            <textarea name="message" rows="5" maxlength="2000" required class="{{ $input }}">{{ old('message') }}</textarea>
                        </label>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('faq.index') }}" class="{{ $secondary }}">← Kembali ke FAQ</a>
                            <button type="submit" class="{{ $primary }}">Kirim Pertanyaan →</button>
                        </div>
                        <p class="text-sm text-[#756a5b]">Formulir ini untuk demo. Pengiriman ke tim bantuan belum aktif.</p>
                    </form>

                    <aside class="grid gap-4">
                        <section class="rounded-2xl bg-[#dce8cc] p-6">
                            <h2 class="text-xl font-bold">Sebelum bertanya</h2>
                            <ul class="mt-3 grid gap-3">
                                @foreach ($questions as $id => $item)
                                    <li><a href="{{ route('faq.answer', ['number' => $id]) }}" class="hover:underline">{{ $item[1] }}</a></li>
                                @endforeach
                            </ul>
                        </section>
                        <section class="rounded-2xl border border-[#e5ddce] bg-white p-6">
                            <h2 class="text-lg font-bold">Bagaimana prosesnya?</h2>
                            <p class="mt-2 text-[#756a5b]">Isi formulir, klik Kirim Pertanyaan, lalu cek ringkasan di halaman konfirmasi.</p>
                        </section>
                    </aside>
                @else
                    <article class="rounded-2xl border border-[#e5ddce] bg-white p-6 sm:p-8">
                        <span class="inline-block rounded-lg bg-[#f4e6af] px-3 py-2 text-sm font-bold">SIMULASI SELESAI</span>
                        <h2 class="mt-4 text-2xl font-bold">Formulirmu sudah diproses.</h2>

                        <dl class="mt-4 grid gap-3 rounded-2xl bg-[#dce8cc] p-5">
                            <div><dt class="text-sm font-semibold">Kategori</dt><dd>{{ $features[$submission['category']][0] }}</dd></div>
                            <div><dt class="text-sm font-semibold">Judul</dt><dd class="break-words font-bold">{{ $submission['title'] }}</dd></div>
                            <div><dt class="text-sm font-semibold">Email</dt><dd class="break-all">{{ $submission['email'] }}</dd></div>
                        </dl>

                        <div class="mt-5 flex flex-wrap gap-3">
                            <a href="{{ route('faq.index') }}" class="{{ $secondary }}">Kembali ke FAQ</a>
                            <a href="{{ $dashboardUrl }}" class="{{ $primary }}">{{ $backLabel }} →</a>
                        </div>
                    </article>

                    <aside class="rounded-2xl bg-[#f4e6af] p-6">
                        <h2 class="text-xl font-bold">Pertanyaan lainnya</h2>
                        <p class="mt-2 text-[#756a5b]">Lanjutkan membaca panduan fitur INKA.</p>
                        <a href="{{ route('faq.index') }}" class="{{ $primary }} mt-4">Baca FAQ Lainnya →</a>
                    </aside>
                @endif
            </div>
        </main>

        <footer class="mt-8 flex flex-wrap justify-between gap-3 text-sm text-[#756a5b]">
            <p>© 2026 INKA · Pusat Bantuan</p>
            <p>Belajar · Berkarya · Bertumbuh</p>
        </footer>
    </div>
</body>
</html>