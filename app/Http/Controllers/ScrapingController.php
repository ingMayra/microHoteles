<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Goutte\Client;

use Illuminate\Http\Request;


class ScrapingController extends Controller
{
    public function scraping(Client $client)
    {
        // $token = 'feb3a08a-a504-4b2e-95ee-3fc274b2ad9d';
        // $client = new Client(HttpClient::create(['headers' => ['Authorization' => 'Bearer ' . $token]]));
        // $crawler = $client->request('GET','https://www.inegi.org.mx/app/api/denue/v1/consulta/buscar/#condicion/#latitud,#longitud/#metros/#token');
        // dd($crawler);

        // $titulos_anuncios = $crawler->filter('div.tabDenue')->each(function ($node) {
        //     return $node->text();
        // });

        // // Imprime los títulos obtenidos
        // foreach ($titulos_anuncios as $titulo) {
        //     echo $titulo . "\n";
        // },
            return view("scraping");
    }
}
