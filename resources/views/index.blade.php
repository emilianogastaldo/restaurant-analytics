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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome locale</th>
                    <th scope="col">Città</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1;
                @endphp
                @foreach ($locations as $location)
                <tr>
                    <th scope="row">{{$count++}}</th>
                    <td><a href="{{route('locations.show', $location->id)}}">{{$location->name}}</a></td>
                    <td>{{$location->city}}</td>
                </tr>                    
                @endforeach
            </tbody>
        </table>
    </main>

</body>
</html>