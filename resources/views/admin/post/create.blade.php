<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/flowbite.js') }}"></script>

    </head>
<body>
    <form action="/admin/post" method="POST">
        @csrf

        <label for="title">Title</label> <br>
        <input type="text" name="title" id="title"> <br> <br>

        <label for="content">Content</label> <br>
        <textarea name="content" id="content" cols="30" rows="10"></textarea> <br> <br>


        <label for="categories">Categories</label> <br>
        <select name="categories[]" id="categories" multiple> 
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select><br><br>

        <label for="tags">Tags:</label> <br>
        <input type="text" name="tags" id="tags"> <br><br>



        <input type="submit" value="Save post">

    </form>


    <script>
        $( "#tags" ).autocomplete({
            source: availableTags
        });
        
        $('#tags').keypres(function() {

            $.ajax(
                'getAutocompleteTags',
                {
                    data: {'name': $('#tags').val() },
                    type: 'POST',
                    success: function(data) {
                        var availableTags = data.tags
                    }
                }
            )
                
        });
    </script>
</body>
</html>