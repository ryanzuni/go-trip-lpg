@extends('layouts.app')

@section('title', 'Kelola Komentar')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Komentar Pengunjung</h2>
            <p class="text-gray-500 text-sm">Panel moderasi komentar & balasan</p>
        </div>

        <div class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
            Total: {{ $comments->total() }}
        </div>
    </div>

    <!-- FLASH -->
    @if(session('success'))
    <div class="mb-4 flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">

        <!-- HEROICON CHECK -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>

        {{ session('success') }}
    </div>
    @endif

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <!-- HEAD -->
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4 text-left">Pengguna</th>
                        <th class="px-6 py-4 text-left">Komentar</th>
                        <th class="px-6 py-4 text-center">Balasan</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Tanggal</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                @forelse($comments as $comment)
                    <tr class="hover:bg-gray-50 transition">

                        <!-- USER -->
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800">
                                {{ $comment->name }}
                            </div>
                            <div class="text-gray-400 text-xs">
                                {{ $comment->email }}
                            </div>
                        </td>

                        <!-- COMMENT -->
                        <td class="px-6 py-4 text-gray-600 max-w-md">
                            {{ Str::limit($comment->message, 120) }}
                        </td>

                        <!-- REPLIES -->
                        <td class="px-6 py-4 text-center">
                            @if($comment->replies->count())

                                <button onclick="openModal('reply{{ $comment->id }}')"
                                        class="flex items-center gap-1 justify-center mx-auto px-3 py-1 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200">

                                    <!-- HEROICON CHAT -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.8L3 20l1.8-3A7.963 7.963 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>

                                    {{ $comment->replies->count() }}
                                </button>

                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-4 text-center">
                            @if($comment->status === 'approved')
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-600">Approved</span>
                            @elseif($comment->status === 'rejected')
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-600">Rejected</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-600">Pending</span>
                            @endif
                        </td>

                        <!-- DATE -->
                        <td class="px-6 py-4 text-center text-xs text-gray-400">
                            {{ $comment->created_at->format('d M Y') }}<br>
                            {{ $comment->created_at->format('H:i') }}
                        </td>

                        <!-- ACTION -->
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">

                                @if($comment->status === 'pending')

                                <!-- APPROVE -->
                                <form method="POST" action="{{ route('admin.comments.approve', $comment->id) }}">
                                    @csrf
                                    <button class="p-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-200">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 13l4 4L19 7"/>
                                        </svg>

                                    </button>
                                </form>

                                <!-- REJECT -->
                                <form method="POST" action="{{ route('admin.comments.reject', $comment->id) }}">
                                    @csrf
                                    <button class="p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"/>
                                        </svg>

                                    </button>
                                </form>

                                @endif

                                <!-- DELETE -->
                                <form method="POST" action="{{ route('admin.comments.destroy', $comment->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus komentar ini?')"
                                            class="p-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 7l-1 12H6L5 7m5-3h4m-6 3h8"/>
                                        </svg>

                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                    <!-- MODAL -->
                    <div id="reply{{ $comment->id }}" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

                        <div class="bg-white w-full max-w-xl rounded-2xl shadow-lg p-6">

                            <div class="flex justify-between items-center mb-4">
                                <h3 class="font-semibold text-gray-800">
                                    Balasan: {{ $comment->name }}
                                </h3>

                                <button onclick="closeModal('reply{{ $comment->id }}')">
                                    ✕
                                </button>
                            </div>

                            <div class="space-y-3 max-h-80 overflow-y-auto">

                                @forelse($comment->replies as $reply)
                                <div class="border rounded-lg p-3">
                                    <div class="text-sm font-semibold">{{ $reply->name }}</div>
                                    <div class="text-xs text-gray-400 mb-1">{{ $reply->email }}</div>
                                    <p class="text-sm text-gray-600">{{ $reply->message }}</p>
                                </div>
                                @empty
                                <p class="text-gray-400 text-center">Tidak ada balasan</p>
                                @endforelse

                            </div>

                        </div>

                    </div>

                @empty
                    <tr>
                        <td colspan="6" class="text-center py-12 text-gray-400">
                            Tidak ada komentar
                        </td>
                    </tr>
                @endforelse

                </tbody>

            </table>
        </div>

    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $comments->links() }}
    </div>

</div>

<!-- MODAL SCRIPT -->
<script>
function openModal(id){
    document.getElementById(id).classList.remove('hidden');
}
function closeModal(id){
    document.getElementById(id).classList.add('hidden');
}
</script>

@endsection