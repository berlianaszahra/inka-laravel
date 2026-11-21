<dialog id="feature-dialog"
    aria-labelledby="feature-dialog-title"
    data-features="{{ json_encode($features, JSON_THROW_ON_ERROR) }}"
    class="m-auto w-[calc(100%_-_2rem)] max-w-md rounded-3xl bg-[#fff9ef] p-7 text-[#493627] shadow-xl backdrop:bg-black/50">
    <h2 id="feature-dialog-title" class="text-2xl font-bold"></h2>
    <p id="feature-dialog-description" class="mt-3 text-[#756a5b]"></p>

    <form method="dialog" class="mt-6">
        <button type="submit"
            class="w-full rounded-xl bg-[#315b37] px-5 py-3 font-bold text-white hover:bg-[#284a2d]">
            Tutup
        </button>
    </form>
</dialog>

<script>
    const dialog = document.querySelector('#feature-dialog');
    const dialogTitle = document.querySelector('#feature-dialog-title');
    const dialogDescription = document.querySelector('#feature-dialog-description');
    const features = JSON.parse(dialog.dataset.features);

    const featureDetails = new Map(
        features.map(([id, title, description]) => [id, { title, description }])
    );

    featureDetails.set('profil', {
        title: 'Profil Akun',
        description: 'Halaman profil sedang disiapkan.'
    });

    for (const button of document.querySelectorAll('[data-feature]')) {
        button.addEventListener('click', () => {
            const feature = featureDetails.get(button.dataset.feature);
            dialogTitle.textContent = feature.title;
            dialogDescription.textContent = feature.description;
            dialog.showModal();
        });
    }
</script>