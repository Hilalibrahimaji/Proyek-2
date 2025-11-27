<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function contact()
    {
        return view('contacs.index');
    }

    /**
     * Handle the contact form submission.
     */
    public function sendMessage(Request $request)
    {
        // Validasi form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:500',
            'message' => 'required|string|min:10|max:2000',
        ]);

        try {
            // Simpan ke database
            $contactMessage = ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => 'unread'
            ]);

            // Kirim email (optional - bisa di-comment jika belum setup email)
            // Mail::to('admin@vhgh.com')->send(new ContactFormMail($contactMessage));

            return redirect()->route('contact')->with('success', 'Thank you for your message! We will get back to you soon.');

        } catch (\Exception $e) {
            return redirect()->route('contact')->with('error', 'Sorry, there was an error sending your message. Please try again.');
        }
    }

    /**
     * Display contact messages in admin panel (optional)
     */
    public function adminMessages()
    {
        $messages = ContactMessage::latest()->get();
        $unreadCount = ContactMessage::unread()->count();

        return view('admin.contact.messages', compact('messages', 'unreadCount'));
    }

    /**
     * Mark message as read
     */
    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->markAsRead();

        return back()->with('success', 'Message marked as read.');
    }

    /**
     * Delete contact message
     */
    public function deleteMessage($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return back()->with('success', 'Message deleted successfully.');
    }
}