@extends('template')

@section('content')

<div id="calendar"></div>

<!-- Modal -->
<div id="event-modal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Evento</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('holidays.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="event-name">Nombre:</label>
                        <input type="text" class="form-control" id="event-name" name="name" required>
                    </div>
                   
                    <div class="form-group">
                        <label for="day">Día:</label>
                        <input type="number" name="day" class="form-control" required>
                    </div>
        
                    <div class="form-group">
                        <label for="month">Mes:</label>
                        <input type="number" name="month" class="form-control" required>
                    </div>
        
                    <div class="form-group">
                        <label for="year">Año:</label>
                        <input type="number" name="year" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="event-color">Color:</label>
                        <input type="color" class="form-control" id="event-color" name="color">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="delete-event" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const currentYear = new Date().getFullYear();

        const calendar = new Calendar('#calendar', {
            dataSource: [
                @foreach($holidays as $holiday)
                {
                    startDate: new Date("{{ $holiday->year }}", "{{ $holiday->month - 1 }}", "{{ $holiday->day }}"),
                    endDate: new Date("{{ $holiday->year }}", "{{ $holiday->month - 1 }}", "{{ $holiday->day }}"),
                    name: "{{ $holiday->name }}",
                    color: "{{ $holiday->color }}"
                },
                @endforeach
            ],
            language: 'es',
            mouseOnDay: function(e) {
                if (e.events.length > 0) {
                    var content = '';
                    for (var i in e.events) {
                        content += '<div class="event-tooltip-content">'
                            + '<div class="event-name" style="color:' + e.events[i].color + '">' + e.events[i].name + '</div>'
                            + '</div>';
                    }
                    $(e.element).popover({
                        trigger: 'manual',
                        container: 'body',
                        html: true,
                        content: content
                    });
                    $(e.element).popover('show');
                }
            },
            mouseOutDay: function(e) {
                if (e.events.length > 0) {
                    $(e.element).popover('hide');
                }
            },
            dayClick: function(event) {
                editEvent(event);
            },
            enableContextMenu: true,
            enableRangeSelection: true,
            contextMenuItems:[
                {
                    text: 'Actualizar',
                    click: function(event) {
                        editEvent(event);
                    }
                },
                {
                    text: 'Eliminar',
                    click: deleteEvent
                }
            ],
            selectRange: function(e) {
                editEvent({ startDate: e.startDate, endDate: e.endDate });
            },
            mouseOnDay: function(e) {
                if(e.events.length > 0) {
                    var content = '';
                    
                    for(var i in e.events) {
                        content += '<div class="event-tooltip-content">'
                                        + '<div class="event-name" style="color:' + e.events[i].color + '">' + e.events[i].name + '</div>'
                                        + '<div class="event-location">' + e.events[i].location + '</div>'
                                    + '</div>';
                    }
                
                    $(e.element).popover({ 
                        trigger: 'manual',
                        container: 'body',
                        html:true,
                        content: content
                    });
                    
                    $(e.element).popover('show');
                }
            },
            mouseOutDay: function(e) {
                if(e.events.length > 0) {
                    $(e.element).popover('hide');
                }
            },
            dayContextMenu: function(e) {
                $(e.element).popover('hide');
            }
        });
        
        function editEvent(event) {
            const date = new Date(event.startDate);
            $('#event-modal input[name="event-index"]').val(event ? event.id : '');
            $('#event-modal input[name="name"]').val(event ? event.name : '');
            $('#event-modal input[name="event-location"]').val(event ? event.location : '');
            $('#event-modal input[name="day"]').val(event ? date.getDate() : '');
            $('#event-modal input[name="month"]').val(event ? date.getMonth() + 1 : '');
            $('#event-modal input[name="year"]').val(event ? date.getFullYear() : '');
            $('#event-modal').modal();
        }
        
        function deleteEvent(event) {
            var dataSource = calendar.getDataSource();
            
            calendar.setDataSource(dataSource.filter(item => item.id !== event.id));
        }
        
        function saveEvent() {
            var event = {
                id: $('#event-modal input[name="event-index"]').val(),
                name: $('#event-modal input[name="event-name"]').val(),
                location: $('#event-modal input[name="event-location"]').val(),
                startDate: $('#event-modal input[name="event-start-date"]').datepicker('getDate'),
                endDate: $('#event-modal input[name="event-end-date"]').datepicker('getDate')
            }
            
            var dataSource = calendar.getDataSource();
        
            if (event.id) {
                for (var i in dataSource) {
                    if (dataSource[i].id == event.id) {
                        dataSource[i].name = event.name;
                        dataSource[i].location = event.location;
                        dataSource[i].startDate = event.startDate;
                        dataSource[i].endDate = event.endDate;
                    }
                }
            }
            else
            {
                var newId = 0;
                for(var i in dataSource) {
                    if(dataSource[i].id > newId) {
                        newId = dataSource[i].id;
                    }
                }
                
                newId++;
                event.id = newId;
            
                dataSource.push(event);
            }
            
            calendar.setDataSource(dataSource);
            $('#event-modal').modal('hide');
        }
        
        $('#save-event').click(function() {
            saveEvent();
        });
        document.querySelector('#calendar').addEventListener('yearchanged', function(e) {
    const currentYear = e.detail.currentYear;
    const recurrentHolidays = [];

    // Obtener los días festivos recurrentes para el nuevo año seleccionado
    @foreach($holidays as $holiday)
        @if($holiday->is_recurrent)
            recurrentHolidays.push({
                startDate: new Date(currentYear, {{ $holiday->month - 1 }}, {{ $holiday->day }}),
                endDate: new Date(currentYear, {{ $holiday->month - 1 }}, {{ $holiday->day }}),
                name: "{{ $holiday->name }}",
                color: "{{ $holiday->color }}"
            });
        @endif
    @endforeach

    // Obtener el dataSource actual del calendario
    let dataSource = calendar.getDataSource();

    // Agregar los días festivos recurrentes al dataSource
    recurrentHolidays.forEach(function(holiday) {
        dataSource.push(holiday);
    });

    // Actualizar el dataSource del calendario con los días festivos recurrentes
    calendar.setDataSource(dataSource);
});

    });
</script>

@endsection
