<h3><strong>{{ $post->title }}</strong></h3>
@forelse ($post->categories as $category)
    <small><i><a href="/category/{{ $category->id }}">{{ $category->name }}</a></i></small>
@empty
    
@endforelse

<p>{{ $post->content }}</p>

<hr>

@forelse ($post->tags as $tag)
    <p>{{ $tag->name }}</p>
    <form action="/admin/tag{{ $tag->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>

@empty
    This post has no tags yet...
@endforelse


<form action="/admin/tag/{{ $post->id }}/comment" method="POST">
    @csrf
    <label for="comment">Add tags</label> <br> 
    <input type="text" name="tag" id="tag">
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