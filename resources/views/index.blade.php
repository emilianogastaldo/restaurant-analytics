<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul>
        @foreach ($locations as $location )
            <li><a href="{{route('locations.show', $location->id)}}">{{$location->name}}</a></li>
        @endforeach

        <a href="{{route('locations.create')}}"> Crea una nuova location </a>
    </ul>
</body>
</html>