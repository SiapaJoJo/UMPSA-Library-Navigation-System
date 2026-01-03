<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Contact Message Details</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">View and manage contact message</p>
            </div>
            <a href="{{ route('admin.contact-messages.index') }}" 
               class="inline-flex items-center px-4 py-2.5 bg-gray-600 dark:bg-gray-700 text-white font-medium rounded-xl hover:bg-gray-700 dark:hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Messages
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-gray-100/50 dark:from-gray-700/50 dark:to-gray-800/50">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="h-14 w-14 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center shadow-lg">
                                        <span class="text-xl font-bold text-white">{{ strtoupper(substr($contactMessage->name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $contactMessage->name }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $contactMessage->email }}</p>
                                        @if($contactMessage->phone)
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $contactMessage->phone }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold
                                        @if($contactMessage->status === 'new') bg-gradient-to-r from-red-100 to-rose-100 dark:from-red-900/30 dark:to-rose-900/30 text-red-800 dark:text-red-300
                                        @elseif($contactMessage->status === 'read') bg-gradient-to-r from-yellow-100 to-amber-100 dark:from-yellow-900/30 dark:to-amber-900/30 text-yellow-800 dark:text-yellow-300
                                        @elseif($contactMessage->status === 'replied') bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 text-blue-800 dark:text-blue-300
                                        @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300
                                        @endif shadow-sm">
                                        {{ ucfirst($contactMessage->status) }}
                                    </span>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">{{ $contactMessage->created_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6 border-b border-gray-200/50 dark:border-gray-700/50">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-3">{{ $contactMessage->subject }}</h4>
                            <div class="prose max-w-none">
                                <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap leading-relaxed">{{ $contactMessage->message }}</p>
                            </div>
                        </div>
                    </div>

                    
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-gray-100/50 dark:from-gray-700/50 dark:to-gray-800/50">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Admin Notes
                            </h4>
                        </div>
                        <form action="{{ route('admin.contact-messages.update', $contactMessage) }}" method="POST" class="p-6 space-y-4">
                            @method('PUT')
                            @csrf
                            
                            <div>
                                <label for="status" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Status</label>
                                <select id="status" 
                                        name="status" 
                                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200">
                                    <option value="new" {{ $contactMessage->status === 'new' ? 'selected' : '' }}>New</option>
                                    <option value="read" {{ $contactMessage->status === 'read' ? 'selected' : '' }}>Read</option>
                                    <option value="replied" {{ $contactMessage->status === 'replied' ? 'selected' : '' }}>Replied</option>
                                    <option value="closed" {{ $contactMessage->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="admin_notes" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Admin Notes</label>
                                <textarea id="admin_notes" 
                                          name="admin_notes" 
                                          rows="4"
                                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200 resize-none">{{ old('admin_notes', $contactMessage->admin_notes) }}</textarea>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:via-blue-800 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Update Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                
                <div class="space-y-6">
                    
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-gray-100/50 dark:from-gray-700/50 dark:to-gray-800/50">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white">Quick Actions</h4>
                        </div>
                        <div class="p-6 space-y-3">
                            @if($contactMessage->status === 'new')
                                <form action="{{ route('admin.contact-messages.mark-read', $contactMessage) }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full px-4 py-3 bg-gradient-to-r from-yellow-500 to-amber-500 text-white font-semibold rounded-xl hover:from-yellow-600 hover:to-amber-600 transition-all duration-300 shadow-md hover:shadow-lg">
                                        Mark as Read
                                    </button>
                                </form>
                            @endif
                            
                            @if($contactMessage->status === 'read')
                                <form action="{{ route('admin.contact-messages.mark-replied', $contactMessage) }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-semibold rounded-xl hover:from-green-600 hover:to-emerald-600 transition-all duration-300 shadow-md hover:shadow-lg">
                                        Mark as Replied
                                    </button>
                                </form>
                            @endif
                            
                            @if($contactMessage->status === 'replied')
                                <form action="{{ route('admin.contact-messages.mark-closed', $contactMessage) }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full px-4 py-3 bg-gray-600 dark:bg-gray-700 text-white font-semibold rounded-xl hover:bg-gray-700 dark:hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg">
                                        Close Message
                                    </button>
                                </form>
                            @endif
                            
                            <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" class="w-full">
                                @method('DELETE')
                                @csrf
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this message?')"
                                        class="w-full px-4 py-3 bg-gradient-to-r from-red-500 to-rose-500 text-white font-semibold rounded-xl hover:from-red-600 hover:to-rose-600 transition-all duration-300 shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete Message
                                </button>
                            </form>
                        </div>
                    </div>

                    
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-2xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-gray-100/50 dark:from-gray-700/50 dark:to-gray-800/50">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white">Message Info</h4>
                        </div>
                        <div class="p-6">
                            <dl class="space-y-4">
                                <div class="pb-3 border-b border-gray-200/50 dark:border-gray-700/50">
                                    <dt class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Received</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $contactMessage->created_at->format('M d, Y H:i') }}</dd>
                                </div>
                                @if($contactMessage->read_at)
                                    <div class="pb-3 border-b border-gray-200/50 dark:border-gray-700/50">
                                        <dt class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Read At</dt>
                                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $contactMessage->read_at->format('M d, Y H:i') }}</dd>
                                    </div>
                                @endif
                                @if($contactMessage->replied_at)
                                    <div>
                                        <dt class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Replied At</dt>
                                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $contactMessage->replied_at->format('M d, Y H:i') }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
