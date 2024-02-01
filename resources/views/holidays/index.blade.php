<!-- resources/views/holidays/index.blade.php -->

@extends('template')
<!-- resources/views/holidays/index.blade.php -->
@section('content')


    <div class="container mt-4">
        <h2>Días Festivos</h2>
        <a href="{{ route('holidays.create') }}" class="btn btn-primary mb-3">Agregar Día Festivo</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Día</th>
                    <th>Mes</th>
                    <th>Año</th>
                    <th>Recurrente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($holidays as $holiday)
                    <tr>
                        <td>{{ $holiday->name }}</td>
                        <td>{{ $holiday->color }}</td>
                        <td>{{ $holiday->day }}</td>
                        <td>{{ $holiday->month }}</td>
                        <td>{{ $holiday->year }}</td>
                        <td>{{ $holiday->is_recurrent ? 'Sí' : 'No' }}</td>
                        <td>
                            <a href="{{ route('holidays.edit', $holiday->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('holidays.destroy', $holiday->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
