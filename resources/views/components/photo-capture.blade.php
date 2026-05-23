@props([
    'name' => 'photo_base64',
    'value' => null,
])

@php
    $id = uniqid('photo_');
@endphp

<div class="col-span-2">

    <x-input-label :for="$id" value="Photo" />

    {{-- Webcam --}}
    <div class="mt-2">
        <video id="{{ $id }}_camera"
               autoplay
               playsinline
               class="w-64 h-48 border rounded bg-black">
        </video>
    </div>

    {{-- Boutons --}}
    <div class="flex gap-2 mt-2">

        <button type="button"
                id="{{ $id }}_take"
                class="px-4 py-2 bg-blue-600 text-white rounded">
            Prendre une photo
        </button>

        {{-- Galerie --}}
        <label class="px-4 py-2 bg-gray-600 text-white rounded cursor-pointer">
            Galerie
            <input type="file"
                   id="{{ $id }}_gallery"
                   accept="image/*"
                   class="hidden">
        </label>

    </div>

    {{-- Message erreur --}}
    <p id="{{ $id }}_message"
       class="text-sm text-red-500 mt-2 hidden">
    </p>

    {{-- Canvas --}}
    <canvas id="{{ $id }}_canvas" class="hidden"></canvas>

    {{-- Preview --}}
    <div class="mt-3">

        <img id="{{ $id }}_preview"
             src="{{ $value }}"
             class="h-24 w-24 rounded-full object-cover border {{ $value ? '' : 'hidden' }}">

    </div>

    {{-- Hidden input --}}
    <input type="hidden"
           name="{{ $name }}"
           id="{{ $id }}_input"
           value="{{ $value }}">

</div>

<script>
(() => {

    const video = document.getElementById('{{ $id }}_camera');
    const canvas = document.getElementById('{{ $id }}_canvas');
    const preview = document.getElementById('{{ $id }}_preview');

    const takeBtn = document.getElementById('{{ $id }}_take');

    const galleryInput = document.getElementById('{{ $id }}_gallery');

    const hiddenInput = document.getElementById('{{ $id }}_input');

    const message = document.getElementById('{{ $id }}_message');

    async function startCamera() {

        if (!navigator.mediaDevices ||
            !navigator.mediaDevices.getUserMedia) {

            showError(
                "Caméra non supportée. Utilisez la galerie."
            );

            return;
        }

        try {

            const stream = await navigator.mediaDevices.getUserMedia({
                video: true
            });

            video.srcObject = stream;

        } catch (error) {

            console.error(error);

            showError(
                "Impossible d'accéder à la caméra. Utilisez la galerie."
            );
        }
    }

    function showError(text) {

        message.textContent = text;

        message.classList.remove('hidden');

        video.classList.add('hidden');

        takeBtn.classList.add('hidden');
    }

    // Capture webcam
    takeBtn.addEventListener('click', () => {

        const context = canvas.getContext('2d');

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        context.drawImage(video, 0, 0);

        const image = canvas.toDataURL('image/png');

        preview.src = image;

        preview.classList.remove('hidden');

        hiddenInput.value = image;
    });

    // Galerie
    galleryInput.addEventListener('change', (e) => {

        const file = e.target.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = function(event) {

            preview.src = event.target.result;

            preview.classList.remove('hidden');

            hiddenInput.value = event.target.result;
        };

        reader.readAsDataURL(file);
    });

    startCamera();

})();
</script>