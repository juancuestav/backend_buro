<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompraReporteController extends Controller
{
    private function n8nInterno(): PendingRequest
    {
        return Http::withHeaders(['x-internal-api-key' => config('services.n8n.key')])
            ->timeout(15);
    }

    private function relanzar(Response $respuesta)
    {
        return response($respuesta->body(), $respuesta->status())
            ->header('Content-Type', 'application/json');
    }

    public function listado()
    {
        $respuesta = $this->n8nInterno()->get(config('services.n8n.url') . '/compras/listado', request()->query());
        return $this->relanzar($respuesta);
    }

    public function resumen()
    {
        $respuesta = $this->n8nInterno()->get(config('services.n8n.url') . '/compras/resumen', request()->query());
        return $this->relanzar($respuesta);
    }

    public function detalle(string $compra)
    {
        $respuesta = $this->n8nInterno()->get(config('services.n8n.url') . '/compras/detalle', ['id' => $compra]);
        return $this->relanzar($respuesta);
    }

    public function reenviarWhatsapp(Request $request)
    {
        $respuesta = Http::timeout(15)->post(config('services.n8n.url') . '/reportes/enviar-wa', [
            'id' => $request->input('reporte_pdf_id'),
            'telefono_cliente' => $request->input('telefono_cliente'),
        ]);
        return $this->relanzar($respuesta);
    }

    public function pdf(Request $request)
    {
        $respuesta = Http::timeout(30)->get(config('services.n8n.url') . '/ver-reporte', [
            'id' => $request->input('reporte_pdf_id'),
        ]);

        if (!$respuesta->successful()) return $this->relanzar($respuesta);

        return response($respuesta->body(), 200)->header('Content-Type', 'application/pdf');
    }
}
