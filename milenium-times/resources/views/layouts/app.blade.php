@extends('layouts.base_layout')

@section('base_layout_content')
    
    {{-- Content Body --}}
    @include('layouts.inc.navbar')
    
    <main class="py-4">
        {{ $slot }}
    </main>



    {{-- END --}}

@endsection