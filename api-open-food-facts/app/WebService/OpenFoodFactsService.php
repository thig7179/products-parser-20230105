<?php 
namespace App\WebService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Product;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class OpenFoodFactsService extends Eloquent{

    use DatabaseMigrations;

    public function getList(){
        $json = file_get_contents('https://static.openfoodfacts.org/data/delta/index.txt');
        $lista = explode("\n", $json);
        
        $nomes = array($lista);  
        foreach ($nomes as $value) {
            $url = 'https://static.openfoodfacts.org/data/delta/'.$value[0];
            $file_name = basename($url);
            if (file_put_contents('./'.$file_name, file_get_contents('compress.zlib://'.$url)))
                {
                    date_default_timezone_set('America/Sao_Paulo');
                    $data = array("downloaded" => "successfully", "data" => date("Y-m-d H:i:s"), "status" => "1");
                    try{
                        $insertManyResult = Product::create(['./'.$file_name]);
                        $data = array("downloaded" => "successfully", "data" => date("Y-m-d H:i:s"), "status" => "1", "count" => $insertManyResult->count());
                        return $data;
                    }catch(Exception $e){
                        echo "Exceção: ".$e->getMessage()."\n";
                        return $data;
                    }
                    
                }
                else
                {
                    date_default_timezone_set('America/Sao_Paulo');
                    $data = array("downloaded" => "failed", "data" => date("Y-m-d H:i:s"), "status" => "2");
                    return $data;
                }
        }  
    }
}

?>