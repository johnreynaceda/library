<div class="p-6 bg-white shadow-lg rounded-lg mt-12 max-w-lg mx-auto w-3/12">
    <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Profile</h2>

    <!-- Profile Photo -->
    <div class="flex justify-center mb-6">
        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://via.placeholder.com/150' }}" alt="Profile Photo" class="w-40 h-40 rounded-full object-cover border-2 border-gray-200 shadow-md" id="profilePhoto">
    </div>

    <div class="space-y-6 text-center">
        <p class="text-xl font-semibold text-gray-700">Name: <span class="font-normal">{{ $user->name }}</span></p>
        <p class="text-xl font-semibold text-gray-700">Email: <span class="font-normal">{{ $user->email }}</span></p>
        <p class="text-xl font-semibold text-gray-700">ID: <span class="font-normal">{{ $user->custom_id }}</span></p>
    </div>

    <!-- Edit and Download Buttons -->
    <div class="mt-8 text-center">
        <x-button primary wire:click="$set('edit_modal', true)" class="bg-blue-600 hover:bg-blue-700 transition">
            Edit Profile
        </x-button>

        <button onclick="downloadUserId()" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition">
            Download Profile
        </button>
    </div>

    <!-- Edit Modal -->
    <x-modal-card title="Edit Profile" name="edit_modal" wire:model.defer="edit_modal" class="max-w-md mx-auto">
        <div class="space-y-6">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input wire:model.defer="name" id="name" type="text" class="block w-full mt-1" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model.defer="email" id="email" type="email" class="block w-full mt-1" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Photo -->
            <div>
                <x-input-label for="photo" :value="__('Profile Photo')" />
                <input type="file" wire:model="photo" id="photo" class="block w-full mt-1" />
                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                @if ($photo && $photo instanceof \Livewire\TemporaryUploadedFile)
                    <img src="{{ $photo->temporaryUrl() }}" alt="Profile Photo Preview" class="mt-2 w-32 h-32 rounded-full object-cover border-2 border-gray-200 shadow-md">
                @endif
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Cancel" x-on:click="$set('edit_modal', false)" class="bg-gray-300 hover:bg-gray-400 transition" />
                <x-button primary label="Update" wire:click="updateProfile" class="bg-blue-600 hover:bg-blue-700 transition" />
            </div>
        </x-slot>
    </x-modal-card>


    <script>
        async function downloadUserId() {
            const { jsPDF } = window.jspdf;


            const name = "{{ $user->name }}";
            const id = "{{ $user->custom_id }}";
            const photoSrc = document.getElementById('profilePhoto').src;


            const doc = new jsPDF({
                unit: 'in',
                format: [3.5, 4],
            });


            const response = await fetch(photoSrc);
            const imageBlob = await response.blob();
            const imageUrl = URL.createObjectURL(imageBlob);


            const img = new Image();
            img.src = imageUrl;

            img.onload = function () {
                doc.addImage(img, 'JPEG', 0.1, 0.2, 1, 1, undefined, 'JPEG');


                doc.setFontSize(12);
                doc.text(`Name: ${name}`, 1.2, 0.6);
                doc.text(`ID: ${id}`, 1.2, 0.8);


                doc.save('StudentIDCard.pdf');
            };
        }
    </script>


</div>

