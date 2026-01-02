<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                {{ __('View Library Map') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.maps.edit', $map) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                    Edit Map
                </a>
                <a href="{{ route('admin.maps.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors">
                    Back to Maps
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Map Information -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Map Information</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Map Name</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $map->name }}</p>
                            </div>

                            @if($map->floor || $map->section)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $map->full_name }}</p>
                                </div>
                            @endif

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">MappedIn URL</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white break-all">{{ $map->mappedin_url }}</p>
                                <a href="{{ $map->mappedin_url }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm">Open in new tab</a>
                            </div>

                            @if($map->description)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $map->description }}</p>
                                </div>
                            @endif

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    @if($map->is_active)
                                        <span class="inline-block mt-1 px-2 py-1 text-xs font-semibold rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">Active</span>
                                    @else
                                        <span class="inline-block mt-1 px-2 py-1 text-xs font-semibold rounded-full bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">Inactive</span>
                                    @endif
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Default Map</label>
                                    @if($map->is_default)
                                        <span class="inline-block mt-1 px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">Yes</span>
                                    @else
                                        <span class="inline-block mt-1 px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300">No</span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sort Order</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $map->sort_order }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Created</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $map->created_at->format('M d, Y \a\t g:i A') }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Updated</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $map->updated_at->format('M d, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map Preview -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Map Preview</h3>
                        
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                            <iframe 
                                src="{{ $map->embed_url }}" 
                                width="100%" 
                                height="400" 
                                frameborder="0" 
                                allowfullscreen
                                class="w-full h-96">
                            </iframe>
                        </div>
                        
                        <div class="mt-4 text-center">
                            <a href="{{ $map->mappedin_url }}" 
                               target="_blank" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Open Full Map
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
