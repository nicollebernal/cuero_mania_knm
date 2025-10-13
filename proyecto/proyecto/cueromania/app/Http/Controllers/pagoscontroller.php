<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Venta;
use Illuminate\Http\Request;

class PagosController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('venta')->get();
        return view('admi.pagos.index', compact('pagos'));
    }

    public function create()
    {
        $ventas = Venta::all();
        return view('admi.pagos.create', compact('ventas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'precio'       => 'required|numeric|min:1',
            'estado_pago'  => 'required|string|max:50',
            'metodo_pagos' => 'required|string|max:50',
            'opcion_pagos' => 'required|string|max:50',
            'id_venta'     => 'required|exists:ventas,id_ventas',
        ]);

        Pago::create($validated);
        return redirect()->route('admi.pagos.index')->with('success', 'Pago creado correctamente.');
    }

    public function edit($id_pagos)
    {
        $pago = Pago::findOrFail($id_pagos);
        $ventas = Venta::all();
        return view('admi.pagos.edit', compact('pago', 'ventas'));
    }

    public function update(Request $request, $id_pagos)
    {
        $validated = $request->validate([
            'precio'       => 'required|numeric|min:1',
            'estado_pago'  => 'required|string|max:50',
            'metodo_pagos' => 'required|string|max:50',
            'opcion_pagos' => 'required|string|max:50',
            'id_venta'     => 'required|exists:ventas,id_ventas',
        ]);

        $pago = Pago::findOrFail($id_pagos);
        $pago->update($validated);

        return redirect()->route('admi.pagos.index')->with('success', 'Pago actualizado correctamente.');
    }

    public function destroy($id_pagos)
    {
        $pago = Pago::findOrFail($id_pagos);
        $pago->delete();

        return redirect()->route('admi.pagos.index')->with('success', 'Pago eliminado correctamente.');
    }
}

