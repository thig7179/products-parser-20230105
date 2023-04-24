<?php 
namespace App\WebService;

class OpenFoodFactsService{

    public function getList(){
        $json = file_get_contents('https://static.openfoodfacts.org/data/delta/index.txt');
        $lista = explode("\n", $json);
        
        $nomes = array($lista);  
        foreach ($nomes as $value) {
            $url = 'https://static.openfoodfacts.org/data/delta/'.$value[0];
            $file_name = basename($url);
            if (file_put_contents('../'.$file_name, file_get_contents($url)))
                {
                    date_default_timezone_set('America/Sao_Paulo');
                    $data = array("downloaded" => "successfully", "data" => date("Y-m-d H:i:s"), "status" => "1");
                    return $data;
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