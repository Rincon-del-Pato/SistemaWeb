<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DocumentConsultController extends Controller
{
    protected $token;
    protected $baseUrl = 'https://apiperu.dev/api/';

    public function __construct()
    {
        $this->token = config('services.apiperu.token');
    }

    public function consult($type, $number)
    {
        try {
            if (!$this->validarDocumento($type, $number)) {
                Log::warning("Documento inválido: $type - $number");
                return response()->json([
                    'success' => false,
                    'message' => 'Número de documento inválido'
                ]);
            }

            Log::info("Consultando documento: $type - $number");
            Log::debug("Token API: " . substr($this->token, 0, 10) . "...");

            $endpoint = $this->baseUrl . strtolower($type) . '/' . $number;
            Log::info("Endpoint: $endpoint");

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->token,
                'Accept' => 'application/json',
            ])->get($endpoint);

            Log::info("Respuesta API: " . json_encode($response->json()));

            if ($response->successful()) {
                $data = $response->json();
                if ($data['success']) {
                    return $this->formatResponse($type, $data['data']);
                }
            }

            Log::warning("No se encontró información para: $type - $number");
            return response()->json([
                'success' => false,
                'message' => 'No se encontró información'
            ]);
        } catch (\Exception $e) {
            Log::error('Error en consulta de documento: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Error al consultar documento: ' . $e->getMessage()
            ]);
        }
    }

    protected function validarDocumento($type, $number)
    {
        if ($type === 'DNI' && strlen($number) !== 8) {
            return false;
        }
        if ($type === 'RUC' && strlen($number) !== 11) {
            return false;
        }
        return true;
    }

    protected function formatResponse($type, $data)
    {
        if ($type === 'DNI') {
            return response()->json([
                'success' => true,
                'name' => "{$data['nombres']} {$data['apellido_paterno']} {$data['apellido_materno']}",
                'document_type' => 'DNI',
                'document_number' => $data['numero']
            ]);
        } else {
            $address = $data['direccion_completa'] ?? null;
            return response()->json([
                'success' => true,
                'name' => $data['nombre_o_razon_social'],
                'document_type' => 'RUC',
                'document_number' => $data['ruc'],
                'address' => $address,
                'state' => $data['estado'],
                'condition' => $data['condicion']
            ]);
        }
    }
}
