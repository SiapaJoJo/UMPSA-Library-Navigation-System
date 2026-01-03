<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 relative overflow-hidden">
        
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] dark:bg-[linear-gradient(to_right,#ffffff08_1px,transparent_1px),linear-gradient(to_bottom,#ffffff08_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        
        
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-pink-400/20 dark:bg-pink-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-400/20 dark:bg-indigo-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

        
        <section class="relative w-full py-16 md:py-24 overflow-hidden">
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="mb-6 md:mb-8">
                    <a href="{{ route('guest.gallery.index') }}" 
                       class="group inline-flex items-center px-6 py-3 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl text-gray-700 dark:text-gray-300 text-sm font-bold rounded-2xl hover:bg-white dark:hover:bg-gray-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 border border-gray-200/50 dark:border-gray-700/50">
                        <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Gallery
                    </a>
                </div>
                
                <div class="text-center">
                    <div class="inline-block mb-6">
                        <span class="text-sm font-semibold text-pink-600 dark:text-pink-400 uppercase tracking-wider bg-pink-50 dark:bg-pink-900/30 px-4 py-2 rounded-full">Gallery</span>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-extrabold mb-4 bg-gradient-to-r from-pink-600 via-purple-600 to-indigo-600 dark:from-pink-400 dark:via-purple-400 dark:to-indigo-400 bg-clip-text text-transparent animate-gradient bg-[length:200%_auto]">
                        {{ $gallery->title }}
                    </h1>
                    @if($gallery->category)
                        <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-400">{{ $gallery->category }}</p>
                    @endif
                </div>
            </div>
        </section>

        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
                
                <div class="lg:col-span-2">
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-gray-200/50 dark:border-gray-700/50">
                        <img src="{{ $gallery->image_url }}" 
                             alt="{{ $gallery->alt_text ?: $gallery->title }}" 
                             class="w-full h-auto max-h-[500px] md:max-h-[600px] object-cover">
                    </div>
                </div>

                
                <div class="space-y-6">
                    @if($gallery->category)
                        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-6 md:p-8 border border-gray-200/50">
                            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-4 flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-purple-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                Category
                            </h2>
                            <span class="inline-flex items-center px-5 py-2.5 rounded-full text-sm font-bold bg-gradient-to-r from-pink-100 to-purple-100 text-pink-800 border-2 border-pink-200">
                                {{ $gallery->category }}
                            </span>
                        </div>
                    @endif

                    @if($gallery->description)
                        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-6 md:p-8 border border-gray-200/50">
                            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-4 flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                Description
                            </h2>
                            <p class="text-gray-600 leading-relaxed text-base md:text-lg">{{ $gallery->description }}</p>
                        </div>
                    @endif
                </div>
            </div>
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
