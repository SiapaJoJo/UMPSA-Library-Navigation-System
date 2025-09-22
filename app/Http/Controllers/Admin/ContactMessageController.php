<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::recent()->get();
        return view('admin.contact.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        // Mark as read if it's new
        if ($contactMessage->status === 'new') {
            $contactMessage->markAsRead();
        }
        
        return view('admin.contact.show', compact('contactMessage'));
    }

    public function update(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'status' => 'required|in:new,read,replied,closed',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $contactMessage->update($request->only(['status', 'admin_notes']));

        // Update timestamps based on status
        if ($request->status === 'read' && !$contactMessage->read_at) {
            $contactMessage->markAsRead();
        } elseif ($request->status === 'replied' && !$contactMessage->replied_at) {
            $contactMessage->markAsReplied();
        }

        return redirect()->route('admin.contact-messages.index')->with('success', 'Message updated successfully!');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact-messages.index')->with('success', 'Message deleted successfully!');
    }

    public function markAsRead(ContactMessage $contactMessage)
    {
        $contactMessage->markAsRead();
        return back()->with('success', 'Message marked as read!');
    }

    public function markAsReplied(ContactMessage $contactMessage)
    {
        $contactMessage->markAsReplied();
        return back()->with('success', 'Message marked as replied!');
    }

    public function markAsClosed(ContactMessage $contactMessage)
    {
        $contactMessage->markAsClosed();
        return back()->with('success', 'Message marked as closed!');
    }
}