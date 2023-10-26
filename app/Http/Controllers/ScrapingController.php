<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Goutte\Client;

use Illuminate\Http\Request;


class ScrapingController extends Controller
{
    public function scraping()
    {
$urlApiBusqueda = "https://www.inegi.org.mx/app/api/denue/v1/consulta/buscar/#condicion/#latitud,#longitud/#metros/#token";
$token = 'feb3a08a-a504-4b2e-95ee-3fc274b2ad9d';

$condicion ='hoteles';
$longitud = '-90.532097';
$latitud = '19.837364';
$metros = '5000';

$urlApiBusquedaTmp = str_replace(['#condicion', '#latitud', '#longitud', '#metros', '#token'], [$condicion, $latitud, $longitud, $metros, $token], $urlApiBusqueda);

if (strpos($token, 'AQUÍ') !== false) {
    echo "Error: Debes ingresar tu token en el código." . PHP_EOL;
} else {
    $ch = curl_init($urlApiBusquedaTmp);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        echo "Error al realizar la solicitud: " . curl_error($ch) . PHP_EOL;
    } else {
        $data = json_decode($response, true);

        if ($data === null) {
            echo "Error al procesar la respuesta JSON." . PHP_EOL;
        } else {
            echo "Hoteles procesados." . PHP_EOL;
             $jsonData = json_encode($data, JSON_PRETTY_PRINT);
            $outputFile = 'hoteles.json';

            if (file_put_contents($outputFile, $jsonData)) {
                echo "Los datos se han exportado a $outputFile" . PHP_EOL;
            } else {
                echo "Error al exportar los datos a $outputFile" . PHP_EOL;
            }
        }
    }

    curl_close($ch);
    }
    }
}
