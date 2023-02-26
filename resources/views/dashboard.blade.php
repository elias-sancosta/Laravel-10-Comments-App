<x-app-layout>
    <div class="py-12">
        <div class="w-3/4 mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('comments.store') }}" method="POST" class="px-6 mb-4">
                @csrf
                <textarea name="body" rows="2" class="w-full border-gray-200 rounded" required></textarea>
                <input type="submit" value="Comentar" class="text-white bg-gray-800 p-2 rounded">
            </form>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($comments as $comment)
                        <div class="bg-gray-100 p-4 mb-4 rounded shadow">
                            <h3>
                                <strong>{{ $comment->user->name }}</strong>
                                <small>{{ $comment->created_at->diffForHumans() }}</small>
                            </h3>
                            <p>
                                {{ $comment->body }}
                            </p>
                            <form action="{{ route('replies.store', $comment->id) }}" method="POST">
                                @csrf
                                <input type="text" name="body" class="w-full text-xs text-gray-500 border border-gray-200 p-2" placeholder="Responder...">
                            </form>
                        </div>
                        @foreach ($comment->replies as $reply) 
                            <p class="ml-4 mb-4">
                                -
                                {{ $reply->body }}
                                <strong>{{ $reply->user->name }}</strong>
                                <small>{{ $reply->created_at->diffForHumans() }}</small>
                            </p>
                        @endforeach
                    @endforeach

                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
