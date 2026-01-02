<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - UMPSA Library</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Smooth Transitions CSS -->
    <link rel="stylesheet" href="{{ asset('css/transitions.css') }}">
    
    <!-- Additional Meta Tags -->
    <meta name="description" content="UMPSA Library Navigation System - Access library resources and maps">
    <meta name="theme-color" content="#2563eb">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
</head>
<body class="font-sans text-gray-900 antialiased" x-data="{ open: false }">
    <div class="min-h-screen w-full bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 relative overflow-hidden">
        <!-- Guest Navigation -->
        <nav class="bg-white/80 backdrop-blur-xl shadow-xl border-b border-gray-200/50 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center mr-20 md:mr-32 lg:mr-40 xl:mr-48">
                        <a href="{{ route('guest.dashboard') }}" class="flex items-center group">
                            <img src="{{ asset('images/logo.png') }}" alt="UMPSA Library" class="h-10 w-auto mr-3 transition-transform group-hover:scale-105">
                            <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">UMPSA Library</span>
                        </a>
                    </div>

                    <!-- Navigation Links - Left Aligned -->
                    <div class="hidden sm:flex items-center space-x-2">
                        <a href="{{ route('guest.dashboard') }}" 
                           class="nav-link flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition-all duration-300 whitespace-nowrap {{ request()->routeIs('guest.dashboard') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50/80' }}">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>About Us</span>
                        </a>
                        <a href="{{ route('guest.library-map') }}" 
                           class="nav-link flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition-all duration-300 whitespace-nowrap {{ request()->routeIs('guest.library-map') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50/80' }}">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                            <span>Library Map</span>
                        </a>
                        <a href="{{ route('guest.panoramas') }}" 
                           class="nav-link flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition-all duration-300 whitespace-nowrap {{ request()->routeIs('guest.panoramas') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50/80' }}">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span>Virtual Tours</span>
                        </a>
                        <a href="{{ route('guest.floors.index') }}" 
                           class="nav-link flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition-all duration-300 whitespace-nowrap {{ request()->routeIs('guest.floors.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50/80' }}">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span>Floor Directory</span>
                        </a>
                        <a href="{{ route('guest.gallery.index') }}" 
                           class="nav-link flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition-all duration-300 whitespace-nowrap {{ request()->routeIs('guest.gallery.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50/80' }}">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Gallery</span>
                        </a>
                        <a href="{{ route('guest.contact.index') }}" 
                           class="nav-link flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition-all duration-300 whitespace-nowrap {{ request()->routeIs('guest.contact.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50/80' }}">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>Contact</span>
                        </a>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-300" 
                 x-transition:enter-start="opacity-0 scale-95" 
                 x-transition:enter-end="opacity-100 scale-100" 
                 x-transition:leave="transition ease-in duration-200" 
                 x-transition:leave-start="opacity-100 scale-100" 
                 x-transition:leave-end="opacity-0 scale-95" 
                 @click.away="open = false"
                 class="sm:hidden bg-white/95 backdrop-blur-xl shadow-xl">
                <div class="pt-2 pb-3 space-y-1 px-4">
                    <a href="{{ route('guest.dashboard') }}" 
                       @click="open = false"
                       class="nav-link flex items-center px-4 py-3 rounded-lg text-base font-semibold transition-all duration-300 {{ request()->routeIs('guest.dashboard') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50/80' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        About Us
                    </a>
                    <a href="{{ route('guest.library-map') }}" 
                       @click="open = false"
                       class="nav-link flex items-center px-4 py-3 rounded-lg text-base font-semibold transition-all duration-300 {{ request()->routeIs('guest.library-map') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50/80' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                        Library Map
                    </a>
                    <a href="{{ route('guest.panoramas') }}" 
                       @click="open = false"
                       class="nav-link flex items-center px-4 py-3 rounded-lg text-base font-semibold transition-all duration-300 {{ request()->routeIs('guest.panoramas') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50/80' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Virtual Tours
                    </a>
                    <a href="{{ route('guest.floors.index') }}" 
                       @click="open = false"
                       class="nav-link flex items-center px-4 py-3 rounded-lg text-base font-semibold transition-all duration-300 {{ request()->routeIs('guest.floors.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50/80' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Floor Directory
                    </a>
                    <a href="{{ route('guest.gallery.index') }}" 
                       @click="open = false"
                       class="nav-link flex items-center px-4 py-3 rounded-lg text-base font-semibold transition-all duration-300 {{ request()->routeIs('guest.gallery.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50/80' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Gallery
                    </a>
                    <a href="{{ route('guest.contact.index') }}" 
                       @click="open = false"
                       class="nav-link flex items-center px-4 py-3 rounded-lg text-base font-semibold transition-all duration-300 {{ request()->routeIs('guest.contact.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50/80' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Contact
                    </a>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="fade-in">
            <div class="page-content">
                {{ $slot }}
            </div>
        </main>

        <!-- AI Chatbot -->
        <div id="ai-chatbot" style="position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: block !important;">
            <!-- Chatbot Toggle Button -->
            <button id="chatbot-toggle" 
                    onclick="toggleChatbot()"
                    class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white rounded-full border-2 border-white/50 shadow-2xl cursor-pointer flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-blue-500/50 hover:rotate-6">
                <svg id="chat-icon" class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <svg id="close-icon" class="w-5 h-5 sm:w-6 sm:h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Chatbot Window -->
            <div id="chatbot-window" 
                 style="position: absolute; bottom: 90px; right: 0; width: 320px; height: 400px; background: white; backdrop-filter: blur(16px); border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(255, 255, 255, 0.5); overflow: hidden; display: none; z-index: 10000;">
                 
                 <style>
                 @media (min-width: 640px) {
                     #chatbot-window {
                         width: 420px !important;
                         height: 520px !important;
                     }
                 }
                 </style>
                
                <!-- Chat Header -->
                <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 px-4 py-3 sm:px-5 sm:py-4 flex items-center justify-between shadow-lg">
                    <div class="flex items-center">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mr-3 shadow-lg">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-sm sm:text-base m-0">Library Assistant</h3>
                            <p class="text-blue-100 text-xs m-0">AI-powered help</p>
                        </div>
                    </div>
                    <!-- Close button removed as requested -->
                </div>

                <!-- Chat Messages -->
                <div id="chat-messages" class="flex-1 overflow-y-auto p-3 sm:p-5 h-64 sm:h-80">
                    <!-- Welcome Message -->
                    <div class="flex items-start mb-3 sm:mb-4">
                        <div class="w-5 h-5 sm:w-6 sm:h-6 bg-blue-100 rounded-full flex items-center justify-center mr-2 mt-1 flex-shrink-0">
                            <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl p-4 sm:p-5 max-w-[85%] border border-gray-200/50 shadow-sm">
                            <p class="m-0 text-sm sm:text-base text-gray-700 leading-relaxed font-medium">Hello! I'm your Library Assistant. How can I help you today?</p>
                        </div>
                    </div>
                </div>

                <!-- Chat Input -->
                <div class="border-t border-gray-200/50 bg-gray-50/50 p-4 sm:p-5">
                    <div class="flex gap-3">
                        <input type="text" 
                               id="chatbot-input"
                               placeholder="Type your message..."
                               class="flex-1 px-4 py-3 text-sm sm:text-base border-2 border-gray-200 rounded-2xl outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-300 shadow-sm">
                        <button id="chatbot-send" onclick="sendMessage()"
                                class="px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm sm:text-base font-bold rounded-2xl border-none cursor-pointer flex items-center justify-center hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="relative bg-white text-gray-800 overflow-hidden border-t border-gray-200">
            <!-- Footer Background Pattern -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(0,0,0,0.3) 1px, transparent 0); background-size: 40px 40px;"></div>
            </div>
            <div class="relative z-10 max-w-7xl mx-auto py-16 md:py-20 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
                    <div class="md:col-span-1">
                        <div class="flex items-center mb-6">
                            <img src="{{ asset('images/logo.png') }}" alt="UMPSA Library" class="h-10 w-auto mr-3">
                            <span class="text-2xl md:text-3xl font-extrabold bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600 bg-clip-text text-transparent">UMPSA Library</span>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            Navigate through our library with ease. Explore sections, find resources, and discover everything that supports your academic journey with our modern digital navigation system.
                        </p>
                        <div class="flex space-x-3">
                            <a href="https://github.com/SiapaJoJo" target="_blank" rel="noopener noreferrer" class="group p-3 bg-white/80 backdrop-blur-xl rounded-xl hover:bg-white/90 transition-all duration-300 hover:scale-110 shadow-lg border border-gray-200/50">
                                <svg class="w-5 h-5 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                            </a>
                            <a href="https://www.reddit.com/user/Immediate_Wing2236/?utm_source=share&utm_medium=web3x&utm_name=web3xcss&utm_term=1&utm_content=share_button" target="_blank" rel="noopener noreferrer" class="p-3 bg-white/80 backdrop-blur-xl rounded-xl hover:bg-white/90 transition-all duration-300 hover:scale-110 shadow-lg border border-gray-200/50">
                                <svg class="w-5 h-5 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0zm5.01 4.744c.688 0 1.25.561 1.25 1.249a1.25 1.25 0 0 1-2.498.056l-2.597-.547-.8 3.747c1.824.07 3.48.632 4.674 1.488.308-.309.73-.491 1.207-.491.968 0 1.754.786 1.754 1.754 0 .716-.435 1.333-1.01 1.614a3.111 3.111 0 0 1 .042.52c0 2.694-3.13 4.87-7.004 4.87-3.874 0-7.004-2.176-7.004-4.87 0-.183.015-.366.043-.534A1.748 1.748 0 0 1 4.028 12c0-.968.786-1.754 1.754-1.754.463 0 .898.196 1.207.49 1.207-.883 2.878-1.43 4.744-1.487l.885-4.182a.342.342 0 0 1 .14-.197.35.35 0 0 1 .238-.042l2.906.617a1.214 1.214 0 0 1 1.108-.701zM9.25 12C8.561 12 8 12.562 8 13.25c0 .687.561 1.248 1.25 1.248.687 0 1.248-.561 1.248-1.249 0-.688-.561-1.249-1.249-1.249zm5.5 0c-.687 0-1.248.561-1.248 1.25 0 .687.561 1.248 1.249 1.248.688 0 1.249-.561 1.249-1.249 0-.687-.562-1.249-1.25-1.249zm-5.466 3.99a.327.327 0 0 0-.231.094.33.33 0 0 0 0 .463c.842.842 2.484.913 2.961.913.477 0 2.105-.056 2.961-.913a.361.361 0 0 0 .029-.463.33.33 0 0 0-.464 0c-.547.533-1.684.73-2.512.73-.828 0-1.979-.196-2.512-.73a.326.326 0 0 0-.232-.095z"/>
                                </svg>
                            </a>
                            <a href="https://www.linkedin.com/in/muhammad-tajul-afiq-bin-tajul-aris-696517240" target="_blank" rel="noopener noreferrer" class="p-3 bg-white/80 backdrop-blur-xl rounded-xl hover:bg-white/90 transition-all duration-300 hover:scale-110 shadow-lg border border-gray-200/50">
                                <svg class="w-5 h-5 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-6 text-cyan-600">Quick Links</h3>
                        <ul class="space-y-3 text-sm">
                            <li><a href="{{ route('guest.library-map') }}" class="text-gray-700 hover:text-cyan-600 transition-all duration-300 flex items-center group hover:translate-x-1">
                                <svg class="w-4 h-4 mr-2 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                                Library Map
                            </a></li>
                            <li><a href="{{ route('guest.panoramas') }}" class="text-gray-700 hover:text-cyan-600 transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                Virtual Tours
                            </a></li>
                            <li><a href="{{ route('guest.floors.index') }}" class="text-gray-700 hover:text-cyan-600 transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Floor Directory
                            </a></li>
                            <li><a href="{{ route('guest.gallery.index') }}" class="text-gray-700 hover:text-cyan-600 transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Gallery
                            </a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-6 text-cyan-600">Contact Info</h3>
                        <div class="text-sm text-gray-700 space-y-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-1 text-gray-800 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900">Universiti Malaysia Pahang</p>
                                    <p class="text-gray-600">Al-Sultan Abdullah</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-1 text-gray-800 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900">Email</p>
                                    <p class="text-gray-600">library@ump.edu.my</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-1 text-gray-800 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900">Hours</p>
                                    <p class="text-gray-600">Mon-Fri: 8AM-10PM</p>
                                    <p class="text-gray-600">Sat-Sun: 9AM-6PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 pt-8 border-t border-gray-300 text-center">
                    <p class="text-gray-600 text-sm md:text-base">&copy; {{ date('Y') }} UMPSA Library. All rights reserved. | Modern Digital Navigation System</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Alpine.js for mobile menu -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Smooth Navigation JavaScript -->
    <script src="{{ asset('js/smooth-navigation.js') }}"></script>
    
    <!-- AI Chatbot JavaScript (ChatGPT API) -->
    <script>
        // Chat state
        let chatbotOpen = false;
        const chatHistory = [];
        
        // Make functions global
        window.toggleChatbot = function() {
            console.log('Toggle chatbot clicked, current state:', chatbotOpen);
            const chatWindow = document.getElementById('chatbot-window');
            const chatIcon = document.getElementById('chat-icon');
            const closeIcon = document.getElementById('close-icon');
            
            console.log('Elements found:', {
                chatWindow: !!chatWindow,
                chatIcon: !!chatIcon,
                closeIcon: !!closeIcon
            });
            
            if (!chatWindow) {
                console.error('Chat window not found!');
                return;
            }
            
            // Toggle the state
            chatbotOpen = !chatbotOpen;
            console.log('New chatbot state:', chatbotOpen);
            
            if (chatbotOpen) {
                // Show chat window
                chatWindow.style.display = 'block';
                console.log('Chat window shown');
                
                // Update icons
                if (chatIcon) chatIcon.style.display = 'none';
                if (closeIcon) closeIcon.style.display = 'block';
                console.log('Icons updated for open state');
            } else {
                // Hide chat window
                chatWindow.style.display = 'none';
                console.log('Chat window hidden');
                
                // Update icons
                if (chatIcon) chatIcon.style.display = 'block';
                if (closeIcon) closeIcon.style.display = 'none';
                console.log('Icons updated for closed state');
            }
        };
        
        window.sendMessage = async function() {
            console.log('Send message clicked');
            const input = document.getElementById('chatbot-input');
            const messages = document.getElementById('chat-messages');
            
            if (!input || !input.value.trim()) {
                console.log('No input or empty input');
                return;
            }
            
            console.log('Sending message:', input.value);
            
            // Add user message
            const userDiv = document.createElement('div');
            userDiv.style.cssText = 'display: flex; justify-content: flex-end; margin: 12px 0;';
            userDiv.innerHTML = `
                <div style="background: #2563eb; color: white; padding: 14px 16px; border-radius: 12px; max-width: 80%; font-size: 15px; line-height: 1.5;">
                    ${input.value}
                </div>
            `;
            messages.appendChild(userDiv);
            
            const userMessage = input.value;
            input.value = '';
            
            // Scroll to bottom
            messages.scrollTop = messages.scrollHeight;
            
            // Push to local history for better context
            chatHistory.push({ role: 'user', content: userMessage });

            // Loader bubble
            const loaderDiv = document.createElement('div');
            loaderDiv.style.cssText = 'display: flex; justify-content: flex-start; margin: 12px 0;';
            loaderDiv.innerHTML = `
                <div style="background: #f3f4f6; color: #374151; padding: 14px 16px; border-radius: 12px; max-width: 85%; font-size: 15px; line-height: 1.5;">
                    <span id="chatbot-typing">Typing…</span>
                </div>
            `;
            messages.appendChild(loaderDiv);
            messages.scrollTop = messages.scrollHeight;

            // Call backend Chat endpoint
            try {
                const csrf = document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content');
                const res = await fetch('{{ route('chat.invoke') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                    },
                    body: JSON.stringify({
                        message: userMessage,
                        history: chatHistory.slice(-6), // send recent history
                    }),
                });

                const data = await res.json();
                loaderDiv.remove();

                let reply = data.reply 
                    || (data && data.error 
                        ? `${data.error}${data.status ? ' (' + data.status + ')' : ''}${data.details ? ': ' + (typeof data.details === 'string' ? data.details : JSON.stringify(data.details)) : ''}`
                        : 'Sorry, something went wrong.');
                chatHistory.push({ role: 'assistant', content: reply });

                const aiDiv = document.createElement('div');
                aiDiv.style.cssText = 'display: flex; justify-content: flex-start; margin: 12px 0;';
                aiDiv.innerHTML = `
                    <div style="background: #f3f4f6; color: #374151; padding: 14px 16px; border-radius: 12px; max-width: 85%; font-size: 15px; line-height: 1.5; white-space: pre-wrap;">
                        ${reply}
                    </div>
                `;
                messages.appendChild(aiDiv);
                messages.scrollTop = messages.scrollHeight;
            } catch (e) {
                loaderDiv.remove();
                const errDiv = document.createElement('div');
                errDiv.style.cssText = 'display: flex; justify-content: flex-start; margin: 12px 0;';
                errDiv.innerHTML = `
                    <div style="background: #fff1f2; color: #991b1b; padding: 14px 16px; border-radius: 12px; max-width: 85%; font-size: 15px; line-height: 1.5;">
                        Unable to contact the assistant. Please try again.
                    </div>
                `;
                messages.appendChild(errDiv);
                messages.scrollTop = messages.scrollHeight;
            }
        };
        // Remove manual reply logic and use API instead
        
        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Chatbot script loaded');
            
            const toggle = document.getElementById('chatbot-toggle');
            const closeBtn = document.getElementById('chatbot-close');
            const sendBtn = document.getElementById('chatbot-send');
            const input = document.getElementById('chatbot-input');
            
            console.log('Elements found:', {
                toggle: !!toggle,
                closeBtn: !!closeBtn,
                sendBtn: !!sendBtn,
                input: !!input
            });
            
            if (toggle) {
                console.log('Toggle button found, but using onclick attribute instead of event listener');
                // Remove event listener to prevent double-click
                // toggle.addEventListener('click', function(e) {
                //     e.preventDefault();
                //     console.log('Button clicked via event listener');
                //     toggleChatbot();
                // });
                console.log('Using onclick attribute only');
            } else {
                console.error('Toggle button not found!');
            }
            
            // Close button removed - no longer needed
            
            if (sendBtn) {
                sendBtn.addEventListener('click', sendMessage);
                console.log('Send event listener added');
            }
            
            if (input) {
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        sendMessage();
                    }
                });
                console.log('Input event listener added');
            }
        });
    </script>
</body>
</html>