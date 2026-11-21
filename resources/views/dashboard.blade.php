<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard User | INKA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fff9ef] font-[Inter,Arial,sans-serif] text-[#493627]">
    @php
        $account = auth()->user();
        $nameParts = preg_split('/\s+/u', trim($account->name), -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $firstName = $nameParts[0] ?? 'Kreator';
        $initials = collect(array_slice($nameParts, 0, 2))
            ->map(fn ($part) => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($part, 0, 1)))
            ->implode('');

        $icon = fn ($file) => asset("images/inka/dashboard/{$file}.svg");

        $featureLinks = [
            'kuis' => \Illuminate\Support\Facades\Route::has('quiz.index')
                ? route('quiz.index')
                : url('/') . '#kuis',
            'bantuan' => route('faq.index'),
            href="{{ route('calculator.index') }}"
        ];

        $features = [
            ['edukasi-hki', 'Edukasi HKI', 'Kenali hak cipta, merek, dan perlindungan karya lewat materi sederhana.', 'Buka Edukasi', '61f72', '23072', 'bg-[#dce8cc]'],
            ['panduan-hki', 'Panduan HKI', 'Ikuti tahapan persiapan pendaftaran dan checklist dokumen HKI.', 'Buka Panduan', '3f24c', '4cc2f', 'bg-[#f8e6b2]'],
            ['kalkulator-hpp', 'Kalkulator HPP', 'Masukkan komponen biaya untuk memperkirakan biaya produksi per unit.', 'Hitung HPP', '085f6', '01e9b', 'bg-[#e9dccb]'],
            ['kuis', 'Kuis HAKI & HPP', 'Kerjakan 10 soal, lihat nilai, dan pelajari pembahasannya.', 'Mulai Kuis', '7c941', '6b792', 'bg-[#f8e6b2]'],
            ['riwayat', 'Riwayat & Laporan', 'Buka hasil kalkulasi sebelumnya dan lihat ringkasan biaya usaha.', 'Lihat Riwayat', '6e256', '246f8', 'bg-[#dce8cc]'],
            ['bantuan', 'Bantuan & FAQ', 'Temukan jawaban atau ajukan pertanyaan lewat formulir bantuan.', 'Buka Bantuan', 'ae60b', 'be63b', 'bg-[#e9dccb]'],
        ];

        $stats = [
            ['Topik dipelajari', 'HAKI dan HPP', '1eb84'],
            ['Kuis dikerjakan', 'Belum ada nilai', '64baf'],
            ['Kalkulasi HPP', 'Riwayat tersimpan', 'b50f3'],
        ];
    @endphp

    <div class="mx-auto grid min-h-screen max-w-[1600px] lg:grid-cols-[277px_minmax(0,1fr)]">
        <aside class="bg-[#315b37] px-5 py-6 text-[#fff9ef] lg:px-[26px] lg:pt-[29px]">
            <a href="{{ route('dashboard') }}" class="mb-7 flex items-center gap-[9px]">
                <img src="{{ $icon('ecf15') }}" alt="">
                <span>
                    <span class="block text-[30px] leading-none font-bold text-white">INKA.</span>
                    <span class="text-xs font-bold text-[#f4e7a5]">RUANG BELAJAR</span>
                </span>
            </a>

            <nav aria-label="Menu pengguna">
                <p class="mb-3 text-[13px] font-bold text-[#c8dcc2]">MENU PENGGUNA</p>

                <ul class="grid gap-2 sm:grid-cols-2 lg:grid-cols-1">
                    <li>
                        <a href="{{ route('dashboard') }}" aria-current="page"
                            class="flex min-h-[57px] items-center gap-[13px] rounded-[10px] bg-[#476a4a] px-[17px] text-[18px] font-bold">
                            <img src="{{ $icon('c64b2') }}" alt="">
                            Dashboard
                        </a>
                    </li>

                    @foreach ($features as [$id, $title, $description, $action, $sidebarIcon])
                        <li>
                            <a href="{{ $featureLinks[$id] ?? '#' . $id }}"
                                class="flex min-h-[57px] items-center gap-[13px] rounded-[10px] px-[17px] text-[18px] font-semibold hover:bg-[#476a4a]">
                                <img src="{{ $icon($sidebarIcon) }}" alt="">
                                {{ $id === 'kuis' ? 'Kuis Interaktif' : $title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="mt-4 border-t border-[#638566] pt-4">
                <p class="mb-2 text-[13px] font-bold text-[#c8dcc2]">AKUN</p>

                <a href="{{ route('profile.show') }}"
                    class="flex min-h-[57px] items-center gap-[13px] rounded-[10px] px-[17px] text-[18px] font-semibold hover:bg-[#476a4a]">
                    <img src="{{ $icon('8ebb8') }}" alt="">
                    Profil Saya
                </a>

                <div class="my-4 flex min-w-0 items-center gap-3">
                    <span class="grid size-11 shrink-0 place-items-center rounded-full bg-[#f4c84e] font-bold text-[#315b37]">
                        {{ $initials }}
                    </span>
                    <div class="min-w-0">
                        <p class="break-words font-bold">{{ $account->name }}</p>
                        <p class="text-sm text-[#c8dcc2]">Akun pengguna</p>
                    </div>
                </div>

                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center gap-[13px] rounded-[10px] px-[17px] py-3 text-left font-bold hover:bg-[#476a4a]">
                        <img src="{{ $icon('4dee2') }}" alt="">
                        Keluar akun
                    </button>
                </form>
            </div>
        </aside>

        <div class="min-w-0 px-5 sm:px-[34px]">
            <header class="flex min-h-[82px] flex-wrap items-center justify-between gap-3 py-4">
                <nav aria-label="Lokasi halaman" class="flex gap-2 text-[#756a5b]">
                    <a href="{{ url('/') }}" class="hover:underline">Beranda</a>
                    <span aria-hidden="true">/</span>
                    <span aria-current="page" class="font-bold text-[#315b37]">Dashboard</span>
                </nav>

                <div class="flex max-w-full items-center gap-3">
                    <button type="button" data-preview-title="Notifikasi"
                        data-preview-message="Belum ada notifikasi baru."
                        aria-label="Lihat notifikasi" aria-haspopup="dialog"
                        class="rounded-lg p-2 hover:bg-[#e7eed8]">
                        <img src="{{ $icon('70762') }}" alt="">
                    </button>

                    <a href="{{ route('profile.show') }}"
                        class="break-all rounded-full bg-[#f4c84e] px-4 py-2 text-sm font-bold uppercase">
                        {{ $account->name }}
                    </a>
                </div>
            </header>

            <main class="space-y-6">
                <section aria-labelledby="dashboard-title"
                    class="grid items-center gap-6 rounded-[24px] bg-[#e7eed8] p-6 sm:p-8 xl:grid-cols-[minmax(0,1fr)_auto]">
                    <div>
                        <p class="inline-block rounded-full bg-[#f4c84e] px-3 py-1.5 text-sm font-bold">
                            DASHBOARD PENGGUNA
                        </p>

                        <h1 id="dashboard-title"
                            class="mt-4 max-w-[680px] break-words text-3xl leading-tight font-bold sm:text-[44px]">
                            Halo, {{ $firstName }}. Siap mengembangkan karyamu?
                        </h1>

                        <p class="mt-4 max-w-[650px] text-lg leading-snug text-[#756a5b] sm:text-[21px]">
                            Belajar HKI, kelola biaya produksi, dan asah kemampuan usahamu melalui satu ruang kerja.
                        </p>

                        <div class="mt-5 flex flex-wrap gap-3">
                            <a href="#pembelajaran"
                                class="inline-flex items-center gap-3 rounded-[10px] bg-[#315b37] px-5 py-4 font-bold text-white hover:bg-[#284a2d]">
                                Lanjutkan Belajar
                                <img src="{{ $icon('fe62c') }}" alt="">
                            </a>

                            <a href="#progres"
                                class="inline-flex items-center gap-3 rounded-[10px] border border-[#ddd2c3] bg-white px-5 py-4 font-bold text-[#315b37] hover:border-[#315b37]">
                                Lihat Progres
                                <img src="{{ $icon('de3d5') }}" alt="">
                            </a>
                        </div>
                    </div>

                    <img src="{{ $icon('c350f') }}" alt="" class="mx-auto max-w-full">
                </section>

                <section id="progres" aria-label="Ringkasan progres" class="grid scroll-mt-6 gap-3 sm:grid-cols-3">
                    @foreach ($stats as [$title, $description, $statIcon])
                        <article class="flex min-h-[130px] items-center gap-4 rounded-2xl bg-white p-5 xl:p-7">
                            <img src="{{ $icon($statIcon) }}" alt="">
                            <div>
                                <p class="text-[34px] leading-none font-bold">0</p>
                                <h2 class="mt-2 text-[18px] font-bold">{{ $title }}</h2>
                                <p class="mt-1 text-sm text-[#756a5b]">{{ $description }}</p>
                            </div>
                        </article>
                    @endforeach
                </section>

                <section aria-labelledby="features-title">
                    <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <h2 id="features-title" class="text-[28px] leading-tight font-bold sm:text-[34px]">
                                Semua kebutuhanmu, satu dashboard.
                            </h2>
                            <p class="mt-2 text-lg text-[#756a5b]">
                                Enam fitur utama INKA untuk mendukung perjalanan bisnis kreatif.
                            </p>
                        </div>
                    </div>

                    <div class="grid gap-x-4 gap-y-6 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($features as [$id, $title, $description, $action, $sidebarIcon, $cardIcon, $background])
                            <article id="{{ $id }}"
                                class="flex min-h-[270px] scroll-mt-6 flex-col rounded-[18px] p-6 {{ $background }}">
                                <div class="flex items-center justify-between gap-3">
                                    <span class="grid size-[59px] place-items-center rounded-[14px] bg-white">
                                        <img src="{{ $icon($cardIcon) }}" alt="">
                                    </span>
                                    <span aria-hidden="true" class="font-bold text-[#315b37]">0{{ $loop->iteration }}</span>
                                </div>

                                <h3 class="mt-5 text-[26px] leading-tight font-bold">{{ $title }}</h3>
                                <p class="mt-3 mb-4 text-[17px] leading-snug text-[#756a5b]">{{ $description }}</p>

                                @if (isset($featureLinks[$id]))
                                    <a href="{{ $featureLinks[$id] }}"
                                        class="mt-auto inline-flex items-center gap-3 self-start text-[17px] font-bold text-[#315b37] hover:underline">
                                        {{ $action }}
                                        <img src="{{ $icon('47edb') }}" alt="">
                                    </a>
                                @else
                                    <button type="button" data-preview-title="{{ $title }}"
                                        data-preview-message="Halaman fitur ini sedang disiapkan." aria-haspopup="dialog"
                                        class="mt-auto inline-flex items-center gap-3 self-start text-left text-[17px] font-bold text-[#315b37] hover:underline">
                                        {{ $action }}
                                        <img src="{{ $icon('47edb') }}" alt="">
                                    </button>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </section>

                <div class="grid gap-4 xl:grid-cols-[minmax(0,1.8fr)_minmax(0,1fr)]">
                    <section id="pembelajaran" aria-labelledby="learning-title" class="scroll-mt-6 rounded-2xl bg-white p-6">
                        <h2 id="learning-title" class="text-2xl font-bold">Lanjutkan pembelajaran</h2>
                        <div class="mt-5 flex flex-wrap items-center gap-4">
                            <img src="{{ $icon('7624a') }}" alt="">
                            <div class="min-w-0 flex-1">
                                <h3 class="text-lg font-bold">Mulai topik pertamamu</h3>
                                <p class="mt-1 text-[#756a5b]">Pilih materi untuk mulai belajar tentang HKI.</p>
                            </div>
                            <a href="#edukasi-hki" class="inline-flex items-center gap-2 font-bold text-[#315b37] hover:underline">
                                Mulai
                                <img src="{{ $icon('7fa1d') }}" alt="">
                            </a>
                        </div>
                    </section>

                    <section id="profil" aria-labelledby="profile-title" class="scroll-mt-6 rounded-2xl bg-white p-6">
                        <h2 id="profile-title" class="text-2xl font-bold">Profil Saya</h2>
                        <div class="mt-4 flex items-center gap-3">
                            <span class="grid size-14 shrink-0 place-items-center rounded-full bg-[#f4c84e] text-xl font-bold text-[#315b37]">
                                {{ $initials }}
                            </span>
                            <div class="min-w-0">
                                <p class="break-words text-lg font-bold">{{ $account->name }}</p>
                                <p class="break-all text-sm text-[#756a5b]">{{ $account->email }}</p>
                            </div>
                        </div>

                        <a href="{{ route('profile.show') }}"
                            class="mt-4 inline-flex items-center gap-2 font-bold text-[#315b37] hover:underline">
                            Kelola Profil
                            <img src="{{ $icon('7fa1d') }}" alt="">
                        </a>
                    </section>
                </div>
            </main>

            <footer class="flex flex-wrap justify-between gap-2 py-6 text-sm text-[#756a5b]">
                <p>© 2026 INKA · Ruang belajar pengguna</p>
                <p>Belajar · Berkarya · Bertumbuh</p>
            </footer>
        </div>
    </div>

    <dialog id="dashboard-dialog" aria-labelledby="dialog-title"
        class="m-auto w-[calc(100%_-_2rem)] max-w-md rounded-3xl bg-[#fff9ef] p-7 text-[#493627] shadow-xl backdrop:bg-black/50">
        <h2 id="dialog-title" class="text-2xl font-bold"></h2>
        <p id="dialog-message" class="mt-3 text-[#756a5b]"></p>

        <form method="dialog" class="mt-6">
            <button type="submit"
                class="w-full rounded-xl bg-[#315b37] px-5 py-3 font-bold text-white hover:bg-[#284a2d]">
                Tutup
            </button>
        </form>
    </dialog>

    <script>
        const dialog = document.querySelector('#dashboard-dialog');
        const dialogTitle = document.querySelector('#dialog-title');
        const dialogMessage = document.querySelector('#dialog-message');

        for (const button of document.querySelectorAll('[data-preview-title]')) {
            button.addEventListener('click', () => {
                dialogTitle.textContent = button.dataset.previewTitle;
                dialogMessage.textContent = button.dataset.previewMessage;
                dialog.showModal();
            });
        }
    </script>
</body>
</html>