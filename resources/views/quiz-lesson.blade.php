@php
    [$topicTitle, $topicDescription, $summary] = $selected['topics'][$topic - 1];

    $routeParams = ['category' => $category, 'topic' => $topic];
    $categoryUrl = route('quiz.category', ['category' => $category]);
    $materialUrl = route('quiz.material', $routeParams);
    $playUrl = route('quiz.play', $routeParams);

    $reminders = $category === 'haki'
        ? [
            'Merek membantu membedakan barang atau jasa.',
            'Hak cipta berkaitan dengan karya yang memenuhi syarat perlindungan.',
            'Persiapan perlindungan mengikuti jenis HKI yang relevan.',
        ]
        : [
            'Catat bahan baku, tenaga kerja langsung, dan overhead produksi.',
            'HPP per unit = total biaya produksi ÷ jumlah unit.',
            'Harga jual juga mempertimbangkan margin dan kondisi pasar.',
        ];

    $example = $category === 'haki'
        ? 'Seorang desainer membuat logo untuk usaha kopi. Logo dapat digunakan sebagai tanda pembeda produk. Desainer dan pemilik usaha juga dapat menyepakati penggunaan hasil desain dalam kontrak.'
        : 'Sebuah usaha mengeluarkan Rp2.000.000 untuk menghasilkan 100 produk. HPP per unitnya adalah Rp2.000.000 ÷ 100 = Rp20.000.';

    $questions = config('quiz.' . $category, []);
@endphp

@if ($stage === 'materi')
    <section aria-labelledby="lesson-title">
        <a href="{{ $categoryUrl }}" class="font-bold text-[#315b37] hover:underline">
            ← Kembali ke Submateri
        </a>

        <p class="mt-6 font-bold text-[#315b37]">MATERI SINGKAT / {{ $selected['label'] }}</p>
        <h1 id="lesson-title" class="mt-2 text-[36px] leading-tight font-bold sm:text-[48px]">
            {{ $topicTitle }}
        </h1>
        <p class="mt-3 text-lg text-[#756a5b] sm:text-[21px]">{{ $topicDescription }}</p>

        <div class="mt-8 grid gap-6 lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)]">
            <article class="rounded-[22px] bg-white p-6 sm:p-8">
                <p class="inline-block rounded-full bg-[#f8e6b2] px-4 py-2 text-sm font-bold">
                    RINGKASAN MATERI
                </p>
                <h2 class="mt-5 text-2xl font-bold sm:text-[32px]">{{ $topicTitle }}</h2>
                <p class="mt-3 text-lg leading-relaxed text-[#756a5b]">{{ $summary }}</p>

                <h3 class="mt-6 text-[22px] font-bold">3 hal yang perlu diingat</h3>
                <ol class="mt-4 space-y-4">
                    @foreach ($reminders as $point)
                        <li class="flex items-start gap-3">
                            <span class="rounded-full bg-[#dce8cc] px-3 py-1 text-sm font-bold text-[#315b37]">
                                0{{ $loop->iteration }}
                            </span>
                            <span class="pt-0.5 text-lg font-semibold">{{ $point }}</span>
                        </li>
                    @endforeach
                </ol>

                <a href="{{ $playUrl }}"
                    class="mt-6 inline-flex min-h-[62px] items-center justify-center rounded-xl bg-[#315b37] px-8 text-lg font-bold text-white hover:bg-[#284a2d] sm:min-w-[300px]">
                    Mulai 10 Soal
                </a>
            </article>

            <aside class="rounded-[22px] p-6 {{ $selected['color'] }}">
                <img src="{{ $icon($selected['icon']) }}" alt="">
                <h2 class="mt-4 text-[26px] leading-tight font-bold">Contoh dekat denganmu</h2>
                <p class="mt-3 text-lg leading-relaxed text-[#756a5b]">{{ $example }}</p>
                <p class="mt-5 inline-block rounded-full bg-[#fff9ef] px-4 py-2 text-sm font-bold text-[#315b37]">
                    APLIKASI UNTUK UMKM
                </p>
            </aside>
        </div>
    </section>
