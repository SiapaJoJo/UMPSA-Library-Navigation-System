<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Gallery Image</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Upload a new image to the gallery</p>
            </div>
            <a href="{{ route('admin.galleries.index') }}" 
               class="inline-flex items-center px-4 py-2.5 bg-gray-600 dark:bg-gray-700 text-white font-medium rounded-xl hover:bg-gray-700 dark:hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Gallery
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl overflow-hidden">
                <div class="p-6 md:p-8">
                    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="title" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Title <span class="text-red-500">*</span></label>
                                <input type="text" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title') }}"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 dark:focus:ring-pink-400 focus:border-transparent transition-all duration-200 @error('title') border-red-500 @enderror">
                                @error('title')
                                    <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="category" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Category</label>
                                <input type="text" 
                                       id="category" 
                                       name="category" 
                                       value="{{ old('category') }}"
                                       placeholder="e.g., Library Spaces, Events, Resources"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 dark:focus:ring-pink-400 focus:border-transparent transition-all duration-200 @error('category') border-red-500 @enderror">
                                @error('category')
                                    <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Description</label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 dark:focus:ring-pink-400 focus:border-transparent transition-all duration-200 resize-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="image" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Image <span class="text-red-500">*</span></label>
                            <input type="file" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 dark:file:bg-pink-900/30 dark:file:text-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-500 dark:focus:ring-pink-400 focus:border-transparent transition-all duration-200 @error('image') border-red-500 @enderror">
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Upload an image (JPEG, PNG, JPG, GIF) - Max 5MB</p>
                            @error('image')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="alt_text" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Alt Text</label>
                            <input type="text" 
                                   id="alt_text" 
                                   name="alt_text" 
                                   value="{{ old('alt_text') }}"
                                   placeholder="Alternative text for accessibility"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 dark:focus:ring-pink-400 focus:border-transparent transition-all duration-200 @error('alt_text') border-red-500 @enderror">
                            @error('alt_text')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="sort_order" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Sort Order</label>
                                <input type="number" 
                                       id="sort_order" 
                                       name="sort_order" 
                                       value="{{ old('sort_order', 0) }}"
                                       min="0"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-pink-500 dark:focus:ring-pink-400 focus:border-transparent transition-all duration-200 @error('sort_order') border-red-500 @enderror">
                                @error('sort_order')
                                    <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="flex items-center pt-8">
                                <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600 w-full">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" 
                                               id="is_featured" 
                                               name="is_featured" 
                                               value="1"
                                               {{ old('is_featured') ? 'checked' : '' }}
                                               class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-yellow-600 shadow-sm focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 focus:ring-offset-0 transition-all">
                                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-white">Featured Image</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="flex items-center pt-8">
                                <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600 w-full">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1"
                                               {{ old('is_active', true) ? 'checked' : '' }}
                                               class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-green-600 shadow-sm focus:ring-2 focus:ring-green-500 dark:bg-gray-700 focus:ring-offset-0 transition-all">
                                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-white">Active</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('admin.galleries.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-600 via-rose-700 to-red-600 text-white font-semibold rounded-xl hover:from-pink-700 hover:via-rose-800 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
