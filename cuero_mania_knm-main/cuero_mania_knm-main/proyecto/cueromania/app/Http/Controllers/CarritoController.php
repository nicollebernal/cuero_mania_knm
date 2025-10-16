<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    // Agregar producto al carrito (sesión)
    public function agregar(Request $request)
    {
        $id = $request->id_producto;
        $cantidad = $request->cantidad ?? 1;

        // Obtener carrito actual de sesión
        $carrito = Session::get('carrito', []);

        // Si ya existe el producto, sumar cantidad
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] += $cantidad;
        } else {
            $carrito[$id] = [
                'id_producto' => $id,
                'cantidad' => $cantidad
            ];
        }

        Session::put('carrito', $carrito);

        return response()->json(['message' => 'Producto agregado al carrito']);
    }

    // Mostrar el carrito en una vista
    public function ver()
    {
        $carrito = Session::get('carrito', []);
        return view('cliente.carrito', compact('carrito'));
    }
    // Eliminar producto del carrito
public function eliminar($id)
{
    $carrito = Session::get('carrito', []);

    if (isset($carrito[$id])) {
        unset($carrito[$id]); // elimina ese producto
        Session::put('carrito', $carrito);
    }

    return redirect()->route('carrito.ver')->with('success', 'Producto eliminado del carrito');
}

}
