<form action="/comment/{{ $comment->id }}" method="POST">
    @csrf
    @method('PUT')

    <label for="comment">Edit comment</label> <br> 
    <textarea name="comment" id="comment" cols="30" rows="10">{{ $comment->comment }}</textarea> <br> <br>
    <input type="submit">
</form>