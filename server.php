<?php

require_once 'config/config.php';
require_once 'data/shoesdata.php';
require_once 'data/usersdata.php';
require_once 'data/discountdata.php';


$response_messages = array(
    405 => "Method Not Allowed",
    200 => "OK",
    400 => "Bad Request",
    404 => "File Not Found",
    500 => "Internal Server Error"
);

$response = new stdClass();
$response->status = 0;
$response->message = "";
$response->data = NULL;
$response->error = false;



$supported_methods = array("GET");
$method = strtoupper($_SERVER['REQUEST_METHOD']);



if (!in_array($method, $supported_methods)) {
    $response->status = 405;
    $response->data = NULL;
} else {
    $url_parts_counter = 0;
    $url_parts = array();

    if (isset($_SERVER['PATH_INFO'])) {

        $path_info = $_SERVER['PATH_INFO'];

        $url_parts = explode("/", $path_info);

        $url_parts_counter = count($url_parts) - 1;
    }

    try {


        switch ($method) {
            case "GET":

                if ($url_parts_counter == 1 and $url_parts[1] == "shoes") {

                    $response->data = ShoesData::GetAllShoes();

                    $response->status = 200;
                } else {
                    if ($url_parts_counter == 1 and $url_parts[1] == "discounts") {

                        $response->data = DiscountData::GetAllDiscounts();
                        $response->status = 200;
                    } else {

                        if ($url_parts_counter == 1 and $url_parts[1] == "users") {

                            $$response->data = UsersData::GetAllUsers();
                            $response->status = 200;

                        } else {
                                $response->status = 400;
                                $response->data = NULL;
                            }
                        
                    }
                }
                break;
        }
    } catch (PDOException $e) {
        $response->status = 500;
        $response->data = NULL;
        $response->error = true;
    }

    $response->message = $response_messages[$response->status];
    header("HTTP/1.1 " . $response->status . " " . $response->message);


    header("Content-Type: application/json");

    if ($response->data != NULL) {

        echo json_encode($response->data);
    }
}
