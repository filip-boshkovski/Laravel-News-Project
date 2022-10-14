<table>
    <thead>
        <th>ID</th>
        <th>Name</th>    
    </thead>    
    <tbody>
        @forelse ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td><a href="/admin/post/{{ $post->id }}" >{{ $post->title }}</a></td>
                <td>{{ $post->getExcerpt() }}</td>
            </tr>
        @empty
            No posts
        @endforelse
    </tbody>
</table>    


<br>
<br>
<br>
<br>


<a href="/admin/post">Add new post</a>