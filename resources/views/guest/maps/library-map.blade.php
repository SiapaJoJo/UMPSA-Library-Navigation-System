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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                </div>
                <h1 class="text-5xl font-bold mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">Library Map</h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                    Interactive map of the library facilities and resources
                </p>
            </div>
        </div>
    </div>

    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16 py-16">
            @if($maps->count() > 0)
                <!-- Interactive Map Container -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 mb-12 border border-white/20">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Interactive Library Map</h2>
                    </div>
                    
                    <!-- Map Selection -->
                    @if($maps->count() > 1)
                        <div class="flex flex-wrap justify-center gap-3 mb-8">
                            @foreach($maps as $map)
                                <button onclick="switchMap('{{ $map->id }}', '{{ $map->embed_url }}')" 
                                        class="px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-200 map-selector {{ $map->is_default ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg' : 'bg-white/80 backdrop-blur-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 border border-gray-200' }}"
                                        data-map-id="{{ $map->id }}">
                                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                    <!-- Map Container -->
                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl overflow-hidden map-container shadow-inner" style="height: 500px; min-height: 400px;">
                        <iframe id="mapFrame" 
                                src="{{ $defaultMap ? $defaultMap->embed_url : $maps->first()->embed_url }}" 
                                width="100%" 
                                height="100%" 
                                frameborder="0" 
                                allowfullscreen
                                class="w-full h-full rounded-2xl"
                                style="min-height: 400px;">
                        </iframe>
                    </div>

                    <!-- Map Information -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Interactive map powered by 
                            <a href="https://mappedin.com" target="_blank" class="text-blue-600 hover:text-blue-800 font-semibold ml-1">MappedIn</a>
                        </p>
                    </div>
                </div>

                <!-- Map Details -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Available Maps -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-white/20">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Available Maps</h3>
                        </div>
                        <div class="space-y-4">
                            @foreach($maps as $map)
                                <div class="group flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl border border-gray-100 hover:shadow-md transition-all duration-200">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">{{ $map->name }}</h4>
                                        @if($map->floor || $map->section)
                                            <p class="text-sm text-gray-600 mt-1">{{ $map->full_name }}</p>
                                        @endif
                                        @if($map->description)
                                            <p class="text-sm text-gray-500 mt-2">{{ $map->description }}</p>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        @if($map->is_default)
                                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 border border-blue-200">Default</span>
                                        @endif
                                        <button onclick="switchMap('{{ $map->id }}', '{{ $map->embed_url }}')" 
                                                class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <!-- No Maps Available -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-16 text-center border border-white/20">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">No Maps Available</h3>
                    <p class="text-gray-600 text-lg">Library maps are not available at the moment. Please check back later.</p>
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Responsive map container */
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
        
        /* Full width responsive design */
        .w-full {
            width: 100%;
        }
        
        /* Ensure proper spacing on very large screens */
        @media (min-width: 1920px) {
            .container-2xl {
                padding-left: 3rem;
                padding-right: 3rem;
            }
        }
    </style>

    <script>
        function switchMap(mapId, embedUrl) {
            // Update iframe source
            document.getElementById('mapFrame').src = embedUrl;
            
            // Update button states
            document.querySelectorAll('.map-selector').forEach(button => {
                button.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700');
                button.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
            });
            
            // Highlight selected button
            const selectedButton = document.querySelector(`[data-map-id="${mapId}"]`);
            if (selectedButton) {
                selectedButton.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
                selectedButton.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700');
            }
        }
    </script>
</x-guest-layout>