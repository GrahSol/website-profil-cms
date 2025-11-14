<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit About') }}
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

                <form method="POST" action="{{ route('admin.abouts.update', $companyAbout) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" 
                            value="{{ old('name', $companyAbout->name) }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="type" :value="__('Type')" />
                        <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" 
                            value="{{ old('type', $companyAbout->type) }}" required />
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        @if($companyAbout->thumbnail)
                            <div class="mb-3">
                                <p class="text-sm text-gray-600 mb-2">Current image:</p>
                                <img src="{{ Storage::url($companyAbout->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[90px] h-[90px]">
                            </div>
                        @endif
                        <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                        <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                    </div>

                    <!-- Keypoints Section -->
                    <div class="mt-4">
                        <x-input-label for="keypoints" :value="__('Keypoints')" />
                        <div id="keypoints-container">
                            @foreach(old('keypoints', $companyAbout->keypoints ?? []) as $index => $keypoint)
                                <div class="keypoint-item flex gap-3 mb-2">
                                    <x-text-input 
                                        type="text" 
                                        name="keypoints[]" 
                                        value="{{ is_object($keypoint) ? $keypoint->name : $keypoint }}" 
                                        class="block w-full" 
                                        placeholder="Enter keypoint"
                                    />
                                    <button type="button" class="remove-keypoint bg-red-500 text-white px-3 py-2 rounded-full">
                                        Remove
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-keypoint" class="bg-green-500 text-white px-4 py-2 rounded-full mt-2">
                            Add Keypoint
                        </button>
                        <x-input-error :messages="$errors->get('keypoints.*')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4 gap-3">
                        <a href="{{ route('admin.abouts.index') }}" class="font-bold py-4 px-6 bg-gray-500 text-white rounded-full">
                            Cancel
                        </a>
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update About
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add keypoint
            document.getElementById('add-keypoint').addEventListener('click', function() {
                const container = document.getElementById('keypoints-container');
                const div = document.createElement('div');
                div.className = 'keypoint-item flex gap-3 mb-2';
                div.innerHTML = `
                    <x-text-input type="text" name="keypoints[]" class="block w-full" placeholder="Enter keypoint" />
                    <button type="button" class="remove-keypoint bg-red-500 text-white px-3 py-2 rounded-full">
                        Remove
                    </button>
                `;
                container.appendChild(div);
            });

            // Remove keypoint
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-keypoint')) {
                    e.target.closest('.keypoint-item').remove();
                }
            });
        });
    </script>
</x-app-layout>