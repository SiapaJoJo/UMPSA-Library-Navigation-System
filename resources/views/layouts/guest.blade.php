<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
<body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-gray-50 to-blue-50" x-data="{ open: false }">
    <div class="min-h-screen w-full">
        <!-- Guest Navigation -->
        <nav class="bg-white/80 backdrop-blur-md shadow-lg border-b border-gray-200/50 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('guest.dashboard') }}" class="flex items-center group">
                                <img src="{{ asset('images/logo.png') }}" alt="UMPSA Library" class="h-10 w-auto mr-3 transition-transform group-hover:scale-105">
                                <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">UMPSA Library</span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-1 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('guest.dashboard') }}" 
                               class="nav-link inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('guest.dashboard') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                About Us
                            </a>
                            <a href="{{ route('guest.library-map') }}" 
                               class="nav-link inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('guest.library-map') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                                Library Map
                            </a>
                            <a href="{{ route('guest.panoramas') }}" 
                               class="nav-link inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('guest.panoramas') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                Virtual Tours
                            </a>
                            <a href="{{ route('guest.floors.index') }}" 
                               class="nav-link inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('guest.floors.*') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Floor Directory
                            </a>
                            <a href="{{ route('guest.gallery.index') }}" 
                               class="nav-link inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('guest.gallery.*') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Gallery
                            </a>
                            <a href="{{ route('guest.contact.index') }}" 
                               class="nav-link inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('guest.contact.*') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Contact
                            </a>
                        </div>
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
                 class="sm:hidden bg-white/95 backdrop-blur-md">
                <div class="pt-2 pb-3 space-y-1 px-4">
                    <a href="{{ route('guest.dashboard') }}" 
                       @click="open = false"
                       class="nav-link flex items-center px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('guest.dashboard') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        About Us
                    </a>
                    <a href="{{ route('guest.library-map') }}" 
                       @click="open = false"
                       class="nav-link flex items-center px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('guest.library-map') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                        Library Map
                    </a>
                    <a href="{{ route('guest.panoramas') }}" 
                       @click="open = false"
                       class="nav-link flex items-center px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('guest.panoramas') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Virtual Tours
                    </a>
                    <a href="{{ route('guest.floors.index') }}" 
                       @click="open = false"
                       class="nav-link flex items-center px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('guest.floors.*') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Floor Directory
                    </a>
                    <a href="{{ route('guest.gallery.index') }}" 
                       @click="open = false"
                       class="nav-link flex items-center px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('guest.gallery.*') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Gallery
                    </a>
                    <a href="{{ route('guest.contact.index') }}" 
                       @click="open = false"
                       class="nav-link flex items-center px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('guest.contact.*') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
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
                    style="width: 56px; height: 56px; background: linear-gradient(to right, #2563eb, #1d4ed8); color: white; border-radius: 50%; border: none; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"
                    onmouseover="this.style.transform='scale(1.1)'" 
                    onmouseout="this.style.transform='scale(1)'">
                <svg id="chat-icon" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <svg id="close-icon" style="width: 24px; height: 24px; display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Chatbot Window -->
            <div id="chatbot-window" 
                 style="position: absolute; bottom: 80px; right: 0; width: 420px; height: 520px; background: white; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); border: 1px solid #e5e7eb; overflow: hidden; display: none; z-index: 10000;">
                
                <!-- Chat Header -->
                <div style="background: linear-gradient(to right, #2563eb, #1d4ed8); padding: 12px 16px; display: flex; align-items: center; justify-content: flex-start;">
                    <div style="display: flex; align-items: center;">
                        <div style="width: 32px; height: 32px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                            <svg style="width: 16px; height: 16px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 style="color: white; font-weight: 600; font-size: 14px; margin: 0;">Library Assistant</h3>
                            <p style="color: #dbeafe; font-size: 12px; margin: 0;">AI-powered help</p>
                        </div>
                    </div>
                </div>

                <!-- Chat Messages -->
                <div id="chat-messages" style="flex: 1; overflow-y: auto; padding: 20px; height: 360px;">
                    <!-- Welcome Message -->
                    <div style="display: flex; align-items: flex-start; margin-bottom: 16px;">
                        <div style="width: 24px; height: 24px; background: #dbeafe; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 8px; margin-top: 4px; flex-shrink: 0;">
                            <svg style="width: 12px; height: 12px; color: #2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div style="background: #f3f4f6; border-radius: 12px; padding: 16px; max-width: 85%;">
                            <p style="margin: 0; font-size: 15px; color: #374151; line-height: 1.5;">Hello! I'm your Library Assistant. How can I help you today?</p>
                        </div>
                    </div>
                </div>

                <!-- Chat Input -->
                <div style="border-top: 1px solid #e5e7eb; padding: 20px;">
                    <div style="display: flex; gap: 12px;">
                        <input type="text" 
                               id="chatbot-input"
                               placeholder="Type your message..."
                               style="flex: 1; padding: 12px 16px; font-size: 15px; border: 1px solid #d1d5db; border-radius: 10px; outline: none; focus:border-blue-500;">
                        <button id="chatbot-send" onclick="sendMessage()"
                                style="padding: 12px 20px; background: #2563eb; color: white; font-size: 15px; font-weight: 500; border-radius: 10px; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gradient-to-r from-gray-900 to-gray-800 text-white">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="md:col-span-2">
                        <div class="flex items-center mb-6">
                            <img src="{{ asset('images/logo.png') }}" alt="UMPSA Library" class="h-10 w-auto mr-4">
                            <span class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-blue-300 bg-clip-text text-transparent">UMPSA Library</span>
                        </div>
                        <p class="text-gray-300 text-base leading-relaxed mb-6 max-w-md">
                            Navigate through our library with ease. Explore sections, find resources, and discover everything that supports your academic journey with our modern digital navigation system.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="p-2 bg-gray-700 rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="p-2 bg-gray-700 rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="p-2 bg-gray-700 rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-6 text-blue-300">Quick Links</h3>
                        <ul class="space-y-3 text-sm">
                            <li><a href="{{ route('guest.library-map') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                                Library Map
                            </a></li>
                            <li><a href="{{ route('guest.panoramas') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                Virtual Tours
                            </a></li>
                            <li><a href="{{ route('guest.floors.index') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Floor Directory
                            </a></li>
                            <li><a href="{{ route('guest.gallery.index') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Gallery
                            </a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-6 text-blue-300">Contact Info</h3>
                        <div class="text-sm text-gray-300 space-y-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium">Universiti Malaysia Pahang</p>
                                    <p class="text-gray-400">Al-Sultan Abdullah</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium">Email</p>
                                    <p class="text-gray-400">library@ump.edu.my</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium">Hours</p>
                                    <p class="text-gray-400">Mon-Fri: 8AM-10PM</p>
                                    <p class="text-gray-400">Sat-Sun: 9AM-6PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 pt-8 border-t border-gray-700 text-center">
                    <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} UMPSA Library. All rights reserved. | Modern Digital Navigation System</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Alpine.js for mobile menu -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Smooth Navigation JavaScript -->
    <script src="{{ asset('js/smooth-navigation.js') }}"></script>
    
    <!-- AI Chatbot JavaScript -->
    <script>
        // Simple chatbot implementation
        let chatbotOpen = false;
        
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
        
        window.sendMessage = function() {
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
            
            // Add AI response
            setTimeout(() => {
                const aiResponse = getAIResponse(userMessage.toLowerCase());
                const aiDiv = document.createElement('div');
                aiDiv.style.cssText = 'display: flex; justify-content: flex-start; margin: 12px 0;';
                aiDiv.innerHTML = `
                    <div style="background: #f3f4f6; color: #374151; padding: 14px 16px; border-radius: 12px; max-width: 85%; font-size: 15px; line-height: 1.5;">
                        ${aiResponse}
                    </div>
                `;
                messages.appendChild(aiDiv);
                messages.scrollTop = messages.scrollHeight;
            }, 1000);
        };
        
        // AI Response function
        function getAIResponse(input) {
            const responses = {
                // Greetings
                'hello': 'Hello! How can I help you with the library today?',
                'hi': 'Hi there! What would you like to know about our library?',
                'hey': 'Hey! I\'m here to help with any library questions you have.',
                
                // Library hours
                'hours': '**🕐 Library Hours**\n\n**Monday - Friday:** 8:00 AM - 10:00 PM\n**Saturday - Sunday:** 9:00 AM - 6:00 PM',
                'when are you open': '**🕐 Library Hours**\n\n**Monday - Friday:** 8:00 AM - 10:00 PM\n**Saturday - Sunday:** 9:00 AM - 6:00 PM',
                'opening times': '**🕐 Library Hours**\n\n**Monday - Friday:** 8:00 AM - 10:00 PM\n**Saturday - Sunday:** 9:00 AM - 6:00 PM',
                'what time': '**🕐 Library Hours**\n\n**Monday - Friday:** 8:00 AM - 10:00 PM\n**Saturday - Sunday:** 9:00 AM - 6:00 PM',
                'open': '**🕐 Library Hours**\n\n**Monday - Friday:** 8:00 AM - 10:00 PM\n**Saturday - Sunday:** 9:00 AM - 6:00 PM',
                
                // Services
                'services': '**🏛️ Library Services**\n\n• Book lending & returns\n• Computer access\n• Printing & scanning\n• Study spaces\n• Virtual tours\n• Research assistance',
                'what services': '**🏛️ Library Services**\n\n• Book lending & returns\n• Computer access\n• Printing & scanning\n• Study spaces\n• Virtual tours\n• Research assistance',
                'help': '**🤖 How can I help?**\n\nI can assist with:\n• Library hours & services\n• Finding books & resources\n• Study spaces & rooms\n• Virtual tours & maps\n• Contact information',
                
                // Study spaces
                'study space': '**📚 Study Spaces**\n\n• Quiet zones\n• Group study rooms\n• Computer labs\n• Reading areas\n\nCheck our Floor Directory for locations!',
                'where can i study': '**📚 Study Spaces**\n\n• Quiet zones\n• Group study rooms\n• Computer labs\n• Reading areas\n\nCheck our Floor Directory for locations!',
                'quiet study': '**🔇 Quiet Study Zones**\n\nAvailable on multiple floors for focused study.',
                'study': '**📚 Study Spaces**\n\n• Quiet zones\n• Group study rooms\n• Computer labs\n• Reading areas\n\nCheck our Floor Directory for locations!',
                'room': '**📚 Study Spaces**\n\n• Quiet zones\n• Group study rooms\n• Computer labs\n• Reading areas\n\nCheck our Floor Directory for locations!',
                
                // Books and resources
                'books': '**📖 Books & Resources**\n\n• Physical books for borrowing\n• Digital resources online\n• Search system available\n• Browse our catalog',
                'find book': '**🔍 Find a Book**\n\n1. Use our search system\n2. Ask our staff for help\n3. Browse the catalog\n\nWhat book are you looking for?',
                'catalog': '**📋 Library Catalog**\n\nSearch for:\n• Books & textbooks\n• Journals & articles\n• Digital resources\n• Research materials',
                'search': '**🔍 Search System**\n\nFind books, journals, and resources using our catalog system.',
                'book': '**📖 Books & Resources**\n\n• Physical books for borrowing\n• Digital resources online\n• Search system available\n• Browse our catalog',
                
                // Virtual tours
                'virtual tour': '**🎥 Virtual Tours**\n\n• 360° panoramas\n• Explore from anywhere\n• Mobile friendly\n\nCheck out our Virtual Tours section!',
                'tour': '**🎥 Virtual Tours**\n\n• 360° panoramas\n• Explore from anywhere\n• Mobile friendly\n\nCheck out our Virtual Tours section!',
                'panorama': '**🌐 360° Panoramas**\n\nExplore the library from anywhere using our virtual tour feature!',
                '360': '**🌐 360° Panoramas**\n\nExplore the library from anywhere using our virtual tour feature!',
                'virtual': '**🎥 Virtual Tours**\n\n• 360° panoramas\n• Explore from anywhere\n• Mobile friendly\n\nCheck out our Virtual Tours section!',
                
                // Maps and navigation
                'map': '**🗺️ Library Map**\n\n• Interactive layout\n• Floor plans\n• Find specific areas\n\nNavigate easily with our map!',
                'library map': '**🗺️ Library Map**\n\n• Interactive layout\n• Floor plans\n• Find specific areas\n\nNavigate easily with our map!',
                'directions': '**🧭 Get Directions**\n\nUse our interactive map to navigate to different areas of the library.',
                'where is': '**🔍 Find Locations**\n\nI can help you find specific areas. What are you looking for?',
                'navigate': '**🧭 Navigation**\n\nUse our interactive library map to navigate and find specific areas.',
                'location': '**🗺️ Library Map**\n\n• Interactive layout\n• Floor plans\n• Find specific areas\n\nNavigate easily with our map!',
                
                // Floor directory
                'floor': '**🏢 Floor Directory**\n\n• Building plans for each level\n• Facilities on each floor\n• Interactive navigation\n\nExplore our Floor Directory!',
                'floors': '**🏢 Floor Directory**\n\n• Building plans for each level\n• Facilities on each floor\n• Interactive navigation\n\nExplore our Floor Directory!',
                'level': '**🏢 Floor Directory**\n\n• Building plans for each level\n• Facilities on each floor\n• Interactive navigation\n\nExplore our Floor Directory!',
                'building plan': '**📋 Building Plans**\n\nView detailed floor plans for each level in our Floor Directory section.',
                'directory': '**🏢 Floor Directory**\n\n• Building plans for each level\n• Facilities on each floor\n• Interactive navigation\n\nExplore our Floor Directory!',
                
                // Gallery
                'gallery': '**📸 Library Gallery**\n\n• Photos of different areas\n• View our facilities\n• Easy browsing\n\nCheck out our Gallery section!',
                'photos': '**📸 Library Gallery**\n\n• Photos of different areas\n• View our facilities\n• Easy browsing\n\nCheck out our Gallery section!',
                'pictures': '**📸 Library Gallery**\n\n• Photos of different areas\n• View our facilities\n• Easy browsing\n\nCheck out our Gallery section!',
                'images': '**📸 Library Gallery**\n\n• Photos of different areas\n• View our facilities\n• Easy browsing\n\nCheck out our Gallery section!',
                'photo': '**📸 Library Gallery**\n\n• Photos of different areas\n• View our facilities\n• Easy browsing\n\nCheck out our Gallery section!',
                
                // Contact
                'contact': '**📞 Contact Us**\n\n**Email:** library@ump.edu.my\n**Phone:** +60 9-424 5000\n**In Person:** Visit us at the library',
                'contact page': '**📞 Contact Us**\n\n**Email:** library@ump.edu.my\n**Phone:** +60 9-424 5000\n**In Person:** Visit us at the library',
                'phone': '**📱 Phone**\n\nCall us at: +60 9-424 5000',
                'email': '**📧 Email**\n\nSend us an email at: library@ump.edu.my',
                'call': '**📱 Phone**\n\nCall us at: +60 9-424 5000',
                'reach': '**📞 Contact Us**\n\n**Email:** library@ump.edu.my\n**Phone:** +60 9-424 5000\n**In Person:** Visit us at the library',
                
                // General
                'thank you': '**😊 You\'re welcome!**\n\nIs there anything else I can help you with?',
                'thanks': '**😊 You\'re welcome!**\n\nFeel free to ask if you need more help!',
                'bye': '**👋 Goodbye!**\n\nHave a great day at the library!',
                'goodbye': '**👋 Goodbye!**\n\nDon\'t hesitate to come back if you need more assistance!'
            };

            // Enhanced matching with fuzzy keywords
            const fuzzyKeywords = {
                'contact': ['contact', 'reach', 'phone', 'email', 'call', 'get in touch', 'speak to', 'talk to'],
                'map': ['map', 'location', 'navigate', 'directions', 'where', 'find', 'locate'],
                'floor': ['floor', 'level', 'directory', 'building', 'plan', 'area'],
                'gallery': ['gallery', 'photo', 'picture', 'image', 'view', 'see'],
                'tour': ['tour', 'virtual', 'panorama', '360', 'explore', 'visit'],
                'study': ['study', 'room', 'space', 'quiet', 'work', 'learn'],
                'book': ['book', 'catalog', 'search', 'find', 'resource', 'material'],
                'hours': ['hours', 'time', 'open', 'close', 'when', 'available']
            };

            // Check for fuzzy matches
            for (const [category, keywords] of Object.entries(fuzzyKeywords)) {
                for (const keyword of keywords) {
                    if (input.includes(keyword)) {
                        // Return specific response based on category
                        switch(category) {
                            case 'contact':
                                return '**📞 Contact Us**\n\n**Email:** library@ump.edu.my\n**Phone:** +60 9-424 5000\n**In Person:** Visit us at the library';
                            case 'map':
                                return '**🗺️ Library Map**\n\n• Interactive layout\n• Floor plans\n• Find specific areas\n\nNavigate easily with our map!';
                            case 'floor':
                                return '**🏢 Floor Directory**\n\n• Building plans for each level\n• Facilities on each floor\n• Interactive navigation\n\nExplore our Floor Directory!';
                            case 'gallery':
                                return '**📸 Library Gallery**\n\n• Photos of different areas\n• View our facilities\n• Easy browsing\n\nCheck out our Gallery section!';
                            case 'tour':
                                return '**🎥 Virtual Tours**\n\n• 360° panoramas\n• Explore from anywhere\n• Mobile friendly\n\nCheck out our Virtual Tours section!';
                            case 'study':
                                return '**📚 Study Spaces**\n\n• Quiet zones\n• Group study rooms\n• Computer labs\n• Reading areas\n\nCheck our Floor Directory for locations!';
                            case 'book':
                                return '**📖 Books & Resources**\n\n• Physical books for borrowing\n• Digital resources online\n• Search system available\n• Browse our catalog';
                            case 'hours':
                                return '**🕐 Library Hours**\n\n**Monday - Friday:** 8:00 AM - 10:00 PM\n**Saturday - Sunday:** 9:00 AM - 6:00 PM';
                        }
                    }
                }
            }

            // Find exact matches
            for (const [key, response] of Object.entries(responses)) {
                if (input.includes(key)) {
                    return response;
                }
            }

            // Enhanced fallback with suggestions
            return `I'm not sure about "${input}". Here are some topics I can help with:

**📚 Library Topics:**
• **Hours** - When we're open
• **Map** - Find your way around  
• **Floors** - Building layout
• **Study** - Study spaces
• **Tours** - Virtual experiences
• **Gallery** - Library photos
• **Contact** - Get in touch

Just ask about any of these!`;
        }
        
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