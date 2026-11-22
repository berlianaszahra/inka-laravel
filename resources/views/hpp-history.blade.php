@php
    $rupiah = static fn ($value, $decimals = 0) =>
        'Rp ' . number_format((float) $value, $decimals, ',', '.');
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $report ? 'Laporan HPP' : 'Riwayat HPP' }} | INKA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#fff9ef] font-sans text-[#493627] print:bg-white">
    <header class="border-b border-[#e6dccb] print:hidden">
        <nav aria-label="Navigasi utama"
            class="mx-auto flex max-w-7xl flex-wrap items-center gap-5 px-6 py-5">
            <a href="{{ url('/') }}" class="mr-auto text-3xl font-black">INKA.</a>
            <a href="{{ route('calculator.index') }}" class="font-bold hover:underline">
                Kalkulator HPP
            </a>
            <a href="{{ route('hpp.history') }}" class="font-bold text-[#315b37] hover:underline">
                Riwayat HPP
            </a>
        </nav>
    </header>

    <main class="mx-auto max-w-7xl px-6 py-8 sm:py-12">
        @if ($report)
            <a href="{{ route('hpp.history') }}"
                class="mb-5 inline-block font-bold text-[#315b37] hover:underline print:hidden">
                ← Kembali ke riwayat
            </a>

            <section class="rounded-3xl bg-[#315b37] p-7 text-white sm:p-10 print:bg-white print:text-black">
                <p class="text-sm font-bold tracking-wider text-[#f4c64d] print:text-black">
                    LAPORAN BIAYA PRODUKSI
                </p>
                <h1 class="mt-3 text-4xl font-black sm:text-5xl">{{ $report['name'] }}</h1>
                <p class="mt-3">
                    Disimpan {{ \Illuminate\Support\Carbon::createFromTimestamp($report['saved_at'], config('app.timezone'))->locale('id')->translatedFormat('d F Y') }}
                </p>
            </section>

            <div class="mt-6 grid items-start gap-5 lg:grid-cols-[3fr_2fr]">
                <section class="rounded-3xl border border-[#e6dccb] bg-white p-7">
                    <h2 class="text-2xl font-extrabold">Rincian biaya</h2>
                    <dl class="mt-4 divide-y divide-[#e6dccb]">
                        @foreach ([
                            'Bahan baku' => $rupiah($report['materials']),
                            'Tenaga kerja' => $rupiah($report['labor']),
                            'Overhead' => $rupiah($report['overhead']),
                            'Total biaya produksi' => $rupiah($report['total']),
                            'Jumlah produksi' => number_format($report['quantity'], 0, ',', '.') . ' unit',
                        ] as $label => $value)
                            <div class="flex flex-wrap justify-between gap-2 py-3">
                                <dt>{{ $label }}</dt>
                                <dd class="font-bold">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </section>

                <aside class="rounded-3xl bg-[#dce8cc] p-7 print:border print:bg-white">
                    <h2 class="text-lg font-extrabold text-[#315b37]">HPP per unit</h2>
                    <p class="mt-3 break-words text-4xl font-black">
                        {{ $rupiah($report['hpp'], 2) }}
                    </p>
                    <p class="mt-3">Total biaya produksi dibagi jumlah produk.</p>
                </aside>
            </div>

            <button type="button" onclick="window.print()"
                class="mt-6 rounded-xl bg-[#f4c64d] px-5 py-3 font-bold hover:bg-[#edb832] print:hidden">
                Cetak / Simpan PDF
            </button>
        @else
            <section class="rounded-3xl bg-[#315b37] p-7 text-white sm:p-10">
                <div class="flex flex-wrap items-end justify-between gap-5">
                    <div>
                        <p class="text-sm font-bold tracking-wider text-[#f4c64d]">RIWAYAT HPP</p>
                        <h1 class="mt-3 text-4xl font-black sm:text-5xl">Riwayat perhitungan</h1>
                        <p class="mt-3">Buka kembali hasil HPP yang pernah kamu simpan.</p>
                    </div>
                    <a href="{{ route('calculator.index') }}"
                        class="rounded-xl bg-[#f4c64d] px-5 py-3 font-bold text-[#493627] hover:bg-[#edb832]">
                        Perhitungan baru
                    </a>
                </div>
            </section>

            @if (session('hpp_status'))
                <p role="status" class="mt-5 rounded-xl bg-[#dce8cc] px-5 py-4 font-semibold">
                    {{ session('hpp_status') }}
                </p>
            @endif

            <section aria-label="Daftar perhitungan" class="mt-6 rounded-3xl border border-[#e6dccb] bg-white p-6">
                <form method="GET" action="{{ route('hpp.history') }}"
                    class="flex flex-wrap items-end gap-3">
                    <div class="min-w-44 flex-1">
                        <label for="q" class="mb-2 block font-bold">Cari produk</label>
                        <input id="q" name="q" value="{{ $search }}" placeholder="Contoh: Cookies Cokelat"
                            class="w-full rounded-xl border border-[#d8cdbc] px-4 py-3">
                    </div>
                    <div>
                        <label for="period" class="mb-2 block font-bold">Periode</label>
                        <select id="period" name="period"
                            class="rounded-xl border border-[#d8cdbc] bg-white px-4 py-3">
                            <option value="">Semua waktu</option>
                            <option value="7" @selected($recent)>7 hari terakhir</option>
                        </select>
                    </div>
                    <button type="submit" class="rounded-xl bg-[#315b37] px-5 py-3 font-bold text-white">
                        Terapkan
                    </button>
                </form>

                @if ($entries->isEmpty())
                    <p class="mt-5 rounded-xl bg-[#fff9ef] p-5">
                        {{ $search !== '' || $recent ? 'Tidak ada perhitungan yang cocok.' : 'Belum ada perhitungan tersimpan.' }}
                    </p>
                @else
                    <div class="mt-6 overflow-x-auto">
                        <table class="w-full min-w-[680px] text-left">
                            <thead class="bg-[#dce8cc] text-[#315b37]">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Produk</th>
                                    <th scope="col" class="px-4 py-3">Tanggal</th>
                                    <th scope="col" class="px-4 py-3">Jumlah</th>
                                    <th scope="col" class="px-4 py-3">HPP / unit</th>
                                    <th scope="col" class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#e6dccb]">
                                @foreach ($entries as $entry)
                                    <tr>
                                        <th scope="row" class="px-4 py-4 font-bold">{{ $entry['name'] }}</th>
                                        <td class="px-4 py-4">
                                            {{ \Illuminate\Support\Carbon::createFromTimestamp($entry['saved_at'], config('app.timezone'))->locale('id')->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="px-4 py-4">{{ $entry['quantity'] }} unit</td>
                                        <td class="px-4 py-4 font-bold">{{ $rupiah($entry['hpp'], 2) }}</td>
                                        <td class="px-4 py-4">
                                            <a href="{{ route('hpp.report', ['id' => $entry['id']]) }}"
                                                aria-label="Lihat detail {{ $entry['name'] }}"
                                                class="font-bold text-[#315b37] underline">
                                                Lihat detail →
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        @endif
    </main>
</body>
</html>