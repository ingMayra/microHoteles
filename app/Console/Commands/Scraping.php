<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        require_once('simple_html_dom.php');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/search?q=aplicaciones+php+gratis');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
        //echo $result;
        
        $domResult = new simple_html_dom();
        $domResult->load($result);
        
        foreach($domResult->find('a[href^=/url?]') as $link)
        echo '<h1>' . $link->plaintext . ' </h1><br>';

    }
}