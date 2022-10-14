<h3><strong>{{ $post->title }}</strong></h3>
<small><strong><i>Categories: </i></strong></small>
@forelse ($post->categories as $category)
    <small><i><a href="/category/{{ $category->id }}">{{ $category->name }}</a></i></small>
@empty
    
@endforelse

<p>{{ $post->content }}</p>
<hr>

<small><strong><i>Tags: </i></strong></small>
@forelse ($post->tags as $tag)
    <small><i><a href="/tag/{{ $tag->id }}">{{ $tag->name }}</a></i></small>
@empty
    
@endforelse

<hr>

<h4><strong>Comments</strong></h4>

@forelse ($post->comments as $comment)
    <div style=" border-bottom: 1px solid red;">
        <p>{{ $comment->comment }}</p>
        <a href="/comment/{{ $comment->id }}">Edit</a>
        <form action="/comment/{{ $comment->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>

@empty
    This post has no comments yet...
@endforelse


<form action="/post/{{ $post->id }}/comment" method="POST">
    @csrf
    <label for="comment">Leave comment</label> <br> 
    <textarea name="comment" id="comment" cols="30" rows="10"></textarea> <br> <br>
    <input type="submit">
</form>



<hr>
<h4>Related posts</h4>
<div>
    @forelse ($posts as $post)
        <div>
            <h3><strong>{{ $post->title }}</strong></h3>
            <p>{{ $post->getExcerpt() }}</p>
        </div>
    @empty
        No related posts.
    @endforelse
</div>