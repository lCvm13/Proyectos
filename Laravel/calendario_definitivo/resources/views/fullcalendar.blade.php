<!DOCTYPE html>
<html>

<head>
    <title>Calendario para laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <form id="formLog" method="POST" action="{{ route('logout') }}">
        @csrf
        <x-dropdown-link class="btn btn-primary" :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
            {{ __('Cerrar sesión') }}
        </x-dropdown-link>
    </form>
    <div class="container">
        <h1>Calendario de: {{Auth::user()->name}}</h1>
        <div id='calendar'></div>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {

        /*------------------------------------------
        --------------------------------------------
        Get Site URL
        --------------------------------------------
        --------------------------------------------*/
        var SITEURL = "{{ url('/') }}";

        /*------------------------------------------
        --------------------------------------------
        CSRF Token Setup
        --------------------------------------------
        --------------------------------------------*/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /*------------------------------------------
        --------------------------------------------
        FullCalender JS Code
        --------------------------------------------
        --------------------------------------------*/
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            events: SITEURL + "/fullcalendar",
            displayEventTime: false,
            editable: true,
            eventRender: function(event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },

            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                var title = prompt('Introduce el título del evento:');
                if (title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                    $.ajax({
                        url: SITEURL + "/fullcalendarAjax",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            type: 'add'
                        },
                        type: "POST",
                        success: function(data) {
                            displayMessage("Evento creado con éxito");

                            calendar.fullCalendar('renderEvent', {
                                id: data.id,
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            }, true);

                            calendar.fullCalendar('unselect');
                        }

                    });
                }
            },
            eventDrop: function(event, delta) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                $.ajax({
                    url: SITEURL + '/fullcalendarAjax',
                    data: {
                        title: event.title,
                        start: start,
                        end: end,
                        id: event.id,
                        type: 'update'
                    },
                    type: "POST",
                    success: function(response) {
                        displayMessage("Evento actualizado con éxito");
                    }
                });
            },
            eventClick: function(event, element) {
                swal.fire({
                    title: `Que quieres hacer con el evento: ${event.title}`,
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Modificar',
                    denyButtonText: 'Borrar',
                    cancelButtonText: 'Cancelar',
                    allowOutsideClick: false,
                    customClass: {
                        actions: 'my-actions',
                        cancelButton: 'order-3 right-gap',
                        confirmButton: 'order-1',
                        denyButton: 'order-2',
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        var newTitle = prompt('Cambie el nombre del evento si quiere:',
                            event.title);
                        if (newTitle !== null) {
                            event.title = newTitle;
                            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                            $.ajax({
                                url: SITEURL + '/fullcalendarAjax',
                                data: {
                                    title: newTitle,
                                    start: start,
                                    end: end,
                                    id: event.id,
                                    type: 'change'
                                },
                                type: "POST",

                                success: function(response) {
                                    displayMessage(
                                        "El título del evento ha sido actualizado con éxito"
                                        );
                                    calendar.fullCalendar('updateEvent', event);
                                }
                            });
                        }
                    } else if (result.isDenied) {
                        var deleteMsg = confirm(
                            "¿Estas seguro que quieres borrar el evento?");
                        if (deleteMsg) {
                            $.ajax({
                                type: "POST",
                                url: SITEURL + '/fullcalendarAjax',
                                data: {
                                    id: event.id,
                                    type: 'delete'
                                },
                                success: function(response) {
                                    calendar.fullCalendar('removeEvents', event
                                        .id);
                                    displayMessage("Evento borrado con éxito");
                                }
                            });
                        }
                    }
                })

            }
        });

    });

    /*------------------------------------------
    --------------------------------------------
    Toastr Success Code
    --------------------------------------------
    --------------------------------------------*/
    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
    </script>

</body>

</html>