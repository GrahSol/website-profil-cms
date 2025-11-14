<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Principle') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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

                <form method="POST" action="{{ route('admin.principles.update', $principle->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" 
                            value="{{ old('name', $principle->name) }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="subtitle" :value="__('Subtitle')" />
                        <textarea name="subtitle" id="subtitle" rows="5" 
                            class="block mt-1 w-full border border-slate-300 rounded-xl p-3"
                            required>{{ old('subtitle', $principle->subtitle) }}</textarea>
                        <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        
                        @if($principle->thumbnail)
                            <div class="mb-3">
                                <p class="text-sm text-gray-600 mb-2">Current Thumbnail:</p>
                                <img src="{{ Storage::url($principle->thumbnail) }}" alt="Current thumbnail" 
                                    class="rounded-2xl object-cover w-32 h-32 border border-gray-300">
                            </div>
                        @endif

                        <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                        <p class="text-sm text-gray-500 mt-1">Upload new thumbnail to replace the current one</p>
                    </div>

                    <div class="mb-6">
                        <x-input-label for="icon" :value="__('Icon')" />
                        
                        @if($principle->icon)
                            <div class="mb-3">
                                <p class="text-sm text-gray-600 mb-2">Current Icon:</p>
                                <img src="{{ Storage::url($principle->icon) }}" alt="Current icon" 
                                    class="rounded-2xl object-cover w-20 h-20 border border-gray-300">
                            </div>
                        @endif

                        <x-text-input id="icon" class="block mt-1 w-full" type="file" name="icon" />
                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                        <p class="text-sm text-gray-500 mt-1">Upload new icon to replace the current one</p>
                    </div>

                    <div class="flex items-center justify-end mt-4 gap-3">
                        <a href="{{ route('admin.principles.index') }}" class="font-bold py-3 px-6 bg-gray-500 text-white rounded-full">
                            Cancel
                        </a>
                        <button type="submit" class="font-bold py-3 px-6 bg-indigo-700 text-white rounded-full">
                            Update Hero Section
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>