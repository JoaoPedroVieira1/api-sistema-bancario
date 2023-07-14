<?php

    class clientController{
        private $conn;

        public function __construct($conn){
            $this->conn=$conn;
        }

        public function registerClient($data){
            global $conn;

            $nome = mysqli_real_escape_string($conn, $data->nome);
            $email = mysqli_real_escape_string($conn, $data->email);
            $endereco = mysqli_real_escape_string($conn, $data->endereco);
            
            $query = "INSERT INTO clientes(nome, email, endereco)
                      VALUES ('$nome', '$email', '$endereco')";
            
            $result = mysqli_query($conn, $query);

            if($result){
                $output = [
                    "status" => 200,
                    "data" => "Data insert successfully",
                    "error" => false
                ];
            }else{
                $output = [
                    "status" => 404,
                    "data" => "Failed to insert data",
                    "error" => true
                ];
            }

            echo json_encode($output);
        }

        public function getClient($id){
            global $conn;

            $query = "SELECT * FROM clientes WHERE id='$id'";
            $result = mysqli_query($conn, $query);
            $numRows = mysqli_num_rows($result);

            if ($numRows > 0) {
                $output = mysqli_fetch_assoc($result);
                $output = [
                    "status" => 200,
                    "data" => $output,
                    "error" => false
                ];
            }else{
                $output = [
                    "status" => 404,
                    "data" => "No record found",
                    "error" => true
                ];
            }

            echo json_encode($output);
        }

        public function getAllClient(){
            global $conn;

            $query = "SELECT * FROM clientes";
            $result = mysqli_query($conn, $query);
            $output = array();

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($output, $row);
            }

            $output = [
                "status" => 200,
                "data" => $output,
                "error" => false
            ];

            echo json_encode($output);
        }

        public function updateClient($id, $data){
            global $conn;

            $nome = mysqli_real_escape_string($conn, $data->nome);
            $email = mysqli_real_escape_string($conn, $data->email);
            $endereco = mysqli_real_escape_string($conn, $data->endereco);

            $query = "UPDATE clientes SET nome='$nome', email='$email', endereco='$endereco' WHERE id='$id'";

            $result = mysqli_query($conn, $query);

            if ($result) {
                $output = [
                    "status" => 200,
                    "data" => "Data Updated Successfully",
                    "error" => false
                ];
            }else{
                $output = [
                    "status" => 404,
                    "data" => "Failed To Update Data",
                    "error" => true
                ];
            }

            echo json_encode($output);
        }

        public function deleteClient($id){
            global $conn;

            $query = "SELECT * FROM clientes WHERE id='$id'";
            $result = mysqli_query($conn, $query);
            $numRows = mysqli_num_rows($result);

            if ($numRows > 0) {
                $query = "DELETE FROM clientes WHERE id='$id'";
                $result = mysqli_query($conn, $query);

                $output = [
                    "status" => 200,
                    "data" => "Data Delected Successfully",
                    "error" => false
                ];
            }else{
                $output = [
                    "status" => 404,
                    "data" => "No Record Found",
                    "error" => true
                ];
            }

            echo json_encode($output);
        }

        /*private function executeQuery($query){
            $result = mysqli_query($this->conn, $query);
    
            if ($result) {
                return [
                    "status" => 200,
                    "data" => "Operation executed successfully",
                    "error" => false
                ];
            } else {
                return [
                    "status" => 500,
                    "data" => "Failed to execute operation",
                    "error" => true
                ];
            }
        }*/
    }