@extends('layouts.base_layout')

@section('base_layout_content')
    
    @include('layouts.inc.root-navbar')

    <main>
        {{ $slot }}
    </main>

@endsection

@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/auth_app.css') }}">
@endpush