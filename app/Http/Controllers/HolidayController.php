<?php

// app/Http/Controllers/HolidayController.php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HolidayController extends Controller
{


    public function obtenerEventos()
{
    $holidays = Holiday::all(); // Suponiendo que tengas un modelo llamado Holiday que representa tus eventos

    return view('index')->with('holidays', $holidays);
}
    public function index()
    {
        $holidays = Holiday::all();
        return view('holidays.index', compact('holidays'));
    }

    public function create()
    {
        return view('holidays.create');
    }
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:50',
            'day' => 'required|numeric|min:1|max:31',
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'nullable|numeric',
        ]);
    
        // Crear una nueva instancia de Holiday y asignar los valores
        $holiday = new Holiday([
            'name' => $validatedData['name'],
            'color' => $validatedData['color'],
            'day' => $validatedData['day'],
            'month' => $validatedData['month'],
            'year' => $validatedData['year'] ?? null,
            'is_recurrent' => $request->filled('is_recurrent'), // Marcar como recurrente si el checkbox está marcado
            'user_id' => auth()->id(), // Obtener el ID del usuario autenticado
        ]);
        if ($holiday->is_recurrent) {
            // Obtener el año actual
            $currentYear = date('Y');
            $holiday->day = $request->input('day');
            $holiday->month = $request->input('month');
            $holiday->year = $currentYear; // Establecer el año actual
        } else {
            // Obtener el año específico del formulario si no es recurrente
            $holiday->day = $request->input('day');
            $holiday->month = $request->input('month');
            $holiday->year = $request->input('year');
        }
        // Guardar el objeto Holiday en la base de datos
        $holiday->save();
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('holidays.index')->with('success', 'Día festivo creado exitosamente.');
    }

    public function show(Holiday $holiday)
    {
        return view('holidays.show', compact('holiday'));
    }

    public function edit(Holiday $holiday)
    {
        return view('holidays.edit', compact('holiday'));
    }

    public function update(Request $request, Holiday $holiday)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:50',
            'day' => 'required|numeric|min:1|max:31',
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'nullable|numeric',
        ]);
    
        // Actualizar los datos del día festivo
        $holiday->name = $validatedData['name'];
        $holiday->color = $validatedData['color'];
        $holiday->day = $validatedData['day'];
        $holiday->month = $validatedData['month'];
    
        // Verificar si el campo is_recurrent está presente y es true
        if (isset($validatedData['is_recurrent']) && $validatedData['is_recurrent']) {
            // Si es recurrente, establecer el año actual si el campo de año está vacío
            $holiday->year = $validatedData['year'] ?: date('Y');
        } else {
            // Si no es recurrente, establecer el año proporcionado en el formulario
            $holiday->year = $validatedData['year'];
        }
    
        // Guardar los cambios en la base de datos
        $holiday->save();
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('holidays.index')->with('success', 'Día festivo actualizado exitosamente.');
    }
    


    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        return redirect()->route('holidays.index')->with('success', 'Día festivo eliminado exitosamente.');
    }
}
