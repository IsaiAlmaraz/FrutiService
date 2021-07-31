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
        foreach($fruits as $fruit)
        {
            if(isset($fruit->name))
            echo "<h3>$fruit->name </h3>";

            if(isset($fruit->genus))
            echo "<h6>Género: $fruit->genus<h6>";

            if(isset($fruit->family))
            echo "<h6>Familia: $fruit->family<h6>";

            if(isset($fruit->order))
            echo "<h6>Orden: $fruit->order<h6>";

            if(isset($fruit->carbohydrates))
            echo "<h6>Carbohidratos: $fruit->carbohydrates g<h6>";

            if(isset($fruit->protein))
            echo "<h6>Proteína:$fruit->protein g<h6>";

            if(isset($fruit->fat))
            echo "<h6>Grasa: $fruit->fat g<h6>";

            if(isset($fruit->calories))
            echo "<h6>Calorías: $fruit->calories g<h6>";

            if(isset($fruit->sugar))
            echo "<h6>Azúcar: $fruit->sugar g<h6>";


            echo "<hr>";

        }

    }
    public function getFruitById($id){
        $fruitDetalle=Fruit::find($id);;
        return $fruitDetalle;
    }
    public function getFruitByName($name){
        $fruitDetalle=Fruit::where('name',$name)->first();
        return $fruitDetalle;
    }

    // public function getFruitByName($name){
    //     $fruitDetalle=Fruit::where('name',$name)->first();
       
    //         if(isset($fruitDetalle->name))
    //         echo "<h3>$fruitDetalle->name </h3>";

    //         if(isset($fruitDetalle->carbohydrates))
    //         echo "<h5>Carbohidratos: $fruitDetalle->carbohydrates g<h5>";

    //         if(isset($fruitDetalle->protein))
    //         echo "<h5>Proteína:$fruitDetalle->protein g<h5>";

    //         if(isset($fruitDetalle->fat))
    //         echo "<h5>Grasa: $fruitDetalle->fat g<h5>";

    //         if(isset($fruitDetalle->calories))
    //         echo "<h5>Calorías: $fruitDetalle->calories g<h5>";

    //         if(isset($fruitDetalle->sugar))
    //         echo "<h5>Azúcar: $fruitDetalle->sugar g<h5>";    
    // }

    public function Frutas(){
        $fruits=Fruit::all();
        return $fruits;
    }

    public function Mango()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://bebida.herokuapp.com/JMango",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT =>30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: https://bebida.herokuapp.com",
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
            //impriiendo datos de la fruta
            $fruitDetalle=Fruit::where('name',"Mango")->first();
                   
            if(isset($fruitDetalle->name))
            echo "<h3>$fruitDetalle->name </h3>";

            if(isset($fruitDetalle->carbohydrates))
            echo "<h5>Carbohidratos: $fruitDetalle->carbohydrates g<h5>";

            if(isset($fruitDetalle->protein))
            echo "<h5>Proteína:$fruitDetalle->protein g<h5>";

            if(isset($fruitDetalle->fat))
            echo "<h5>Grasa: $fruitDetalle->fat g<h5>";

            if(isset($fruitDetalle->calories))
            echo "<h5>Calorías: $fruitDetalle->calories g<h5>";

            if(isset($fruitDetalle->sugar))
            echo "<h5>Azúcar: $fruitDetalle->sugar g<h5>";    

            echo "<p/><h3>Algunas bebidas... </h3>";

            //imprimiendo bebidas
            $bebidas = json_decode($response);

            foreach($bebidas as $bebida)
            {
                if(isset($bebida->strDrink))
                echo "<h3>$bebida->strDrink </h3>"."<br/>";

                if(isset($bebida->strDrinkThumb))
                echo "<img src='$bebida->strDrinkThumb' alt=''>"."<br/>";

            }

        }

    }
    public function Sandia()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://bebida.herokuapp.com/JSandia",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT =>30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: https://bebida.herokuapp.com",
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
            //impriiendo datos de la fruta
            $fruitDetalle=Fruit::where('name',"Watermelon")->first();
                   
            if(isset($fruitDetalle->name))
            echo "<h3>$fruitDetalle->name </h3>";

            if(isset($fruitDetalle->carbohydrates))
            echo "<h5>Carbohidratos: $fruitDetalle->carbohydrates g<h5>";

            if(isset($fruitDetalle->protein))
            echo "<h5>Proteína:$fruitDetalle->protein g<h5>";

            if(isset($fruitDetalle->fat))
            echo "<h5>Grasa: $fruitDetalle->fat g<h5>";

            if(isset($fruitDetalle->calories))
            echo "<h5>Calorías: $fruitDetalle->calories g<h5>";

            if(isset($fruitDetalle->sugar))
            echo "<h5>Azúcar: $fruitDetalle->sugar g<h5>";    

            echo "<p/><h3>Algunas bebidas... </h3>";

            //imprimiendo bebidas
            $bebidas = json_decode($response);

            foreach($bebidas as $bebida)
            {
                if(isset($bebida->strDrink))
                echo "<h3>$bebida->strDrink </h3>"."<br/>";

                if(isset($bebida->strDrinkThumb))
                echo "<img src='$bebida->strDrinkThumb' alt=''>"."<br/>";

            }

        }

    }
  public function Naranja()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://bebida.herokuapp.com/JNaranja",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT =>30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: https://bebida.herokuapp.com",
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
            //impriiendo datos de la fruta
            $fruitDetalle=Fruit::where('name',"Orange")->first();
                   
            if(isset($fruitDetalle->name))
            echo "<h3>$fruitDetalle->name </h3>";

            if(isset($fruitDetalle->carbohydrates))
            echo "<h5>Carbohidratos: $fruitDetalle->carbohydrates g<h5>";

            if(isset($fruitDetalle->protein))
            echo "<h5>Proteína:$fruitDetalle->protein g<h5>";

            if(isset($fruitDetalle->fat))
            echo "<h5>Grasa: $fruitDetalle->fat g<h5>";

            if(isset($fruitDetalle->calories))
            echo "<h5>Calorías: $fruitDetalle->calories g<h5>";

            if(isset($fruitDetalle->sugar))
            echo "<h5>Azúcar: $fruitDetalle->sugar g<h5>";    

            echo "<p/><h3>Algunas bebidas... </h3>";

            //imprimiendo bebidas
            $bebidas = json_decode($response);

            foreach($bebidas as $bebida)
            {
                if(isset($bebida->strDrink))
                echo "<h3>$bebida->strDrink </h3>"."<br/>";

                if(isset($bebida->strDrinkThumb))
                echo "<img src='$bebida->strDrinkThumb' alt=''>"."<br/>";

            }

        }

    }



}
