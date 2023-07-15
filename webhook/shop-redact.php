<?php

include_once '../append/connection.php';
include_once  ABS_PATH . '/user/cls_functions.php';
require_once '../cls_shopifyapps/config.php';
$shop = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
$user_obj = new Client_functions($shop);

$hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];

function verify_webhook($data, $hmac_header, $cls_functions)
{
    $where_query = array(["", "status", "=", "1"]);
    $comeback= $cls_functions->select_result(CLS_TABLE_THIRDPARTY_APIKEY, '*',$where_query);
    $SHOPIFY_SECRET = (isset($comeback['data'][2]['thirdparty_apikey']) && $comeback['data'][2]['thirdparty_apikey'] !== '') ? $comeback['data'][2]['thirdparty_apikey'] : '';
    $calculated_hmac = base64_encode(hash_hmac('sha256', $data, $SHOPIFY_SECRET, true));
    return hash_equals($calculated_hmac, $hmac_header);
}



$data = file_get_contents('php://input');
$verified = verify_webhook($data, $hmac_header, $cls_functions);
generate_log('Webhook verified: '.var_export($verified, true)); 



if ($verified) {
 generate_log('shop-redact-webhook' , "in if");
    $shopinfo = (array) $user_obj->current_store_obj;
    generate_log('shop-redact-webhook' , json_encode($shopinfo ));
    $store_user_id = $shopinfo['store_user_id'];
    generate_log('shop-redact-webhook' , $store_user_id." STORE_CLIENT_ID");
    if (!empty($shopinfo)) {
       generate_log('shop-redact-webhook' , " IF SHOP INFO");
        
        $fields = array(
            'address11' => '',
            'address22' => '',
            'city' => '',
            'country_name' => '',
            'zip' => '',
            'timezone' => '',        
            'domain' => '',
            'mobile_no' => '',/*phone number*/
            'store_holder' => '',/*shop owner*/
            'cash' => '',/*currency*/
            'price_pattern' => '',/*money format*/
        );
    
        $where = array(['','store_user_id','=',$store_user_id]);
        $returrnn = $user_obj->put_data(TABLE_USER_SHOP, $fields, $where);
            generate_log('shop-redact-webhook' , json_encode($returrnn));
            generate_log('shop-redact-webhook' , "QUERY RESULT");
        if (!empty($returrnn['data']) && $returrnn['status'] == 0) {
            generate_log('shop-redact-webhook' , json_encode($returrnn));
        }
    
        http_response_code(200);
        exit();
    }else{
        echo
        http_response_code(400);
        exit();
    }
} else {
  generate_log('shop-redact-webhook' , "in else");
  http_response_code(401);
}










?>