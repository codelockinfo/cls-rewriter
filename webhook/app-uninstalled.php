<?php
include_once '../append/connection.php';
generate_log('uninstall-webhook', "STEP1");
include_once ABS_PATH . '/user/cls_functions.php';
generate_log('uninstall-webhook', "STEP2");
require_once '../cls_shopifyapps/config.php';
generate_log('uninstall-webhook', "STEP3");
$cls_functions = new Client_functions($_GET['store']);
generate_log('uninstall-webhook', "STEP4");

function verify_webhook($data, $hmac_header)
{
    generate_log('uninstall-webhook' , " verify webhook function calling ");
    $where_query = array(["", "status", "=", "1"]);
    $comeback= $this->select_result(CLS_TABLE_THIRDPARTY_APIKEY, '*',$where_query);
    $SHOPIFY_SECRET = (isset($comeback['data'][2]['thirdparty_apikey']) && $comeback['data'][2]['thirdparty_apikey'] !== '') ? $comeback['data'][2]['thirdparty_apikey'] : '';
    $calculated_hmac = base64_encode(hash_hmac('sha256', $data, $SHOPIFY_SECRET, true));
    return hash_equals($hmac_header, $calculated_hmac);
}

$hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
generate_log('uninstall-webhook', $hmac_header . "   HMAC");
$data = file_get_contents('php://input');
$verified = verify_webhook($data, $hmac_header);
generate_log('uninstall-webhook' , var_export($verified, true)); //check error.log to see the result

// function verify_webhook($data, $hmac_header) {
//     $calculated_hmac = base64_encode(hash_hmac('sha256',$data,SHOPIFY_APP_SECRET,true));
//     generate_log('testingwebhook', $calculated_hmac . "   calculated_hmac");
//     return hash_equals($hmac_header, $calculated_hmac);
//     // return ($hmac_header == $calculated_hmac);
// }
$topic_header = $_SERVER['HTTP_X_SHOPIFY_TOPIC'];
generate_log('uninstall-webhook', $topic_header . "TOPIC");
$shop = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
// $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
// generate_log('testingwebhook', $hmac_header . "  hmac_header ");
// $datas = file_get_contents('php://input');
// $verified = verify_webhook($datas, $hmac_header);
//     generate_log('testingwebhook',var_export($verified, true)); //check error.log to see the result
  


if($verified == true){
   generate_log('uninstall-webhook', json_encode($verified) . "  verified"); 
    if( $topic_header == "app/uninstalled" ) {
        $shop = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
        $fields = array(
            'status' => '0',
            'is_demand_accept' => '0'
        );
        $where_query = array(["", "shop_name", "=",$shop]);
        generate_log('uninstall-webhook', json_encode($where_query) . "were  result");
        $data =  $cls_functions->put_data(TABLE_USER_SHOP, $fields, $where_query);
        generate_log('uninstall-webhook', $data);
    }
    else {
        echo "Access Denied";
        exit;
    }    
}
else {
    generate_log('uninstall-webhook', json_encode($verified) . "  not verified"); 
    echo "Access Denied main ";
}

?>

