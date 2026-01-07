@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Virtual Tour</h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Update panorama information</p>
        </div>
        <a href="{{ route('admin.pano.index') }}" 
           class="inline-flex items-center px-4 py-2.5 bg-gray-600 dark:bg-gray-700 text-white font-medium rounded-xl hover:bg-gray-700 dark:hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Panoramas
        </a>
    </div>
@endsection

@section('content')
    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl overflow-hidden">
        <div class="p-6 md:p-8">
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

            @if(session('error'))
                <div class="mb-6 bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/20 border-l-4 border-red-500 dark:border-red-400 p-4 rounded-xl shadow-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800 dark:text-red-300">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.pano.update', $pano) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Panorama Name <span class="text-red-500">*</span></label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name', $pano->name) }}"
                               placeholder="Enter panorama name" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent transition-all duration-200 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Floor</label>
                        <input type="text" 
                               name="floor" 
                               value="{{ old('floor', $pano->floor) }}"
                               placeholder="e.g., Ground Floor, 1st Floor, 2nd Floor"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent transition-all duration-200 @error('floor') border-red-500 @enderror">
                        @error('floor')
                            <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                
                <div>
                    <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Description</label>
                    <textarea name="description" 
                              rows="4"
                              placeholder="Enter a description of this panorama..."
                              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent transition-all duration-200 resize-none @error('description') border-red-500 @enderror">{{ old('description', $pano->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                
                <div>
                    <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Display Image</label>
                    @if($pano->display_image)
                        <div class="mb-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Current display image:</p>
                            <img src="{{ asset('panos/' . $pano->folder . '/' . $pano->display_image) }}" 
                                 alt="{{ $pano->name }}" 
                                 class="w-32 h-32 object-cover rounded-xl border-2 border-gray-300 dark:border-gray-600 shadow-md">
                        </div>
                    @endif
                    <div class="relative">
                        <input type="file" 
                               name="display_image" 
                               accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 dark:file:bg-purple-900/30 dark:file:text-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent transition-all duration-200 @error('display_image') border-red-500 @enderror">
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Upload a new image to replace the current one (JPEG, PNG, JPG, GIF)</p>
                    @error('display_image')
                        <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Replace Panorama ZIP File</label>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Upload a new ZIP file to replace the existing panorama files. This will keep the current metadata (name, description, floor) but replace all panorama files.</p>
                        
                        <form id="replace-form" action="{{ route('admin.pano.replace', $pano) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to replace the panorama files? This action cannot be undone.')">
                            @csrf
                            <div>
                                <input type="file" 
                                       name="pano_file" 
                                       accept=".zip" 
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 dark:file:bg-purple-900/30 dark:file:text-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent transition-all duration-200 @error('pano_file') border-red-500 @enderror">
                                @error('pano_file')
                                    <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.pano.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg">
                        Cancel
                    </a>
                    <button type="submit" 
                            form="replace-form"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 via-purple-700 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:via-purple-800 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Replace Files
                    </button>
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 via-purple-700 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:via-purple-800 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Panorama
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
