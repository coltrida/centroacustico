@extends('layouts.stile2')

@section('headSection')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <style>

        #calendar a.fc-event {
            color: #ffffff; /* bootstrap default styles make it black. undo */
            border: 3px solid red;
        }

        #calendar .fc-bgevent {
            background: #b71212; /* bootstrap default styles make it black. undo */
        }

        #calendar .fc-content-col {
            background: #199f0c; /* bootstrap default styles make it black. undo */
        }

        #calendar  td, th {
            height: 40px;
        }

    </style>

@endsection

@section('content')
    <div class="modal fade" id="bookingModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Booking title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="" id="idClient" value="{{$client->id}}">
                    <input type="time" class="form-control" name="" id="orario">
                    <select class="form-select" aria-label="Default select example" id="tipoAppuntamento">
                        <option selected>Tipo Appuntamento</option>
                        <option>Prima Visita</option>
                        <option>Consegna Apa</option>
                        <option>Controllo</option>
                        <option>Assistenza</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="padding: 100px 0">
        <div id="calendar">
    </div>


@endsection

@section('footerSection')
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
{{--            <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>--}}
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/locale/it.js"></script>
            <script>
                $(document).ready(function (){

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        }
                    })

                    var booking = @json($events);
                    $('#calendar').fullCalendar({
                        header:{
                            left : 'prev, next, today',
                            center: 'title',
                            right: 'month, agendaWeek, agendaDay, listWeek'
                        },
                        events: booking,
                        selectable: true,
                        selectHelper: true,
                        nowIndicator: true,
                        displayEventEnd: true,
                        eventResizableFromStart: true,
                        locate:'it',
                        minTime:'08:00:00',
                        maxTime:'20:00:00',
                        height: 'auto',

                        businessHours: {
                            dow: [ 1, 2, 3, 4, 5 ], // Monday - Thursday

                            start: '09:00', // a start time (10am in this example)
                            end: '19:00', // an end time (6pm in this example)
                        },
                        defaultView: 'agendaWeek',

                        /*eventRender: function(eventObj, $el) {
                            $el.popover({
                                title: eventObj.title ? eventObj.title : '',
                                content: eventObj.tipo ? eventObj.tipo : '',
                                trigger: 'hover',
                                placement: 'top',
                                container: 'body'
                            });
                        },*/

                        select: function (start, end) {
                            $('#orario').val(moment(start).format('HH:mm:00'));
                            $('#bookingModel').modal('toggle');

                            $('#saveBtn').click(function (){
                                var idClient = $('#idClient').val();
                                var tipo = $('#tipoAppuntamento').val();
                                var user_id = {{\Illuminate\Support\Facades\Auth::id()}};
                                var start_date = moment(start).format('YYYY-MM-DD HH:mm:00');
                                var end_date = moment(end).format('YYYY-MM-DD HH:mm:00');

                                $.ajax({
                                    url:"{{route('appuntamenti.aggiungi')}}",
                                    type: "POST",
                                    datatype: 'json',
                                    data: {start_date, end_date, idClient, user_id, tipo},
                                    success: function (response)
                                    {
                                        $('#title').val('');
                                        $('#bookingModel').modal('hide');
                                        $('#calendar').fullCalendar('renderEvent', {
                                            id: response.id,
                                            title: response.title,
                                            start: response.start,
                                            end: response.end,
                                            color: response.color,
                                        });
                                        swal("Good job!", "Evento inserito", "success");
                                    },
                                    error: function (error)
                                    {
                                        if (error.responseJSON.errors){
                                            $('#titleError').html(error.responseJSON.errors.title);
                                        }
                                    },
                                });
                            });

                        },

                        editable: true,
                        eventDrop: function (event){
                            var id = event.id;
                            var start_date = moment(event.start).format('YYYY-MM-DD HH:mm:00');
                            var end_date = moment(event.end).format('YYYY-MM-DD HH:mm:00');

                            $.ajax({
                                url:"{{route('appuntamenti.modifica', '')}}" + '/' + id,
                                type: "PATCH",
                                datatype: 'json',
                                data: {start_date, end_date},
                                success: function (response)
                                {
                                    swal("Good job!", "Evento aggiornato", "success");
                                },
                                error: function (error)
                                {
                                    console.log(error)
                                },
                            });
                        },

                        eventClick: function (event){
                            var id = event.id;

                            if(confirm('Sei sicuro?')){
                                $.ajax({
                                    url:"{{route('appuntamenti.elimina', '')}}" + '/' + id,
                                    type: "DELETE",
                                    datatype: 'json',
                                    success: function (id)
                                    {
                                        $('#calendar').fullCalendar('removeEvents', id)
                                        swal("Good job!", "Evento eliminato", "success");
                                    },
                                    error: function (error)
                                    {
                                        console.log(error)
                                    },
                                });
                            }
                        },

                        eventResize: function (event){
                            var id = event.id;
                            var start_date = moment(event.start).format('YYYY-MM-DD HH:mm:00');
                            var end_date = moment(event.end).format('YYYY-MM-DD HH:mm:00');

                            $.ajax({
                                url:"{{route('appuntamenti.modifica', '')}}" + '/' + id,
                                type: "PATCH",
                                datatype: 'json',
                                data: {start_date, end_date},
                                success: function (response)
                                {
                                    swal("Good job!", "Evento aggiornato", "success");
                                },
                                error: function (error)
                                {
                                    console.log(error)
                                },
                            });
                        },

                        selectAllow: function (event){
                            return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
                        }
                    });

                    $('#bookingModel').on('hidden.bs.modal', function (){
                        $('#saveBtn').unbind();
                    });

                });
            </script>
@endsection
