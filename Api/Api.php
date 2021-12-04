<?php

namespace Api;

class Api {

    /**
     * Variable contenant les disquettes du fichier disquettes.json
     */
    public $json;

    public $content;

    public function __construct() 
    {
        $this->json = file_get_contents('https://raw.githubusercontent.com/Nirbose/disquettes-api/main/disquettes.json');
        $this->content = json_decode($this->json, true);
    }

    public function getApi()
    {
        $this->render([
            "status" => 200,
            "api" => "disquettes-api",
            "routes" => [
                "/",
                "/api",
                "/random",
                "/firstname/{firstname}",
                "/id/{id}",
                "/all"
            ]
        ]);
    }

    public function getAll()
    {
        $this->render($this->content);
    }

    public function getRandom()
    {
        $this->render($this->content[array_rand($this->content)]);
    }

    public function getID(int $id) 
    {
        $tableNumber = $id - 1;

        if (isset($this->content[$tableNumber])) {
            $content = $this->content[$tableNumber];         
        } else {
            $content = ["error" => "Not Found", "code" => 404];
        }

        $this->render($content);
    }

    public function getName(string $firstname)
    {
        $code = 404;
        $content = ["error" => "Not Found", "code" => 404];
        $list = [];

        foreach ($this->content as $value) {
            if (in_array($firstname, $value['firstname'])) {
                $code = 200;
                array_push($list, $value);
                $content = $list;
            }
        }

        $this->render($content, $code);
    }

    public function render($content, $code = 200)
    {
        http_response_code($code);
        header("Content-Type: application/json");
        echo json_encode($content);
    }

}
