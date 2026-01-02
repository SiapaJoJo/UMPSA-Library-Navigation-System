<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 relative overflow-hidden">
        <!-- Animated Background Grid -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        
        <!-- Floating Orbs -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-pink-400/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-400/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

        <!-- Hero Section -->
        <section class="relative w-full py-24 md:py-32 overflow-hidden">
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="inline-block mb-6">
                        <span class="text-sm font-semibold text-pink-600 uppercase tracking-wider bg-pink-50 px-4 py-2 rounded-full">Category</span>
                    </div>
                    <h1 class="text-6xl md:text-8xl font-extrabold mb-6 bg-gradient-to-r from-pink-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent animate-gradient bg-[length:200%_auto]">
                        {{ $category }} Gallery
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-700 max-w-3xl mx-auto leading-relaxed">
                        Explore our {{ strtolower($category) }} images and discover what our library has to offer.
                    </p>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            @if($galleries->count() > 0)
                <!-- Category Filter -->
                <div class="mb-12">
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('guest.gallery.index') }}" 
                           class="group px-6 py-3 rounded-2xl text-sm font-bold transition-all duration-300 {{ request()->routeIs('guest.gallery.index') ? 'bg-gradient-to-r from-pink-600 to-purple-600 text-white shadow-xl scale-105' : 'bg-white/80 backdrop-blur-sm text-gray-700 hover:bg-pink-50 hover:text-pink-700 border border-gray-200/50 hover:scale-105 hover:shadow-lg' }}">
                            <svg class="w-4 h-4 mr-2 inline group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            All Images
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('guest.gallery.category', $cat) }}" 
                               class="group px-6 py-3 rounded-2xl text-sm font-bold transition-all duration-300 {{ $cat === $category ? 'bg-gradient-to-r from-pink-600 to-purple-600 text-white shadow-xl scale-105' : 'bg-white/80 backdrop-blur-sm text-gray-700 hover:bg-pink-50 hover:text-pink-700 border border-gray-200/50 hover:scale-105 hover:shadow-lg' }}">
                                <svg class="w-4 h-4 mr-2 inline group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                {{ $cat }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Gallery Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
                    @foreach($galleries as $gallery)
                        <div class="group relative bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 border border-gray-200/50 transform hover:-translate-y-4 hover:scale-[1.02]">
                            <div class="relative overflow-hidden">
                                <img src="{{ $gallery->image_url }}" 
                                     alt="{{ $gallery->alt_text ?: $gallery->title }}" 
                                     class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-700">
                                
                                @if($gallery->is_featured)
                                    <div class="absolute top-4 right-4">
                                        <span class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 text-white text-xs font-bold rounded-full shadow-xl flex items-center border border-white/30">
                                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            Featured
                                        </span>
                                    </div>
                                @endif
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end justify-center pb-8">
                                    <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                        <a href="{{ route('guest.gallery.show', $gallery) }}" 
                                           class="group/btn inline-flex items-center px-8 py-4 bg-white/90 backdrop-blur-xl text-gray-900 text-sm font-bold rounded-2xl hover:bg-white transition-all duration-300 shadow-2xl hover:scale-105 border border-white/50">
                                            <svg class="w-5 h-5 mr-2 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-6 md:p-8">
                                <h3 class="text-xl md:text-2xl font-extrabold text-gray-900 mb-4 group-hover:text-pink-600 transition-colors duration-300">{{ $gallery->title }}</h3>
                                
                                @if($gallery->description)
                                    <p class="text-sm md:text-base text-gray-600 leading-relaxed line-clamp-2">{{ Str::limit($gallery->description, 80) }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 md:py-32">
                    <div class="inline-flex items-center justify-center w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full mb-8 shadow-xl">
                        <svg class="w-12 h-12 md:w-16 md:h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">No {{ strtolower($category) }} images</h3>
                    <p class="text-gray-600 text-lg md:text-xl mb-10 max-w-2xl mx-auto">No images available in this category at the moment.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('guest.gallery.index') }}" 
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-2xl hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                            View All Images
                        </a>
                        <a href="{{ route('guest.dashboard') }}" 
                           class="inline-flex items-center px-8 py-4 bg-white/80 backdrop-blur-xl text-gray-700 font-bold rounded-2xl border-2 border-gray-200 hover:bg-white transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Home
                        </a>
                    </div>
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
