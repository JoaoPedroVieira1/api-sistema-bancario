<?php
    require 'connection.php';
    require 'allControllers.php';

    $method = $_SERVER['REQUEST_METHOD'];
    $client_controller = new clientController($conn);

    if ($method == 'POST') {
        $data = json_decode(file_get_contents("php://input"));
        $client_controller->registerClient($data);
    }elseif($method == 'GET'){
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $id = $_GET['id'];
            $client_controller->getClient($id);
        }else{
            $client_controller->getAllClient();
        }
    }elseif($method == 'PUT'){
        if(isset($_GET['id']) && $_GET['id'] != ""){
            $id = $_GET['id'];
            $data = json_decode(file_get_contents("php://input"));
            $client_controller->updateClient($id, $data);
        }
    }elseif($method == 'DELETE'){
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $id = $_GET['id'];
            $client_controller->deleteClient($id);
        }
    }else{
        $output = [
            "status" => 404,
            "data" => "Invalid Request Method",
            "error" => true 
        ];

        echo json_encode($output);
    }

?>