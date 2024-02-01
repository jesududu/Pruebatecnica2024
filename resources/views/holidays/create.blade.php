<!-- resources/views/holidays/create.blade.php -->

@extends('template')
<!-- resources/views/holidays/create.blade.php -->
@section('content')


    <div class="container mt-4">
        <h2>Agregar Día Festivo</h2>

        <form action="{{ route('holidays.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="color">Color:</label>
                <input type="color" value="#ff0000" name="color" class="form-control" required>
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
                <div class="form-check">
                    <input type="checkbox" id="is_recurrent"  name="is_recurrent" class="form-check-input"  value="1">
                    <label class="form-check-label" for="is_recurrent">Recurrente</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    @endsection
