<div class="card {{ $bg_color }} p-2 my-2">
	<div>{{ $comment->created_at->format('d-m-Y h:m a') }}</div>
	<hr>
	<div>{{ $comment->message }}</div>
</div>