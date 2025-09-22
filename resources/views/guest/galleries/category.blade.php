<x-guest-layout>
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">{{ $category }} Gallery</h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    Explore our {{ strtolower($category) }} images and discover what our library has to offer.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($galleries->count() > 0)
            <!-- Category Filter -->
            <div class="mb-8">
                <div class="flex flex-wrap justify-center gap-2">
                    <a href="{{ route('guest.gallery.index') }}" 
                       class="px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-700 hover:bg-gray-200">
                        All Images
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('guest.gallery.category', $cat) }}" 
                           class="px-4 py-2 rounded-full text-sm font-medium {{ $cat === $category ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($galleries as $gallery)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                        <div class="relative overflow-hidden">
                            <img src="{{ $gallery->image_url }}" 
                                 alt="{{ $gallery->alt_text ?: $gallery->title }}" 
                                 class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            
                            @if($gallery->is_featured)
                                <div class="absolute top-2 right-2">
                                    <span class="px-2 py-1 bg-yellow-500 text-white text-xs font-medium rounded-full">
                                        Featured
                                    </span>
                                </div>
                            @endif
                            
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <a href="{{ route('guest.gallery.show', $gallery) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-white text-gray-900 text-sm font-medium rounded-md hover:bg-gray-100">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $gallery->title }}</h3>
                            
                            @if($gallery->description)
                                <p class="text-sm text-gray-600">{{ Str::limit($gallery->description, 80) }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No {{ strtolower($category) }} images</h3>
                <p class="mt-2 text-gray-500">No images available in this category at the moment.</p>
                <div class="mt-6">
                    <a href="{{ route('guest.gallery.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                        View All Images
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-guest-layout>
