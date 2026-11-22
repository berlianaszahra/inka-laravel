<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalkulator HPP | INKA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#fff9ef] font-sans text-[#493627]">
    @php
        $fields = [
            'name' => 'Nama produk',
            'materials' => 'Biaya bahan baku',
            'labor' => 'Biaya tenaga kerja',
            'overhead' => 'Biaya overhead',
            'quantity' => 'Jumlah produk',
        ];

        $rupiah = static fn ($value, $decimals = 0) =>
            'Rp ' . number_format((float) $value, $decimals, ',', '.');
    @endphp

    <header class="border-b border-[#e3dac9]">
        <nav class="mx-auto flex max-w-7xl flex-wrap items-center gap-x-8 gap-y-3 px-6 py-5">
            <a href="{{ url('/') }}" class="mr-auto text-2xl font-black">INKA.</a>
            <a href="{{ url('/') }}" class="font-semibold hover:underline">Beranda</a>
            <a href="{{ route('calculator.index') }}" aria-current="page"
                class="font-bold text-[#315b37]">Kalkulator HPP</a>
            <a href="{{ route('hpp.history') }}" class="font-semibold hover:underline">Riwayat HPP</a>
        </nav>
    </header>

    <main class="mx-auto max-w-7xl px-6 py-10 sm:py-14">
        <section class="mb-8 rounded-3xl bg-[#dce8cc] p-7 sm:p-10">
            <h1 class="text-4xl font-black tracking-tight sm:text-5xl">Kalkulator HPP</h1>
            <p class="mt-3 max-w-2xl text-lg">
                Hitung biaya produksi per unit dari biaya bahan baku, tenaga kerja, dan overhead.
            </p>
            <p class="mt-5 font-bold text-[#315b37]">
                HPP per unit = total biaya produksi ÷ jumlah produk
            </p>
        </section>

        @if (session('hpp_status'))
            <p role="status" class="mb-6 rounded-xl bg-[#dce8cc] px-5 py-4 font-semibold text-[#315b37]">
                {{ session('hpp_status') }}
            </p>
        @endif

        <div class="grid items-start gap-6 lg:grid-cols-2">
            <section class="rounded-3xl border border-[#e3dac9] bg-white p-6 sm:p-8">
                <h2 class="text-2xl font-extrabold">Input biaya produksi</h2>
                <p class="mt-2 text-[#756a5b]">Masukkan biaya dalam rupiah tanpa titik atau koma.</p>

                <form method="POST" action="{{ route('calculator.calculate') }}" class="mt-6 grid gap-5">
                    @csrf

                    @foreach ($fields as $key => $label)
                        <div>
                            <label for="{{ $key }}" class="mb-2 block font-bold">{{ $label }}</label>
                            <input
                                id="{{ $key }}"
                                name="{{ $key }}"
                                type="{{ $key === 'name' ? 'text' : 'number' }}"
                                value="{{ old($key, $selected[$key] ?? $result[$key] ?? '') }}"
                                @if ($key === 'name')
                                    maxlength="100"
                                    placeholder="Contoh: Cookies Cokelat"
                                @else
                                    min="{{ $key === 'quantity' ? 1 : 0 }}"
                                    step="1"
                                    placeholder="{{ $key === 'quantity' ? '50' : '0' }}"
                                @endif
                                required
                                class="w-full rounded-xl border border-[#d8cdbc] bg-[#fffdf8] px-4 py-3 focus:border-[#315b37] focus:outline-2 focus:outline-[#315b37]"
                            >
                            @error($key)
                                <p class="mt-1 text-sm font-semibold text-red-700">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    <button type="submit" class="rounded-xl bg-[#315b37] px-6 py-3 font-bold text-white hover:bg-[#284a2d]">
                        Hitung HPP
                    </button>
                </form>
            </section>

            <section id="hasil" class="scroll-mt-6 rounded-3xl border border-[#e3dac9] bg-white p-6 sm:p-8">
                <h2 class="text-2xl font-extrabold">Hasil perhitungan</h2>

                @if ($result)
                    <div class="mt-5 rounded-2xl bg-[#315b37] p-6 text-white">
                        <p class="font-semibold">{{ $result['name'] }}</p>
                        <p class="mt-2 text-4xl font-black">{{ $rupiah($result['hpp'], 2) }}</p>
                        <p class="mt-1 text-sm">HPP per unit</p>
                    </div>

                    <details class="mt-5 rounded-xl border border-[#e3dac9] p-4">
                        <summary class="cursor-pointer font-bold text-[#315b37]">Lihat rincian biaya</summary>
                        <dl class="mt-4 grid grid-cols-[1fr_auto] gap-3">
                            @foreach (['materials', 'labor', 'overhead', 'quantity'] as $key)
                                <dt>{{ $fields[$key] }}</dt>
                                <dd class="text-right font-semibold">
                                    {{ $key === 'quantity' ? $result[$key] . ' unit' : $rupiah($result[$key]) }}
                                </dd>
                            @endforeach
                            <dt class="font-bold">Total produksi</dt>
                            <dd class="text-right font-bold">{{ $rupiah($result['total']) }}</dd>
                        </dl>
                    </details>

                    <button type="button" id="open-save-dialog"
                        class="mt-5 w-full rounded-xl bg-[#f4c64d] px-6 py-3 font-bold hover:bg-[#edb832]">
                        Simpan riwayat
                    </button>

                    <dialog id="save-dialog" aria-labelledby="save-title"
                        class="m-auto w-[calc(100%-2rem)] max-w-md rounded-3xl bg-[#fff9ef] p-7 text-[#493627] shadow-xl backdrop:bg-black/45">
                        <h3 id="save-title" class="text-2xl font-extrabold">Simpan perhitungan?</h3>
                        <p class="mt-2">Hasil untuk {{ $result['name'] }} akan masuk ke riwayat HPP.</p>
                        <div class="mt-6 flex flex-wrap justify-end gap-3">
                            <form method="dialog">
                                <button class="rounded-xl border border-[#d8cdbc] px-4 py-3 font-bold">Batal</button>
                            </form>
                            <form method="POST" action="{{ route('calculator.save') }}">
                                @csrf
                                <input type="hidden" name="result_id" value="{{ $result['id'] }}">
                                <button class="rounded-xl bg-[#315b37] px-4 py-3 font-bold text-white">Konfirmasi simpan</button>
                            </form>
                        </div>
                    </dialog>

                    <script>
                        document.getElementById('open-save-dialog').addEventListener('click', () => {
                            document.getElementById('save-dialog').showModal();
                        });
                    </script>
                @else
                    <p class="mt-5 rounded-2xl bg-[#fff9ef] p-5 text-[#756a5b]">
                        Isi biaya dan jumlah produk, lalu pilih <strong>Hitung HPP</strong>.
                    </p>
                @endif
            </section>
        </div>

        <section id="riwayat" class="mt-8 scroll-mt-6 rounded-3xl border border-[#e3dac9] bg-white p-6 sm:p-8">
            <h2 class="text-2xl font-extrabold">Riwayat HPP</h2>

            <form method="GET" action="{{ route('calculator.index', '#riwayat') }}"
                class="mt-5 flex flex-wrap items-end gap-3">
                <div class="min-w-44 flex-1">
                    <label for="q" class="mb-2 block font-bold">Cari produk</label>
                    <input id="q" name="q" value="{{ $search }}" class="w-full rounded-xl border border-[#d8cdbc] px-4 py-3">
                </div>
                <div>
                    <label for="period" class="mb-2 block font-bold">Periode</label>
                    <select id="period" name="period" class="rounded-xl border border-[#d8cdbc] bg-white px-4 py-3">
                        <option value="">Semua waktu</option>
                        <option value="7" @selected($recent)>7 hari terakhir</option>
                    </select>
                </div>
                <button class="rounded-xl bg-[#315b37] px-5 py-3 font-bold text-white">Terapkan</button>
            </form>

            @if ($selected)
                <article class="mt-6 rounded-2xl bg-[#dce8cc] p-5">
                    <h3 class="text-xl font-extrabold">{{ $selected['name'] }}</h3>
                    <dl class="mt-3 grid max-w-lg grid-cols-[1fr_auto] gap-2">
                        @foreach (['materials', 'labor', 'overhead', 'quantity'] as $key)
                            <dt>{{ $fields[$key] }}</dt>
                            <dd class="text-right font-semibold">
                                {{ $key === 'quantity' ? $selected[$key] . ' unit' : $rupiah($selected[$key]) }}
                            </dd>
                        @endforeach
                        <dt>Total biaya produksi</dt>
                        <dd class="text-right font-bold">{{ $rupiah($selected['total']) }}</dd>
                        <dt class="font-bold">HPP per unit</dt>
                        <dd class="text-right font-bold">{{ $rupiah($selected['hpp'], 2) }}</dd>
                    </dl>
                    <a href="#name" class="mt-4 inline-block font-bold text-[#315b37] underline">Gunakan data di formulir</a>
                </article>
            @endif

            @forelse ($entries as $entry)
                <div class="mt-4 flex flex-wrap items-center justify-between gap-4 rounded-xl border border-[#e3dac9] p-4">
                    <div>
                        <p class="font-extrabold">{{ $entry['name'] }}</p>
                        <p class="mt-1 text-sm text-[#756a5b]">
                            {{ $entry['quantity'] }} unit · {{ $rupiah($entry['hpp'], 2) }} per unit
                        </p>
                    </div>
                    <a href="{{ route('calculator.index', ['detail' => $entry['id'], 'q' => $search, 'period' => $recent ? '7' : '']) }}#riwayat"
                        class="font-bold text-[#315b37] underline">Lihat detail</a>
                </div>
            @empty
                <p class="mt-5 rounded-xl bg-[#fff9ef] p-4 text-[#756a5b]">
                    {{ $search !== '' || $recent ? 'Tidak ada perhitungan yang cocok.' : 'Belum ada perhitungan tersimpan.' }}
                </p>
            @endforelse
        </section>
    </main>
</body>
</html>