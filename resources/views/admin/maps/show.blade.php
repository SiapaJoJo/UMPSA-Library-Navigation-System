<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">View Library Map</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Map details and preview</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.maps.edit', $map) }}" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Map
                </a>
                <a href="{{ route('admin.maps.index') }}" class="inline-flex items-center px-4 py-2.5 bg-gray-600 dark:bg-gray-700 text-white font-medium rounded-xl hover:bg-gray-700 dark:hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Maps
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-gray-100/50 dark:from-gray-700/50 dark:to-gray-800/50">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Map Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-5">
                            <div class="pb-4 border-b border-gray-200/50 dark:border-gray-700/50">
                                <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Map Name</label>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $map->name }}</p>
                            </div>

                            @if($map->floor || $map->section)
                                <div class="pb-4 border-b border-gray-200/50 dark:border-gray-700/50">
                                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Location</label>
                                    <p class="text-base font-medium text-gray-900 dark:text-white">{{ $map->full_name }}</p>
                                </div>
                            @endif

                            <div class="pb-4 border-b border-gray-200/50 dark:border-gray-700/50">
                                <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">MappedIn URL</label>
                                <p class="text-sm text-gray-900 dark:text-white break-all mb-2">{{ $map->mappedin_url }}</p>
                                <a href="{{ $map->mappedin_url }}" target="_blank" class="inline-flex items-center text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Open in new tab
                                </a>
                            </div>

                            @if($map->description)
                                <div class="pb-4 border-b border-gray-200/50 dark:border-gray-700/50">
                                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Description</label>
                                    <p class="text-sm text-gray-900 dark:text-white">{{ $map->description }}</p>
                                </div>
                            @endif

                            <div class="grid grid-cols-2 gap-4 pb-4 border-b border-gray-200/50 dark:border-gray-700/50">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Status</label>
                                    @if($map->is_active)
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
                                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Default Map</label>
                                    @if($map->is_default)
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 text-blue-800 dark:text-blue-300 shadow-sm">
                                            <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Yes
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 shadow-sm">No</span>
                                    @endif
                                </div>
                            </div>

                            <div class="pb-4 border-b border-gray-200/50 dark:border-gray-700/50">
                                <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Sort Order</label>
                                <p class="text-base font-medium text-gray-900 dark:text-white">{{ $map->sort_order }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Created</label>
                                    <p class="text-sm text-gray-900 dark:text-white">{{ $map->created_at->format('M d, Y') }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $map->created_at->format('g:i A') }}</p>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Last Updated</label>
                                    <p class="text-sm text-gray-900 dark:text-white">{{ $map->updated_at->format('M d, Y') }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $map->updated_at->format('g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-gray-100/50 dark:from-gray-700/50 dark:to-gray-800/50">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Map Preview
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden shadow-lg">
                            <iframe 
                                src="{{ $map->embed_url }}" 
                                width="100%" 
                                height="400" 
                                frameborder="0" 
                                allowfullscreen
                                class="w-full h-96 rounded-lg">
                            </iframe>
                        </div>
                        
                        <div class="mt-6 text-center">
                            <a href="{{ $map->mappedin_url }}" 
                               target="_blank" 
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:via-blue-800 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
