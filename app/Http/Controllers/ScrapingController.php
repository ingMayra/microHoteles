<?php

namespace App\Http\Controllers;
use Goutte\Client;

use Illuminate\Http\Request;


class ScrapingController extends Controller
{
    public function scraping(Client $client)
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.google.com/maps/search/Hoteles+Campeche+mexico/@19.8381611,-90.5027599,12z');

        $titulos_anuncios = $crawler->filter('div.qBF1Pd.fontHeadlineSmall')->each(function ($node) {
            return $node->text();
        });

        // Imprime los títulos obtenidos
        foreach ($titulos_anuncios as $titulo) {
            echo $titulo . "\n";
        }
    }
}
