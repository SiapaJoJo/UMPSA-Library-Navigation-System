@extends('layouts.admin')

@section('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('UMPSA Library - Admin Dashboard') }}
        </h2>
@endsection

@section('content')

    <div class="py-12">
        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
            <!-- Statistics Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Library Maps Card -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 rounded-lg shadow-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Library Maps</p>
                            <p class="text-3xl font-bold">{{ \App\Models\LibraryMap::count() }}</p>
                        </div>
                        <div class="p-3 bg-blue-400 rounded-full">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                </div>
                    </div>
                </div>

                <!-- Panoramas Card -->
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6 rounded-lg shadow-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Virtual Tours</p>
                            <p class="text-3xl font-bold">{{ \App\Models\Panorama::count() }}</p>
                        </div>
                        <div class="p-3 bg-purple-400 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Floors Card -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 rounded-lg shadow-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Floor Directory</p>
                            <p class="text-3xl font-bold">{{ \App\Models\Floor::count() }}</p>
                        </div>
                        <div class="p-3 bg-green-400 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                                </div>
                            </div>
                        </div>

                <!-- Gallery Card -->
                <div class="bg-gradient-to-r from-pink-500 to-pink-600 p-6 rounded-lg shadow-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-pink-100 text-sm font-medium">Gallery Images</p>
                            <p class="text-3xl font-bold">{{ \App\Models\Gallery::count() }}</p>
                        </div>
                        <div class="p-3 bg-pink-400 rounded-full">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                </div>
                            </div>
                        </div>

            <!-- Content Management Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Recent Contact Messages -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Messages</h3>
                        <a href="{{ route('admin.contact-messages.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                    </div>
                    <div class="space-y-3">
                        @php
                            $recentMessages = \App\Models\ContactMessage::latest()->take(5)->get();
                        @endphp
                        @if($recentMessages->count() > 0)
                            @foreach($recentMessages as $message)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $message->name }}</p>
                                        <p class="text-xs text-gray-500">{{ Str::limit($message->subject, 40) }}</p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($message->status === 'new') bg-red-100 text-red-800
                                            @elseif($message->status === 'read') bg-yellow-100 text-yellow-800
                                            @elseif($message->status === 'replied') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($message->status) }}
                                        </span>
                                        <span class="text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-500 text-center py-4">No messages yet</p>
                        @endif
                    </div>
                </div>

                <!-- Content Statistics Chart -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Content Overview</h3>
                    <div class="space-y-4">
                        <!-- Library Maps Progress -->
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600">Library Maps</span>
                                <span class="text-gray-900 font-medium">{{ \App\Models\LibraryMap::count() }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(100, (\App\Models\LibraryMap::count() / 10) * 100) }}%"></div>
                            </div>
                        </div>

                        <!-- Panoramas Progress -->
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600">Virtual Tours</span>
                                <span class="text-gray-900 font-medium">{{ \App\Models\Panorama::count() }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-purple-600 h-2 rounded-full" style="width: {{ min(100, (\App\Models\Panorama::count() / 15) * 100) }}%"></div>
                            </div>
                        </div>

                        <!-- Floors Progress -->
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600">Floor Directory</span>
                                <span class="text-gray-900 font-medium">{{ \App\Models\Floor::count() }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ min(100, (\App\Models\Floor::count() / 8) * 100) }}%"></div>
                            </div>
                        </div>

                        <!-- Gallery Progress -->
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600">Gallery Images</span>
                                <span class="text-gray-900 font-medium">{{ \App\Models\Gallery::count() }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-pink-600 h-2 rounded-full" style="width: {{ min(100, (\App\Models\Gallery::count() / 20) * 100) }}%"></div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Quick Actions</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('admin.maps.create') }}" class="group bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-lg border border-blue-200 hover:shadow-md transition-all duration-200">
                                <div class="text-center">
                            <div class="p-3 rounded-full bg-blue-500 text-white w-12 h-12 mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                            <h4 class="font-medium text-gray-900 group-hover:text-blue-600">Add Map</h4>
                                </div>
                            </a>

                    <a href="{{ route('admin.pano.index') }}" class="group bg-gradient-to-r from-purple-50 to-purple-100 p-4 rounded-lg border border-purple-200 hover:shadow-md transition-all duration-200">
                                <div class="text-center">
                            <div class="p-3 rounded-full bg-purple-500 text-white w-12 h-12 mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                            <h4 class="font-medium text-gray-900 group-hover:text-purple-600">Manage Tours</h4>
                                </div>
                            </a>

                    <a href="{{ route('admin.floors.index') }}" class="group bg-gradient-to-r from-green-50 to-green-100 p-4 rounded-lg border border-green-200 hover:shadow-md transition-all duration-200">
                                <div class="text-center">
                            <div class="p-3 rounded-full bg-green-500 text-white w-12 h-12 mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                            <h4 class="font-medium text-gray-900 group-hover:text-green-600">Manage Floors</h4>
                                </div>
                            </a>

                    <a href="{{ route('admin.galleries.index') }}" class="group bg-gradient-to-r from-pink-50 to-pink-100 p-4 rounded-lg border border-pink-200 hover:shadow-md transition-all duration-200">
                                <div class="text-center">
                            <div class="p-3 rounded-full bg-pink-500 text-white w-12 h-12 mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                            <h4 class="font-medium text-gray-900 group-hover:text-pink-600">Manage Gallery</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