@elseif (empty($questions))
    <section class="rounded-[22px] bg-white p-6">
        <h1 class="text-2xl font-bold">Soal {{ $selected['label'] }} belum tersedia</h1>
        <p class="mt-2 text-[#756a5b]">Data soal untuk kategori ini belum terbaca dari config/quiz.php.</p>
        <a href="{{ $materialUrl }}" class="mt-4 inline-block font-bold text-[#315b37] hover:underline">
            Kembali ke Materi
        </a>
    </section>
@else
    <section id="quiz-player"
        data-questions="{{ json_encode($questions, JSON_THROW_ON_ERROR) }}">
        <div id="quiz-position" class="flex flex-wrap items-center justify-between gap-3">
            <a href="{{ $materialUrl }}"
                class="rounded-full px-4 py-2 font-bold text-[#315b37] {{ $selected['color'] }}">
                KUIS {{ $selected['label'] }}
            </a>
            <p id="question-count" class="text-lg font-bold text-[#315b37]" aria-live="polite"></p>
        </div>

        <div id="quiz-progress" class="quiz-progress-track" role="progressbar"
            aria-label="Posisi soal" aria-valuemin="0"
            aria-valuemax="{{ count($questions) }}" aria-valuenow="1">
            <span id="quiz-progress-fill" class="quiz-progress-fill"></span>
        </div>

        <form id="question-form" class="mt-5 rounded-[22px] bg-white p-6 sm:p-8">
            <p id="question-number" class="font-bold text-[#315b37]"></p>
            <h1 id="question-title" tabindex="-1"
                class="mt-3 text-[26px] leading-tight font-bold outline-none sm:text-[34px]"></h1>

            <fieldset class="mt-4">
                <legend class="text-lg text-[#756a5b]">Pilih satu jawaban yang paling tepat.</legend>
                <div id="question-options" class="mt-4 space-y-4"></div>
            </fieldset>

            <div class="quiz-actions">
                <button id="previous-question" type="button"
                    class="min-h-[60px] rounded-xl border border-[#ddd2c3] px-4 font-bold text-[#315b37] disabled:opacity-40 sm:max-w-[245px]">
                    Sebelumnya
                </button>
                <p class="hidden text-center text-[#756a5b] sm:block">{{ count($questions) }} soal · Latihan interaktif</p>
                <button id="next-question" type="submit"
                    class="min-h-[60px] rounded-xl bg-[#315b37] px-4 font-bold text-white hover:bg-[#284a2d] sm:w-full sm:max-w-[280px] sm:justify-self-end">
                    Berikutnya
                </button>
            </div>
        </form>

        <section id="quiz-result" hidden aria-labelledby="result-title">
            <div class="quiz-result-hero">
                <div>
                    <p class="inline-block rounded-full bg-[#f4c84e] px-4 py-2 text-sm font-bold">
                        KUIS {{ $selected['label'] }} SELESAI
                    </p>

                    <h2 id="result-title" tabindex="-1"
                        class="mt-5 text-[34px] leading-tight font-bold outline-none sm:text-[44px]">
                        Kamu sudah menyelesaikan kuis!
                    </h2>

                    <p class="mt-4 max-w-[690px] text-[21px] leading-snug text-[#756a5b]">
                        Lihat bagian yang sudah kamu kuasai dan materi yang masih perlu dipelajari.
                    </p>

                    <div class="mt-5 flex flex-wrap gap-4">
                        <button id="open-review" type="button"
                            class="rounded-xl bg-[#315b37] px-8 py-4 text-lg font-bold text-white hover:bg-[#284a2d]">
                            Lihat Pembahasan
                        </button>
                        <a href="{{ $playUrl }}"
                            class="rounded-xl border border-[#ddd1c2] bg-white px-8 py-4 text-lg font-bold text-[#315b37]">
                            Ulangi Kuis
                        </a>
                    </div>
                </div>

                <div class="rounded-[19px] bg-[#f8e6a7] px-6 py-8 text-[#315b37]">
                    <p class="font-bold">SKOR KUIS</p>
                    <p id="result-score" class="mt-3 text-[52px] leading-tight font-bold sm:text-[60px]"></p>
                    <p id="result-count" class="mt-4 text-lg text-[#756a5b]"></p>
                </div>
            </div>

            <div class="quiz-result-stats">
                <article class="rounded-[19px] bg-[#dce8cc] p-6">
                    <img src="{{ $icon('result-check') }}" alt="">
                    <h3 id="correct-stat" class="mt-3 text-[28px] font-bold"></h3>
                    <p class="mt-2 text-[#756a5b]">Jawaban yang sudah tepat</p>
                </article>

                <article class="rounded-[19px] bg-[#f8e6a7] p-6">
                    <img src="{{ $icon('result-book') }}" alt="">
                    <h3 id="review-stat" class="mt-3 text-[28px] font-bold"></h3>
                    <p class="mt-2 text-[#756a5b]">Pelajari kembali konsep terkait</p>
                </article>

                <article class="rounded-[19px] bg-[#dce8cc] p-6">
                    <img src="{{ $icon('result-history') }}" alt="">
                    <h3 class="mt-3 text-[28px] font-bold">Sesi latihan</h3>
                    <p class="mt-2 text-[#756a5b]">Hasil tampil selama halaman ini terbuka</p>
                </article>
            </div>
        </section>

        <section id="quiz-review" hidden aria-labelledby="review-title">
            <p class="font-bold text-[#315b37]">ULASAN JAWABAN</p>
            <h2 id="review-title" tabindex="-1"
                class="mt-3 text-[34px] leading-tight font-bold outline-none sm:text-[48px]">
                Tinjau jawaban kuismu.
            </h2>
            <p class="mt-3 text-lg text-[#756a5b]">Bandingkan pilihanmu dengan jawaban yang tepat.</p>

            <ol id="result-review" class="mt-6 grid max-w-[1200px] gap-5"></ol>

            <div class="mt-6 flex flex-wrap gap-4">
                <a href="{{ $playUrl }}" class="rounded-xl border border-[#ddd1c2] bg-white px-7 py-4 font-bold text-[#315b37]">
                    Ulangi Kuis
                </a>
                <button id="back-to-result" type="button" class="rounded-xl bg-[#315b37] px-7 py-4 font-bold text-white">
                    Kembali ke Hasil
                </button>
            </div>
        </section>
    </section>

    <script>
        const player = document.querySelector('#quiz-player');
        const questions = JSON.parse(player.dataset.questions);
        const answers = Array(questions.length).fill(null);

        const form = document.querySelector('#question-form');
        const title = document.querySelector('#question-title');
        const number = document.querySelector('#question-number');
        const count = document.querySelector('#question-count');
        const progress = document.querySelector('#quiz-progress');
        const progressFill = document.querySelector('#quiz-progress-fill');
        const options = document.querySelector('#question-options');
        const previous = document.querySelector('#previous-question');
        const next = document.querySelector('#next-question');
        const result = document.querySelector('#quiz-result');

        let current = 0;

        function showQuestion() {
            const [question, choices] = questions[current];
            const position = current + 1;

            title.textContent = question;
            number.textContent = 'PERTANYAAN ' + String(position).padStart(2, '0');
            count.textContent = 'Soal ' + position + ' dari ' + questions.length;
            progress.setAttribute('aria-valuenow', position);
            progressFill.style.width = (position / questions.length * 100) + '%';
            previous.disabled = current === 0;
            next.textContent = position === questions.length ? 'Kumpulkan Kuis' : 'Berikutnya';
            options.replaceChildren();

            for (const [index, choice] of choices.entries()) {
                const label = document.createElement('label');
                label.className = 'quiz-choice';

                const input = document.createElement('input');
                input.type = 'radio';
                input.name = 'answer';
                input.value = index;
                input.required = true;
                input.checked = answers[current] === index;
                input.className = 'sr-only';
                input.addEventListener('change', () => {
                    answers[current] = Number(input.value);
                });

                const letter = document.createElement('span');
                letter.className = 'quiz-choice-letter';
                letter.textContent = String.fromCharCode(65 + index);

                const text = document.createElement('span');
                text.textContent = choice;

                label.append(input, letter, text);
                options.append(label);
            }
        }

        const reviewScreen = document.querySelector('#quiz-review');

        document.querySelector('#open-review').addEventListener('click', () => {
            result.hidden = true;
            reviewScreen.hidden = false;
            document.querySelector('#review-title').focus();
            window.scrollTo(0, 0);
        });

        document.querySelector('#back-to-result').addEventListener('click', () => {
            reviewScreen.hidden = true;
            result.hidden = false;
            document.querySelector('#result-title').focus();
            window.scrollTo(0, 0);
        });

        function showResult() {
            const correct = questions.filter(([, , key], index) => answers[index] === key).length;
            const incorrect = questions.length - correct;
            const score = Math.round(correct / questions.length * 100);
            const review = document.querySelector('#result-review');

            document.querySelector('#result-score').textContent = score + ' / 100';
            document.querySelector('#result-count').textContent =
                correct + ' jawaban benar · ' + incorrect + ' perlu dipelajari';
            document.querySelector('#correct-stat').textContent = correct + ' Benar';
            document.querySelector('#review-stat').textContent = incorrect + ' Perlu Dipelajari';

            questions.forEach(([question, choices, key], index) => {
                const isCorrect = answers[index] === key;
                const item = document.createElement('li');
                const meta = document.createElement('div');
                const badge = document.createElement('span');
                const status = document.createElement('span');
                const heading = document.createElement('h3');
                const yourAnswer = document.createElement('p');
                const correctAnswer = document.createElement('p');

                item.className = 'rounded-[19px] bg-white p-6';
                meta.className = 'flex flex-wrap items-center justify-between gap-3 text-sm font-bold';
                badge.className = 'rounded-full px-4 py-2 text-[#315b37] ' +
                    (isCorrect ? 'bg-[#dce8cc]' : 'bg-[#f8e6a7]');
                badge.textContent = 'SOAL ' + String(index + 1).padStart(2, '0');
                status.className = isCorrect ? 'text-[#315b37]' : 'text-[#a33b2e]';
                status.textContent = isCorrect ? 'BENAR' : 'PERLU DIPELAJARI';
                heading.className = 'mt-4 text-[23px] font-bold';
                heading.textContent = question;
                correctAnswer.className = 'mt-3 text-lg font-bold text-[#315b37]';
                correctAnswer.textContent = '✓ Jawaban tepat: ' + choices[key];
                yourAnswer.className = 'mt-2 text-[#756a5b]';
                yourAnswer.textContent = 'Jawabanmu: ' + choices[answers[index]];

                meta.append(badge, status);
                item.append(meta, heading, correctAnswer, yourAnswer);
                review.append(item);
            });

            document.querySelector('#quiz-position').hidden = true;
            progress.hidden = true;
            form.hidden = true;
            result.hidden = false;
            document.querySelector('#result-title').focus();
            window.scrollTo(0, 0);
        }

        previous.addEventListener('click', () => {
            current -= 1;
            showQuestion();
            title.focus();
        });

        form.addEventListener('submit', (event) => {
            event.preventDefault();

            const selectedAnswer = form.querySelector('input[name="answer"]:checked');
            if (!selectedAnswer) return;

            answers[current] = Number(selectedAnswer.value);

            if (current === questions.length - 1) {
                showResult();
                return;
            }

            current += 1;
            showQuestion();
            title.focus();
        });

        showQuestion();
    </script>
@endif