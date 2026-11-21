<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | INKA</title>
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
                <span aria-current="page">Register</span>
            </nav>
        </header>

        <main class="grid items-center gap-8 lg:grid-cols-[535fr_635fr] xl:gap-[90px]">
            <section class="w-full max-w-[510px]" aria-labelledby="register-title">
                <div class="mb-[15px] space-y-3">
                    <p class="font-bold text-[#315b37]">MULAI BERSAMA INKA</p>
                    <h1 id="register-title" class="text-[36px] font-bold sm:text-[50px]">
                        Buat akun gratis.
                    </h1>
                    <p class="max-w-[505px] text-lg text-[#756a5b] sm:text-[21px]">
                        Satu akun untuk belajar HKI, menghitung HPP, dan mencoba kuis interaktif.
                    </p>
                </div>

                @if ($errors->any())
                    <ul role="alert" class="mb-4 list-disc space-y-1 rounded-xl border border-[#ad9674] px-8 py-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                @php
                    $fields = [
                        ['name', 'Nama lengkap', 'text', 'Masukkan nama lengkap', 'name'],
                        ['email', 'Alamat email', 'email', 'nama@email.com', 'email'],
                        ['password', 'Password', 'password', 'Minimal 8 karakter', 'new-password'],
                        ['password_confirmation', 'Konfirmasi password', 'password', 'Ulangi password', 'new-password'],
                    ];
                @endphp

                <form id="register-form" method="post" action="{{ route('register.store') }}" class="space-y-[15px]">
                    @csrf

                    @foreach ($fields as [$id, $label, $type, $placeholder, $autocomplete])
                        <div>
                            <label for="{{ $id }}" class="mb-[10px] block text-[19px] font-semibold">
                                {{ $label }}
                            </label>
                            <div class="flex h-[68px] items-center gap-2 rounded-xl border-[1.5px] border-[#ddd2c3] bg-white px-4 focus-within:border-[#315b37] focus-within:ring-1 focus-within:ring-[#315b37] sm:px-[22px]">
                                <input id="{{ $id }}" name="{{ $id }}" type="{{ $type }}"
                                    placeholder="{{ $placeholder }}" autocomplete="{{ $autocomplete }}"
                                    @if ($type === 'password')
                                        minlength="8"
                                    @else
                                        value="{{ old($id) }}" maxlength="255"
                                    @endif
                                    required class="h-full min-w-0 flex-1 text-lg outline-none placeholder:text-[#756a5b] sm:text-[20px]">

                                @if ($type === 'password')
                                    <button type="button" data-toggle-password="{{ $id }}" aria-controls="{{ $id }}"
                                        class="shrink-0 font-semibold text-[#315b37] hover:underline sm:text-[17px]">
                                        Tampilkan
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <label class="flex items-center gap-3 text-[17px] text-[#756a5b]">
                        <input type="checkbox" name="terms" value="1" @checked(old('terms')) required
                            class="size-[25px] shrink-0 cursor-pointer appearance-none rounded-[5px] border-2 border-[#315b37] bg-white checked:appearance-auto accent-[#315b37]">
                        <span>Saya menyetujui Syarat Penggunaan dan Kebijakan Privasi INKA.</span>
                    </label>

                    <button type="submit"
                        class="h-[65px] w-full rounded-xl bg-[#315b37] text-[21px] font-bold text-white hover:bg-[#284a2d]">
                        Daftar Sekarang
                    </button>
                </form>

                <p class="mt-[15px] text-[18px] text-[#756a5b]">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="ml-1 font-bold text-[#315b37] hover:underline">
                        Masuk di sini
                    </a>
                </p>
            </section>

            <aside class="flex flex-col items-center justify-center gap-[22px] rounded-3xl bg-[#f9e7ad] px-6 py-[34px] sm:px-9 lg:min-h-[830px]">
                <img src="{{ asset('images/inka/register-illustration.svg') }}" alt="" class="h-auto max-w-full">

                <h2 class="w-full max-w-[530px] text-[32px] font-bold xl:text-[39px]">
                    Dari ide ke usaha yang lebih siap.
                </h2>
                <p class="w-full max-w-[530px] text-lg text-[#756a5b] sm:text-[21px]">
                    Langkah pertama untuk membuka semua fitur INKA sesuai kebutuhanmu.
                </p>
            </aside>
        </main>

        <footer class="flex flex-wrap justify-between gap-3 text-[#756a5b]">
            <p>© 2026 INKA. Tumbuh bersama karya.</p>
            <p>Bantuan <span class="mx-2">·</span> Kebijakan Privasi <span class="mx-2">·</span> Syarat Penggunaan</p>
        </footer>
    </div>

    <script>
        const form = document.querySelector('#register-form');
        const password = form.elements.namedItem('password');
        const confirmation = form.elements.namedItem('password_confirmation');

        function validateConfirmation() {
            const mismatch = confirmation.value && confirmation.value !== password.value;
            confirmation.setCustomValidity(
                mismatch ? 'Konfirmasi password harus sama dengan password.' : ''
            );
        }

        password.addEventListener('input', validateConfirmation);
        confirmation.addEventListener('input', validateConfirmation);

        for (const button of form.querySelectorAll('[data-toggle-password]')) {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.togglePassword);
                const showPassword = input.type === 'password';

                input.type = showPassword ? 'text' : 'password';
                button.textContent = showPassword ? 'Sembunyikan' : 'Tampilkan';
            });
        }
    </script>
</body>
</html>