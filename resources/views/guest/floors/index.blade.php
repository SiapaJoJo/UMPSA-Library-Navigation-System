<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 relative overflow-hidden">
        
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] dark:bg-[linear-gradient(to_right,#ffffff08_1px,transparent_1px),linear-gradient(to_bottom,#ffffff08_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        
        
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-green-400/20 dark:bg-green-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-400/20 dark:bg-indigo-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

        
        <section class="relative w-full py-24 md:py-32 overflow-hidden">
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                    <div class="inline-block mb-6">
                        <span class="text-sm font-semibold text-green-600 dark:text-green-400 uppercase tracking-wider bg-green-50 dark:bg-green-900/30 px-4 py-2 rounded-full">Directory</span>
                </div>
                    <h1 class="text-6xl md:text-8xl font-extrabold mb-6 bg-gradient-to-r from-green-600 via-blue-600 to-indigo-600 dark:from-green-400 dark:via-blue-400 dark:to-indigo-400 bg-clip-text text-transparent animate-gradient bg-[length:200%_auto]">
                        Floor Directory
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Explore our library floors and discover all the facilities and resources available on each level.
                </p>
            </div>
        </div>
        </section>

    
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            @php
                $floorsWithImages = $floors->filter(function($floor) {
                    return !empty($floor->image);
                });
            @endphp
            @if($floorsWithImages->count() > 0)
            
                <div class="mb-20">
                <div class="text-center mb-12">
                        <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-gray-100 mb-4">Building Floor Plans</h2>
                        <p class="text-gray-600 dark:text-gray-400 text-lg md:text-xl">Swipe or use navigation to explore each floor</p>
                </div>

                
                    <div class="relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-gray-200/50 dark:border-gray-700/50" x-data="floorCarousel()">
                    
                    <div class="relative h-96 md:h-[500px] lg:h-[600px] overflow-hidden"
                         @touchstart="handleTouchStart($event)"
                         @touchend="handleTouchEnd($event)">
                        
                        <div class="flex transition-transform duration-500 ease-in-out" 
                             :style="`transform: translateX(-${currentIndex * 100}%)`">
                                @foreach($floorsWithImages as $index => $floor)
                                <div class="w-full h-full flex-shrink-0 relative">
                                        <img src="{{ asset('images/floors/' . $floor->image) }}" 
                                             alt="{{ $floor->name }}" 
                                             class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    
                        <div class="p-6 md:p-8 bg-gradient-to-br from-gray-50/80 to-blue-50/80 dark:from-gray-700/80 dark:to-gray-800/80 backdrop-blur-sm">
                            <div class="flex space-x-4 overflow-x-auto pb-2 scrollbar-hide">
                                @foreach($floorsWithImages as $index => $floor)
                                <button @click="goToFloor({{ $index }})" 
                                            class="flex-shrink-0 w-24 h-24 md:w-28 md:h-28 rounded-2xl overflow-hidden border-4 transition-all duration-300 transform hover:scale-110"
                                            :class="currentIndex === {{ $index }} ? 'border-blue-500 dark:border-blue-400 ring-4 ring-blue-200 dark:ring-blue-800 shadow-xl scale-110' : 'border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 shadow-lg'">
                                        <img src="{{ asset('images/floors/' . $floor->image) }}" 
                                             alt="{{ $floor->name }}" 
                                             class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($floorsWithImages as $floor)
                        <div class="group relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 border border-gray-200/50 dark:border-gray-700/50 transform hover:-translate-y-4 hover:scale-[1.02]">
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('images/floors/' . $floor->image) }}" 
                                     alt="{{ $floor->name }}" 
                                     class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                @if($floor->level)
                                    <div class="absolute top-4 right-4">
                                        <span class="px-4 py-2 bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl text-blue-800 dark:text-blue-300 text-sm font-bold rounded-full shadow-xl border border-white/50 dark:border-gray-700/50">
                                            Level {{ $floor->level }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-6 md:p-8">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-gray-100 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300">{{ $floor->name }}</h3>
                            </div>
                            
                            @if($floor->description)
                                    <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed text-base">{{ Str::limit($floor->description, 120) }}</p>
                            @endif
                            
                            @if($floor->facilities && count($floor->facilities) > 0)
                                <div class="mb-6">
                                        <h4 class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-3 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Facilities
                                    </h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($floor->facilities as $facility)
                                                <span class="px-3 py-1.5 bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 text-xs font-bold rounded-full border border-green-200">{{ $facility }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            <a href="{{ route('guest.floors.show', $floor) }}" 
                                   class="group/btn inline-flex items-center justify-center w-full px-6 py-4 bg-gradient-to-r from-green-600 via-blue-600 to-indigo-600 text-white text-sm md:text-base font-bold rounded-2xl hover:from-green-700 hover:via-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-1000"></div>
                                    <svg class="w-5 h-5 mr-2 relative z-10 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                    <span class="relative z-10">View Details</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
                <div class="text-center py-20 md:py-32">
                    <div class="inline-flex items-center justify-center w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full mb-8 shadow-xl">
                        <svg class="w-12 h-12 md:w-16 md:h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-gray-100 mb-4">No floors available</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-lg md:text-xl mb-10 max-w-2xl mx-auto">Floor directory information is not available at the moment.</p>
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

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>

    
    <script>
        function floorCarousel() {
            return {
                currentIndex: 0,
                floors: @json($floorsWithImages->values()->toArray()),
                touchStartX: 0,
                touchEndX: 0,
                
                nextFloor() {
                    if (this.currentIndex < this.floors.length - 1) {
                        this.currentIndex++;
                    }
                },
                
                previousFloor() {
                    if (this.currentIndex > 0) {
                        this.currentIndex--;
                    }
                },
                
                goToFloor(index) {
                    this.currentIndex = index;
                },

                handleTouchStart(event) {
                    this.touchStartX = event.touches[0].clientX;
                },
                
                handleTouchEnd(event) {
                    this.touchEndX = event.changedTouches[0].clientX;
                    this.handleSwipe();
                },
                
                handleSwipe() {
                    const swipeThreshold = 50; // Minimum distance for a swipe
                    const swipeDistance = this.touchStartX - this.touchEndX;
                    
                    if (Math.abs(swipeDistance) > swipeThreshold) {
                        if (swipeDistance > 0) {

                            this.nextFloor();
                        } else {

                            this.previousFloor();
                        }
                    }
                },

                handleKeydown(event) {
                    if (event.key === 'ArrowLeft') {
                        this.previousFloor();
                    } else if (event.key === 'ArrowRight') {
                        this.nextFloor();
                    }
                },

                init() {

                    document.addEventListener('keydown', (e) => this.handleKeydown(e));
                }
            }
        }
    </script>
</x-guest-layout>
