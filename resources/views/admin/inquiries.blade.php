@extends('layouts.admin')

@section('title', 'Manage Inquiries - Admin')
@section('page_title', 'Buyer & Client Inquiries')

@section('content')

    <div class="space-y-6">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
            <div class="px-6 py-4 border-b border-slate-800 flex items-center justify-between">
                <h3 class="font-bold text-white text-base">Received Inquiries ({{ $inquiries->total() }})</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="bg-slate-950 text-slate-400 text-xs uppercase tracking-wider border-b border-slate-800">
                        <tr>
                            <th class="px-6 py-4">Client Name</th>
                            <th class="px-6 py-4">Phone & Email</th>
                            <th class="px-6 py-4">Target Property</th>
                            <th class="px-6 py-4">Message</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($inquiries as $inquiry)
                            <tr class="hover:bg-slate-800/50 transition">
                                <td class="px-6 py-4 font-bold text-white">
                                    {{ $inquiry->first_name }} {{ $inquiry->last_name }}
                                </td>
                                <td class="px-6 py-4 text-xs">
                                    <span class="block text-slate-200 font-semibold"><i class="fa-solid fa-phone text-amber-400 mr-1"></i> {{ $inquiry->phone }}</span>
                                    <span class="text-slate-400"><i class="fa-solid fa-envelope text-slate-500 mr-1"></i> {{ $inquiry->email }}</span>
                                </td>
                                <td class="px-6 py-4 text-xs">
                                    @if($inquiry->property)
                                        <a href="{{ route('properties.show', $inquiry->property->property_slug ?: $inquiry->property->id) }}" target="_blank" class="text-amber-400 font-semibold hover:underline line-clamp-1">
                                            {{ $inquiry->property->property_title }}
                                        </a>
                                    @else
                                        <span class="text-slate-500 italic">General Inquiry</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-300 max-w-xs">
                                    <p class="line-clamp-2">"{{ $inquiry->message }}"</p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}" method="POST" onsubmit="return confirm('Delete this inquiry?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg bg-slate-800 text-slate-400 hover:text-red-400 hover:bg-slate-700 transition" title="Delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                    No inquiries submitted yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-800">
                {{ $inquiries->links() }}
            </div>
        </div>
    </div>

@endsection
