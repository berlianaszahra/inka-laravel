<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin | INKA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fff9ef] font-sans text-[#493627]">
    <div class="grid min-h-screen lg:grid-cols-[280px_minmax(0,1fr)]">
        <aside class="bg-[#315b37] p-6 text-white">
            <a href="{{ route('admin.index') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/inka/brand-leaf.svg') }}" alt="" width="42" height="42">
                <span>
                    <span class="block text-[30px] leading-none font-bold">INKA.</span>
                    <span class="text-xs font-bold tracking-wide text-[#f9e7ad]">ADMIN WORKSPACE</span>
                </span>
            </a>

            <nav aria-label="Menu admin" class="mt-8 grid gap-2">
                <a href="{{ route('admin.index') }}" aria-current="page"
                    class="rounded-xl bg-[#476a4a] px-4 py-3 font-bold text-[#f9e7ad]">Dashboard</a>
                <a href="#materi" class="rounded-xl px-4 py-3 font-semibold hover:bg-[#476a4a]">Kelola Materi</a>
                <a href="{{ route('profile.show') }}"
                    class="rounded-xl px-4 py-3 font-semibold hover:bg-[#476a4a]">Profil Saya</a>
            </nav>

            <div class="mt-6 border-t border-white/25 pt-5">
                <p class="break-words font-bold">{{ auth()->user()->name }}</p>
                <p class="mt-1 text-sm text-[#dce8cc]">Administrator</p>

                <form method="post" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="font-bold text-[#f9e7ad] hover:underline">Keluar Akun</button>
                </form>
            </div>
        </aside>

        <main class="mx-auto w-full min-w-0 max-w-[1310px] px-5 py-7 sm:px-[30px]">
            <header class="flex flex-wrap items-center justify-between gap-3">
                <p class="text-[#756a5b]">Admin / <strong class="text-[#315b37]">Dashboard</strong></p>
                <a href="{{ route('profile.show') }}"
                    class="rounded-full bg-[#f4c84e] px-4 py-2 text-sm font-bold">
                    {{ auth()->user()->name }}
                </a>
            </header>

            <p class="mt-6 font-bold text-[#315b37]">DASHBOARD ADMINISTRATOR</p>
            <h1 class="mt-2 text-4xl leading-tight font-bold sm:text-[44px]">Selamat datang, Admin.</h1>
            <p class="mt-2 text-lg text-[#756a5b]">Kelola materi HAKI dan HPP dari satu halaman.</p>

            @if (session('status'))
                <p role="status" class="mt-5 rounded-xl bg-[#dce8cc] px-5 py-3 font-semibold text-[#315b37]">
                    {{ session('status') }}
                </p>
            @endif

            <section id="materi" aria-labelledby="materi-title" class="mt-6 rounded-3xl bg-white p-5 sm:p-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <h2 id="materi-title" class="text-[28px] font-bold">Kelola Materi</h2>
                        <p class="mt-1 text-[#756a5b]">Tambah materi, ubah isinya, dan atur statusnya.</p>
                    </div>
                    <button id="add-content" type="button" aria-haspopup="dialog"
                        class="rounded-xl bg-[#315b37] px-5 py-3 font-bold text-white hover:bg-[#284a2d]">
                        + Tambah Materi
                    </button>
                </div>

                <form method="get" action="{{ route('admin.index') }}" class="my-5 flex flex-wrap items-center gap-3">
                    <input type="search" name="q" value="{{ $search }}" maxlength="150"
                        aria-label="Cari judul materi" placeholder="Cari judul materi..."
                        class="min-w-0 flex-1 rounded-xl border border-[#ddd2c3] px-4 py-3">
                    <select name="category" aria-label="Filter kategori"
                        class="rounded-xl border border-[#ddd2c3] bg-white px-4 py-3 font-semibold text-[#315b37]">
                        <option value="">Semua Kategori</option>
                        <option value="haki" @selected($category === 'haki')>HAKI</option>
                        <option value="hpp" @selected($category === 'hpp')>HPP</option>
                    </select>
                    <button class="rounded-xl bg-[#dce8cc] px-5 py-3 font-bold text-[#315b37]">Cari</button>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[670px] text-left">
                        <thead class="bg-[#f5efe3] text-sm font-bold uppercase text-[#756a5b]">
                            <tr>
                                <th scope="col" class="rounded-l-lg px-4 py-3">Judul</th>
                                <th scope="col" class="px-4 py-3">Kategori</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Diperbarui</th>
                                <th scope="col" class="rounded-r-lg px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contents as $content)
                                <tr class="even:bg-[#fff9ef]">
                                    <td class="px-4 py-4 font-bold">{{ $content->title }}</td>
                                    <td class="px-4 py-4">
                                        <span class="rounded-full px-3 py-1 text-sm font-bold text-[#315b37] {{ $content->category === 'haki' ? 'bg-[#dce8cc]' : 'bg-[#f9e7ad]' }}">
                                            {{ strtoupper($content->category) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="rounded-full px-3 py-1 text-sm font-bold {{ $content->status === 'terbit' ? 'bg-[#dce8cc] text-[#315b37]' : 'bg-[#f9e7ad]' }}">
                                            {{ ucfirst($content->status) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-[#756a5b]">
                                        {{ $content->updated_at->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.index', ['edit' => $content->id]) }}"
                                                class="rounded-lg border border-[#ddd2c3] px-3 py-2 font-bold text-[#315b37]">Edit</a>
                                            <form method="post" action="{{ route('admin.destroy', $content) }}" data-delete-content>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-lg border border-[#ddd2c3] px-3 py-2 font-bold text-[#a33b2e]">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-[#756a5b]">
                                        {{ $search !== '' || $category !== '' ? 'Tidak ada materi yang cocok dengan pencarian.' : 'Belum ada materi. Klik Tambah Materi untuk memulai.' }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-5">
                    {{ $contents->links() }}
                </div>
            </section>

            <footer class="mt-6 text-sm text-[#756a5b]">© 2026 INKA · Admin Workspace</footer>
        </main>
    </div>

    <dialog id="content-dialog" aria-labelledby="content-title"
        data-open="{{ $editing || $errors->any() ? 'yes' : 'no' }}"
        class="m-auto max-h-[85vh] w-[calc(100%_-_2rem)] max-w-xl overflow-y-auto rounded-3xl bg-[#fff9ef] p-6 text-[#493627] shadow-xl backdrop:bg-black/50">
        <h2 id="content-title" class="text-[28px] font-bold">{{ $editing ? 'Edit Materi' : 'Tambah Materi' }}</h2>

        @if ($errors->any())
            <ul role="alert" class="mt-4 list-disc space-y-1 pl-5 text-[#a33b2e]">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="post" action="{{ $editing ? route('admin.update', $editing) : route('admin.store') }}"
            class="mt-5 grid gap-4">
            @csrf
            @if ($editing)
                @method('PATCH')
            @endif

            <label class="grid gap-2 font-semibold">
                Judul
                <input name="title" required maxlength="150" value="{{ old('title', $editing?->title) }}"
                    class="rounded-xl border border-[#ddd2c3] bg-white px-4 py-3">
            </label>

            <div class="grid gap-4 sm:grid-cols-2">
                <label class="grid gap-2 font-semibold">
                    Kategori
                    <select name="category" class="rounded-xl border border-[#ddd2c3] bg-white px-4 py-3">
                        <option value="haki" @selected(old('category', $editing?->category) === 'haki')>HAKI</option>
                        <option value="hpp" @selected(old('category', $editing?->category) === 'hpp')>HPP</option>
                    </select>
                </label>
                <label class="grid gap-2 font-semibold">
                    Status
                    <select name="status" class="rounded-xl border border-[#ddd2c3] bg-white px-4 py-3">
                        <option value="draft" @selected(old('status', $editing?->status) === 'draft')>Draft</option>
                        <option value="terbit" @selected(old('status', $editing?->status) === 'terbit')>Terbit</option>
                    </select>
                </label>
            </div>

            <label class="grid gap-2 font-semibold">
                Isi materi
                <textarea name="body" required maxlength="20000" rows="5"
                    class="rounded-xl border border-[#ddd2c3] bg-white px-4 py-3">{{ old('body', $editing?->body) }}</textarea>
            </label>

            <div class="flex flex-wrap justify-end gap-3">
                @if ($editing)
                    <a href="{{ route('admin.index') }}" class="rounded-xl border border-[#ddd2c3] px-5 py-3 font-bold">Batal</a>
                @else
                    <button id="close-content" type="button"
                        class="rounded-xl border border-[#ddd2c3] px-5 py-3 font-bold">Batal</button>
                @endif
                <button type="submit" class="rounded-xl bg-[#315b37] px-5 py-3 font-bold text-white">Simpan Materi</button>
            </div>
        </form>
    </dialog>

    <script>
        const contentDialog = document.querySelector('#content-dialog');

        document.querySelector('#add-content').addEventListener('click', () => {
            const createUrl = new URL(window.location.href);
            if (createUrl.searchParams.has('edit')) {
                createUrl.searchParams.delete('edit');
                createUrl.hash = 'tambah-materi';
                window.location.assign(createUrl);
                return;
            }

            contentDialog.showModal();
        });

        document.querySelector('#close-content')?.addEventListener('click', () => {
            contentDialog.close();
        });

        if (contentDialog.dataset.open === 'yes' || window.location.hash === '#tambah-materi') {
            contentDialog.showModal();
        }

        for (const form of document.querySelectorAll('[data-delete-content]')) {
            form.addEventListener('submit', (event) => {
                if (!window.confirm('Hapus materi ini?')) {
                    event.preventDefault();
                }
            });
        }
    </script>
</body>
</html>