<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div>
            <a href="/" class="hover:underline">Dashboard</a>
            <a href="/top-author" class="hover:underline">Top Author</a>
            <a href="/form-rating" class="hover:underline">Add Ratings</a>
        </div>
        <div>
            @yield('content')
        </div>
    </div>
</body>
</html>

<style>
    .container {
        margin: 1rem 3rem;
    }

    table, th, td {
      border: 1px solid black;
    }

    .input-form {
        margin: 1rem 0;
    }
</style>