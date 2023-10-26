<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\HttpClient\HttpClient;

class Scraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'aqui se ejecutara el scraping y extraera toda la informacion';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // require_once('simple_html_dom.php');

        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/search?q=aplicaciones+php+gratis');
        // curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // $result = curl_exec($curl);
        // curl_close($curl);
        // //echo $result;
        
        // $domResult = new simple_html_dom();
        // $domResult->load($result);
        
        // foreach($domResult->find('a[href^=/url?]') as $link)
        // echo '<h1>' . $link->plaintext . ' </h1><br>';

$urlApiBusqueda = "https://www.inegi.org.mx/app/api/denue/v1/consulta/buscar/#condicion/#latitud,#longitud/#metros/#token";
$token = 'feb3a08a-a504-4b2e-95ee-3fc274b2ad9d';

$condicion = readline('Ingresa la condición: ');
$longitud = readline('Ingresa la longitud: ');
$latitud = readline('Ingresa la latitud: ');
$metros = readline('Ingresa el alcance: ');

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
