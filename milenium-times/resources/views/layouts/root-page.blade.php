@extends('layouts.base_layout')

@section('base_layout_content')
    

    <main>
        <div
            class="root-page-content"
            data-notify='{{ session('message') }}'
            >
                
            @include('layouts.inc.root-navbar')
            {{ $slot }}
            <x-footer pages="base"/>
            
        </div>
    </main>



    {{-- Session Message --}}
    <div id="session-message" class="session-message-card">
        <div class="content">
            <i class="success fa-solid fa-circle-check"></i>
            <i class="info fa-solid fa-circle-info"></i>
            <i class="danger fa-solid fa-circle-exclamation"></i>
            <span class="message">Message Placeholder</span>
        </div>
        <div class="close-button">
            <i class="success fa-solid fa-xmark"></i>
        </div>
    </div>



@endsection

@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/auth_app.css') }}">
@endpush

@push('scripts')
<script>

    // Session Message Events
    function show_message($msg, $class) {
        $('.session-message-card').addClass($class);
        $('.session-message-card .message').text($msg);
        $('.session-message-card').addClass('active');
        setTimeout(function() {
            $('.session-message-card').removeClass('active');
        }, 3000);
    }

    $(document).ready(function () {
        $('.session-message-card').removeClass('success');
        $('.session-message-card').removeClass('danger');
        $('.session-message-card').removeClass('info');

        if( $('.root-page-content').data('notify') ) {
            show_message($('.root-page-content').data('notify'), 'success');
        }
    });

    $('.session-message-card .close-button').click(function () {
        $('.session-message-card').removeClass('active');
    });

    $(window).on('display-message', function (event) {
        $('.session-message-card').removeClass('success');
        $('.session-message-card').removeClass('danger');
        $('.session-message-card').removeClass('info');

        if (event.detail.success) {
            show_message(event.detail.success, 'success');
        }
        else if (event.detail.error) {
            show_message(event.detail.error, 'danger');          
        }
        else {
            show_message(event.detail.info, 'info');          
        }
    });

</script>
@endpush