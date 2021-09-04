@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



<nav class="navbar navbar-light bg-white p-0">
    <ul class="nav flex-column w-100">
        @foreach($adminMenus as $index => $menu)
            @if(!empty($menu['nav_title']))
                <li class="nav-item bg-primary text-white px-2 py-3 font-weight-bold">
                    {{ $menu['nav_title'] }}
                </li>
            @endif

            @if(!empty($menu['sub']))
                <li class="nav-item border-bottom">
                    <p class="mb-0 px-2">{{ $menu['title'] }}</p>
                    <ul class="nav flex-column">
                        @foreach($menu['sub'] as $subIndex => $subMenu)
                            <li class="nav-item">
                                <a class="nav-link @if($nowMenu === $index && $nowPosition === $subIndex) active @endif "
                                   href="{{ $subMenu['url'] }}">
                                    {{ $subMenu['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="nav-item border-bottom">
                    <a class="nav-link @if($nowMenu === $index) active @endif " href="{{ $menu['url'] }}">
                        {{ $menu['title'] }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</nav>