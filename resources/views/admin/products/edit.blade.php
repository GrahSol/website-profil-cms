<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
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

                <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" 
                            value="{{ old('name', $product->name) }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="tagline" :value="__('Tagline')" />
                        <x-text-input id="tagline" class="block mt-1 w-full" type="text" name="tagline" 
                            value="{{ old('tagline', $product->tagline) }}" required />
                        <x-input-error :messages="$errors->get('tagline')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        @if($product->thumbnail)
                            <div class="mb-3">
                                <p class="text-sm text-gray-600 mb-2">Current image:</p>
                                <img src="{{ Storage::url($product->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[90px] h-[90px]">
                            </div>
                        @endif
                        <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                        <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="about" :value="__('About')" />
                        <textarea name="about" id="about" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full">{{ old('about', $product->about) }}</textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4 gap-3">
                        <a href="{{ route('admin.products.index') }}" class="font-bold py-4 px-6 bg-gray-500 text-white rounded-full">
                            Cancel
                        </a>
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Product
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>