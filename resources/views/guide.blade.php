@php
    $steps = [
        'persiapan' => [
            'title' => 'Siapkan pengajuan',
            'summary' => 'Rapikan informasi merek dan berkas sebelum mengajukan.',
            'action' => 'Buka checklist',
            'items' => [
                'Catat nama merek dan siapkan file logo jika ada.',
                'Susun daftar barang atau jasa yang akan menggunakan merek.',
                'Siapkan informasi identitas pemohon.',
                'Telusuri merek serupa dan cek persyaratan di situs DJKI.',
            ],
        ],
        'pengajuan' => [
            'title' => 'Ajukan permohonan',
            'summary' => 'Tinjau data yang akan dikirim dan simpan bukti pengajuan.',
            'action' => 'Lihat langkah pengajuan',
            'items' => [
                'Buka kanal resmi DJKI dan ikuti petunjuk pengajuan merek.',
                'Periksa kembali informasi pemohon, merek, dan daftar barang atau jasa.',
                'Simpan bukti, nomor, dan tanggal permohonan setelah pengajuan.',
            ],
        ],
        'pemantauan' => [
            'title' => 'Pantau permohonan',
            'summary' => 'Gunakan nomor permohonan untuk memeriksa pembaruan.',
            'action' => 'Lihat cara memantau',
            'items' => [
                'Periksa status permohonan melalui kanal resmi DJKI.',
                'Baca pemberitahuan yang masuk ke akun pengajuan.',
                'Catat tindak lanjut dan simpan salinan pemberitahuan.',
            ],
        ],
    ];

    $slug = request()->route('langkah');
    $current = $steps[$slug] ?? null;
    $slugs = array_keys($steps);
    $index = array_search($slug, $slugs, true);
    $previous = $index !== false ? ($slugs[$index - 1] ?? null) : null;
    $next = $index !== false ? ($slugs[$index + 1] ?? null) : null;

    $stepUrl = static fn ($step) => route('guide.index', ['langkah' => $step]);
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $current['title'] ?? 'Panduan Pengurusan HKI' }} | INKA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fff9ef] font-sans text-[#493627]">
    <header class="border-b border-[#e6dccb]">
        <nav aria-label="Navigasi utama"
            class="mx-auto flex max-w-7xl flex-wrap items-center gap-6 px-6 py-5">
            <a href="{{ url('/') }}" class="mr-auto text-3xl font-black">INKA.</a>
            <a href="{{ url('/') }}" class="font-bold hover:underline">Beranda</a>
            <a href="{{ route('guide.index') }}" class="font-bold text-[#315b37] hover:underline">
                Panduan HKI
            </a>
        </nav>
    </header>

    <main class="mx-auto max-w-7xl px-6 py-10">
        <section class="rounded-3xl bg-[#315b37] p-7 text-white sm:p-12">
            <p class="text-sm font-extrabold tracking-wide text-[#f4c64d]">
                {{ $current ? 'LANGKAH ' . ($index + 1) . ' DARI ' . count($steps) : 'PANDUAN PENGURUSAN HKI' }}
            </p>
            <h1 class="mt-3 text-4xl font-black tracking-tight sm:text-6xl">
                {{ $current['title'] ?? 'Mulai urus merek usahamu.' }}
            </h1>
            <p class="mt-4 max-w-2xl text-lg">
                {{ $current['summary'] ?? 'Ikuti alurnya dari menyiapkan berkas sampai memantau permohonan.' }}
            </p>
        </section>

        @if ($current)
            <nav aria-label="Langkah panduan" class="mt-6 flex flex-wrap gap-3">
                @foreach ($steps as $key => $step)
                    @if ($key === $slug)
                        <span aria-current="step" class="rounded-full bg-[#315b37] px-4 py-2 font-bold text-white">
                            {{ $loop->iteration }}. {{ $step['title'] }}
                        </span>
                    @else
                        <a href="{{ $stepUrl($key) }}"
                            class="rounded-full bg-[#dce8cc] px-4 py-2 font-bold text-[#315b37] hover:underline">
                            {{ $loop->iteration }}. {{ $step['title'] }}
                        </a>
                    @endif
                @endforeach
            </nav>

            <section class="mt-6 rounded-3xl border border-[#e6dccb] bg-white p-6 sm:p-8">
                <h2 class="text-2xl font-extrabold">Yang perlu kamu lakukan</h2>
                <ol class="mt-5 space-y-3">
                    @foreach ($current['items'] as $item)
                        <li class="flex gap-3 rounded-xl bg-[#fff9ef] px-4 py-3">
                            <span class="font-extrabold text-[#315b37]">{{ $loop->iteration }}.</span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ol>
            </section>

            <div class="mt-6 flex flex-wrap justify-between gap-3">
                <a href="{{ $previous ? $stepUrl($previous) : route('guide.index') }}"
                    class="rounded-xl border border-[#e6dccb] bg-white px-5 py-3 font-bold text-[#315b37] hover:bg-[#dce8cc]">
                    {{ $previous ? 'Langkah sebelumnya' : 'Kembali ke panduan' }}
                </a>
                <a href="{{ $next ? $stepUrl($next) : route('guide.index') }}"
                    class="rounded-xl bg-[#315b37] px-5 py-3 font-bold text-white hover:bg-[#284a2d]">
                    {{ $next ? 'Langkah berikutnya' : 'Selesai · Kembali ke panduan' }}
                </a>
            </div>
        @else
            <div class="mt-6 grid gap-5 md:grid-cols-3">
                @foreach ($steps as $key => $step)
                    <article class="flex flex-col rounded-3xl border border-[#e6dccb] bg-white p-6">
                        <span class="self-start rounded-full bg-[#dce8cc] px-4 py-2 font-black text-[#315b37]">
                            {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <h2 class="mt-4 text-2xl font-extrabold">{{ $step['title'] }}</h2>
                        <p class="mt-2 flex-1 leading-relaxed">{{ $step['summary'] }}</p>
                        <a href="{{ $stepUrl($key) }}"
                            class="mt-5 rounded-xl bg-[#315b37] px-5 py-3 text-center font-bold text-white hover:bg-[#284a2d]">
                            {{ $step['action'] }}
                        </a>
                    </article>
                @endforeach
            </div>
        @endif

        <a href="https://www.dgip.go.id/"
            class="mt-6 inline-flex rounded-xl bg-[#f4c64d] px-5 py-3 font-bold hover:bg-[#edb832]">
            Buka situs DJKI
        </a>
    </main>
</body>
</html>