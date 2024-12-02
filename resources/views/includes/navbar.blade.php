<menu>
    <ul>
        <li><a href="/">Torna alla home</a></li>
        <li><a class="@if(Request::is('locations')) active @endif" href="{{route('locations.index')}}">Lista completa</a></li>
        <li><a class="@if(Request::is('locations/create')) active @endif" href="{{route('locations.create')}}">Crea nuova location</a></li>
    </ul>        
</menu>