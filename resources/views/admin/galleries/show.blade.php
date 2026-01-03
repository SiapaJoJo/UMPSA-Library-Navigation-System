@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">View Gallery Image</h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Gallery image details and information</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.galleries.edit', $gallery) }}" 
               class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Image
            </a>
            <a href="{{ route('admin.galleries.index') }}" 
               class="inline-flex items-center px-4 py-2.5 bg-gray-600 dark:bg-gray-700 text-white font-medium rounded-xl hover:bg-gray-700 dark:hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Gallery
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-gray-100/50 dark:from-gray-700/50 dark:to-gray-800/50">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Image Preview
                </h3>
            </div>
            <div class="p-6">
                <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden bg-gray-50 dark:bg-gray-700/50 shadow-lg">
                    <img src="{{ $gallery->image_url }}" 
                         alt="{{ $gallery->alt_text ?: $gallery->title }}" 
                         class="w-full h-auto max-h-[500px] object-contain">
                </div>
            </div>
        </div>

        
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-gray-100/50 dark:from-gray-700/50 dark:to-gray-800/50">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Image Information
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-5">
                    <div class="pb-4 border-b border-gray-200/50 dark:border-gray-700/50">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Title</label>
                        <p class="text-base font-bold text-gray-900 dark:text-white">{{ $gallery->title }}</p>
                    </div>

                    @if($gallery->category)
                        <div class="pb-4 border-b border-gray-200/50 dark:border-gray-700/50">
                            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Category</label>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-gradient-to-r from-pink-100 to-rose-100 dark:from-pink-900/30 dark:to-rose-900/30 text-pink-800 dark:text-pink-300 shadow-sm">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                {{ $gallery->category }}
                            </span>
                        </div>
                    @endif

                    @if($gallery->description)
                        <div class="pb-4 border-b border-gray-200/50 dark:border-gray-700/50">
                            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Description</label>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $gallery->description }}</p>
                        </div>
                    @endif

                    @if($gallery->alt_text)
                        <div class="pb-4 border-b border-gray-200/50 dark:border-gray-700/50">
                            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Alt Text</label>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $gallery->alt_text }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4 pb-4 border-b border-gray-200/50 dark:border-gray-700/50">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Status</label>
                            @if($gallery->is_active)
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 text-green-800 dark:text-green-300 shadow-sm">
                                    <svg class="w-2 h-2 mr-1.5" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3"></circle>
                                    </svg>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-red-100 to-rose-100 dark:from-red-900/30 dark:to-rose-900/30 text-red-800 dark:text-red-300 shadow-sm">
                                    <svg class="w-2 h-2 mr-1.5" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3"></circle>
                                    </svg>
                                    Inactive
                                </span>
                            @endif
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Featured</label>
                            @if($gallery->is_featured)
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-yellow-100 to-amber-100 dark:from-yellow-900/30 dark:to-amber-900/30 text-yellow-800 dark:text-yellow-300 shadow-sm">
                                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    Featured
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 shadow-sm">Not Featured</span>
                            @endif
                        </div>
                    </div>

                    <div class="pb-4 border-b border-gray-200/50 dark:border-gray-700/50">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Sort Order</label>
                        <p class="text-base font-medium text-gray-900 dark:text-white">#{{ $gallery->sort_order }}</p>
                    </div>

                    <div class="pb-4 border-b border-gray-200/50 dark:border-gray-700/50">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Image URL</label>
                        <p class="text-sm text-gray-600 dark:text-gray-400 break-all mb-2">{{ $gallery->image_url }}</p>
                        <a href="{{ $gallery->image_url }}" target="_blank" class="inline-flex items-center text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Open in new tab
                        </a>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Created</label>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $gallery->created_at->format('M d, Y') }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $gallery->created_at->format('g:i A') }}</p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Last Updated</label>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $gallery->updated_at->format('M d, Y') }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $gallery->updated_at->format('g:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
