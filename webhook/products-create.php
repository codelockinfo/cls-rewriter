<?php

$__multiLanguageNotNeeded = TRUE ;
include_once '../append/connection.php';
include_once ABS_PATH . '/user/cls_functions.php';
require_once '../cls_shopifyapps/config.php';

$shop = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
$cls_functions = new Client_functions($shop);
 

function verify_webhook($data, $hmac_header, $cls_functions)
{
	$where_query = array(["", "status", "=", "1"]);
	$comeback= $cls_functions->select_result(CLS_TABLE_THIRDPARTY_APIKEY, '*',$where_query);
	$SHOPIFY_SECRET = (isset($comeback['data'][2]['thirdparty_apikey']) && $comeback['data'][2]['thirdparty_apikey'] !== '') ? $comeback['data'][2]['thirdparty_apikey'] : '';
  	$calculated_hmac = base64_encode(hash_hmac('sha256', $data, $SHOPIFY_SECRET, true));
  	return hash_equals($hmac_header, $calculated_hmac);
}


$hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
generate_log('server_data', json_encode($_SERVER));
$data = file_get_contents('php://input');
generate_log('product_create-webhook', json_encode($data) . "  DATA"); 
$product = json_decode($data);
$verified = verify_webhook($data, $hmac_header, $cls_functions);
generate_log('product_create-webhook' , var_export($verified, true)); //check error.log to see the result


$topic_header = $_SERVER['HTTP_X_SHOPIFY_TOPIC'];


if($verified == true){
    if( $topic_header == "products/create" ) {
        if(!empty($product)){
			$shopinfo = $cls_functions->get_store_detail_obj();
			$productid = isset($product->id) ? $product->id : '';
			$where_query = array(["", "product_id", "=", "$productid"], ["AND", "store_user_id", "=", "$shopinfo->store_user_id"]);
			generate_log('product_create-webhook', json_encode($shopinfo) . "  ARRAY SHOPINFO"); 
			generate_log('product_create-webhook', json_encode($shopinfo->store_user_id) . "  STORE USER ID"); 
			$comeback = $cls_functions->select_result(TABLE_PRODUCT_MASTER, '*', $where_query);
			generate_log('product_create-webhook', json_encode($comeback['data'])   . "product DATA");
			generate_log('product_create-webhook', json_encode($comeback['data']->product_id)   . "DATA  product ID");
			$ProductId = isset($comeback['data']->product_id) ? $comeback['data']->product_id : '';
			   generate_log('product_create-webhook', json_encode($ProductId)   . "product ID");
			if(empty($ProductId)){
			$field_array = array();
			// $p_id = '';
			foreach ($product->variants as $i => $variants) {
				$main_price = ($variants->price != '') ? $variants->price : "";
			}
			$img_src = ($product->image == '') ? '' : $product->image->src;     
			$field_array = array(
				'`product_id`' => $product->id,
				'`title`' => $product->title,
				'`image`' =>$img_src,
				'`description`' =>str_replace("'", "\'",$product->body_html),
				'`handle`' =>$product->handle,
				'`price`' =>$main_price,
				'`vendor`' =>$product->vendor,
				'`store_user_id`' => $shopinfo->store_user_id,
				'`created_at`' => date('Y-m-d H:i:s'),
				'`updated_at`' => date('Y-m-d H:i:s'),
			);
			   generate_log('product_create-webhook', json_encode(array($field_array)));
			$sql_prod_id = $cls_functions->post_data(TABLE_PRODUCT_MASTER, array($field_array));
			 generate_log('product_create-webhook', json_encode($sql_prod_id) . " sql_prod_id");
		}
		}
    }
    else {
        echo "Access Denied";
        exit;
    }    
}
else {
    generate_log('product_create-webhook', json_encode($verified) . "  not verified"); 
    echo "Access Denied main ";
}

?>









