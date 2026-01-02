<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 relative overflow-hidden">
        <!-- Animated Background Grid -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        
        <!-- Floating Orbs -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-400/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-400/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

        <!-- Hero Section -->
        <section class="relative w-full py-24 md:py-32 overflow-hidden">
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="inline-block mb-6">
                        <span class="text-sm font-semibold text-purple-600 uppercase tracking-wider bg-purple-50 px-4 py-2 rounded-full">Virtual Experience</span>
                    </div>
                    <h1 class="text-6xl md:text-8xl font-extrabold mb-6 bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 bg-clip-text text-transparent animate-gradient bg-[length:200%_auto]">
                        Virtual Library Tours
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-700 max-w-3xl mx-auto leading-relaxed">
                        Explore our library through immersive 360° panoramic tours. Navigate through different sections and discover all the resources available to you.
                    </p>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            @if($panoramas->count() > 0)
                <!-- Panoramas Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($panoramas as $panorama)
                        <div class="group relative bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 border border-gray-200/50 transform hover:-translate-y-4 hover:scale-[1.02]">
                            <!-- Panorama Preview -->
                            <div class="relative aspect-w-16 aspect-h-9 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                                @if($panorama->display_image)
                                    <img src="{{ asset('panos/' . $panorama->folder . '/' . $panorama->display_image) }}" 
                                         alt="{{ $panorama->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center">
                                        <div class="text-center text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                            <div class="w-20 h-20 bg-white/20 backdrop-blur-xl rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-500 shadow-2xl">
                                                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <p class="text-base font-bold">360° Tour</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-purple-500 to-indigo-600 group-hover:from-purple-600 group-hover:to-indigo-700 transition-all duration-500">
                                        <div class="text-center text-white">
                                            <div class="w-24 h-24 bg-white/20 backdrop-blur-xl rounded-full flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-2xl">
                                                <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <p class="text-base font-bold">360° Panorama</p>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Floor Badge -->
                                @if($panorama->floor)
                                    <div class="absolute top-4 left-4">
                                        <span class="px-4 py-2 bg-white/90 backdrop-blur-xl text-blue-800 text-xs font-bold rounded-full shadow-xl flex items-center border border-white/50">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                            {{ $panorama->floor }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Content -->
                            <div class="p-6 md:p-8">
                                <h3 class="text-xl md:text-2xl font-extrabold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors duration-300">{{ $panorama->name }}</h3>
                                
                                @if($panorama->description)
                                    <p class="text-gray-600 text-sm md:text-base mb-6 leading-relaxed line-clamp-2">
                                        {{ Str::limit($panorama->description, 100) }}
                                    </p>
                                @endif
                                
                                <div class="flex items-center justify-between mb-6">
                                    <p class="text-gray-500 text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="hidden sm:inline">Created {{ $panorama->created_at->format('M d, Y') }}</span>
                                        <span class="sm:hidden">{{ $panorama->created_at->format('M d') }}</span>
                                    </p>
                                </div>
                                
                                <!-- Action Button -->
                                <a href="{{ route('pano.view', $panorama->id) }}" 
                                   class="group/btn inline-flex items-center justify-center w-full px-6 py-4 bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 text-white text-sm md:text-base font-bold rounded-2xl hover:from-purple-700 hover:via-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-1000"></div>
                                    <svg class="w-5 h-5 mr-2 relative z-10 group-hover/btn:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span class="relative z-10">View Tour</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20 md:py-32">
                    <div class="inline-flex items-center justify-center w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full mb-8 shadow-xl">
                        <svg class="w-12 h-12 md:w-16 md:h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">No Virtual Tours Available</h3>
                    <p class="text-gray-600 text-lg md:text-xl mb-10 max-w-2xl mx-auto">Check back later for immersive library tours.</p>
                    <a href="{{ route('guest.dashboard') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-2xl hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Home
                    </a>
                </div>
            @endif
        </div>
    </div>

    <style>
        @keyframes gradient {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }

        .animate-gradient {
            animation: gradient 8s ease infinite;
        }
    </style>
</x-guest-layout>
