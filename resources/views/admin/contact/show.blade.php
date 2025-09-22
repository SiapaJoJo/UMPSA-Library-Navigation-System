<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Contact Message Details') }}
            </h2>
            <a href="{{ route('admin.contact-messages.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Messages
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Message Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Message Header -->
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-4">
                                <div class="h-12 w-12 rounded-full bg-gray-300 flex items-center justify-center">
                                    <span class="text-lg font-medium text-gray-700">
                                        {{ strtoupper(substr($contactMessage->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $contactMessage->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $contactMessage->email }}</p>
                                    @if($contactMessage->phone)
                                        <p class="text-sm text-gray-500">{{ $contactMessage->phone }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 text-sm rounded-full
                                    @if($contactMessage->status === 'new') bg-red-100 text-red-800
                                    @elseif($contactMessage->status === 'read') bg-yellow-100 text-yellow-800
                                    @elseif($contactMessage->status === 'replied') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($contactMessage->status) }}
                                </span>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $contactMessage->created_at->format('M d, Y H:i') }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="border-t pt-4">
                            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ $contactMessage->subject }}</h4>
                            <div class="prose max-w-none">
                                <p class="text-gray-700 whitespace-pre-wrap">{{ $contactMessage->message }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Notes -->
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Admin Notes</h4>
                        <form action="{{ route('admin.contact-messages.update', $contactMessage) }}" method="POST" class="space-y-4">
                            @method('PUT')
                            
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select id="status" 
                                        name="status" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="new" {{ $contactMessage->status === 'new' ? 'selected' : '' }}>New</option>
                                    <option value="read" {{ $contactMessage->status === 'read' ? 'selected' : '' }}>Read</option>
                                    <option value="replied" {{ $contactMessage->status === 'replied' ? 'selected' : '' }}>Replied</option>
                                    <option value="closed" {{ $contactMessage->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Admin Notes</label>
                                <textarea id="admin_notes" 
                                          name="admin_notes" 
                                          rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('admin_notes', $contactMessage->admin_notes) }}</textarea>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" 
                                        class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Update Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Actions Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h4>
                        <div class="space-y-3">
                            @if($contactMessage->status === 'new')
                                <form action="{{ route('admin.contact-messages.mark-read', $contactMessage) }}" method="POST" class="w-full">
                                    <button type="submit" 
                                            class="w-full px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                        Mark as Read
                                    </button>
                                </form>
                            @endif
                            
                            @if($contactMessage->status === 'read')
                                <form action="{{ route('admin.contact-messages.mark-replied', $contactMessage) }}" method="POST" class="w-full">
                                    <button type="submit" 
                                            class="w-full px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                        Mark as Replied
                                    </button>
                                </form>
                            @endif
                            
                            @if($contactMessage->status === 'replied')
                                <form action="{{ route('admin.contact-messages.mark-closed', $contactMessage) }}" method="POST" class="w-full">
                                    <button type="submit" 
                                            class="w-full px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                        Close Message
                                    </button>
                                </form>
                            @endif
                            
                            <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" class="w-full">
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this message?')"
                                        class="w-full px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    Delete Message
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Message Info -->
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Message Info</h4>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Received</dt>
                                <dd class="text-sm text-gray-900">{{ $contactMessage->created_at->format('M d, Y H:i') }}</dd>
                            </div>
                            @if($contactMessage->read_at)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Read At</dt>
                                    <dd class="text-sm text-gray-900">{{ $contactMessage->read_at->format('M d, Y H:i') }}</dd>
                                </div>
                            @endif
                            @if($contactMessage->replied_at)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Replied At</dt>
                                    <dd class="text-sm text-gray-900">{{ $contactMessage->replied_at->format('M d, Y H:i') }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
