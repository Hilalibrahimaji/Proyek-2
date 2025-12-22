@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
<div class="container mx-auto px-6 py-6">

    <h1 class="text-2xl font-bold mb-6">
        Contact Messages
        <span class="text-sm text-red-500">
            ({{ $unreadCount }} unread)
        </span>
    </h1>

    <div class="bg-white rounded-lg shadow border overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Subject</th>
                    <th class="px-4 py-3 text-center">Status</th>
                    <th class="px-4 py-3 text-center">Date</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $msg->name }}</td>
                    <td class="px-4 py-3">{{ $msg->email }}</td>
                    <td class="px-4 py-3">{{ $msg->subject }}</td>
                    <td class="px-4 py-3 text-center">
                        <span class="px-2 py-1 rounded text-xs
                            {{ $msg->status == 'unread' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                            {{ ucfirst($msg->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        {{ $msg->created_at->format('d M Y') }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        <a href="{{ route('admin.contact.read', $msg->id) }}"
                           class="text-blue-600 hover:underline">
                           Mark Read
                        </a>
                        |
                        <a href="{{ route('admin.contact.delete', $msg->id) }}"
                           class="text-red-600 hover:underline"
                           onclick="return confirm('Delete message?')">
                           Delete
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">
                        No messages found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
