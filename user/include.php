<?php 
include_once ('../append/connection.php');
?>
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>HELLOOO 000000000000</h1>
    </body>
</html>

<?php
include_once 'cls_functions.php';

include_once '../append/Login.php';
if(isset($_GET['destroy'])){
    session_destroy();
}
$store = (isset($_GET['store']) && $_GET['store'] != '') ? $_GET['store'] : "managedashboard.myshopify.com";
$ologin = new Login($store);
$functions = new Client_functions();
?>
