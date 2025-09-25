@if(request()->has('guest') || !auth()->check())
<x-guest-layout>
    <!-- Page Header -->
    <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 text-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-10 left-10 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-96 h-96 bg-blue-300/20 rounded-full blur-3xl"></div>
            </div>
                </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Back to Virtual Tours Link -->
            <div class="mb-4">
                <a href="{{ route('guest.panoramas') }}" 
                   class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm text-white text-sm font-medium rounded-lg hover:bg-white/30 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Virtual Tours
                </a>
            </div>
            
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-2">{{ $pano->name }}</h1>
                <p class="text-blue-100 text-lg">Virtual Library Tour</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Card container --}}
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden border border-white/20">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">360° Panorama Viewer</h2>
                    </div>
                    <div class="text-sm text-gray-500">Pano2VR</div>
                </div>
            </div>

            {{-- Panorama iframe --}}
            <div id="panorama-container" class="relative w-full h-[600px] overflow-hidden">
                <!-- Floating Fullscreen Button -->
                <div class="absolute bottom-4 right-4 z-10">
                    <button id="fullscreen-btn" 
                            onclick="toggleFullscreen()"
                            class="inline-flex items-center px-4 py-2 bg-black/70 backdrop-blur-sm text-white text-sm font-medium rounded-lg hover:bg-black/80 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200 hover:scale-105 shadow-lg">
                        <svg id="fullscreen-icon" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                        </svg>
                        Fullscreen
                    </button>
                </div>
                <!-- Fullscreen Exit Button -->
                <button id="fullscreen-exit-btn" 
                        class="fullscreen-exit-btn"
                        onclick="toggleFullscreen()">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Exit Fullscreen
                </button>
                <!-- Loading Overlay -->
                <div id="loading-overlay" class="absolute inset-0 bg-gray-100 flex items-center justify-center z-50">
                    <div class="text-center text-gray-600">
                        <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-blue-600 mx-auto mb-4"></div>
                        <p class="text-lg font-medium">Loading Panorama...</p>
                        <p class="text-sm text-gray-500 mt-2">{{ $pano->name }}</p>
                    </div>
                </div>

                <iframe id="panorama-frame"
                        src="{{ asset('panos/' . $pano->folder . $subfolder . '/index.html') }}"
                        class="w-full h-full border-0"
                        title="{{ $pano->name }} Panorama"
                        allow="fullscreen; xr-spatial-tracking"
                        allowfullscreen
                        loading="lazy"
                        onload="hideLoadingOverlay()">
                </iframe>
            </div>

            <!-- Card Footer -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-3 border-t border-gray-200">
                <div class="flex items-center justify-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                    </svg>
                    <span>Drag to navigate • Press F for fullscreen</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Fullscreen styles for mobile */
        .fullscreen-container {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            z-index: 9999 !important;
            background: #000 !important;
            border-radius: 0 !important;
        }
        
        .fullscreen-container iframe {
            width: 100% !important;
            height: 100% !important;
            border-radius: 0 !important;
        }
        
        /* Mobile-specific fullscreen button */
        @media (max-width: 768px) {
            #fullscreen-btn {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            }
        }
        
        /* Fullscreen exit button */
        .fullscreen-exit-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 10000;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: none;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        
        .fullscreen-container .fullscreen-exit-btn {
            display: block;
        }
        
        /* Hide main fullscreen button when in fullscreen */
        .fullscreen-container #fullscreen-btn {
            display: none !important;
        }
        
        /* Ensure exit button is hidden by default */
        #fullscreen-exit-btn {
            display: none !important;
        }
        
        /* Show exit button only when in fullscreen */
        .fullscreen-container #fullscreen-exit-btn {
            display: block !important;
        }
    </style>

    <script>
        function hideLoadingOverlay() {
            const overlay = document.getElementById('loading-overlay');
            if (overlay) {
                overlay.style.opacity = '0';
                setTimeout(() => {
                    overlay.style.display = 'none';
                }, 300);
            }
        }

        function toggleFullscreen() {
            const container = document.querySelector('.bg-white.rounded-2xl.shadow-md.p-4');
            const panoramaContainer = document.getElementById('panorama-container');
            const fullscreenIcon = document.getElementById('fullscreen-icon');
            const fullscreenBtn = document.getElementById('fullscreen-btn');
            
            // Check if we're already in fullscreen mode
            const isInCssFullscreen = container.classList.contains('fullscreen-container');
            const isInNativeFullscreen = document.fullscreenElement !== null;
            
            console.log('Toggle fullscreen - CSS:', isInCssFullscreen, 'Native:', isInNativeFullscreen);
            
            if (!isInCssFullscreen && !isInNativeFullscreen) {
                // Enter fullscreen
                const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                
                if (isMobile) {
                    // For mobile, use CSS-based fullscreen
                    container.classList.add('fullscreen-container');
                    panoramaContainer.style.height = '100vh';
                    updateFullscreenButton(true);
                } else {
                    // For desktop, use native fullscreen API
                    if (container.requestFullscreen) {
                        container.requestFullscreen().then(() => {
                            updateFullscreenButton(true);
                        }).catch(err => {
                            console.log('Error attempting to enable fullscreen:', err);
                            tryIframeFullscreen();
                        });
                    } else if (container.webkitRequestFullscreen) {
                        container.webkitRequestFullscreen().then(() => {
                            updateFullscreenButton(true);
                        }).catch(err => {
                            console.log('Error attempting to enable fullscreen:', err);
                            tryIframeFullscreen();
                        });
                    } else if (container.mozRequestFullScreen) {
                        container.mozRequestFullScreen().then(() => {
                            updateFullscreenButton(true);
                        }).catch(err => {
                            console.log('Error attempting to enable fullscreen:', err);
                            tryIframeFullscreen();
                        });
                    } else {
                        tryIframeFullscreen();
                    }
                }
            } else {
                // Exit fullscreen
                if (isInCssFullscreen) {
                    // Exit CSS-based fullscreen
                    container.classList.remove('fullscreen-container');
                    panoramaContainer.style.height = '600px';
                    updateFullscreenButton(false);
                } else if (isInNativeFullscreen) {
                    // Exit native fullscreen
                    if (document.exitFullscreen) {
                        document.exitFullscreen().then(() => {
                            updateFullscreenButton(false);
                        });
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen().then(() => {
                            updateFullscreenButton(false);
                        });
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen().then(() => {
                            updateFullscreenButton(false);
                        });
                    }
                }
            }
        }

        function tryIframeFullscreen() {
            const iframe = document.getElementById('panorama-frame');
            if (iframe.requestFullscreen) {
                iframe.requestFullscreen().then(() => {
                    updateFullscreenButton(true);
                }).catch(err => {
                    console.log('Iframe fullscreen also failed:', err);
                    // Show user-friendly message
                    alert('Fullscreen not supported on this device. Try rotating your device or using a different browser.');
                });
            }
        }

        function updateFullscreenButton(isFullscreen) {
            const fullscreenIcon = document.getElementById('fullscreen-icon');
            const fullscreenBtn = document.getElementById('fullscreen-btn');
            const exitBtn = document.getElementById('fullscreen-exit-btn');
            
            console.log('Updating fullscreen button:', isFullscreen);
            
            if (isFullscreen) {
                // Show exit button, hide main button
                if (exitBtn) exitBtn.style.display = 'block';
                if (fullscreenBtn) fullscreenBtn.style.display = 'none';
                
                // Update main button text (in case it's visible)
                if (fullscreenIcon) {
                    fullscreenIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15h4.5M9 15l5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25"></path>';
                }
                if (fullscreenBtn) {
                    fullscreenBtn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15h4.5M9 15l5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25"></path></svg>Exit Fullscreen';
                }
            } else {
                // Show main button, hide exit button
                if (fullscreenBtn) fullscreenBtn.style.display = 'inline-flex';
                if (exitBtn) exitBtn.style.display = 'none';
                
                // Update main button text
                if (fullscreenIcon) {
                    fullscreenIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>';
                }
                if (fullscreenBtn) {
                    fullscreenBtn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>Fullscreen';
                }
            }
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'f' || e.key === 'F') {
                e.preventDefault();
                toggleFullscreen();
            } else if (e.key === 'Escape') {
                // Exit fullscreen with ESC key
                const container = document.querySelector('.bg-white.rounded-2xl.shadow-md.p-4');
                const isInCssFullscreen = container.classList.contains('fullscreen-container');
                const isInNativeFullscreen = document.fullscreenElement !== null;
                
                if (isInCssFullscreen || isInNativeFullscreen) {
                    e.preventDefault();
                    toggleFullscreen();
                }
            }
        });

        // Hide loading overlay after 3 seconds as fallback
        setTimeout(hideLoadingOverlay, 3000);

        // Initialize button state on page load
        function initializeButtonState() {
            const container = document.querySelector('.bg-white.rounded-2xl.shadow-md.p-4');
            const isInCssFullscreen = container.classList.contains('fullscreen-container');
            const isInNativeFullscreen = document.fullscreenElement !== null;
            
            console.log('Initializing button state - CSS:', isInCssFullscreen, 'Native:', isInNativeFullscreen);
            updateFullscreenButton(isInCssFullscreen || isInNativeFullscreen);
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', initializeButtonState);

        // Mobile touch gestures for fullscreen exit
        let touchStartY = 0;
        let touchEndY = 0;

        document.addEventListener('touchstart', function(e) {
            touchStartY = e.changedTouches[0].screenY;
        });

        document.addEventListener('touchend', function(e) {
            touchEndY = e.changedTouches[0].screenY;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const swipeDistance = touchStartY - touchEndY;
            
            // Swipe up to exit fullscreen (only when in fullscreen)
            const container = document.querySelector('.bg-white.rounded-2xl.shadow-md.p-4');
            const isInCssFullscreen = container.classList.contains('fullscreen-container');
            const isInNativeFullscreen = document.fullscreenElement !== null;
            
            if (swipeDistance > swipeThreshold && (isInCssFullscreen || isInNativeFullscreen)) {
                toggleFullscreen();
            }
        }
    </script>
</x-guest-layout>
@else
<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('admin.pano.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition-all duration-300 hover:scale-105 shadow-lg mr-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Virtual Tours
                </a>
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h1 class="text-xl font-semibold text-gray-900">{{ $pano->name }}</h1>
                </div>
            </div>
            <button id="fullscreen-btn" 
                    onclick="toggleFullscreen()"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg id="fullscreen-icon" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                </svg>
                Fullscreen
            </button>
        </div>
    </x-slot>

    <div class="p-6">
        {{-- Card container --}}
        <div class="bg-white rounded-2xl shadow-md p-4">
            <h2 class="text-lg font-semibold mb-2">Interactive Library Panorama</h2>

            {{-- Panorama iframe --}}
            <div id="panorama-container" class="relative w-full h-[600px] rounded-lg overflow-hidden">
                <!-- Fullscreen Exit Button -->
                <button id="fullscreen-exit-btn" 
                        class="fullscreen-exit-btn"
                        onclick="toggleFullscreen()">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Exit Fullscreen
                </button>
                <!-- Loading Overlay -->
                <div id="loading-overlay" class="absolute inset-0 bg-gray-100 flex items-center justify-center z-50">
                    <div class="text-center text-gray-600">
                        <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-blue-600 mx-auto mb-4"></div>
                        <p class="text-lg font-medium">Loading Panorama...</p>
                        <p class="text-sm text-gray-500 mt-2">{{ $pano->name }}</p>
                    </div>
                </div>

                <iframe id="panorama-frame"
                        src="{{ asset('panos/' . $pano->folder . $subfolder . '/index.html') }}"
                        class="w-full h-full border-0"
                        title="{{ $pano->name }} Panorama"
                        allow="fullscreen; xr-spatial-tracking"
                        allowfullscreen
                        loading="lazy"
                        onload="hideLoadingOverlay()">
                </iframe>
            </div>

            <!-- Card Footer -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-3 border-t border-gray-200">
                <div class="flex items-center justify-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                    </svg>
                    <span>Drag to navigate • Press F for fullscreen</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Fullscreen styles for mobile */
        .fullscreen-container {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            z-index: 9999 !important;
            background: #000 !important;
            border-radius: 0 !important;
        }
        
        .fullscreen-container iframe {
            width: 100% !important;
            height: 100% !important;
            border-radius: 0 !important;
        }
        
        /* Mobile-specific fullscreen button */
        @media (max-width: 768px) {
            #fullscreen-btn {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            }
        }
        
        /* Fullscreen exit button */
        .fullscreen-exit-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 10000;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: none;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        
        .fullscreen-container .fullscreen-exit-btn {
            display: block;
        }
        
        /* Hide main fullscreen button when in fullscreen */
        .fullscreen-container #fullscreen-btn {
            display: none !important;
        }
        
        /* Ensure exit button is hidden by default */
        #fullscreen-exit-btn {
            display: none !important;
        }
        
        /* Show exit button only when in fullscreen */
        .fullscreen-container #fullscreen-exit-btn {
            display: block !important;
        }
    </style>

    <script>
        function hideLoadingOverlay() {
            const overlay = document.getElementById('loading-overlay');
            if (overlay) {
                overlay.style.opacity = '0';
                setTimeout(() => {
                    overlay.style.display = 'none';
                }, 300);
            }
        }

        function toggleFullscreen() {
            const container = document.querySelector('.bg-white.rounded-2xl.shadow-md.p-4');
            const panoramaContainer = document.getElementById('panorama-container');
            const fullscreenIcon = document.getElementById('fullscreen-icon');
            const fullscreenBtn = document.getElementById('fullscreen-btn');
            
            // Check if we're already in fullscreen mode
            const isInCssFullscreen = container.classList.contains('fullscreen-container');
            const isInNativeFullscreen = document.fullscreenElement !== null;
            
            console.log('Toggle fullscreen - CSS:', isInCssFullscreen, 'Native:', isInNativeFullscreen);
            
            if (!isInCssFullscreen && !isInNativeFullscreen) {
                // Enter fullscreen
                const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                
                if (isMobile) {
                    // For mobile, use CSS-based fullscreen
                    container.classList.add('fullscreen-container');
                    panoramaContainer.style.height = '100vh';
                    updateFullscreenButton(true);
                } else {
                    // For desktop, use native fullscreen API
                    if (container.requestFullscreen) {
                        container.requestFullscreen().then(() => {
                            updateFullscreenButton(true);
                        }).catch(err => {
                            console.log('Error attempting to enable fullscreen:', err);
                            tryIframeFullscreen();
                        });
                    } else if (container.webkitRequestFullscreen) {
                        container.webkitRequestFullscreen().then(() => {
                            updateFullscreenButton(true);
                        }).catch(err => {
                            console.log('Error attempting to enable fullscreen:', err);
                            tryIframeFullscreen();
                        });
                    } else if (container.mozRequestFullScreen) {
                        container.mozRequestFullScreen().then(() => {
                            updateFullscreenButton(true);
                        }).catch(err => {
                            console.log('Error attempting to enable fullscreen:', err);
                            tryIframeFullscreen();
                        });
                    } else {
                        tryIframeFullscreen();
                    }
                }
            } else {
                // Exit fullscreen
                if (isInCssFullscreen) {
                    // Exit CSS-based fullscreen
                    container.classList.remove('fullscreen-container');
                    panoramaContainer.style.height = '600px';
                    updateFullscreenButton(false);
                } else if (isInNativeFullscreen) {
                    // Exit native fullscreen
                    if (document.exitFullscreen) {
                        document.exitFullscreen().then(() => {
                            updateFullscreenButton(false);
                        });
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen().then(() => {
                            updateFullscreenButton(false);
                        });
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen().then(() => {
                            updateFullscreenButton(false);
                        });
                    }
                }
            }
        }

        function tryIframeFullscreen() {
            const iframe = document.getElementById('panorama-frame');
            if (iframe.requestFullscreen) {
                iframe.requestFullscreen().then(() => {
                    updateFullscreenButton(true);
                }).catch(err => {
                    console.log('Iframe fullscreen also failed:', err);
                    // Show user-friendly message
                    alert('Fullscreen not supported on this device. Try rotating your device or using a different browser.');
                });
            }
        }

        function updateFullscreenButton(isFullscreen) {
            const fullscreenIcon = document.getElementById('fullscreen-icon');
            const fullscreenBtn = document.getElementById('fullscreen-btn');
            const exitBtn = document.getElementById('fullscreen-exit-btn');
            
            console.log('Updating fullscreen button:', isFullscreen);
            
            if (isFullscreen) {
                // Show exit button, hide main button
                if (exitBtn) exitBtn.style.display = 'block';
                if (fullscreenBtn) fullscreenBtn.style.display = 'none';
                
                // Update main button text (in case it's visible)
                if (fullscreenIcon) {
                    fullscreenIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15h4.5M9 15l5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25"></path>';
                }
                if (fullscreenBtn) {
                    fullscreenBtn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15h4.5M9 15l5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25"></path></svg>Exit Fullscreen';
                }
            } else {
                // Show main button, hide exit button
                if (fullscreenBtn) fullscreenBtn.style.display = 'inline-flex';
                if (exitBtn) exitBtn.style.display = 'none';
                
                // Update main button text
                if (fullscreenIcon) {
                    fullscreenIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>';
                }
                if (fullscreenBtn) {
                    fullscreenBtn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>Fullscreen';
                }
            }
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'f' || e.key === 'F') {
                e.preventDefault();
                toggleFullscreen();
            } else if (e.key === 'Escape') {
                // Exit fullscreen with ESC key
                const container = document.querySelector('.bg-white.rounded-2xl.shadow-md.p-4');
                const isInCssFullscreen = container.classList.contains('fullscreen-container');
                const isInNativeFullscreen = document.fullscreenElement !== null;
                
                if (isInCssFullscreen || isInNativeFullscreen) {
                    e.preventDefault();
                    toggleFullscreen();
                }
            }
        });

        // Hide loading overlay after 3 seconds as fallback
        setTimeout(hideLoadingOverlay, 3000);

        // Initialize button state on page load
        function initializeButtonState() {
            const container = document.querySelector('.bg-white.rounded-2xl.shadow-md.p-4');
            const isInCssFullscreen = container.classList.contains('fullscreen-container');
            const isInNativeFullscreen = document.fullscreenElement !== null;
            
            console.log('Initializing button state - CSS:', isInCssFullscreen, 'Native:', isInNativeFullscreen);
            updateFullscreenButton(isInCssFullscreen || isInNativeFullscreen);
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', initializeButtonState);

        // Mobile touch gestures for fullscreen exit
        let touchStartY = 0;
        let touchEndY = 0;

        document.addEventListener('touchstart', function(e) {
            touchStartY = e.changedTouches[0].screenY;
        });

        document.addEventListener('touchend', function(e) {
            touchEndY = e.changedTouches[0].screenY;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const swipeDistance = touchStartY - touchEndY;
            
            // Swipe up to exit fullscreen (only when in fullscreen)
            const container = document.querySelector('.bg-white.rounded-2xl.shadow-md.p-4');
            const isInCssFullscreen = container.classList.contains('fullscreen-container');
            const isInNativeFullscreen = document.fullscreenElement !== null;
            
            if (swipeDistance > swipeThreshold && (isInCssFullscreen || isInNativeFullscreen)) {
                toggleFullscreen();
            }
        }
    </script>
</x-admin-layout>
@endif