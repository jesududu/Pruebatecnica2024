<!-- resources/views/holidays/edit.blade.php -->

@extends('template')
@section('content')

    <div class="container mt-4">
        <h2>Editar Día Festivo</h2>

        <form action="{{ route('holidays.update', $holiday->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" value="{{ $holiday->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="color">Color:</label>
                <input type="color"  name="color" value="{{ $holiday->color }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="day">Día:</label>
                <input type="number" name="day" value="{{ $holiday->day }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="month">Mes:</label>
                <input type="number" name="month" value="{{ $holiday->month }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="year">Año:</label>
                <input type="number" name="year" value="{{ $holiday->year }}" class="form-control">
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="is_recurrent" class="form-check-input" {{ $holiday->is_recurrent ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_recurrent">Recurrente</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>

    @endsection
