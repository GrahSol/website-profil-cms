<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Hero Sections') }}
            </h2>
            <a href="{{ route('admin.hero_sections.create') }}" class="font-bold py-3 px-6 bg-indigo-700 text-white rounded-full">
                Add New Hero Section
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header Table -->
                    <div class="grid grid-cols-12 gap-4 px-6 py-4 bg-gray-50 rounded-lg border-b font-semibold text-gray-700">
                        <div class="col-span-1">No</div>
                        <div class="col-span-3">Banner</div>
                        <div class="col-span-4">Content</div>
                        <div class="col-span-2">Date Created</div>
                        <div class="col-span-2 text-center">Actions</div>
                    </div>

                    <!-- Data Rows -->
                    @forelse($hero_sections as $hero_section)
                    <div class="grid grid-cols-12 gap-4 px-6 py-6 items-center border-b hover:bg-gray-50 transition duration-150">
                        <!-- No -->
                        <div class="col-span-1 text-gray-600 font-medium">
                            {{ $loop->iteration }}
                        </div>
                        
                        <!-- Banner -->
                        <div class="col-span-3">
                            <img src="{{ Storage::url($hero_section->banner) }}" 
                                 alt="Banner" 
                                 class="w-20 h-12 object-cover rounded-lg border shadow-sm">
                        </div>
                        
                        <!-- Content -->
                        <div class="col-span-4">
                            <h3 class="font-bold text-gray-900 text-lg mb-1">
                                {{ $hero_section->heading }}
                            </h3>
                            @if($hero_section->subheading)
                            <p class="text-sm text-gray-600 line-clamp-2">
                                {{ $hero_section->subheading }}
                            </p>
                            @endif
                            @if($hero_section->achievement)
                            <p class="text-xs text-indigo-600 mt-1">
                                {{ Str::limit($hero_section->achievement, 50) }}
                            </p>
                            @endif
                        </div>
                        
                        <!-- Date -->
                        <div class="col-span-2">
                            <p class="text-sm text-gray-500 font-medium">
                                {{ $hero_section->created_at->format('M d, Y') }}
                            </p>
                            <p class="text-xs text-gray-400">
                                {{ $hero_section->created_at->format('H:i') }}
                            </p>
                        </div>
                        
                        <!-- Actions -->
                        <div class="col-span-2 flex flex-row justify-center gap-2">
                            <a href="{{ route('admin.hero_sections.edit', $hero_section) }}" 
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition duration-200">
                                Edit
                            </a>
                            <form action="{{ route('admin.hero_sections.destroy', $hero_section) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition duration-200"
                                        onclick="return confirm('Are you sure you want to delete this hero section?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div class="text-gray-400 text-6xl mb-4">📷</div>
                        <h3 class="text-lg font-semibold text-gray-600 mb-2">No Hero Sections Found</h3>
                        <p class="text-gray-500 mb-6">Get started by creating your first hero section.</p>
                        <a href="{{ route('admin.hero_sections.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition duration-200">
                            Create First Hero Section
                        </a>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($hero_sections->hasPages())
                <div class="px-6 py-4 border-t bg-gray-50">
                    {{ $hero_sections->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>