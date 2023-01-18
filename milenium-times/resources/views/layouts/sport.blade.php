@extends('layouts.base_layout')

@section('base_layout_content')
    
    {{-- Content Body --}}
    <main>
        @include('layouts.inc.sport-navbar')
        {{ $slot }}
        <x-footer pages="sport"/>
    </main>

    {{-- END --}}

@endsection