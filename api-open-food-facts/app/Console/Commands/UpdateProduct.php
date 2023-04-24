<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Product;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UpdateProduct extends Command
{
    use DatabaseMigrations;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mongodb:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
            $json = file_get_contents('https://static.openfoodfacts.org/data/delta/index.txt');
            $lista = explode("\n", $json);
            
            $nomes = array($lista);  
            foreach ($nomes as $value) {
                $url = 'https://static.openfoodfacts.org/data/delta/'.$value[0];
                $file_name = basename($url);
                if (file_put_contents('./'.$file_name, file_get_contents('compress.zlib://'.$url)))
                    {
                        
                        try{
                            $insertManyResult = Product::create(['./'.$file_name]);   
                        }catch(Exception $e){
                            echo "Exceção: ".$e->getMessage()."\n";   
                        }
                        
                    }
            }
    }
}
