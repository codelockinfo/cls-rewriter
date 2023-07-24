<?php
require_once('include.php');
include_once('cls_header.php');
$common_function = new common_function();
$functions = new Client_functions($store);
$shopinfo = $functions->current_store_obj;
$shopinfo = (object)$shopinfo;
$message = file_get_contents('thankemail_template.php');
$to = "codelockinfo@gmail.com";	
$subject="Rewriter App"; 
$headers ="From:". $shopinfo->email ." \r\n";     
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
generate_log('user_index' , $shopinfo->email  . " ... EMAIL");
generate_log('user_index' , json_encode($message)  . " ... MESSSAGE");
$responceEmail = mail ($to, $subject, $message, $headers);	
generate_log('user_index' , json_encode($responceEmail)  . " ... EMAIL RESPONSE");

include 'dashboard.php';
die;
?>
