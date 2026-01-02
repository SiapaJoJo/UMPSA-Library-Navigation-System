@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">View Floor</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-300">View floor details and information</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.floors.edit', $floor) }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Floor
            </a>
            <a href="{{ route('admin.floors.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Floors
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Floor Plan Image -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Floor Plan</h3>
                @if($floor->image)
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden bg-gray-50 dark:bg-gray-700/50">
                        <img src="{{ asset('images/floors/' . $floor->image) }}" 
                             alt="{{ $floor->name }} Floor Plan" 
                             class="w-full h-auto max-h-[500px] object-contain">
                    </div>
                @else
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-12 text-center bg-gray-50 dark:bg-gray-700/50">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-200 dark:bg-gray-600 rounded-full mb-4">
                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Floor Plan Image</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Floor plan image not available</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Floor Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Floor Information</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Floor Name</label>
                        <p class="text-sm text-gray-900 dark:text-white font-medium">{{ $floor->name }}</p>
                    </div>

                    @if($floor->level)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Level</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Level {{ $floor->level }}
                            </span>
                        </div>
                    @endif

                    @if($floor->description)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $floor->description }}</p>
                        </div>
                    @endif

                    @if($floor->facilities && count($floor->facilities) > 0)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Facilities</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($floor->facilities as $facility)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ $facility }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                            @if($floor->is_active)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                    <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3"></circle>
                                    </svg>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                                    <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3"></circle>
                                    </svg>
                                    Inactive
                                </span>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sort Order</label>
                            <p class="text-sm text-gray-900 dark:text-white">#{{ $floor->sort_order }}</p>
                        </div>
                    </div>

                    @if($floor->image)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Image Path</label>
                            <p class="text-sm text-gray-600 dark:text-gray-400 break-all">{{ asset('images/floors/' . $floor->image) }}</p>
                            <a href="{{ asset('images/floors/' . $floor->image) }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm mt-1 inline-flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Open in new tab
                            </a>
                        </div>
                    @endif

                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Created</label>
                        <p class="text-sm text-gray-900 dark:text-white">{{ $floor->created_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Last Updated</label>
                        <p class="text-sm text-gray-900 dark:text-white">{{ $floor->updated_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


