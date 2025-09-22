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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h1 class="text-5xl font-bold mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">Floor Directory</h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                    Explore our library floors and discover all the facilities and resources available on each level.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($floors->count() > 0)
            <!-- Floor Carousel Section -->
            <div class="mb-16">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Building Floor Plans</h2>
                    <p class="text-gray-600 text-lg">Swipe or use navigation to explore each floor</p>
                </div>

                <!-- Carousel Container -->
                <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden" x-data="floorCarousel()">
                    <!-- Main Image Display -->
                    <div class="relative h-96 md:h-[500px] lg:h-[600px] overflow-hidden"
                         @touchstart="handleTouchStart($event)"
                         @touchend="handleTouchEnd($event)">
                        <!-- Floor Images -->
                        <div class="flex transition-transform duration-500 ease-in-out" 
                             :style="`transform: translateX(-${currentIndex * 100}%)`">
                            @foreach($floors as $index => $floor)
                                <div class="w-full h-full flex-shrink-0 relative">
                                    @if($floor->image)
                                        <img src="{{ asset('images/floors/' . $floor->image) }}" 
                                             alt="{{ $floor->name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <div class="text-center">
                                                <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                                <p class="text-gray-500 text-lg">No floor plan available</p>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <!-- Floor Info Overlay -->
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6">
                                        <div class="text-white">
                                            <h3 class="text-2xl md:text-3xl font-bold mb-2">{{ $floor->name }}</h3>
                                            @if($floor->level)
                                                <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm text-white text-sm font-semibold rounded-full mb-3">
                                                    Level {{ $floor->level }}
                                                </span>
                                            @endif
                                            @if($floor->description)
                                                <p class="text-white/90 text-sm md:text-base max-w-2xl">{{ Str::limit($floor->description, 150) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation Arrows -->
                        <button @click="previousFloor()" 
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 hover:text-blue-600 rounded-full p-3 shadow-lg transition-all duration-200 hover:scale-110"
                                :disabled="currentIndex === 0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        
                        <button @click="nextFloor()" 
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 hover:text-blue-600 rounded-full p-3 shadow-lg transition-all duration-200 hover:scale-110"
                                :disabled="currentIndex === {{ $floors->count() - 1 }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>

                        <!-- Floor Counter -->
                        <div class="absolute top-4 right-4 bg-black/50 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium">
                            <span x-text="currentIndex + 1"></span> / {{ $floors->count() }}
                        </div>
                    </div>

                    <!-- Floor Thumbnails -->
                    <div class="p-6 bg-gray-50">
                        <div class="flex space-x-4 overflow-x-auto pb-2">
                            @foreach($floors as $index => $floor)
                                <button @click="goToFloor({{ $index }})" 
                                        class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 transition-all duration-200"
                                        :class="currentIndex === {{ $index }} ? 'border-blue-500 ring-2 ring-blue-200' : 'border-gray-200 hover:border-blue-300'">
                                    @if($floor->image)
                                        <img src="{{ asset('images/floors/' . $floor->image) }}" 
                                             alt="{{ $floor->name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                        
                        <!-- Floor Names -->
                        <div class="mt-4 text-center">
                            <h3 class="text-lg font-semibold text-gray-900" x-text="floors[currentIndex]?.name || ''"></h3>
                            <p class="text-sm text-gray-600" x-text="floors[currentIndex]?.level ? 'Level ' + floors[currentIndex].level : ''"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Floor Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($floors as $floor)
                    <div class="group bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border border-white/20 hover:-translate-y-2">
                        @if($floor->image)
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('images/floors/' . $floor->image) }}" 
                                     alt="{{ $floor->name }}" 
                                     class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                @if($floor->level)
                                    <div class="absolute top-4 right-4">
                                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-blue-800 text-sm font-semibold rounded-full shadow-lg">
                                            Level {{ $floor->level }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="w-full h-56 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center group-hover:from-blue-50 group-hover:to-blue-100 transition-all duration-300">
                                <div class="text-center">
                                    <svg class="w-16 h-16 text-gray-400 group-hover:text-blue-400 mx-auto mb-2 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    @if($floor->level)
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full">
                                            Level {{ $floor->level }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">{{ $floor->name }}</h3>
                            </div>
                            
                            @if($floor->description)
                                <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($floor->description, 120) }}</p>
                            @endif
                            
                            @if($floor->facilities && count($floor->facilities) > 0)
                                <div class="mb-6">
                                    <h4 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Facilities
                                    </h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($floor->facilities as $facility)
                                            <span class="px-3 py-1 bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 text-xs font-medium rounded-full border border-green-200">{{ $facility }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            <a href="{{ route('guest.floors.show', $floor) }}" 
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl group-hover:scale-105 transform">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-4">No floors available</h3>
                <p class="text-gray-500 text-lg">Floor directory information is not available at the moment.</p>
            </div>
        @endif
    </div>

    <!-- Alpine.js Carousel Script -->
    <script>
        function floorCarousel() {
            return {
                currentIndex: 0,
                floors: @json($floors->toArray()),
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
                
                // Touch handling for mobile swipe
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
                            // Swipe left - next floor
                            this.nextFloor();
                        } else {
                            // Swipe right - previous floor
                            this.previousFloor();
                        }
                    }
                },
                
                // Keyboard navigation
                handleKeydown(event) {
                    if (event.key === 'ArrowLeft') {
                        this.previousFloor();
                    } else if (event.key === 'ArrowRight') {
                        this.nextFloor();
                    }
                },
                
                // Auto-play functionality (optional)
                init() {
                    // Add keyboard event listener
                    document.addEventListener('keydown', (e) => this.handleKeydown(e));
                    
                    // Uncomment the lines below to enable auto-play
                    // setInterval(() => {
                    //     if (this.currentIndex < this.floors.length - 1) {
                    //         this.nextFloor();
                    //     } else {
                    //         this.currentIndex = 0;
                    //     }
                    // }, 5000);
                }
            }
        }
    </script>
</x-guest-layout>
