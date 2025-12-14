@php
    $indentClass = $level > 0 ? 'ml-' . ($level * 8) . ' border-l-2 border-gray-200 pl-4' : '';
@endphp

<div class="bg-white rounded-lg shadow-md p-6 {{ $indentClass }}">
    <div class="flex items-start space-x-4">
        <!-- Avatar -->
        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-400 rounded-full flex items-center justify-center text-white font-bold text-sm">
            {{ strtoupper(substr($comment->name, 0, 1)) }}
        </div>

        <!-- Comment Content -->
        <div class="flex-1">
            <div class="flex items-center space-x-2 mb-2">
                <h4 class="font-semibold text-gray-800">{{ $comment->name }}</h4>
                <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
            </div>

            <p class="text-gray-700 mb-4">{{ $comment->message }}</p>

            <!-- Reply Button -->
            @if($level < 2) <!-- Limit nesting to 2 levels -->
                <button onclick="toggleReplyForm({{ $comment->id }})"
                        class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center space-x-1">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Balas</span>
                </button>
            @endif

            <!-- Reply Form (hidden by default) -->
            <div id="reply-form-{{ $comment->id }}" class="hidden mt-4">
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <input type="text" name="name"
                           class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                           placeholder="Nama Anda" required>
                    <input type="email" name="email"
                           class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                           placeholder="Email Anda" required>
                    <textarea name="message" rows="3"
                              class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                              placeholder="Tulis balasan Anda..." required></textarea>
                    <div class="flex space-x-2">
                        <button type="submit"
                                class="bg-gradient-to-r from-blue-500 to-cyan-400 text-white px-4 py-2 rounded-lg text-sm font-medium hover:shadow-md transition">
                            Kirim Balasan
                        </button>
                        <button type="button" onclick="toggleReplyForm({{ $comment->id }})"
                                class="text-gray-500 px-4 py-2 text-sm hover:text-gray-700">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Replies -->
@if($comment->approvedReplies->count() > 0)
    <div class="mt-4 space-y-4">
        @foreach($comment->approvedReplies as $reply)
            @include('partials.comment', ['comment' => $reply, 'level' => $level + 1])
        @endforeach
    </div>
@endif

<script>
function toggleReplyForm(commentId) {
    const form = document.getElementById('reply-form-' + commentId);
    form.classList.toggle('hidden');
}
</script>
