<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;

class FruitController extends Controller
{
    public function getFruits()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://www.fruityvice.com/api/fruit/all",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT =>30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: https://www.fruityvice.com",
                "x-rapidapi-key: "
            ],

        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if($err){
            echo "cURL Error #:". $err;
        }else
        {
            $objeto = json_decode($response);
            // $allData=$objeto->data;

            // print_r($objeto);
            // var_dump($objeto);
            foreach($objeto as $fruit)
            {
                
                $verificar = Fruit::where('name',$fruit->name)->first();

                if(!$verificar){
                    $nuevoFruit = new Fruit();
                    $nuevoFruit->genus = $fruit->genus;
                    $nuevoFruit->name=$fruit->name;
                    $nuevoFruit->family= $fruit->family;
                    $nuevoFruit->order= $fruit->order;
                    $nutrientes=$fruit->nutritions;
                    $nuevoFruit->carbohydrates=$nutrientes->carbohydrates;
                    $nuevoFruit->protein=$nutrientes->protein;
                    $nuevoFruit->fat=$nutrientes->fat;
                    $nuevoFruit->calories=$nutrientes->calories;
                    $nuevoFruit->sugar=$nutrientes->sugar;
                    $nuevoFruit->save();
                    echo "<h3> Frutas registradas </h3>";

                }
            }
        }      
    }

    public function getAllFruits(){
        $fruits=Fruit::all();
        

    }
}
