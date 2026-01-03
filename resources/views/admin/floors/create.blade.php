<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Floor</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Create a new floor directory entry</p>
            </div>
            <a href="{{ route('admin.floors.index') }}" 
               class="inline-flex items-center px-4 py-2.5 bg-gray-600 dark:bg-gray-700 text-white font-medium rounded-xl hover:bg-gray-700 dark:hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Floors
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl overflow-hidden">
                <div class="p-6 md:p-8">
                <form action="{{ route('admin.floors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                                <label for="name" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Floor Name <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   required
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent transition-all duration-200 @error('name') border-red-500 @enderror">
                            @error('name')
                                    <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                                <label for="level" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Level</label>
                            <input type="text" 
                                   id="level" 
                                   name="level" 
                                   value="{{ old('level') }}"
                                   placeholder="e.g., Ground Floor, 1st Floor, 2nd Floor"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent transition-all duration-200 @error('level') border-red-500 @enderror">
                            @error('level')
                                    <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                            <label for="description" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Description</label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent transition-all duration-200 resize-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                            <label for="image" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Floor Plan Image</label>
                        <input type="file" 
                               id="image" 
                               name="image" 
                               accept="image/*"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 dark:file:bg-green-900/30 dark:file:text-green-300 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent transition-all duration-200 @error('image') border-red-500 @enderror">
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Upload a floor plan image (JPEG, PNG, JPG, GIF) - Max 2MB</p>
                        @error('image')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                            <label for="facilities" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Facilities</label>
                        <div id="facilities-container" class="space-y-2">
                            <div class="flex space-x-2">
                                <input type="text" 
                                       name="facilities[]" 
                                       placeholder="Enter facility name"
                                           class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent transition-all duration-200">
                                <button type="button" 
                                        onclick="removeFacility(this)"
                                            class="px-4 py-3 bg-gradient-to-r from-red-500 to-rose-500 text-white text-sm font-semibold rounded-xl hover:from-red-600 hover:to-rose-600 transition-all duration-200 shadow-md hover:shadow-lg">
                                    Remove
                                </button>
                            </div>
                        </div>
                        <button type="button" 
                                onclick="addFacility()"
                                    class="mt-3 px-4 py-2.5 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-sm font-semibold rounded-xl hover:from-green-600 hover:to-emerald-600 transition-all duration-200 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            Add Facility
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                                <label for="sort_order" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Sort Order</label>
                            <input type="number" 
                                   id="sort_order" 
                                   name="sort_order" 
                                   value="{{ old('sort_order', 0) }}"
                                   min="0"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent transition-all duration-200 @error('sort_order') border-red-500 @enderror">
                            @error('sort_order')
                                    <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                            <div class="flex items-center pt-8">
                                <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
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
                        <a href="{{ route('admin.floors.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg">
                            Cancel
                        </a>
                        <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 via-emerald-700 to-teal-600 text-white font-semibold rounded-xl hover:from-green-700 hover:via-emerald-800 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            Add Floor
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addFacility() {
            const container = document.getElementById('facilities-container');
            const div = document.createElement('div');
            div.className = 'flex space-x-2';
            div.innerHTML = `
                <input type="text" 
                       name="facilities[]" 
                       placeholder="Enter facility name"
                       class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent transition-all duration-200">
                <button type="button" 
                        onclick="removeFacility(this)"
                        class="px-4 py-3 bg-gradient-to-r from-red-500 to-rose-500 text-white text-sm font-semibold rounded-xl hover:from-red-600 hover:to-rose-600 transition-all duration-200 shadow-md hover:shadow-lg">
                    Remove
                </button>
            `;
            container.appendChild(div);
        }

        function removeFacility(button) {
            button.parentElement.remove();
        }
    </script>
</x-admin-layout>
