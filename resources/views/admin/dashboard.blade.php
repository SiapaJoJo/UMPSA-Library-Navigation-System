@extends('layouts.admin')

@section('header')
    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('UMPSA Library - Admin Dashboard') }}
        </h2>
            <div class="mt-3 flex flex-wrap items-center gap-4 text-sm">
                <div class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                    <span class="text-lg">👋</span>
                    <span>Welcome back, <strong>{{ auth()->user()->name ?? 'Admin' }}</strong></span>
                </div>
                <div class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                    <span class="text-lg">📅</span>
                    <span>Last updated: {{ now()->format('M d, g:i A') }}</span>
                </div>
                <div class="flex items-center gap-2 text-green-600 dark:text-green-400">
                    <span class="text-lg">🟢</span>
                    <span>System Status: All services running</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @php
        $mapsCount = \App\Models\LibraryMap::count();
        $activeMapsCount = \App\Models\LibraryMap::where('is_active', true)->count();
        $panoramasCount = \App\Models\Panorama::count();
        $floorsCount = \App\Models\Floor::count();
        $activeFloorsCount = \App\Models\Floor::where('is_active', true)->count();
        $galleriesCount = \App\Models\Gallery::count();
        $activeGalleriesCount = \App\Models\Gallery::where('is_active', true)->count();
        $featuredGalleriesCount = \App\Models\Gallery::where('is_featured', true)->count();
        $unreadMessagesCount = \App\Models\ContactMessage::where('status', 'new')->count();
        $totalMessagesCount = \App\Models\ContactMessage::count();
        
        $latestMap = \App\Models\LibraryMap::latest()->first();
        $latestPanorama = \App\Models\Panorama::latest()->first();
        $latestFloor = \App\Models\Floor::latest()->first();
        $latestGallery = \App\Models\Gallery::latest()->first();
        
        $mapsThisWeek = \App\Models\LibraryMap::where('created_at', '>=', now()->subWeek())->count();
        $panoramasThisWeek = \App\Models\Panorama::where('created_at', '>=', now()->subWeek())->count();
        $floorsThisWeek = \App\Models\Floor::where('created_at', '>=', now()->subWeek())->count();
        $galleriesThisWeek = \App\Models\Gallery::where('created_at', '>=', now()->subWeek())->count();
        
        $mapsThisMonth = \App\Models\LibraryMap::where('created_at', '>=', now()->subMonth())->count();
        $panoramasThisMonth = \App\Models\Panorama::where('created_at', '>=', now()->subMonth())->count();
        $floorsThisMonth = \App\Models\Floor::where('created_at', '>=', now()->subMonth())->count();
        $galleriesThisMonth = \App\Models\Gallery::where('created_at', '>=', now()->subMonth())->count();
        
        $mostCommonFloor = \App\Models\Panorama::select('floor')
            ->whereNotNull('floor')
            ->groupBy('floor')
            ->orderByRaw('COUNT(*) DESC')
            ->first();
        
        $mostCommonCategory = \App\Models\Gallery::select('category')
            ->whereNotNull('category')
            ->groupBy('category')
            ->orderByRaw('COUNT(*) DESC')
            ->first();
        
        $oldFloors = \App\Models\Floor::where('updated_at', '<', now()->subMonths(3))->count();
        $oldMaps = \App\Models\LibraryMap::where('updated_at', '<', now()->subMonths(3))->count();
        $panoramasWithoutImage = \App\Models\Panorama::where(function($q) {
            $q->whereNull('display_image')->orWhere('display_image', '');
        })->count();
        
        $mapsProgress = $mapsCount > 0 ? min(100, ($activeMapsCount / max(1, $mapsCount)) * 100) : 0;
        $panoramasProgress = $panoramasCount > 0 ? 100 : 0;
        $galleriesProgress = $galleriesCount > 0 ? min(100, ($activeGalleriesCount / max(1, $galleriesCount)) * 100) : 0;
        
        $chartData = [];
        $chartLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $chartLabels[] = $date->format('D');
            $chartData[] = \App\Models\LibraryMap::whereDate('created_at', $date->format('Y-m-d'))->count() +
                          \App\Models\Panorama::whereDate('created_at', $date->format('Y-m-d'))->count() +
                          \App\Models\Floor::whereDate('created_at', $date->format('Y-m-d'))->count() +
                          \App\Models\Gallery::whereDate('created_at', $date->format('Y-m-d'))->count();
        }
        
        $activities = [];
        if ($latestMap) {
            $activities[] = [
                'icon' => '🗺️',
                'action' => 'Library Map',
                'item' => $latestMap->name,
                'time' => $latestMap->created_at->diffForHumans(),
                'url' => route('admin.maps.index'),
                'type' => 'created'
            ];
        }
        if ($latestPanorama) {
            $activities[] = [
                'icon' => '🧭',
                'action' => 'Virtual Tour',
                'item' => $latestPanorama->name,
                'time' => $latestPanorama->created_at->diffForHumans(),
                'url' => route('admin.pano.index'),
                'type' => 'created'
            ];
        }
        if ($latestFloor) {
            $activities[] = [
                'icon' => '🏢',
                'action' => 'Floor Directory',
                'item' => $latestFloor->name,
                'time' => $latestFloor->updated_at->diffForHumans(),
                'url' => route('admin.floors.index'),
                'type' => 'updated'
            ];
        }
        if ($latestGallery) {
            $activities[] = [
                'icon' => '🖼️',
                'action' => 'Gallery Image',
                'item' => $latestGallery->title,
                'time' => $latestGallery->created_at->diffForHumans(),
                'url' => route('admin.galleries.index'),
                'type' => 'created'
            ];
        }
        
        usort($activities, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });
        $activities = array_slice($activities, 0, 4);
    @endphp

    <div class="py-12">
        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="group relative bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 p-6 rounded-2xl shadow-xl text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium mb-1">Library Maps</p>
                            <p class="text-4xl font-bold mb-1">{{ $mapsCount }}</p>
                            <p class="text-blue-100 text-xs">{{ $activeMapsCount }} active</p>
                        </div>
                        <div class="p-4 bg-white/20 backdrop-blur-sm rounded-2xl group-hover:rotate-12 transition-transform duration-300 shadow-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                </div>
                    </div>
                </div>

                <div class="group relative bg-gradient-to-br from-purple-500 via-purple-600 to-pink-600 p-6 rounded-2xl shadow-xl text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium mb-1">Virtual Tours</p>
                            <p class="text-4xl font-bold mb-1">{{ $panoramasCount }}</p>
                            <p class="text-purple-100 text-xs">{{ $panoramasCount }} active</p>
                        </div>
                        <div class="p-4 bg-white/20 backdrop-blur-sm rounded-2xl group-hover:rotate-12 transition-transform duration-300 shadow-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="group relative bg-gradient-to-br from-green-500 via-emerald-600 to-teal-600 p-6 rounded-2xl shadow-xl text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium mb-1">Floor Directory</p>
                            <p class="text-4xl font-bold mb-1">{{ $floorsCount }}</p>
                            <p class="text-green-100 text-xs">{{ $activeFloorsCount }} active</p>
                        </div>
                        <div class="p-4 bg-white/20 backdrop-blur-sm rounded-2xl group-hover:rotate-12 transition-transform duration-300 shadow-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                                </div>
                            </div>
                        </div>

                <div class="group relative bg-gradient-to-br from-pink-500 via-rose-600 to-red-600 p-6 rounded-2xl shadow-xl text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-pink-100 text-sm font-medium mb-1">Gallery Images</p>
                            <p class="text-4xl font-bold mb-1">{{ $galleriesCount }}</p>
                            <p class="text-pink-100 text-xs">{{ $featuredGalleriesCount }} featured</p>
                        </div>
                        <div class="p-4 bg-white/20 backdrop-blur-sm rounded-2xl group-hover:rotate-12 transition-transform duration-300 shadow-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                </div>
                            </div>
                        </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                                <span class="text-2xl">📋</span> 
                                <span>Recent Activities</span>
                            </h3>
                    </div>
                    <div class="space-y-3">
                            @forelse($activities as $activity)
                                <a href="{{ $activity['url'] ?? '#' }}" class="block">
                                    <div class="flex items-start gap-4 p-4 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100/50 dark:from-gray-700/50 dark:to-gray-800/50 hover:from-blue-50 hover:to-indigo-50 dark:hover:from-blue-900/20 dark:hover:to-indigo-900/20 border border-gray-200/50 dark:border-gray-600/50 hover:border-blue-300 dark:hover:border-blue-700 transition-all duration-300 group cursor-pointer">
                                        <span class="text-3xl transform group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">{{ $activity['icon'] }}</span>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $activity['action'] }}</p>
                                                <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                                                    {{ $activity['type'] }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 truncate">{{ $activity['item'] }}</p>
                                        </div>
                                        <span class="text-xs text-gray-500 dark:text-gray-500 whitespace-nowrap">{{ $activity['time'] }}</span>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                    <p>No recent activities</p>
                                </div>
                            @endforelse
                        </div>
                                    </div>

                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                                <span class="text-2xl">📊</span> 
                                <span>Content Growth (Last 7 Days)</span>
                            </h3>
                            <div class="flex items-center gap-4 text-sm">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                                    <span class="text-gray-600 dark:text-gray-400">Total Content</span>
                                </div>
                            </div>
                        </div>
                        <div class="h-64">
                            <canvas id="contentChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                            <span class="text-2xl">📈</span> 
                            <span>Engagement Insights</span>
                        </h3>
                    <div class="space-y-4">
                            <div class="p-4 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 hover:shadow-lg transition-shadow duration-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">👀</span>
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Most Viewed Floor</span>
                                    </div>
                                    <span class="text-sm font-bold text-blue-600 dark:text-blue-400">
                                        {{ $mostCommonFloor ? $mostCommonFloor->floor : 'N/A' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-4 rounded-xl bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 border border-purple-200 dark:border-purple-800 hover:shadow-lg transition-shadow duration-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">🧭</span>
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Most Used Feature</span>
                                    </div>
                                    <span class="text-sm font-bold text-purple-600 dark:text-purple-400">Virtual Tours</span>
                                </div>
                            </div>
                            <div class="p-4 rounded-xl bg-gradient-to-br from-pink-50 to-rose-50 dark:from-pink-900/20 dark:to-rose-900/20 border border-pink-200 dark:border-pink-800 hover:shadow-lg transition-shadow duration-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">📸</span>
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Gallery This Week</span>
                                    </div>
                                    <span class="text-sm font-bold text-pink-600 dark:text-pink-400">{{ $galleriesThisWeek }} new</span>
                        </div>
                            </div>
                            <div class="p-4 rounded-xl bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800 hover:shadow-lg transition-shadow duration-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">🗺️</span>
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Maps This Month</span>
                                    </div>
                                    <span class="text-sm font-bold text-green-600 dark:text-green-400">{{ $mapsThisMonth }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                            <span class="text-2xl">⚠️</span> 
                            <span>Attention Needed</span>
                        </h3>
                        <div class="space-y-3">
                            @if($panoramasWithoutImage > 0)
                                <a href="{{ route('admin.pano.index') }}" class="block">
                                    <div class="p-4 rounded-xl bg-gradient-to-r from-yellow-50 to-amber-50 dark:from-yellow-900/20 dark:to-amber-900/20 border border-yellow-200 dark:border-yellow-800 hover:shadow-lg transition-all duration-300">
                                        <div class="flex items-center gap-3">
                                            <span class="text-2xl">⚠️</span>
                                            <div class="flex-1">
                                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $panoramasWithoutImage }} Virtual Tour(s) missing thumbnail</p>
                                            </div>
                                            <span class="text-xs text-yellow-600 dark:text-yellow-400">View →</span>
                                        </div>
                                    </div>
                                </a>
                            @endif
                            
                            @if($oldFloors > 0)
                                <a href="{{ route('admin.floors.index') }}" class="block">
                                    <div class="p-4 rounded-xl bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 hover:shadow-lg transition-all duration-300">
                                        <div class="flex items-center gap-3">
                                            <span class="text-2xl">⏳</span>
                                            <div class="flex-1">
                                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $oldFloors }} Floor(s) not updated in 3 months</p>
                                            </div>
                                            <span class="text-xs text-blue-600 dark:text-blue-400">View →</span>
                                        </div>
                                    </div>
                                </a>
                            @endif
                            
                            @if($unreadMessagesCount > 0)
                                <a href="{{ route('admin.contact-messages.index') }}" class="block">
                                    <div class="p-4 rounded-xl bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/20 border border-red-200 dark:border-red-800 hover:shadow-lg transition-all duration-300">
                                        <div class="flex items-center gap-3">
                                            <span class="text-2xl">📨</span>
                                            <div class="flex-1">
                                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $unreadMessagesCount }} unread message(s)</p>
                                            </div>
                                            <span class="text-xs text-red-600 dark:text-red-400">View →</span>
                                        </div>
                                    </div>
                                </a>
                            @endif
                            
                            @if($panoramasWithoutImage == 0 && $oldFloors == 0 && $unreadMessagesCount == 0)
                                <div class="p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">✅</span>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">All systems running smoothly!</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                            <span class="text-2xl">⭕</span> 
                            <span>Content Status</span>
                        </h3>
                        <div class="space-y-6">
                            <div class="flex items-center gap-4">
                                <div class="relative w-20 h-20">
                                    <svg class="transform -rotate-90 w-20 h-20">
                                        <circle cx="40" cy="40" r="36" stroke="currentColor" stroke-width="6" fill="none" class="text-gray-200 dark:text-gray-700"></circle>
                                        <circle cx="40" cy="40" r="36" stroke="currentColor" stroke-width="6" fill="none" 
                                                stroke-dasharray="{{ 2 * M_PI * 36 }}" 
                                                stroke-dashoffset="{{ 2 * M_PI * 36 * (1 - $mapsProgress / 100) }}"
                                                class="text-blue-600 transition-all duration-1000" 
                                                stroke-linecap="round"></circle>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ round($mapsProgress) }}%</span>
                                    </div>
                                </div>
                        <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Library Maps</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $activeMapsCount }}/{{ $mapsCount }} active</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-4">
                                <div class="relative w-20 h-20">
                                    <svg class="transform -rotate-90 w-20 h-20">
                                        <circle cx="40" cy="40" r="36" stroke="currentColor" stroke-width="6" fill="none" class="text-gray-200 dark:text-gray-700"></circle>
                                        <circle cx="40" cy="40" r="36" stroke="currentColor" stroke-width="6" fill="none" 
                                                stroke-dasharray="{{ 2 * M_PI * 36 }}" 
                                                stroke-dashoffset="{{ 2 * M_PI * 36 * (1 - $panoramasProgress / 100) }}"
                                                class="text-purple-600 transition-all duration-1000"
                                                stroke-linecap="round"></circle>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ round($panoramasProgress) }}%</span>
                            </div>
                        </div>
                        <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Virtual Tours</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $panoramasCount }} active</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-4">
                                <div class="relative w-20 h-20">
                                    <svg class="transform -rotate-90 w-20 h-20">
                                        <circle cx="40" cy="40" r="36" stroke="currentColor" stroke-width="6" fill="none" class="text-gray-200 dark:text-gray-700"></circle>
                                        <circle cx="40" cy="40" r="36" stroke="currentColor" stroke-width="6" fill="none" 
                                                stroke-dasharray="{{ 2 * M_PI * 36 }}" 
                                                stroke-dashoffset="{{ 2 * M_PI * 36 * (1 - $galleriesProgress / 100) }}"
                                                class="text-pink-600 transition-all duration-1000"
                                                stroke-linecap="round"></circle>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ round($galleriesProgress) }}%</span>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Gallery Coverage</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $activeGalleriesCount }}/{{ $galleriesCount }} active</p>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                        <span class="text-2xl">🔍</span> 
                        <span>Latest Content</span>
                    </h3>
                    <div class="space-y-4">
                        @if($latestMap)
                            <a href="{{ route('admin.maps.index') }}" class="block">
                                <div class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100/50 dark:from-gray-700/50 dark:to-gray-800/50 hover:from-blue-50 hover:to-indigo-50 dark:hover:from-blue-900/20 dark:hover:to-indigo-900/20 border border-gray-200/50 dark:border-gray-600/50 hover:border-blue-300 dark:hover:border-blue-700 transition-all duration-300 group cursor-pointer">
                                    <div class="flex items-center gap-4">
                                        <span class="text-3xl transform group-hover:scale-110 transition-transform duration-300">🗺️</span>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Latest Map</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ Str::limit($latestMap->name, 40) }}</p>
                                            @if($latestMap->floor)
                                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Floor: {{ $latestMap->floor }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="text-xs text-blue-600 dark:text-blue-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300">Edit →</span>
                                </div>
                            </a>
                        @endif
                        
                        @if($latestGallery)
                            <a href="{{ route('admin.galleries.index') }}" class="block">
                                <div class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100/50 dark:from-gray-700/50 dark:to-gray-800/50 hover:from-pink-50 hover:to-rose-50 dark:hover:from-pink-900/20 dark:hover:to-rose-900/20 border border-gray-200/50 dark:border-gray-600/50 hover:border-pink-300 dark:hover:border-pink-700 transition-all duration-300 group cursor-pointer">
                                    <div class="flex items-center gap-4">
                                        <span class="text-3xl transform group-hover:scale-110 transition-transform duration-300">🖼️</span>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Latest Image</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ Str::limit($latestGallery->title, 40) }}</p>
                                            @if($latestGallery->category)
                                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Category: {{ $latestGallery->category }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="text-xs text-pink-600 dark:text-pink-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300">View →</span>
                                </div>
                            </a>
                        @endif
                        
                        @if($latestPanorama)
                            <a href="{{ route('admin.pano.index') }}" class="block">
                                <div class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100/50 dark:from-gray-700/50 dark:to-gray-800/50 hover:from-purple-50 hover:to-indigo-50 dark:hover:from-purple-900/20 dark:hover:to-indigo-900/20 border border-gray-200/50 dark:border-gray-600/50 hover:border-purple-300 dark:hover:border-purple-700 transition-all duration-300 group cursor-pointer">
                                    <div class="flex items-center gap-4">
                                        <span class="text-3xl transform group-hover:scale-110 transition-transform duration-300">🧭</span>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Latest Tour</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ Str::limit($latestPanorama->name, 40) }}</p>
                                            @if($latestPanorama->floor)
                                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Floor: {{ $latestPanorama->floor }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="text-xs text-purple-600 dark:text-purple-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300">Edit →</span>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-indigo-900/20 dark:via-purple-900/20 dark:to-pink-900/20 rounded-2xl shadow-xl p-6 border border-indigo-200 dark:border-indigo-800 transform transition-all duration-300 hover:shadow-2xl">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                        <span class="text-2xl">🤖</span> 
                        <span>Smart Insights</span>
                    </h3>
                    <div class="space-y-4">
                        <div class="p-4 rounded-xl bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm border border-white/50 dark:border-gray-700/50 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-2xl">🤖</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">Suggested Update</span>
                            </div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                @if($oldFloors > 0)
                                    {{ $oldFloors }} floor(s) need updating
                                @elseif($panoramasWithoutImage > 0)
                                    Add thumbnails to {{ $panoramasWithoutImage }} virtual tour(s)
                                @else
                                    All content is up to date
                                @endif
                            </p>
                        </div>
                        <div class="p-4 rounded-xl bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm border border-white/50 dark:border-gray-700/50 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-2xl">🔍</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">Most Popular</span>
                            </div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                @if($mostCommonFloor)
                                    Floor: {{ $mostCommonFloor->floor }} ({{ \App\Models\Panorama::where('floor', $mostCommonFloor->floor)->count() }} tours)
                                @elseif($mostCommonCategory)
                                    Category: {{ $mostCommonCategory->category }} ({{ \App\Models\Gallery::where('category', $mostCommonCategory->category)->count() }} images)
                                @else
                                    Virtual Tours are most accessed
                                @endif
                            </p>
                                    </div>
                        <div class="p-4 rounded-xl bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm border border-white/50 dark:border-gray-700/50 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-2xl">📊</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">This Week's Growth</span>
                                </div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                {{ $mapsThisWeek + $panoramasThisWeek + $floorsThisWeek + $galleriesThisWeek }} new items added
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Recent Messages</h3>
                    <a href="{{ route('admin.contact-messages.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-semibold hover:underline">View All ({{ $totalMessagesCount }})</a>
                </div>
                <div class="space-y-3">
                    @php
                        $recentMessages = \App\Models\ContactMessage::latest()->take(5)->get();
                    @endphp
                    @if($recentMessages->count() > 0)
                        @foreach($recentMessages as $message)
                            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-gray-100/50 dark:from-gray-700/50 dark:to-gray-800/50 rounded-xl hover:from-blue-50 hover:to-indigo-50 dark:hover:from-blue-900/20 dark:hover:to-indigo-900/20 border border-gray-200/50 dark:border-gray-600/50 hover:border-blue-300 dark:hover:border-blue-700 transition-all duration-300">
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $message->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ Str::limit($message->subject, 50) }}</p>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        @if($message->status === 'new') bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300
                                        @elseif($message->status === 'read') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300
                                        @elseif($message->status === 'replied') bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300
                                        @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 @endif">
                                        {{ ucfirst($message->status) }}
                                    </span>
                                    <span class="text-xs text-gray-400 dark:text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-center py-8">No messages yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('contentChart');
            if (ctx) {
                const isDark = document.documentElement.classList.contains('dark');
                const textColor = isDark ? '#e5e7eb' : '#374151';
                const gridColor = isDark ? '#374151' : '#e5e7eb';
                
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($chartLabels),
                        datasets: [{
                            label: 'Content Added',
                            data: @json($chartData),
                            borderColor: 'rgb(99, 102, 241)',
                            backgroundColor: 'rgba(99, 102, 241, 0.1)',
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: 'rgb(99, 102, 241)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: isDark ? '#1f2937' : '#ffffff',
                                titleColor: textColor,
                                bodyColor: textColor,
                                borderColor: gridColor,
                                borderWidth: 1,
                                padding: 12,
                                cornerRadius: 8,
                                displayColors: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: textColor,
                                    stepSize: 1
                                },
                                grid: {
                                    color: gridColor,
                                    drawBorder: false
                                }
                            },
                            x: {
                                ticks: {
                                    color: textColor
                                },
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection
