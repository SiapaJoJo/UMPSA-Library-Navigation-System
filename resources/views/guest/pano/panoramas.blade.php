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
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-white/10 rounded-full mb-4 md:mb-6 backdrop-blur-sm">
                    <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl md:text-5xl font-bold mb-4 md:mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">Virtual Library Tours</h1>
                <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed px-4">
                    Explore our library through immersive 360° panoramic tours. Navigate through different sections and discover all the resources available to you.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
        @if($panoramas->count() > 0)
            <!-- Panoramas Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8">
                @foreach($panoramas as $panorama)
                    <div class="group bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border border-white/20 hover:-translate-y-2">
                        <!-- Panorama Preview -->
                        <div class="relative aspect-w-16 aspect-h-9 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                            @if($panorama->display_image)
                                <img src="{{ asset('panos/' . $panorama->folder . '/' . $panorama->display_image) }}" 
                                     alt="{{ $panorama->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                                    <div class="text-center text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-3">
                                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-sm font-semibold">360° Tour</p>
                                    </div>
                                </div>
                            @else
                                <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-blue-400 to-blue-600 group-hover:from-blue-500 group-hover:to-blue-700 transition-all duration-300">
                                    <div class="text-center text-white">
                                        <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                            <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-sm font-semibold">360° Panorama</p>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Floor Badge -->
                            @if($panorama->floor)
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-blue-800 text-xs font-bold rounded-full shadow-lg flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        {{ $panorama->floor }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <div class="p-4 md:p-6">
                            <h3 class="text-lg md:text-2xl font-bold text-gray-900 mb-2 md:mb-3 group-hover:text-blue-600 transition-colors duration-200">{{ $panorama->name }}</h3>
                            
                            @if($panorama->description)
                                <p class="text-gray-600 text-xs md:text-sm mb-3 md:mb-4 leading-relaxed line-clamp-2">
                                    {{ Str::limit($panorama->description, 100) }}
                                </p>
                            @endif
                            
                            <div class="flex items-center justify-between mb-4 md:mb-6">
                                <p class="text-gray-500 text-xs flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="hidden sm:inline">Created {{ $panorama->created_at->format('M d, Y') }}</span>
                                    <span class="sm:hidden">{{ $panorama->created_at->format('M d') }}</span>
                                </p>
                            </div>
                            
                            <!-- Action Button -->
                            <a href="{{ route('pano.view', $panorama->id) }}" 
                               class="group/btn inline-flex items-center justify-center w-full px-4 md:px-6 py-2 md:py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-xs md:text-sm font-semibold rounded-lg md:rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl group-hover:scale-105 transform">
                                <svg class="w-3 h-3 md:w-4 md:h-4 mr-2 group-hover/btn:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <span class="hidden sm:inline">View Tour</span>
                                <span class="sm:hidden">View</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12 md:py-20">
                <div class="inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-gray-100 rounded-full mb-4 md:mb-6">
                    <svg class="w-8 h-8 md:w-10 md:h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl md:text-2xl font-semibold text-gray-900 mb-3 md:mb-4">No Virtual Tours Available</h3>
                <p class="text-gray-500 text-base md:text-lg mb-6 md:mb-8 px-4">Check back later for immersive library tours.</p>
                <a href="{{ route('guest.dashboard') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm md:text-base font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Home
                </a>
            </div>
        @endif
    </div>

</x-guest-layout>
