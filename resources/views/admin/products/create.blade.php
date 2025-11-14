<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Company About') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">
                
                @if($errors->any())
                    <div class="mb-5">
                        @foreach($errors->all() as $error)
                            <div class="py-3 px-5 mb-3 rounded-3xl bg-red-500 text-white">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.abouts.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="type" :value="__('Type')" />
                        <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type')" required autofocus autocomplete="type" />
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" required autofocus autocomplete="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="keypoints" :value="__('Keypoints')" />
                        <div id="keypoints-container">
                            <div class="flex gap-2 mb-2">
                                <x-text-input type="text" name="keypoints[]" class="block w-full" placeholder="Enter keypoint" />
                                <button type="button" onclick="removeKeypoint(this)" class="px-3 bg-red-500 text-white rounded">-</button>
                            </div>
                        </div>
                        <button type="button" onclick="addKeypoint()" class="mt-2 px-4 py-2 bg-green-500 text-white rounded">+ Add Keypoint</button>
                        <x-input-error :messages="$errors->get('keypoints')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Add New Company About
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function addKeypoint() {
            const container = document.getElementById('keypoints-container');
            const div = document.createElement('div');
            div.className = 'flex gap-2 mb-2';
            div.innerHTML = `
                <x-text-input type="text" name="keypoints[]" class="block w-full" placeholder="Enter keypoint" />
                <button type="button" onclick="removeKeypoint(this)" class="px-3 bg-red-500 text-white rounded">-</button>
            `;
            container.appendChild(div);
        }

        function removeKeypoint(button) {
            if (document.querySelectorAll('#keypoints-container > div').length > 1) {
                button.parentElement.remove();
            } else {
                alert('Minimum one keypoint is required');
            }
        }
    </script>
</x-app-layout>