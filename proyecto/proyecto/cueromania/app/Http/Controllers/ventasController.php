<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VentasController extends Controller
{
    public function index(): View
    {
        $ventas = Venta::with('usuario')->get();
        return view('admi.ventas.index', compact('ventas'));
    }

    public function create(): View
    {
        return view('admi.ventas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'fecha_ventas'  => 'required|date',
            'estado_venta'  => 'required|string|max:30',
            'Total'         => 'required|numeric|min:0',
            'id_usuario'    => 'required|integer|exists:usuarios,id_usuario',
        ]);

        Venta::create($validated);

        return redirect()->route('admi.ventas.index')->with('success', 'Venta creada exitosamente');
    }

    public function show(Venta $venta): View
    {
        return view('admi.ventas.show', compact('venta'));
    }

    public function edit(Venta $venta): View
    {
        return view('admi.ventas.edit', compact('venta'));
    }

    public function update(Request $request, Venta $venta): RedirectResponse
    {
        $validated = $request->validate([
            'fecha_ventas'  => 'required|date',
            'estado_venta'  => 'required|string|max:30',
            'Total'         => 'required|numeric|min:0',
            'id_usuario'    => 'required|integer|exists:usuarios,id_usuario',
        ]);

        $venta->update($validated);

        return redirect()->route('admi.ventas.index')->with('success', 'Venta actualizada exitosamente');
    }

    public function destroy(Venta $venta): RedirectResponse
    {
        $venta->delete();
        return redirect()->route('admi.ventas.index')->with('success', 'Venta eliminada exitosamente');
    }
}
