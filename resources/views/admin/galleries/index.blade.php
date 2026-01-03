@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Gallery Management</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-300">Manage image gallery and visual content</p>
        </div>
        <a href="{{ route('admin.galleries.create') }}" 
           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-600 via-rose-700 to-red-600 text-white font-semibold rounded-xl hover:from-pink-700 hover:via-rose-800 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add New Image
        </a>
    </div>
@endsection

@section('content')
    @if(session('success'))
        <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-l-4 border-green-500 dark:border-green-400 p-4 rounded-xl shadow-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800 dark:text-green-300">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="group relative bg-gradient-to-br from-pink-500 via-rose-600 to-red-600 p-6 rounded-2xl shadow-xl text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-pink-100 text-sm font-medium mb-1">Total Images</p>
                    <p class="text-4xl font-bold">{{ $galleries->count() }}</p>
                </div>
                <div class="p-4 bg-white/20 backdrop-blur-sm rounded-2xl group-hover:rotate-12 transition-transform duration-300 shadow-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="group relative bg-gradient-to-br from-yellow-500 via-amber-600 to-orange-600 p-6 rounded-2xl shadow-xl text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-sm font-medium mb-1">Featured Images</p>
                    <p class="text-4xl font-bold">{{ $galleries->where('is_featured', true)->count() }}</p>
                </div>
                <div class="p-4 bg-white/20 backdrop-blur-sm rounded-2xl group-hover:rotate-12 transition-transform duration-300 shadow-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="group relative bg-gradient-to-br from-green-500 via-emerald-600 to-teal-600 p-6 rounded-2xl shadow-xl text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">Active Images</p>
                    <p class="text-4xl font-bold">{{ $galleries->where('is_active', true)->count() }}</p>
                </div>
                <div class="p-4 bg-white/20 backdrop-blur-sm rounded-2xl group-hover:rotate-12 transition-transform duration-300 shadow-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    @if($galleries->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($galleries as $gallery)
                <div class="group bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02]">
                    <div class="relative overflow-hidden">
                        <img src="{{ $gallery->image_url }}" 
                             alt="{{ $gallery->alt_text ?: $gallery->title }}" 
                             class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                        
                        <div class="absolute top-3 right-3 flex flex-col space-y-1.5">
                            @if($gallery->is_featured)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-yellow-400 to-amber-500 text-white shadow-lg">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    Featured
                                </span>
                            @endif
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $gallery->is_active ? 'bg-gradient-to-r from-green-400 to-emerald-500' : 'bg-gradient-to-r from-red-400 to-rose-500' }} text-white shadow-lg">
                                <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3"></circle>
                                </svg>
                                {{ $gallery->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-1">{{ $gallery->title }}</h3>
                        
                        @if($gallery->category)
                            <p class="text-sm text-pink-600 dark:text-pink-400 font-semibold mb-2 flex items-center">
                                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                {{ $gallery->category }}
                            </p>
                        @endif
                        
                        @if($gallery->description)
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-3 line-clamp-2">{{ Str::limit($gallery->description, 100) }}</p>
                        @endif
                        
                        <div class="flex justify-between items-center pt-3 border-t border-gray-200/50 dark:border-gray-700/50">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.galleries.show', $gallery) }}" 
                                   class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-pink-100 to-rose-100 dark:from-pink-900/30 dark:to-rose-900/30 text-pink-700 dark:text-pink-300 text-sm font-semibold rounded-lg hover:from-pink-200 hover:to-rose-200 dark:hover:from-pink-900/50 dark:hover:to-rose-900/50 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View
                                </a>
                                <a href="{{ route('admin.galleries.edit', $gallery) }}" 
                                   class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 text-blue-700 dark:text-blue-300 text-sm font-semibold rounded-lg hover:from-blue-200 hover:to-indigo-200 dark:hover:from-blue-900/50 dark:hover:to-indigo-900/50 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2.5 py-1 rounded-full font-medium">#{{ $gallery->sort_order }}</span>
                                <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to delete this image?')"
                                            class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-red-100 to-rose-100 dark:from-red-900/30 dark:to-rose-900/30 text-red-700 dark:text-red-300 text-sm font-semibold rounded-lg hover:from-red-200 hover:to-rose-200 dark:hover:from-red-900/50 dark:hover:to-rose-900/50 transition-all duration-200 shadow-sm hover:shadow-md">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl p-16 text-center border border-gray-200/50 dark:border-gray-700/50">
            <div class="w-20 h-20 bg-gradient-to-br from-pink-100 to-rose-100 dark:from-pink-900/30 dark:to-rose-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No images found</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Get started by uploading your first image to the gallery.</p>
            <a href="{{ route('admin.galleries.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-600 via-rose-700 to-red-600 text-white font-semibold rounded-xl hover:from-pink-700 hover:via-rose-800 hover:to-red-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add First Image
            </a>
        </div>
    @endif
@endsection
