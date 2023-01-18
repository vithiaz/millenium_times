@extends('layouts.base_layout')

@section('base_layout_content')
    
    @include('layouts.inc.navbar')

    <main class="py-4">
        @yield('content')
    </main>

@endsection