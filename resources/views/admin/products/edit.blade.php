<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Product') }}
            </h2>
            <a href="{{ route('admin.products.index') }}" class="font-bold py-4 px-6 bg-gray-500 text-white rounded-full">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                
                @if($errors->any())
                    <div class="mb-5">
                        @foreach($errors->all() as $error)
                        <div class="py-3 px-5 mb-3 rounded-3xl bg-red-500 text-white">
                            {{ $error }}
                        </div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col gap-y-5">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" 
                                value="{{ old('name', $product->name) }}" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="5" class="block mt-1 w-full border border-slate-300 rounded-xl" 
                                required>{{ old('description', $product->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" 
                                value="{{ old('price', $product->price) }}" required autocomplete="price" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="image" :value="__('Image')" />
                            <img src="{{ Storage::url($product->image) }}" alt="Current image" class="rounded-2xl object-cover w-[120px] h-[120px] mb-3">
                            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" autocomplete="image" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            <p class="text-sm text-slate-500 mt-1">Leave empty to keep current image</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 gap-x-3">
                        <a href="{{ route('admin.products.index') }}" class="font-bold py-3 px-6 bg-gray-500 text-white rounded-full">
                            Cancel
                        </a>
                        <button type="submit" class="font-bold py-3 px-6 bg-indigo-700 text-white rounded-full">
                            Update Product
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>