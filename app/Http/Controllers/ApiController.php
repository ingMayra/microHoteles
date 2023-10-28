<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ApiController extends Controller
{
    public function datosApi()
    {
        $urlApi = "https://www.inegi.org.mx/app/api/denue/v1/consulta/buscar/#condicion/#latitud,#longitud/#metros/#token";
        $token = 'feb3a08a-a504-4b2e-95ee-3fc274b2ad9d';
        $condicion = 'hoteles';
        $longitud = '-90.537361';
        $latitud = '19.844813';
        $metros = '5000';

        $busquedaApi = str_replace(['#condicion', '#latitud', '#longitud', '#metros', '#token'], [$condicion, $latitud, $longitud, $metros, $token], $urlApi);

        $ch = curl_init($busquedaApi);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($response === false) {
            return "Error al realizar la solicitud: " . curl_error($ch);
        }

        $data = json_decode($response, true);

        if ($data === null) {
            return "Error al procesar la respuesta JSON.";
        }
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        return view('Api', ['jsonData' => $jsonData]);
    }

    
}