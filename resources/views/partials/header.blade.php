<nav class="navbar">
    <img class="logo" src="{{URL::to('img/logo.png')}}" />
    <li class="div-nav">
        <a class="{{$title === 'Home' ? 'menus' : 'menu'}}" href="/">Home</a>
        <a class="{{$title === 'Division' ? 'menus' : 'menu'}}" href="/division">Division</a>
        <a class="{{$title === 'Relation' ? 'menus' : 'menu'}}" href="/relation">Relation</a>
        <a class="{{$title === 'Publication' ? 'menus' : 'menu'}}" href="/publication">Publication</a>
        <a class="{{$title === 'Service' ? 'menus' : 'menu'}}" href="/service">Service</a>
    </li>
</nav>