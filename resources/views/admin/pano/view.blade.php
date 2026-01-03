@if(request()->has('guest') || !auth()->check())
<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 relative overflow-hidden">
        
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] dark:bg-[linear-gradient(to_right,#ffffff08_1px,transparent_1px),linear-gradient(to_bottom,#ffffff08_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        
        
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-400/20 dark:bg-purple-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-400/20 dark:bg-indigo-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

        
        <section class="relative w-full py-16 md:py-24 overflow-hidden">
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="mb-6 md:mb-8">
                    <a href="{{ route('guest.panoramas') }}" 
                       class="group inline-flex items-center px-6 py-3 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl text-gray-700 dark:text-gray-300 text-sm font-bold rounded-2xl hover:bg-white dark:hover:bg-gray-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 border border-gray-200/50 dark:border-gray-700/50">
                        <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Virtual Tours
                    </a>
                </div>
                
                <div class="text-center">
                    <div class="inline-block mb-6">
                        <span class="text-sm font-semibold text-purple-600 dark:text-purple-400 uppercase tracking-wider bg-purple-50 dark:bg-purple-900/30 px-4 py-2 rounded-full">Virtual Tour</span>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-extrabold mb-4 bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 dark:from-purple-400 dark:via-indigo-400 dark:to-blue-400 bg-clip-text text-transparent animate-gradient bg-[length:200%_auto]">
                        {{ $pano->name }}
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-400">Virtual Library Tour</p>
                </div>
            </div>
        </section>

        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            {{-- Card container --}}
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-gray-200/50 dark:border-gray-700/50">
            
            <div class="bg-gradient-to-r from-purple-50/80 via-indigo-50/80 to-blue-50/80 dark:from-gray-700/80 dark:via-gray-800/80 dark:to-gray-700/80 backdrop-blur-sm px-6 md:px-8 py-5 md:py-6 border-b border-gray-200/50 dark:border-gray-700/50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 via-indigo-500 to-blue-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-gray-100">360° Panorama Viewer</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pano2VR</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Panorama iframe --}}
            <div id="panorama-container" class="relative w-full h-[600px] overflow-hidden">
                
                <div class="absolute bottom-6 right-6 z-10">
                    <button id="fullscreen-btn" 
                            onclick="toggleFullscreen()"
                            class="group inline-flex items-center px-5 py-3 bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 backdrop-blur-xl text-white text-sm font-bold rounded-2xl hover:from-purple-700 hover:via-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-300 hover:scale-110 shadow-2xl hover:shadow-purple-500/50 border border-white/20">
                        <svg id="fullscreen-icon" class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                        </svg>
                        Fullscreen
                    </button>
                </div>
                
                <button id="fullscreen-exit-btn" 
                        class="fullscreen-exit-btn"
                        onclick="toggleFullscreen()">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Exit Fullscreen
                </button>
                
                <div id="loading-overlay" class="absolute inset-0 bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center z-50 backdrop-blur-sm">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-full mb-6 shadow-xl">
                            <div class="animate-spin rounded-full h-16 w-16 border-4 border-purple-200 dark:border-purple-800 border-t-purple-600 dark:border-t-purple-400"></div>
                        </div>
                        <p class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Loading Panorama...</p>
                        <p class="text-base text-gray-600 dark:text-gray-400">{{ $pano->name }}</p>
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

            
            <div class="bg-gradient-to-r from-gray-50/80 to-blue-50/80 dark:from-gray-700/80 dark:to-gray-800/80 backdrop-blur-sm px-6 md:px-8 py-4 md:py-5 border-t border-gray-200/50 dark:border-gray-700/50">
                <div class="flex items-center justify-center text-sm md:text-base text-gray-600 dark:text-gray-400 font-medium">
                    <svg class="w-5 h-5 mr-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                    </svg>
                    <span>Drag to navigate • Press F for fullscreen</span>
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
        
        
        @media (max-width: 768px) {
            #fullscreen-btn, #fullscreen-btn-floating {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            }
        }
        
        
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
        
        
        .fullscreen-container #fullscreen-btn,
        .fullscreen-container #fullscreen-btn-floating {
            display: none !important;
        }
        
        
        #fullscreen-exit-btn {
            display: none !important;
        }
        
        
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

            const isInCssFullscreen = container.classList.contains('fullscreen-container');
            const isInNativeFullscreen = document.fullscreenElement !== null;
            
            console.log('Toggle fullscreen - CSS:', isInCssFullscreen, 'Native:', isInNativeFullscreen);
            
            if (!isInCssFullscreen && !isInNativeFullscreen) {

                const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                
                if (isMobile) {

                    container.classList.add('fullscreen-container');
                    panoramaContainer.style.height = '100vh';
                    updateFullscreenButton(true);
                } else {

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

                if (isInCssFullscreen) {

                    container.classList.remove('fullscreen-container');
                    panoramaContainer.style.height = '600px';
                    updateFullscreenButton(false);
                } else if (isInNativeFullscreen) {

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

                if (exitBtn) exitBtn.style.display = 'block';
                if (fullscreenBtn) fullscreenBtn.style.display = 'none';

                if (fullscreenIcon) {
                    fullscreenIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15h4.5M9 15l5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25"></path>';
                }
                if (fullscreenBtn) {
                    fullscreenBtn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15h4.5M9 15l5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25"></path></svg>Exit Fullscreen';
                }
            } else {

                if (fullscreenBtn) fullscreenBtn.style.display = 'inline-flex';
                if (exitBtn) exitBtn.style.display = 'none';

                if (fullscreenIcon) {
                    fullscreenIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>';
                }
                if (fullscreenBtn) {
                    fullscreenBtn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>Fullscreen';
                }
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'f' || e.key === 'F') {
                e.preventDefault();
                toggleFullscreen();
            } else if (e.key === 'Escape') {

                const container = document.querySelector('.bg-white.rounded-2xl.shadow-md.p-4');
                const isInCssFullscreen = container.classList.contains('fullscreen-container');
                const isInNativeFullscreen = document.fullscreenElement !== null;
                
                if (isInCssFullscreen || isInNativeFullscreen) {
                    e.preventDefault();
                    toggleFullscreen();
                }
            }
        });

        setTimeout(hideLoadingOverlay, 3000);

        function initializeButtonState() {
            const container = document.querySelector('.bg-white.rounded-2xl.shadow-md.p-4');
            const isInCssFullscreen = container.classList.contains('fullscreen-container');
            const isInNativeFullscreen = document.fullscreenElement !== null;
            
            console.log('Initializing button state - CSS:', isInCssFullscreen, 'Native:', isInNativeFullscreen);
            updateFullscreenButton(isInCssFullscreen || isInNativeFullscreen);
        }

        document.addEventListener('DOMContentLoaded', initializeButtonState);

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
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pano->name }}</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-1">Interactive 360° Panorama Viewer</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.pano.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Virtual Tours
                </a>
                <button id="fullscreen-btn" 
                        onclick="toggleFullscreen()"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white text-sm font-semibold rounded-xl hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg id="fullscreen-icon" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                    </svg>
                    Fullscreen
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Card container --}}
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700 overflow-hidden">
                
                <div class="bg-gradient-to-r from-purple-50/80 via-indigo-50/80 to-blue-50/80 dark:from-gray-700/80 dark:via-gray-800/80 dark:to-gray-700/80 backdrop-blur-sm px-6 md:px-8 py-5 md:py-6 border-b border-gray-200/50 dark:border-gray-700/50">
                    <div class="flex items-center">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 via-indigo-500 to-blue-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-gray-100">360° Panorama Viewer</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pano2VR</p>
                        </div>
                    </div>
                </div>

                {{-- Panorama iframe --}}
                <div id="panorama-container" class="relative w-full h-[600px] overflow-hidden">
                    
                    <div class="absolute bottom-6 right-6 z-10">
                        <button id="fullscreen-btn-floating" 
                                onclick="toggleFullscreen()"
                                class="group inline-flex items-center px-5 py-3 bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 backdrop-blur-xl text-white text-sm font-bold rounded-2xl hover:from-purple-700 hover:via-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all duration-300 hover:scale-110 shadow-2xl hover:shadow-purple-500/50 border border-white/20">
                            <svg id="fullscreen-icon-floating" class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                            </svg>
                            Fullscreen
                        </button>
                    </div>
                    
                    <button id="fullscreen-exit-btn" 
                            class="fullscreen-exit-btn"
                            onclick="toggleFullscreen()">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Exit Fullscreen
                    </button>
                    
                    <div id="loading-overlay" class="absolute inset-0 bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center z-50 backdrop-blur-sm">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-full mb-6 shadow-xl">
                                <div class="animate-spin rounded-full h-16 w-16 border-4 border-purple-200 dark:border-purple-800 border-t-purple-600 dark:border-t-purple-400"></div>
                            </div>
                            <p class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Loading Panorama...</p>
                            <p class="text-base text-gray-600 dark:text-gray-400">{{ $pano->name }}</p>
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

                
                <div class="bg-gradient-to-r from-gray-50/80 to-blue-50/80 dark:from-gray-700/80 dark:via-gray-800/80 backdrop-blur-sm px-6 md:px-8 py-4 md:py-5 border-t border-gray-200/50 dark:border-gray-700/50">
                    <div class="flex items-center justify-center text-sm md:text-base text-gray-600 dark:text-gray-400 font-medium">
                        <svg class="w-5 h-5 mr-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                        </svg>
                        <span>Drag to navigate • Press F for fullscreen</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        
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
        
        
        @media (max-width: 768px) {
            #fullscreen-btn, #fullscreen-btn-floating {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            }
        }
        
        
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
        
        
        .fullscreen-container #fullscreen-btn,
        .fullscreen-container #fullscreen-btn-floating {
            display: none !important;
        }
        
        
        #fullscreen-exit-btn {
            display: none !important;
        }
        
        
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
            const container = document.querySelector('.bg-white\\/80.rounded-2xl, .bg-white.rounded-2xl.shadow-md.p-4');
            const panoramaContainer = document.getElementById('panorama-container');
            const fullscreenIcon = document.getElementById('fullscreen-icon');
            const fullscreenBtn = document.getElementById('fullscreen-btn');
            const fullscreenIconFloating = document.getElementById('fullscreen-icon-floating');
            const fullscreenBtnFloating = document.getElementById('fullscreen-btn-floating');

            const isInCssFullscreen = container && container.classList.contains('fullscreen-container');
            const isInNativeFullscreen = document.fullscreenElement !== null;
            
            console.log('Toggle fullscreen - CSS:', isInCssFullscreen, 'Native:', isInNativeFullscreen);
            
            if (!isInCssFullscreen && !isInNativeFullscreen) {

                const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                
                if (isMobile) {

                    if (container) {
                        container.classList.add('fullscreen-container');
                        panoramaContainer.style.height = '100vh';
                        updateFullscreenButton(true);
                    }
                } else {

                    if (container && container.requestFullscreen) {
                        container.requestFullscreen().then(() => {
                            updateFullscreenButton(true);
                        }).catch(err => {
                            console.log('Error attempting to enable fullscreen:', err);
                            tryIframeFullscreen();
                        });
                    } else if (container && container.webkitRequestFullscreen) {
                        container.webkitRequestFullscreen().then(() => {
                            updateFullscreenButton(true);
                        }).catch(err => {
                            console.log('Error attempting to enable fullscreen:', err);
                            tryIframeFullscreen();
                        });
                    } else if (container && container.mozRequestFullScreen) {
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

                if (isInCssFullscreen && container) {

                    container.classList.remove('fullscreen-container');
                    panoramaContainer.style.height = '600px';
                    updateFullscreenButton(false);
                } else if (isInNativeFullscreen) {

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

                    alert('Fullscreen not supported on this device. Try rotating your device or using a different browser.');
                });
            }
        }

        function updateFullscreenButton(isFullscreen) {
            const fullscreenIcon = document.getElementById('fullscreen-icon');
            const fullscreenBtn = document.getElementById('fullscreen-btn');
            const fullscreenIconFloating = document.getElementById('fullscreen-icon-floating');
            const fullscreenBtnFloating = document.getElementById('fullscreen-btn-floating');
            const exitBtn = document.getElementById('fullscreen-exit-btn');
            
            console.log('Updating fullscreen button:', isFullscreen);
            
            if (isFullscreen) {

                if (exitBtn) exitBtn.style.display = 'block';
                if (fullscreenBtn) fullscreenBtn.style.display = 'none';
                if (fullscreenBtnFloating) fullscreenBtnFloating.style.display = 'none';

                if (fullscreenIcon) {
                    fullscreenIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15h4.5M9 15l5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25"></path>';
                }
                if (fullscreenIconFloating) {
                    fullscreenIconFloating.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15h4.5M9 15l5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25"></path>';
                }
            } else {

                if (fullscreenBtn) fullscreenBtn.style.display = 'inline-flex';
                if (fullscreenBtnFloating) fullscreenBtnFloating.style.display = 'inline-flex';
                if (exitBtn) exitBtn.style.display = 'none';

                if (fullscreenIcon) {
                    fullscreenIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>';
                }
                if (fullscreenIconFloating) {
                    fullscreenIconFloating.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>';
                }
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'f' || e.key === 'F') {
                e.preventDefault();
                toggleFullscreen();
            } else if (e.key === 'Escape') {

                const container = document.querySelector('.bg-white\\/80.rounded-2xl, .bg-white.rounded-2xl.shadow-md.p-4');
                const isInCssFullscreen = container && container.classList.contains('fullscreen-container');
                const isInNativeFullscreen = document.fullscreenElement !== null;
                
                if (isInCssFullscreen || isInNativeFullscreen) {
                    e.preventDefault();
                    toggleFullscreen();
                }
            }
        });

        setTimeout(hideLoadingOverlay, 3000);

        function initializeButtonState() {
            const container = document.querySelector('.bg-white\\/80.rounded-2xl, .bg-white.rounded-2xl.shadow-md.p-4');
            const isInCssFullscreen = container && container.classList.contains('fullscreen-container');
            const isInNativeFullscreen = document.fullscreenElement !== null;
            
            console.log('Initializing button state - CSS:', isInCssFullscreen, 'Native:', isInNativeFullscreen);
            updateFullscreenButton(isInCssFullscreen || isInNativeFullscreen);
        }

        document.addEventListener('DOMContentLoaded', initializeButtonState);

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

            const container = document.querySelector('.bg-white\\/80.rounded-2xl, .bg-white.rounded-2xl.shadow-md.p-4');
            const isInCssFullscreen = container && container.classList.contains('fullscreen-container');
            const isInNativeFullscreen = document.fullscreenElement !== null;
            
            if (swipeDistance > swipeThreshold && (isInCssFullscreen || isInNativeFullscreen)) {
                toggleFullscreen();
            }
        }
    </script>
</x-admin-layout>
@endif