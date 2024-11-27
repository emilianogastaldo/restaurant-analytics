<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('locations.store')}}" method="POST">
        @csrf
        <label for="name">
            Nome
            <input type="text" name="name" id="name">
        </label>
        <label for="lat">
            Latitudine
            <input type="text" name="latitude" id="lat">
        </label>
        <label for="lon">
            Longitudine
            <input type="text" name="longitude" id="lon">
        </label>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk me-2"></i>Salva</button>
    </form>
</body>
</html>