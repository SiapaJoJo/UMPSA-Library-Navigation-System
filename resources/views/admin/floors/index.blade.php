@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Floor Directory Management</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-300">Manage library floors, facilities, and floor plans</p>
        </div>
        <a href="{{ route('admin.floors.create') }}" 
           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-medium rounded-lg hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add New Floor
        </a>
    </div>
@endsection

@section('content')

    @if(session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-400 dark:border-green-500 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400 dark:text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Floors Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-full">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Floors</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $floors->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-full">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Active Floors</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $floors->where('is_active', true)->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-full">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">With Images</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $floors->where('image', '!=', null)->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    @if($floors->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($floors as $floor)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-200">
                    @if($floor->image)
                        <div class="relative">
                            <img src="{{ asset('images/floors/' . $floor->image) }}" 
                                 alt="{{ $floor->name }}" 
                                 class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4">
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
                        </div>
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <p class="text-sm text-gray-500 dark:text-gray-400">No image</p>
                            </div>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $floor->name }}</h3>
                            <span class="text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">Order: {{ $floor->sort_order }}</span>
                        </div>
                        
                        @if($floor->level)
                            <p class="text-sm text-green-600 dark:text-green-400 font-medium mb-2">
                                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Level {{ $floor->level }}
                            </p>
                        @endif
                        
                        @if($floor->description)
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">{{ Str::limit($floor->description, 120) }}</p>
                        @endif
                        
                        @if($floor->facilities && count($floor->facilities) > 0)
                            <div class="mb-4">
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">Facilities:</p>
                                <div class="flex flex-wrap gap-1">
                                    @foreach(array_slice($floor->facilities, 0, 3) as $facility)
                                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 text-xs rounded-full">{{ $facility }}</span>
                                    @endforeach
                                    @if(count($floor->facilities) > 3)
                                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs rounded-full">+{{ count($floor->facilities) - 3 }} more</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                        
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex space-x-3">
                                <a href="{{ route('admin.floors.show', $floor) }}" 
                                   class="inline-flex items-center text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 text-sm font-medium transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View
                                </a>
                                <a href="{{ route('admin.floors.edit', $floor) }}" 
                                   class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                            </div>
                            <form action="{{ route('admin.floors.destroy', $floor) }}" method="POST" class="inline">
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this floor?')"
                                        class="inline-flex items-center text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 text-sm font-medium transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 dark:text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No floors found</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Get started by creating your first floor directory entry.</p>
            <a href="{{ route('admin.floors.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-medium rounded-lg hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add First Floor
            </a>
        </div>
    @endif
        </div>
    </div>
@endsection
