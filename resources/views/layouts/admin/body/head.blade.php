<!-- Title -->
<title>@yield("title")</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon" />
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<!-- Font -->
{{-- <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900"> --}}

    {{-- <link rel="stylesheet" href="{{ URL::asset('assets/css/font.css') }}"  /> --}}
@yield('css')
<!--- Style css -->
{{-- <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet"> --}}
<!--- Style css -->
@if (App::getLocale() == 'en')
    <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
@else
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
@endif


{{-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script> --}}
<script src="{{ URL::asset('assets/js/pusher.min.js') }}"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('local', {
        wsHost: '127.0.0.1',
        wsPort: 6001,
        forceTLS: false,
        disableStats: true
    });


    var channel = pusher.subscribe('tickets');
    channel.bind('App\\Events\\TicketCreated', function(data) {
        toastr.success('New ticket created: ' + data.ticket_title);
        Livewire.dispatch('createdTicket');
    });

    var channel = pusher.subscribe('ticketsClose');
    channel.bind('App\\Events\\TicketClose', function(data) {
        toastr.success('Ticket Closed By : '+ data.support_name);
        Livewire.dispatch('createdTicket');
    });



</script>
