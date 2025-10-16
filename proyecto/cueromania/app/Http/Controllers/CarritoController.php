<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos;
use App\Models\venta;
use App\Models\detallesventa;
use App\Models\usuarioDAO;
use Carbon\Carbon;

class CarritoController extends Controller
{
    public function productos()
    {
        $productos = productos::all();
        return view('cliente.cliente', compact('productos'));
    }

    public function index()
    {
        $carrito = session()->get('carrito', []);
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        return view('cliente.carrito', compact('carrito', 'total'));
    }

    public function agregar(Request $request, $id)
    {
        $producto = productos::findOrFail($id);
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                "id_producto" => $producto->id_producto,
                "nombre" => $producto->nombre,
                "precio" => $producto->precio,
                "cantidad" => 1
            ];
        }

        session()->put('carrito', $carrito);
        return back()->with('success', 'Producto agregado al carrito');
    }

    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }
        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito');
    }

    public function pagar()
    {
        $carrito = session()->get('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }

        $usuario = session('usuario');
        if (!$usuario) {
            return redirect()->route('carrito.index')->with('error', 'Debes iniciar sesión para pagar.');
        }

        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        $venta = new venta();
        $venta->fecha_ventas = Carbon::now();
        $venta->estado_venta = 'pagado';
        $venta->Total = $total;
        $venta->id_usuario = $usuario->id_usuario;
        $venta->save();

        foreach ($carrito as $id => $item) {
            detallesventa::create([
                'cantidad' => $item['cantidad'],
                'cantidad_pagada' => $item['cantidad'] * $item['precio'],
                'precio_unitario' => $item['precio'],
                'id_venta' => $venta->id_ventas,
                'id_producto' => $id
            ]);
        }

        $detalles = detallesventa::with('producto')->where('id_venta', $venta->id_ventas)->get();
        $usuarioCompleto = usuarioDAO::find($venta->id_usuario);

        session()->forget('carrito');

        return view('cliente.factura', [
            'usuario' => $usuarioCompleto,
            'venta' => $venta,
            'detalles' => $detalles
        ]);
    }
}
