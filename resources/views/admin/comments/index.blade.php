@extends('layouts.app')

@section('title', 'Kelola Komentar')

@section('content')
<section class="py-8 px-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Kelola Komentar</h1>
                    <p class="text-gray-600">Kelola komentar dan balasan dari pengunjung website</p>
                </div>
                <div class="bg-gradient-to-r from-blue-500 to-cyan-400 text-white px-4 py-2 rounded-full text-sm font-semibold">
                    Total: {{ $comments->total() }}
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- Comments Table -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-50 to-cyan-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Pengguna
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Komentar
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Balasan
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($comments as $comment)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <!-- User Info -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-400 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                        {{ strtoupper(substr($comment->name, 0, 1)) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $comment->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $comment->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Comment Content -->
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-md">
                                    {{ Str::limit($comment->message, 100) }}
                                </div>
                            </td>

                            <!-- Replies Count -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($comment->replies->count() > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i data-lucide="message-circle" class="w-3 h-3 mr-1"></i>
                                            {{ $comment->replies->count() }}
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $comment->status === 'approved' ? 'bg-green-100 text-green-800' :
                                       ($comment->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ ucfirst($comment->status) }}
                                </span>
                            </td>

                            <!-- Date -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $comment->created_at->format('d M Y') }}<br>
                                <span class="text-xs">{{ $comment->created_at->format('H:i') }}</span>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    @if($comment->status === 'pending')
                                        <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition-colors duration-200">
                                                <i data-lucide="check" class="w-3 h-3 mr-1"></i>
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.comments.reject', $comment->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 transition-colors duration-200">
                                                <i data-lucide="x" class="w-3 h-3 mr-1"></i>
                                                Tolak
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">
                                            <i data-lucide="trash-2" class="w-3 h-3 mr-1"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Show replies as sub-rows -->
                        @if($comment->replies->count() > 0)
                            @foreach($comment->replies as $reply)
                            <tr class="bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <td class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center ml-8">
                                        <div class="w-8 h-8 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                            {{ strtoupper(substr($reply->name, 0, 1)) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-xs font-medium text-gray-700">{{ $reply->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $reply->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-3">
                                    <div class="text-xs text-gray-700 max-w-md">
                                        {{ Str::limit($reply->message, 80) }}
                                    </div>
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap">
                                    <span class="text-xs text-gray-400">-</span>
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-0.5 text-xs font-semibold rounded-full
                                        {{ $reply->status === 'approved' ? 'bg-green-100 text-green-800' :
                                           ($reply->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($reply->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-xs text-gray-500">
                                    {{ $reply->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-xs font-medium">
                                    <div class="flex space-x-1">
                                        @if($reply->status === 'pending')
                                            <form action="{{ route('admin.comments.approve', $reply->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-green-600 hover:bg-green-700 transition-colors duration-200">
                                                    <i data-lucide="check" class="w-3 h-3"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.comments.reject', $reply->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 transition-colors duration-200">
                                                    <i data-lucide="x" class="w-3 h-3"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.comments.destroy', $reply->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus balasan ini?')">
                                                <i data-lucide="trash-2" class="w-3 h-3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i data-lucide="message-circle" class="w-8 h-8 text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-600 mb-2">Belum ada komentar</h3>
                                    <p class="text-sm text-gray-500">Komentar dari pengunjung akan muncul di sini setelah mereka mengirim komentar.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($comments->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex justify-center">
                        {{ $comments->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Load Lucide icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endsection
