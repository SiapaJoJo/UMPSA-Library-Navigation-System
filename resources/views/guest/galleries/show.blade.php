<x-guest-layout>
    <!-- Header Section -->
    <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 text-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-10 left-10 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-96 h-96 bg-blue-300/20 rounded-full blur-3xl"></div>
            </div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
            <!-- Back to Gallery Link -->
            <div class="mb-4 md:mb-6">
                <a href="{{ route('guest.gallery.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm text-white text-sm font-medium rounded-lg hover:bg-white/30 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Gallery
                </a>
            </div>
            
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-white/10 rounded-full mb-4 md:mb-6 backdrop-blur-sm">
                    <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold mb-2 md:mb-4 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">{{ $gallery->title }}</h1>
                @if($gallery->category)
                    <p class="text-lg md:text-xl text-blue-100">{{ $gallery->category }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
            <!-- Image -->
            <div class="lg:col-span-2">
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden border border-white/20">
                    <img src="{{ $gallery->image_url }}" 
                         alt="{{ $gallery->alt_text ?: $gallery->title }}" 
                         class="w-full h-auto max-h-[400px] md:max-h-[500px] object-cover">
                </div>
            </div>

            <!-- Image Details -->
            <div class="space-y-4 md:space-y-6">
                @if($gallery->category)
                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-4 md:p-6 border border-white/20">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 md:mb-4 flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            Category
                        </h2>
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border border-blue-300">
                            {{ $gallery->category }}
                        </span>
                    </div>
                @endif

                @if($gallery->description)
                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-4 md:p-6 border border-white/20">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 md:mb-4 flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            Description
                        </h2>
                        <p class="text-gray-600 leading-relaxed text-sm md:text-base">{{ $gallery->description }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
