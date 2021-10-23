<?php

namespace Api;

class Api {

    /**
     * Variable contenant les disquettes du fichier disquettes.json
     *
     * @var JSON
     */
    public $json;

    public $content;

    public function __construct() 
    {
        $this->json = file_get_contents('./disquettes.json');
        $this->content = json_decode($this->json, true);
    }

    public function getAll()
    {
        http_response_code(200);
        header("Content-Type: application/json");
        echo $this->json;
    }

    public function getID(int $id) 
    {
        $tableNumber = $id - 1;

        if (isset($this->content[$tableNumber])) { 
            http_response_code(200);
            $content = json_encode($this->content[$tableNumber]);            
        } else {
            http_response_code(404);
            $content = json_encode(["error" => "Not Found"]);
        }

        header("Content-Type: application/json");
        echo $content;
    }

}
