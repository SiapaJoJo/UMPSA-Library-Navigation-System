<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Gallery Image</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-1">Update gallery image information and settings</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.galleries.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Gallery
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700 overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-8 py-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Gallery Image Information</h3>
                            <p class="text-purple-100">Update the gallery image details and settings</p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @method('PUT')

                    @if(session('success'))
                        <div class="mb-8 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-300 px-6 py-4 rounded-xl flex items-center">
                            <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Title -->
                            <div class="space-y-2">
                                <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Title *</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $gallery->title) }}"
                                           required
                                           class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('title') border-red-300 focus:ring-red-500 @enderror"
                                           placeholder="Enter image title">
                                </div>
                                @error('title')
                                    <p class="text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="space-y-2">
                                <label for="category" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Category</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" 
                                           id="category" 
                                           name="category" 
                                           value="{{ old('category', $gallery->category) }}"
                                           class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('category') border-red-300 focus:ring-red-500 @enderror"
                                           placeholder="e.g., Library Spaces, Events, Facilities">
                                </div>
                                @error('category')
                                    <p class="text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Alt Text -->
                            <div class="space-y-2">
                                <label for="alt_text" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Alt Text</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" 
                                           id="alt_text" 
                                           name="alt_text" 
                                           value="{{ old('alt_text', $gallery->alt_text) }}"
                                           class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('alt_text') border-red-300 focus:ring-red-500 @enderror"
                                           placeholder="Describe the image for accessibility">
                                </div>
                                @error('alt_text')
                                    <p class="text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Sort Order -->
                            <div class="space-y-2">
                                <label for="sort_order" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Sort Order</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    </div>
                                    <input type="number" 
                                           id="sort_order" 
                                           name="sort_order" 
                                           value="{{ old('sort_order', $gallery->sort_order ?? 0) }}"
                                           min="0"
                                           class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('sort_order') border-red-300 focus:ring-red-500 @enderror"
                                           placeholder="0">
                                </div>
                                @error('sort_order')
                                    <p class="text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Status Toggles -->
                            <div class="space-y-4">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Status Settings</label>
                                <div class="space-y-3">
                                    <label class="flex items-center">
                                        <input type="checkbox" 
                                               name="is_active" 
                                               value="1" 
                                               {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}
                                               class="w-4 h-4 text-purple-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-purple-500 focus:ring-2">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Active</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" 
                                               name="is_featured" 
                                               value="1" 
                                               {{ old('is_featured', $gallery->is_featured) ? 'checked' : '' }}
                                               class="w-4 h-4 text-yellow-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-yellow-500 focus:ring-2">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Featured</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Description -->
                            <div class="space-y-2">
                                <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Description</label>
                                <textarea id="description" 
                                          name="description" 
                                          rows="6"
                                          class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-none @error('description') border-red-300 focus:ring-red-500 @enderror"
                                          placeholder="Enter image description...">{{ old('description', $gallery->description) }}</textarea>
                                @error('description')
                                    <p class="text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Current Image -->
                            @if($gallery->image_path)
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Current Image</label>
                                    <div class="relative">
                                        <img src="{{ $gallery->image_url }}" 
                                             alt="{{ $gallery->alt_text ?: $gallery->title }}" 
                                             class="w-full h-64 object-cover rounded-xl border border-gray-200 dark:border-gray-700">
                                        <div class="absolute top-2 right-2 flex space-x-2">
                                            @if($gallery->is_featured)
                                                <span class="px-2 py-1 bg-gradient-to-r from-yellow-500 to-orange-500 text-white text-xs font-bold rounded-full flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    Featured
                                                </span>
                                            @endif
                                            <span class="px-2 py-1 bg-black/50 text-white text-xs rounded-full">Current</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- New Image Upload -->
                            <div class="space-y-2">
                                <label for="image" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    {{ $gallery->image_path ? 'Replace Image' : 'Upload Image' }}
                                </label>
                                <div class="relative">
                                    <input type="file" 
                                           id="image" 
                                           name="image" 
                                           accept="image/*"
                                           class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('image') border-red-300 focus:ring-red-500 @enderror">
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Supported formats: JPEG, PNG, JPG, GIF. Max size: 5MB</p>
                                @error('image')
                                    <p class="text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Image Preview -->
                            <div id="image-preview" class="hidden space-y-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Image Preview</label>
                                <div class="relative">
                                    <img id="preview-img" 
                                         class="w-full h-64 object-cover rounded-xl border border-gray-200 dark:border-gray-700">
                                    <div class="absolute top-2 right-2">
                                        <span class="px-2 py-1 bg-green-500 text-white text-xs font-bold rounded-full">New</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-4">
                        <a href="{{ route('admin.galleries.index') }}" 
                           class="px-6 py-3 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-200 text-sm font-semibold rounded-xl hover:bg-gray-200 dark:hover:bg-gray-500 transition-all duration-200">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white text-sm font-semibold rounded-xl hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Gallery Image
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('image-preview').classList.add('hidden');
            }
        });
    </script>
</x-admin-layout>
