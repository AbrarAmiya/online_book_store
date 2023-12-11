<!DOCTYPE html>
<html lang="en">
<style>
        body {
            /* padding: 25px; */
            background-color: white;
            color: #2C3E50;
            font-size: 25px;
        }
 
        .dark-mode {
            background-color: black;
            color: white;
        }
 
        .light-mode {
            background-color: white;
            color: black;
        }
    </style>
<?php
session_start();
include '_dbconnect.php';


if(!(isset($_SESSION["cart"]))){
    $_SESSION["cart"];
}
 if(isset($_POST["id"])){
        $id = $_POST["id"];
        $quan = $_POST["quan"];
        $sql = "SELECT * FROM `products` WHERE `product_id` = $id";
        $result = mysqli_query($conn, $sql);
        $stock = 0;
        while($row = mysqli_fetch_assoc($result)){
            $stock = $row['product_stock'];
        }
        if($quan>0 && $quan <= $stock && filter_var($quan,FILTER_VALIDATE_INT)){
            $_SESSION['cart'][$id] = $quan;
            $sql = "Update `products` SET `product_stock` = `product_stock` - $quan WHERE `product_id` = $id";
            $result = mysqli_query($conn, $sql);
            
        }else{
            $script = $_POST["script"];
            $params = $_POST["params"];
            $temp = $_POST["id"];
            header("Location: $script?$params&err=True");
            exit();
        }   
    }
$script = $_POST["script"];
$params = $_POST["params"];
header("Location: $script?$params&err=false");
exit();

?>