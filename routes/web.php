<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculadoraController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistema de Cotización
|--------------------------------------------------------------------------
*/

// 1. Mostrar el formulario principal (Página de inicio)
Route::get('/', [CalculadoraController::class, 'index'])
    ->name('cotizador.index');

// 2. Procesar los datos y generar la factura/cotización
// Se usa POST para proteger los datos y permitir el envío de JSON pesado (servicios)
Route::post('/generar-factura', [CalculadoraController::class, 'generarFactura'])
    ->name('factura.generar');

// Opcional: Si quieres que al recargar la factura no de error,
// podrías redirigir el GET de esa URL al inicio.
Route::get('/generar-factura', function () {
    return redirect()->route('cotizador.index');
});
