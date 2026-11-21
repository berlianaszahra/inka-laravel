<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password | INKA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fff9ef] font-[Inter,Arial,sans-serif] text-[#493627]">
    <header class="mx-auto flex max-w-[1440px] items-center justify-between gap-4 px-5 py-8 sm:px-10 xl:px-[90px]">
        <a href="{{ url('/') }}" class="flex items-center gap-[10px] text-[32px] font-bold">
            <img src="{{ asset('images/inka/brand-leaf.svg') }}" alt="">
            INKA.
        </a>

        <a href="{{ route('login') }}" class="font-semibold text-[#315b37] hover:underline">
            Kembali ke Login
        </a>
    </header>

    <main class="mx-auto max-w-xl px-5 py-10 sm:py-16" aria-labelledby="forgot-title">
        <section class="rounded-3xl border border-[#ddd2c3] bg-white p-6 sm:p-10">
            <p class="mb-3 font-bold text-[#315b37]">AKSES AKUN INKA</p>
            <h1 id="forgot-title" class="text-[36px] leading-tight font-bold sm:text-[44px]">
                Lupa password?
            </h1>
            <p class="mt-3 text-lg text-[#756a5b]">
                Masukkan alamat email yang kamu gunakan untuk membuat akun INKA.
            </p>

            <form id="forgot-password-form" method="post" class="mt-7 space-y-5">
                <div>
                    <label for="email" class="mb-[10px] block text-[19px] font-semibold">
                        Alamat email
                    </label>
                    <input id="email" type="email" autocomplete="email"
                        required placeholder="nama@email.com"
                        class="h-[68px] w-full rounded-xl border-[1.5px] border-[#ddd2c3] px-[22px] text-lg outline-none placeholder:text-[#756a5b] focus:border-[#315b37] focus:ring-1 focus:ring-[#315b37]">
                </div>

                <button type="submit" disabled
                    class="h-[65px] w-full rounded-xl bg-[#315b37] px-4 text-lg font-bold text-white hover:bg-[#284a2d] disabled:opacity-60">
                    Kirim tautan reset
                </button>
            </form>
        </section>
    </main>

    <dialog id="reset-popup" aria-labelledby="popup-title"
        class="m-auto w-[calc(100%_-_2rem)] max-w-md rounded-3xl bg-[#fff9ef] p-7 text-[#493627] shadow-xl backdrop:bg-black/50">
        <h2 id="popup-title" class="text-2xl font-bold">Cek email kamu</h2>
        <p class="mt-3 text-[#756a5b]">
            Jika email terdaftar, petunjuk reset password akan dikirim. Jangan lupa periksa folder spam.
        </p>
        <p class="mt-3 text-sm text-[#756a5b]">
            Ini pratinjau. Email reset belum dikirim.
        </p>

        <form method="dialog" class="mt-6">
            <button class="w-full rounded-xl bg-[#315b37] px-5 py-3 font-bold text-white hover:bg-[#284a2d]">
                Tutup
            </button>
        </form>
    </dialog>

    <script>
        const form = document.querySelector('#forgot-password-form');
        const popup = document.querySelector('#reset-popup');
        const submitButton = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            popup.showModal();
        });

        submitButton.disabled = false;
    </script>
</body>
</html>