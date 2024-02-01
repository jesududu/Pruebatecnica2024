<!-- resources/views/holidays/show.blade.php -->

<!-- resources/views/holidays/show.blade.php -->

@extends('template')

    <div class="container mt-4">
        <h2>{{ $holiday->name }}</h2>

        <p><strong>Color:</strong> {{ $holiday->color }}</p>
        <p><strong>Día:</strong> {{ $holiday->day }}</p>
        <p><strong>Mes:</strong> {{ $holiday->month }}</p>
        <p><strong>Año:</strong> {{ $holiday->year }}</p>
        <p><strong>Recurrente:</strong> {{ $holiday->is_recurrent ? 'Sí' : 'No' }}</p>

        <a href="{{ route('holidays.index') }}" class="btn btn-secondary">Volver al listado</a>
    </div>

