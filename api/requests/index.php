<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = file_get_contents("php://input");
    $data_array = json_decode($data);
    $query = $data_array->query;
    require "functions.php";
    switch ($query) {
        case "view-apartments":
            $apartments = new Apartments();
            $result = $apartments->viewApartments();
            echo json_encode($result);
            break;
        case "view-houses":
            $apartments = new Apartments();
            $result = $apartments->viewHouses($_SESSION['user_id']);
            echo json_encode($result);        
            break;
        case "view-tenants":
            $apartments = new Apartments();
            $result = $apartments->viewTenants($_SESSION['user_id']);
            echo json_encode($result);
            break;
        case "view-caretakers":
            $apartments = new Apartments();
            $result = $apartments->viewCareTakers($_SESSION['user_id']);
            echo json_encode($result);
            break;
        case "view-invoices":
            $apartments = new Apartments();
            $result = $apartments->viewInvoices($_SESSION['user_id']);
            echo json_encode($result); 
            break;
        case "view-water-bills":
            
            break;
        case "view-recurrent-bills":
            break;
        case "generate-invoices":
            break;
        case "add-apartment":
            $data = file_get_contents("../apartments/add.php");
            echo json_encode([
                "content"=>$data
            ]);
            break;
        case "home":
            $data = file_get_contents("../../dashboard/landlord/main-area-top.php");
            echo json_encode([
                "content"=>$data
            ]);
            break;
        case "add-house":
            break;
        case "add-tenant":
    }
}
