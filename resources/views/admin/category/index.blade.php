<table>
    <thead>
        <th>ID</th>
        <th>Name</th>    
        <th>Edit</th>    
        <th>Delete</th>    
    </thead>    
    <tbody>
        @forelse ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td><button id="{{ $category->id }}" class="editBtn">Edit</button></td>
                <td><button id="{{ $category->id }}" class="deleteBtn">Delete</button></td>
            </tr>
        @empty
            No categories
        @endforelse
    </tbody>
</table>    


<form action="/admin/category" method="POST">
    @csrf
    <input type="text" name="name" id="name">
    <button type="submit">Add category</button>
</form>