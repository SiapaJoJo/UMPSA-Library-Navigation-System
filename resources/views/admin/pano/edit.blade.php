@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Virtual Tour</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-300">Update panorama information</p>
        </div>
        <a href="{{ route('admin.pano.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Panoramas
        </a>
    </div>
@endsection

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        @if(session('error'))
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-400 dark:border-red-500 p-4 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400 dark:text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700 dark:text-red-300">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.pano.update', $pano) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Panorama Name *</label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name', $pano->name) }}"
                           placeholder="Enter panorama name" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Floor</label>
                    <input type="text" 
                           name="floor" 
                           value="{{ old('floor', $pano->floor) }}"
                           placeholder="e.g., Ground Floor, 1st Floor, 2nd Floor"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors @error('floor') border-red-500 @enderror">
                    @error('floor')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                <textarea name="description" 
                          rows="4"
                          placeholder="Enter a description of this panorama..."
                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors @error('description') border-red-500 @enderror">{{ old('description', $pano->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Display Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Display Image</label>
                @if($pano->display_image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">Current display image:</p>
                        <img src="{{ asset('panos/' . $pano->folder . '/' . $pano->display_image) }}" 
                             alt="{{ $pano->name }}" 
                             class="w-32 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                    </div>
                @endif
                <div class="relative">
                    <input type="file" 
                           name="display_image" 
                           accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors @error('display_image') border-red-500 @enderror">
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Upload a new image to replace the current one (JPEG, PNG, JPG, GIF)</p>
                @error('display_image')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.pano.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-medium rounded-lg hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Panorama
                </button>
            </div>
        </form>
    </div>
@endsection


