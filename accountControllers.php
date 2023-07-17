<?php

    class accountController{
        private $conn;

        public function __construct($conn){
            $this->conn=$conn;
        }

        public function registerAccount($data){
            global $conn;

            $numero = mysqli_real_escape_string($conn, $data->numero_conta);
            $tipo = mysqli_real_escape_string($conn, $data->tipo_conta);
            $saldo = mysqli_real_escape_string($conn, $data->saldo);
            $client_id = mysqli_real_escape_string($conn, $data->client_id);
            
            $query = "INSERT INTO conta(numero_conta, tipo_conta, saldo, client_id)
                      VALUES ('$numero', '$tipo', '$saldo', '$client_id')";
            
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

        public function getAccount($id){
            global $conn;

            $query = "SELECT * FROM conta WHERE id='$id'";
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

        public function getAllAccount(){
            global $conn;

            $query = "SELECT * FROM conta";
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

        public function updateAccount($id, $data){
            global $conn;

            $numero_conta = mysqli_real_escape_string($conn, $data->numero_conta);
            $tipo_conta = mysqli_real_escape_string($conn, $data->tipo_conta);
            $saldo = mysqli_real_escape_string($conn, $data->saldo);

            $query = "UPDATE conta SET numero_conta='$numero_conta', tipo_conta='$tipo_conta', saldo='$saldo' WHERE id='$id'";

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

        public function deleteAccount($id){
            global $conn;

            $query = "SELECT * FROM conta WHERE id='$id'";
            $result = mysqli_query($conn, $query);
            $numRows = mysqli_num_rows($result);

            if ($numRows > 0) {
                $query = "DELETE FROM conta WHERE id='$id'";
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
    }

?>