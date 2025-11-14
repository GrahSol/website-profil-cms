<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Hero Section') }}
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

                <form method="POST" action="{{ route('admin.hero_sections.update', $heroSection->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <x-input-label for="heading" :value="__('Heading')" />
                        <x-text-input id="heading" class="block mt-1 w-full" type="text" name="heading" 
                            value="{{ old('heading', $heroSection->heading) }}" required autofocus />
                        <x-input-error :messages="$errors->get('heading')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="banner" :value="__('Banner')" />
                        <img src="{{ Storage::url($heroSection->banner) }}" alt="" class="rounded-2xl object-cover w-[120px] h-[80px] mb-3">
                        <x-text-input id="banner" class="block mt-1 w-full" type="file" name="banner" />
                        <x-input-error :messages="$errors->get('banner')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="subheading" :value="__('Subheading')" />
                        <textarea name="subheading" id="subheading" rows="3" class="block mt-1 w-full border border-slate-300 rounded-xl p-2">{{ old('subheading', $heroSection->subheading) }}</textarea>
                        <x-input-error :messages="$errors->get('subheading')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="achievement" :value="__('Achievement')" />
                        <x-text-input id="achievement" class="block mt-1 w-full" type="text" name="achievement" 
                            value="{{ old('achievement', $heroSection->achievement) }}" />
                        <x-input-error :messages="$errors->get('achievement')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="path_video" :value="__('Path Video')" />
                        <x-text-input id="path_video" class="block mt-1 w-full" type="text" name="path_video" 
                            value="{{ old('path_video', $heroSection->path_video) }}" />
                        <x-input-error :messages="$errors->get('path_video')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4 gap-3">
                        <a href="{{ route('admin.hero_sections.index') }}" class="font-bold py-3 px-6 bg-gray-500 text-white rounded-full">
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