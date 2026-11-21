<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Saya | INKA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fff9ef] font-sans text-[#493627]">
    @php
        $account = auth()->user();
        $icon = fn ($file) => asset("images/inka/profile/{$file}.svg");
    @endphp

    <div class="mx-auto max-w-[1334px] px-5 pt-[27px] pb-[34px] sm:px-8">
        <header class="flex flex-wrap items-center justify-between gap-3">
            <a href="{{ url('/') }}" class="flex items-center gap-[10px] text-[30px] font-bold">
                <img src="{{ $icon('894e7') }}" alt="">
                INKA.
            </a>

            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-[10px] text-base font-bold text-[#315b37] hover:underline sm:text-[19px]">
                <img src="{{ $icon('b61f6') }}" alt="">
                Kembali ke Dashboard
            </a>
        </header>

        <main class="mt-[29px]">
            <section aria-labelledby="profile-title"
                class="flex flex-col gap-6 rounded-[22px] bg-[#dce8cc] p-6 sm:flex-row sm:items-center sm:p-[30px]">
                <div class="grid size-[92px] shrink-0 place-items-center rounded-[20px] bg-white">
                    <img src="{{ $icon('718bf') }}" alt="">
                </div>

                <div>
                    <p class="font-bold text-[#315b37]">FITUR INKA</p>
                    <h1 id="profile-title" class="mt-1 text-[37px] leading-tight font-bold sm:text-[47px]">
                        Profil Saya
                    </h1>
                    <p class="mt-2 text-lg text-[#756a5b] sm:text-[21px]">
                        Kelola informasi akun dan lihat perkembangan pembelajaranmu.
                    </p>
                </div>
            </section>

            <div class="mx-auto mt-[29px] max-w-[1120px]">
                @if (session('status'))
                    <p role="status" class="mb-4 rounded-xl bg-[#dce8cc] px-5 py-3 font-semibold text-[#315b37]">
                        {{ session('status') }}
                    </p>
                @endif

                <div class="grid gap-5 md:grid-cols-2">
                    <section aria-labelledby="account-title" class="rounded-[22px] bg-white p-[26px]">
                        <p class="inline-block rounded-full bg-[#f4c84e] px-4 py-1.5 text-sm font-bold">
                            AKUN PENGGUNA
                        </p>
                        <h2 id="account-title" class="mt-4 break-words text-[32px] leading-tight font-bold">
                            {{ $account->name }}
                        </h2>
                        <p class="mt-3 text-sm font-semibold text-[#756a5b]">Alamat email</p>
                        <p class="mt-1 break-all text-lg text-[#756a5b]">{{ $account->email }}</p>

                        <button id="open-edit-profile" type="button" aria-haspopup="dialog"
                            class="mt-6 inline-flex min-h-[60px] items-center justify-center gap-3 rounded-xl bg-[#315b37] px-8 text-lg font-bold text-white hover:bg-[#284a2d]">
                            Edit Profil
                            <img src="{{ $icon('39d05') }}" alt="">
                        </button>
                    </section>

                    <section aria-labelledby="learning-title" class="rounded-[22px] bg-[#dce8cc] p-[26px]">
                        <h2 id="learning-title" class="text-[28px] leading-tight font-bold">
                            Perkembangan belajar
                        </h2>

                        <ul class="mt-4 space-y-2 text-[22px] font-bold text-[#315b37]">
                            <li>0 kuis diselesaikan</li>
                            <li>0 topik dipelajari</li>
                            <li>0 simulasi HPP</li>
                        </ul>

                        <a href="{{ route('dashboard') }}#riwayat"
                            class="mt-5 inline-flex min-h-[60px] items-center justify-center gap-3 rounded-xl bg-[#315b37] px-8 text-lg font-bold text-white hover:bg-[#284a2d]">
                            Lihat Riwayat
                            <img src="{{ $icon('39d05') }}" alt="">
                        </a>
                    </section>
                </div>
            </div>
        </main>

        <footer class="mt-[29px] text-sm text-[#756a5b]">
            <p>© 2026 INKA · Dashboard pengguna</p>
        </footer>
    </div>

    <dialog id="edit-profile-dialog" aria-labelledby="edit-profile-title"
        class="m-auto w-[calc(100%_-_2rem)] max-w-md rounded-[22px] bg-[#fff9ef] p-6 text-[#493627] shadow-xl backdrop:bg-black/50">
        <h2 id="edit-profile-title" class="text-[28px] font-bold">Edit Profil</h2>

        <form method="post" action="{{ route('profile.update') }}" class="mt-5 space-y-5">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="mb-2 block font-semibold">Nama lengkap</label>
                <input id="name" name="name" type="text" autocomplete="name"
                    value="{{ old('name', $account->name) }}" required maxlength="255"
                    @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
                    class="w-full rounded-xl border border-[#ddd2c3] bg-white px-4 py-3 text-lg outline-none focus:ring-2 focus:ring-[#315b37]">

                @error('name')
                    <p id="name-error" role="alert" class="mt-2 text-sm font-semibold text-[#8a3b25]">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex flex-wrap justify-end gap-3">
                <button id="close-edit-profile" type="button"
                    class="rounded-xl border border-[#ddd2c3] bg-white px-5 py-3 font-bold text-[#315b37]">
                    Batal
                </button>
                <button type="submit" class="rounded-xl bg-[#315b37] px-5 py-3 font-bold text-white hover:bg-[#284a2d]">
                    Simpan Nama
                </button>
            </div>
        </form>
    </dialog>

    <script>
        const profileDialog = document.querySelector('#edit-profile-dialog');

        document.querySelector('#open-edit-profile').addEventListener('click', () => {
            profileDialog.showModal();
        });

        document.querySelector('#close-edit-profile').addEventListener('click', () => {
            profileDialog.close();
        });

        if (document.querySelector('#name-error')) {
            profileDialog.showModal();
        }
    </script>
</body>
</html>