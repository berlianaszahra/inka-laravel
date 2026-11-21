<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | INKA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fff9ef] font-[Inter,Arial,sans-serif] leading-[1.2] text-[#493627]">
    <div class="mx-auto flex min-h-screen max-w-[1440px] flex-col justify-between gap-6 px-5 pt-8 pb-[25px] sm:px-10 xl:px-[90px]">
        <header class="flex items-center justify-between gap-3">
            <a href="{{ url('/') }}" class="flex items-center gap-[10px] text-[32px] font-bold">
                <img src="{{ asset('images/inka/brand-leaf.svg') }}" alt="">
                INKA.
            </a>
            <nav aria-label="Lokasi halaman" class="flex gap-3 font-semibold text-[#315b37] sm:text-[18px]">
                <a href="{{ url('/') }}" class="hover:underline">Beranda</a>
                <span aria-hidden="true">/</span>
                <span aria-current="page">Login</span>
            </nav>
        </header>

        <main class="grid items-center gap-8 lg:grid-cols-[535fr_635fr] xl:gap-[90px]">
            <section class="w-full max-w-[510px]" aria-labelledby="login-title">
                <div class="mb-5 space-y-3">
                    <p class="font-bold text-[#315b37]">SELAMAT DATANG KEMBALI</p>
                    <h1 id="login-title" class="text-[36px] font-bold sm:text-[50px]">Masuk ke INKA.</h1>
                    <p class="max-w-[505px] text-lg text-[#756a5b] sm:text-[21px]">
                        Lanjutkan perjalanan belajarmu dan kelola usahamu dengan lebih percaya diri.
                    </p>
                </div>

                @if (session('status'))
                    <p role="status" class="mb-4 rounded-xl bg-[#dce8cc] px-4 py-3 font-semibold text-[#315b37]">
                        {{ session('status') }}
                    </p>
                @endif

                @if ($errors->any())
                    <ul role="alert" class="mb-4 list-disc space-y-1 rounded-xl border border-[#ad9674] px-8 py-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="post" action="{{ route('login.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="mb-[10px] block text-[19px] font-semibold">Alamat email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            autocomplete="email" required placeholder="nama@email.com"
                            class="h-[68px] w-full rounded-xl border-[1.5px] border-[#ddd2c3] bg-white px-[22px] text-lg outline-none placeholder:text-[#756a5b] focus:border-[#315b37] focus:ring-1 focus:ring-[#315b37] sm:text-[20px]">
                    </div>

                    <div>
                        <label for="password" class="mb-[10px] block text-[19px] font-semibold">Password</label>
                        <div class="flex h-[68px] items-center gap-2 rounded-xl border-[1.5px] border-[#ddd2c3] bg-white px-4 focus-within:border-[#315b37] focus-within:ring-1 focus-within:ring-[#315b37] sm:px-[22px]">
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                required placeholder="Masukkan password"
                                class="h-full min-w-0 flex-1 text-lg outline-none placeholder:text-[#756a5b] sm:text-[20px]">
                            <button id="toggle-password" type="button" aria-controls="password"
                                class="shrink-0 font-semibold text-[#315b37] hover:underline sm:text-[17px]">
                                Tampilkan
                            </button>
                        </div>
                    </div>

                    <div class="text-right">
                        @if (\Illuminate\Support\Facades\Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[19px] font-bold text-[#315b37] hover:underline">
                                Lupa password?
                            </a>
                        @else
                            <button type="button" data-preview="Fitur reset password belum terhubung."
                                class="text-[19px] font-bold text-[#315b37] hover:underline">
                                Lupa password?
                            </button>
                        @endif
                    </div>

                    <button type="submit"
                        class="h-[65px] w-full rounded-xl bg-[#315b37] text-[21px] font-bold text-white hover:bg-[#284a2d]">
                        Masuk ke Akun INKA
                    </button>
                </form>

                <div class="my-5 flex items-center gap-3 text-[17px] text-[#756a5b]">
                    <span class="h-px flex-1 bg-[#ddd2c3]" aria-hidden="true"></span>
                    atau
                    <span class="h-px flex-1 bg-[#ddd2c3]" aria-hidden="true"></span>
                </div>

                <button type="button" data-preview="Login dengan Google belum terhubung."
                    class="h-[65px] w-full rounded-xl border-[1.5px] border-[#ddd2c3] bg-white px-3 text-lg font-bold text-[#315b37] hover:border-[#315b37] sm:text-[21px]">
                    Lanjutkan dengan Google
                </button>

                <p class="mt-5 text-[18px] text-[#756a5b]">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="ml-1 font-bold text-[#315b37] hover:underline">
                        Daftar sekarang
                    </a>
                </p>
            </section>

            <aside class="flex flex-col items-center justify-center gap-4 overflow-hidden rounded-3xl bg-[#dce8cc] px-6 py-10 text-center sm:px-9 lg:min-h-[830px]">
                <div class="relative flex h-[385px] w-full max-w-[540px] items-center justify-center" aria-hidden="true">
                    <div class="relative h-[350px] w-[230px] -rotate-7 rounded-[35px] border-[7px] border-[#09251f] bg-[#103d35] px-[15px] pt-[48px] text-white shadow-[0_30px_25px_rgba(22,78,67,0.19)]">
                        <div class="absolute top-4 left-1/2 h-[18px] w-20 -translate-x-1/2 rounded-full bg-[#071e1a]"></div>

                        <div class="flex justify-between text-[10px]">
                            <span>9:41</span>
                            <span>•••</span>
                        </div>

                        <p class="mt-3 text-[15px] text-[#a6b8ad]">Halo, Kreator</p>

                        <div class="mt-4 space-y-[5px] rounded-[17px] bg-[#1d6554] p-[18px]">
                            <p class="text-[10px] text-[#bce7d2]">Total biaya produksi</p>
                            <p class="text-[23px] font-bold">Rp 450.000</p>
                            <p class="text-[10px] text-[#a4edbd]">+ Catatan terbaru</p>
                        </div>

                        <div class="mt-5 flex justify-between text-[9px]">
                            <div class="grid justify-items-center gap-1">
                                <span class="grid size-[30px] place-items-center rounded-full bg-[#79dfa0] font-bold text-[#103d35]">+</span>
                                Tambah
                            </div>
                            <div class="grid justify-items-center gap-1">
                                <span class="grid size-[30px] place-items-center rounded-full bg-[#79dfa0] font-bold text-[#103d35]">≡</span>
                                Materi
                            </div>
                            <div class="grid justify-items-center gap-1">
                                <span class="grid size-[30px] place-items-center rounded-full bg-[#79dfa0] font-bold text-[#103d35]">✓</span>
                                Kuis
                            </div>
                        </div>
                    </div>

                    <div class="absolute top-0 left-0 rotate-4 rounded-2xl bg-white p-4 text-left text-[#103d35] shadow-lg sm:left-4">
                        <p class="text-[10px]">Perhitungan HPP</p>
                        <p class="my-1 text-base font-bold">Rp 9.000 / unit</p>
                        <p class="text-[10px] text-[#398c5b]">● Hasil tersimpan</p>
                    </div>

                    <div class="absolute top-20 right-0 hidden -rotate-22 rounded-2xl bg-white p-4 text-[#103d35] shadow-lg sm:block">
                        <p class="mb-3 text-[11px] font-bold">Aktivitas belajar</p>
                        <div class="space-y-2 text-left text-[9px]">
                            <p class="border-b border-[#dce8cc] pb-1">Dasar perlindungan merek ✓</p>
                            <p>Kalkulator biaya produksi →</p>
                        </div>
                    </div>

                    <div class="absolute bottom-5 left-0 rotate-4 rounded-2xl bg-white p-4 text-left text-[#103d35] shadow-lg sm:left-10">
                        <p class="text-[10px]">Progres belajar</p>
                        <p class="my-1 text-base font-bold">72% selesai</p>
                        <p class="text-[10px] text-[#398c5b]">Terus berkembang!</p>
                    </div>
                </div>

                <h2 class="text-[32px] font-bold xl:text-[39px]">Selamat datang kembali.</h2>
                <p class="max-w-[530px] text-lg font-semibold text-[#756a5b] sm:text-[21px]">
                    Lindungi karya dan ambil keputusan bisnis dengan pengetahuan yang tepat.
                </p>
            </aside>
        </main>

        <footer class="flex flex-wrap justify-between gap-3 text-[#756a5b]">
            <p>© 2026 INKA. Tumbuh bersama karya.</p>
            <p>Bantuan <span class="mx-2">·</span> Kebijakan Privasi <span class="mx-2">·</span> Syarat Penggunaan</p>
        </footer>
    </div>

    <dialog id="login-dialog" aria-labelledby="preview-title"
        class="m-auto w-[calc(100%_-_2rem)] max-w-sm rounded-2xl bg-[#fff9ef] p-6 text-[#493627] shadow-xl backdrop:bg-black/50">
        <h2 id="preview-title" class="text-2xl font-bold">Pratinjau Login</h2>
        <p id="preview-message" class="mt-3"></p>
        <form method="dialog" class="mt-5">
            <button class="rounded-xl bg-[#315b37] px-5 py-2 font-bold text-white">Tutup</button>
        </form>
    </dialog>

    <script>
        const password = document.querySelector('#password');
        const toggle = document.querySelector('#toggle-password');
        const dialog = document.querySelector('#login-dialog');
        const message = document.querySelector('#preview-message');

        toggle.addEventListener('click', () => {
            const showPassword = password.type === 'password';
            password.type = showPassword ? 'text' : 'password';
            toggle.textContent = showPassword ? 'Sembunyikan' : 'Tampilkan';
        });

        for (const button of document.querySelectorAll('[data-preview]')) {
            button.addEventListener('click', () => {
                message.textContent = button.dataset.preview;
                dialog.showModal();
            });
        }
    </script>
</body>
</html>