<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CalculadoraController extends Controller
{
    /**
     * Muestra el formulario principal.
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Procesa los datos y genera la vista de la factura.
     */
    public function generarFactura(Request $request)
    {
        // 1. Decodificar servicios con fallback a array vacío
        $serviciosElegidos = json_decode($request->input('servicios'), true);
        $serviciosElegidos = is_array($serviciosElegidos) ? $serviciosElegidos : [];

        // 2. Capturar datos de Branding y Cliente
        $empresa  = $request->input('empresa', 'Espumas');
        $color    = $request->input('color', '#003399');
        $logo     = $request->input('logo', 'LOGOPNG.png');
        $cliente  = $request->input('cliente', 'Cliente General');

        // 3. Ubicación y Ruta
        $zona     = $request->input('zona', 'N/A');
        $ruta     = $request->input('ruta', 'N/A');
        $subruta  = $request->input('subruta', 'N/A');

        // 4. Procesar Totales y Normalizar nombres de servicios
        $subtotalServicios = 0;
        foreach ($serviciosElegidos as &$s) {
            /** * MEJORA: Validación de llave 'nombre'.
             * Si no existe 'nombre', intenta usar 'descripcion'.
             * Si ninguno existe, asigna 'Sin nombre' para evitar el error Exception.
             */
            if (!isset($s['nombre'])) {
                $s['nombre'] = $s['descripcion'] ?? 'Servicio/Producto';
            }

            // Aseguramos que precio y cantidad sean numéricos para evitar errores de cálculo
            $precio   = isset($s['precio']) ? (float)$s['precio'] : 0;
            $cantidad = isset($s['cantidad']) ? (float)$s['cantidad'] : 1;

            // Re-asignamos al array para que la vista reciba valores limpios
            $s['precio'] = $precio;
            $s['cantidad'] = $cantidad;

            $subtotalServicios += ($precio * $cantidad);
        }
        // Limpiamos la referencia para evitar errores de memoria
        unset($s);

        // 5. Capturar Gastos Extra y Descuentos
        $transporte = (float)$request->input('transporte', 0);
        $descuento  = (float)$request->input('descuento_total', 0);

        // 6. Cálculos Finales
        $subtotalGeneral = ($subtotalServicios + $transporte) - $descuento;

        // IVA (15%) - Se calcula sobre el subtotal general
        $iva = $request->has('aplicar_iva') ? ($subtotalGeneral * 0.15) : 0;
        $totalFinal = $subtotalGeneral + $iva;

        // 7. Configurar Moneda
        $moneda = ($empresa === 'Pethelios') ? '$' : 'C$';

        // 8. Fecha y hora Nicaragua
        $ahora = Carbon::now('America/Managua');

        // 9. Retornar la vista con todos los datos procesados
        return view('factura', [
            'empresa'    => $empresa,
            'color'      => $color,
            'logo'       => $logo,
            'cliente'    => $cliente,
            'zona'       => $zona,
            'ruta'       => $ruta,
            'subruta'    => $subruta,
            'fecha'      => $ahora->format('d/m/Y'),
            'hora'       => $ahora->format('h:i A'),
            'servicios'  => $serviciosElegidos,
            'transporte' => $transporte,
            'descuento'  => $descuento,
            'subtotal'   => $subtotalGeneral,
            'iva'        => $iva,
            'total'      => $totalFinal,
            'moneda'     => $moneda
        ]);
    }
}
