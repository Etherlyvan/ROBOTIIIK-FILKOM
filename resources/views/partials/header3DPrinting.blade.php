<nav class="navbar">
    <a href="/"><img class="logo" src="{{URL::to('img/logo.png')}}" /></a>
    <ul class="div-nav">
        @auth
            @if (Auth::user()->is_admin)
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="{{$title === 'Register' ? 'menus' : 'menu'}}"
                            style="background: none; border: none;">Logout</button>
                    </form>
                </li>
            @else
                <li>
                    <form action="/{{ $title === 'Order' || $title === "Print Orders" || $title === "Design Orders"? 'dashboard' : 'order' }}" method="get">
                        <button type="submit"
                            class="{{$title === 'Register' ? 'menus' : 'menu'}}">{{ $title === 'Order' || $title === "Print Orders" || $title === "Design Orders"? 'Dashboard' : 'Order' }}</button>
                    </form>
                </li>

                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="{{$title === 'Register' ? 'menus' : 'menu'}}"
                            style="background: none; border: none;">Logout</button>
                    </form>
                </li>
            @endif
        @else
            <li>
                <a class="{{$title === 'Login' ? 'menus' : 'menu'}}" href="/login" style="margin-left: 18.5em;">Login</a>
            </li>
            <li>
                <a class="{{$title === 'Register' ? 'menus' : 'menu'}}" href="/register">Register</a>
            </li>
        @endauth

    </ul>
</nav>