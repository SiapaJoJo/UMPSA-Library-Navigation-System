<x-guest-layout>
    <!-- Header Section -->
    <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 text-white overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-10 left-10 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-96 h-96 bg-blue-300/20 rounded-full blur-3xl"></div>
            </div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/10 rounded-full mb-6 backdrop-blur-sm">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl font-bold mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">Library Gallery</h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                    Explore our library through beautiful images showcasing our facilities, spaces, and community.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($galleries->count() > 0)
            <!-- Category Filter -->
            @if($categories->count() > 0)
                <div class="mb-12">
                    <div class="flex flex-wrap justify-center gap-3">
                        <a href="{{ route('guest.gallery.index') }}" 
                           class="px-6 py-3 rounded-full text-sm font-semibold transition-all duration-200 {{ request()->routeIs('guest.gallery.index') ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg' : 'bg-white/80 backdrop-blur-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 border border-gray-200' }}">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            All Images
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('guest.gallery.category', $category) }}" 
                               class="px-6 py-3 rounded-full text-sm font-semibold transition-all duration-200 {{ request()->is('guest/gallery/category/' . $category) ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg' : 'bg-white/80 backdrop-blur-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 border border-gray-200' }}">
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                {{ $category }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($galleries as $gallery)
                    <div class="group bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border border-white/20 hover:-translate-y-2">
                        <div class="relative overflow-hidden">
                            <img src="{{ $gallery->image_url }}" 
                                 alt="{{ $gallery->alt_text ?: $gallery->title }}" 
                                 class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500">
                            
                            @if($gallery->is_featured)
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-gradient-to-r from-yellow-500 to-orange-500 text-white text-xs font-bold rounded-full shadow-lg flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        Featured
                                    </span>
                                </div>
                            @endif
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-end justify-center pb-6">
                                <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <a href="{{ route('guest.gallery.show', $gallery) }}" 
                                       class="inline-flex items-center px-6 py-3 bg-white/90 backdrop-blur-sm text-gray-900 text-sm font-semibold rounded-xl hover:bg-white transition-all duration-200 shadow-lg">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-200">{{ $gallery->title }}</h3>
                            
                            @if($gallery->category)
                                <div class="mb-3">
                                    <span class="inline-flex items-center px-3 py-1 bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 text-xs font-semibold rounded-full border border-blue-200">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        {{ $gallery->category }}
                                    </span>
                                </div>
                            @endif
                            
                            @if($gallery->description)
                                <p class="text-sm text-gray-600 leading-relaxed">{{ Str::limit($gallery->description, 100) }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-4">No images available</h3>
                <p class="text-gray-500 text-lg">Gallery images are not available at the moment.</p>
            </div>
        @endif
    </div>
</x-guest-layout>
