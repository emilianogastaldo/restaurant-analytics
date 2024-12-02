<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Styles -->
    @vite('resources/js/app.js')
</head>
<body>
    @include('includes.navbar')
    <main>
        <form id="create-form" action="{{route('locations.store')}}" method="POST">
            @csrf
            <div class="row row-cols-2 g-3">
                <label for="name" class="col">
                    Nome
                    <input type="text" name="name" id="name">
                    <ul class="list-group" id="flats-list"></ul>
                </label>
                <label for="city" class="col">
                    Città
                    <input type="text" name="city" id="city">
                </label>
                <label for="lat" class="col">
                    Latitudine
                    <input type="text" name="latitude" id="lat">
                </label>
                <label for="lon" class="col">
                    Longitudine
                    <input type="text" name="longitude" id="lon">
                </label>
            </div>
            <button type="submit" class="btn btn-success mt-3">Salva</button>
        </form>
    </main>
</body>
</html>