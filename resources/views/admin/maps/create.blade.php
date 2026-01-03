<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Library Map</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Create a new interactive library map</p>
            </div>
            <a href="{{ route('admin.maps.index') }}" class="inline-flex items-center px-4 py-2.5 bg-gray-600 dark:bg-gray-700 text-white font-medium rounded-xl hover:bg-gray-700 dark:hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Maps
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl overflow-hidden">
                <div class="p-6 md:p-8">
                    <form method="POST" action="{{ route('admin.maps.store') }}" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Map Name <span class="text-red-500">*</span></label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name') }}"
                                       required
                                       placeholder="e.g., Main Library Map, Ground Floor Map"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200">
                                @error('name')
                                    <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            
                            <div class="md:col-span-2">
                                <label for="mappedin_url" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">MappedIn URL <span class="text-red-500">*</span></label>
                                <input type="url" 
                                       name="mappedin_url" 
                                       id="mappedin_url" 
                                       value="{{ old('mappedin_url') }}"
                                       required
                                       placeholder="https://app.mappedin.com/map/..."
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200">
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Enter the full MappedIn URL for this map</p>
                                @error('mappedin_url')
                                    <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            
                            <div>
                                <label for="floor" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Floor</label>
                                <input type="text" 
                                       name="floor" 
                                       id="floor" 
                                       value="{{ old('floor') }}"
                                       placeholder="e.g., Ground Floor, First Floor"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200">
                                @error('floor')
                                    <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            
                            <div>
                                <label for="section" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Section</label>
                                <input type="text" 
                                       name="section" 
                                       id="section" 
                                       value="{{ old('section') }}"
                                       placeholder="e.g., Section A, Main Area"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200">
                                @error('section')
                                    <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            
                            <div>
                                <label for="sort_order" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Sort Order</label>
                                <input type="number" 
                                       name="sort_order" 
                                       id="sort_order" 
                                       value="{{ old('sort_order', 0) }}"
                                       min="0"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200">
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Lower numbers appear first</p>
                                @error('sort_order')
                                    <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Status</label>
                                <div class="mt-2 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" 
                                               name="is_active" 
                                               value="1" 
                                               {{ old('is_active', true) ? 'checked' : '' }}
                                               class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 focus:ring-offset-0 transition-all">
                                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-white">Active</span>
                                    </label>
                                </div>
                                @error('is_active')
                                    <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Default Map</label>
                                <div class="mt-2 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" 
                                               name="is_default" 
                                               value="1" 
                                               {{ old('is_default') ? 'checked' : '' }}
                                               class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 focus:ring-offset-0 transition-all">
                                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-white">Set as default map</span>
                                    </label>
                                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Only one map can be the default</p>
                                </div>
                                @error('is_default')
                                    <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        
                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Description</label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200 resize-none"
                                      placeholder="Brief description of this map...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        
                        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('admin.maps.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:via-blue-800 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add Map
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
