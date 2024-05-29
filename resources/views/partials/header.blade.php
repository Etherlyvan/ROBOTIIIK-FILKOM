<nav class="navbar">
    <a href="/"><img class="logo" src="{{URL::to('img/logo.png')}}" /></a>
    <ul class="div-nav">
        <li>
            <a class="{{$title === 'Home' ? 'menus' : 'menu'}}" href="/">Home</a>
        </li>
        <li class="menu {{$title === 'Division' ? 'menus' : 'menu'}}">
            Division<i class="bi bi-caret-right"></i>
            <div class="dropdown-content">
                <div class="dropdown-item">
                    <a href="/bpi">BPI</a>
                </div>
                <div class="dropdown-item">
                    <a href="/humanoid">Humanoid</a>
                </div>
                <div class="dropdown-item">
                    <a href="/quadqopter">Quadcopter</a>
                </div>
                <div class="dropdown-item">
                    <a href="/amarine">Amarine</a>
                </div>
                <div class="dropdown-item">
                    <a href="/public_relation">Public Relation</a>
                </div>
                <div class="dropdown-item">
                    <a href="/comp.management">Comp. Management</a>
                </div>
                <div class="dropdown-item">
                    <a href="/creative-media">Creative Media</a>
                </div>
                <div class="dropdown-item">
                    <a href="/fund-raising">Fund Raising</a>
                </div>
            </div>
        </li>
        <li>
            <a class="{{$title === 'Relation' ? 'menus' : 'menu'}}" href="/relation">Relation</a>
        </li>
        <li>
            <a class="{{$title === 'Publication' ? 'menus' : 'menu'}}" href="/publication">Publication</a>
        </li>
        <li>
            <a class="{{$title === 'Service' ? 'menus' : 'menu'}}" href="/service">Service</a>
        </li>
    </ul>
</nav>
