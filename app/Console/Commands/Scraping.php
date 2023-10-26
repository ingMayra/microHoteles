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

        //buscar y procesar datos
        // ...

        $condicion = $this->ask('Enter the condition:');
        $longitud = $this->ask('Enter the longitude:');
        $latitud = $this->ask('Enter the latitude:');
        $metros = $this->ask('Enter the meters:');

        $urlApiBusquedaTmp = str_replace(['#condicion', '#latitud', '#longitud', '#metros', '#token'], [$condicion, $latitud, $longitud, $metros, $token], $urlApiBusqueda);

        if (strpos($token, 'AQUÍ') !== false) {
            $this->error("You must enter your token in the code.");
        } else {
            $httpClient = HttpClient::create();
            $response = $httpClient->request('GET', $urlApiBusquedaTmp);

            // Process the API response and display the data
            $data = $response->toArray();
            $this->info("Data fetched successfully.");
            // You can process and display the data here
        }
    }
}