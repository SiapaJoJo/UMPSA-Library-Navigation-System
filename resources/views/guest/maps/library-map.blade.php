<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 relative overflow-hidden">
        
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] dark:bg-[linear-gradient(to_right,#ffffff08_1px,transparent_1px),linear-gradient(to_bottom,#ffffff08_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        
        
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-400/20 dark:bg-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-400/20 dark:bg-indigo-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

        
        <section class="relative w-full py-24 md:py-32 overflow-hidden">
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="inline-block mb-6">
                        <span class="text-sm font-semibold text-blue-600 dark:text-blue-400 uppercase tracking-wider bg-blue-50 dark:bg-blue-900/30 px-4 py-2 rounded-full">Navigation</span>
                    </div>
                    <h1 class="text-6xl md:text-8xl font-extrabold mb-6 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 dark:from-blue-400 dark:via-indigo-400 dark:to-purple-400 bg-clip-text text-transparent animate-gradient bg-[length:200%_auto]">
                        Library Map
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                        Interactive map of the library facilities and resources
                    </p>
                </div>
            </div>
        </section>

        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            @if($maps->count() > 0)
                
                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 md:p-12 mb-12 border border-gray-200/50 dark:border-gray-700/50">
                    <div class="flex items-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-gray-100">Interactive Library Map</h2>
                    </div>
                    
                    
                    @if($maps->count() > 1)
                        <div class="flex flex-wrap justify-center gap-4 mb-8">
                            @foreach($maps as $map)
                                <button onclick="switchMap('{{ $map->id }}', '{{ $map->embed_url }}')" 
                                        class="group px-6 py-3 rounded-2xl text-sm font-bold transition-all duration-300 map-selector {{ $map->is_default ? 'bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-500 dark:to-indigo-500 text-white shadow-xl scale-105' : 'bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:text-blue-700 dark:hover:text-blue-400 border border-gray-200/50 dark:border-gray-700/50 hover:scale-105 hover:shadow-lg' }}"
                                        data-map-id="{{ $map->id }}">
                                    <svg class="w-4 h-4 mr-2 inline group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                    {{ $map->name }}
                                    @if($map->floor)
                                        <span class="text-xs opacity-75">({{ $map->floor }})</span>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    @endif

                    
                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl overflow-hidden map-container shadow-inner border border-gray-300/50" style="height: 500px; min-height: 400px;">
                        <iframe id="mapFrame" 
                                src="{{ $defaultMap ? $defaultMap->embed_url : $maps->first()->embed_url }}" 
                                width="100%" 
                                height="100%" 
                                frameborder="0" 
                                allowfullscreen
                                class="w-full h-full rounded-3xl"
                                style="min-height: 400px;">
                        </iframe>
                    </div>

                    
                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-600 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Interactive map powered by 
                            <a href="https://mappedin.com" target="_blank" class="text-blue-600 hover:text-blue-800 font-semibold ml-1 transition-colors">MappedIn</a>
                        </p>
                    </div>
                </div>

                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    
                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 md:p-10 border border-gray-200/50">
                        <div class="flex items-center mb-8">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-extrabold text-gray-900">Available Maps</h3>
                        </div>
                        <div class="space-y-4">
                            @foreach($maps as $map)
                                <div class="group flex items-center justify-between p-6 bg-gradient-to-r from-gray-50/80 to-blue-50/80 backdrop-blur-sm rounded-2xl border border-gray-200/50 hover:shadow-xl hover:scale-[1.02] transition-all duration-300">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300 text-lg">{{ $map->name }}</h4>
                                        @if($map->floor || $map->section)
                                            <p class="text-sm text-gray-600 mt-1">{{ $map->full_name }}</p>
                                        @endif
                                        @if($map->description)
                                            <p class="text-sm text-gray-500 mt-2 leading-relaxed">{{ $map->description }}</p>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-3 ml-4">
                                        @if($map->is_default)
                                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 border border-blue-200">Default</span>
                                        @endif
                                        <button onclick="switchMap('{{ $map->id }}', '{{ $map->embed_url }}')" 
                                                class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-bold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 hover:-translate-y-0.5">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-16 md:p-20 text-center border border-gray-200/50">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-gray-900 mb-4">No Maps Available</h3>
                    <p class="text-gray-600 text-lg mb-8">Library maps are not available at the moment. Please check back later.</p>
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

        
        @media (min-width: 1024px) {
            .map-container {
                height: 600px;
            }
        }
        
        @media (min-width: 1280px) {
            .map-container {
                height: 700px;
            }
        }
        
        @media (min-width: 1536px) {
            .map-container {
                height: 800px;
            }
        }
    </style>

    <script>
        function switchMap(mapId, embedUrl) {

            document.getElementById('mapFrame').src = embedUrl;

            document.querySelectorAll('.map-selector').forEach(button => {
                button.classList.remove('bg-gradient-to-r', 'from-blue-600', 'to-indigo-600', 'text-white', 'shadow-xl', 'scale-105');
                button.classList.add('bg-white/80', 'backdrop-blur-sm', 'text-gray-700', 'border', 'border-gray-200/50');
            });

            const selectedButton = document.querySelector(`[data-map-id="${mapId}"]`);
            if (selectedButton) {
                selectedButton.classList.remove('bg-white/80', 'backdrop-blur-sm', 'text-gray-700', 'border', 'border-gray-200/50');
                selectedButton.classList.add('bg-gradient-to-r', 'from-blue-600', 'to-indigo-600', 'text-white', 'shadow-xl', 'scale-105');
            }
        }
    </script>
</x-guest-layout>
