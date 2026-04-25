@extends('layouts.app')

@section('title', 'Kelola Komentar')

@section('content')
<div class="container-fluid">

    {{-- PAGE HEADER --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold mb-1">Komentar Pengunjung</h2>
            <p class="text-muted mb-0">Panel moderasi komentar & balasan</p>
        </div>

        <span class="badge bg-primary fs-6 px-3 py-2">
            Total: {{ $comments->total() }}
        </span>
    </div>

    {{-- FLASH --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE CARD --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    {{-- TABLE HEADER --}}
                    <thead style="background:#f1f5f9">
                        <tr class="text-secondary small text-uppercase">
                            <th class="ps-4">Pengguna</th>
                            <th>Komentar</th>
                            <th class="text-center">Balasan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($comments as $comment)
                        <tr>
                            {{-- USER --}}
                            <td class="ps-4">
                                <div class="fw-semibold">{{ $comment->name }}</div>
                                <small class="text-muted">{{ $comment->email }}</small>
                            </td>

                            {{-- COMMENT --}}
                            <td style="max-width:420px">
                                {{ Str::limit($comment->message, 120) }}
                            </td>

                            {{-- REPLIES --}}
                            <td class="text-center">
                                @if($comment->replies->count())
                                    <button class="btn btn-outline-primary btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#replyModal{{ $comment->id }}">
                                        <i class="bi bi-chat-dots"></i>
                                        {{ $comment->replies->count() }}
                                    </button>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- STATUS --}}
                            <td class="text-center">
                                @if($comment->status === 'approved')
                                    <span class="badge bg-success-subtle text-success">Approved</span>
                                @elseif($comment->status === 'rejected')
                                    <span class="badge bg-danger-subtle text-danger">Rejected</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning">Pending</span>
                                @endif
                            </td>

                            {{-- DATE --}}
                            <td class="text-center small text-muted">
                                {{ $comment->created_at->format('d M Y') }}<br>
                                {{ $comment->created_at->format('H:i') }}
                            </td>

                            {{-- ACTION --}}
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-1 flex-wrap">
                                    @if($comment->status === 'pending')
                                        <form method="POST" action="{{ route('admin.comments.approve', $comment->id) }}">
                                            @csrf
                                            <button class="btn btn-success btn-sm">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.comments.reject', $comment->id) }}">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('admin.comments.destroy', $comment->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Hapus komentar ini?')"
                                                class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- ================= MODAL REPLIES ================= --}}
                        <div class="modal fade" id="replyModal{{ $comment->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">
                                            Balasan untuk: {{ $comment->name }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        @forelse($comment->replies as $reply)
                                            <div class="border rounded p-3 mb-3">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <strong>{{ $reply->name }}</strong><br>
                                                        <small class="text-muted">{{ $reply->email }}</small>
                                                    </div>
                                                    <small class="text-muted">
                                                        {{ $reply->created_at->format('d M Y H:i') }}
                                                    </small>
                                                </div>

                                                <p class="mt-2 mb-0">
                                                    {{ $reply->message }}
                                                </p>
                                            </div>
                                        @empty
                                            <p class="text-muted text-center">
                                                Tidak ada balasan
                                            </p>
                                        @endforelse
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                                data-bs-dismiss="modal">
                                            Tutup
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- ================= END MODAL ================= --}}

                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                Tidak ada komentar
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $comments->links() }}
    </div>

</div>
@endsection
