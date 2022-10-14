<table>
    <thead>
        <th>ID</th>
        <th>Name</th>    
        <th>Edit</th>    
        <th>Delete</th>    
    </thead>    
    <tbody>
        @forelse ($tags as $tag)
            <tr>
                <td>{{ $tag->id }}</td>
                <td>{{ $tag->name }}</td>
                <td><button id="{{ $tag->id }}" class="editBtn">Edit</button></td>
                <td><button id="{{ $tag->id }}" class="deleteBtn">Delete</button></td>
            </tr>
        @empty
            No tags
        @endforelse
    </tbody>
</table>    


<form action="/admin/tag" method="POST">
    @csrf
    <input type="text" name="name" id="name">
    <button type="submit">Add tag</button>
</form>