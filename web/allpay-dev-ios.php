<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header("Content-Type:text/html; charset=utf-8");
require('../vendor/autoload.php');
include_once('./AllPay.Payment.Integration.php');
/*產生訂單範例*/
try
{
	$cartId = $_REQUEST["cartId"];
	$price = $_REQUEST["price"];
	
	$oPayment = new AllInOne();
	
	/* test env. */
	$oPayment->ServiceURL ="http://payment-stage.allpay.com.tw/Cashier/AioCheckOut";
	$oPayment->HashKey = "5294y06JbISpM5x9";//這是測試帳號專用的不用改它
	$oPayment->HashIV = "v77hoKGq4kWxNNIS";//這是測試帳號專用的不用改它
	$oPayment->MerchantID = "2000132";//這是測試帳號專用的不用改它
	
	$time=time();
	/* 基本參數 */
	$oPayment->Send['ReturnURL'] = "https://hungrybeephp.herokuapp.com/return-ios.php";//請填入你主機要接受訂單付款後狀態 回傳的程式名稱 記住 該網址需能對外
	$oPayment->Send['ClientBackURL'] ="https://hungrybeephp.herokuapp.com/return-ios.php";
	$oPayment->Send['OrderResultURL'] = "https://hungrybeephp.herokuapp.com/return-ios.php";//請填入你主機要接受訂單付款後狀態 回傳的程式名稱 記住 該網址需能對外
	
	//$oPayment->Send['MerchantTradeNo'] = $time;//這邊是店家端所產生的訂單編號
	$oPayment->Send['MerchantTradeNo'] = $cartId;//訂單編號
	$oPayment->Send['MerchantTradeDate'] = date("Y/m/d H:i:s");
	$oPayment->Send['TotalAmount'] = $price;//付款總金額
	$oPayment->Send['TradeDesc'] = "Hungrybee美食外送";//交易敘述
	$oPayment->Send['ChoosePayment'] = PaymentMethod::Credit;//付款方式 這邊是開啟所有付款方式讓消費者自行選擇
	
	$oPayment->Send['IgnorePayment'] ="Alipay";//把不的付款方式取消掉
	$oPayment->Send['DeviceSource'] ="M";//參數M表示使用行動版的頁面 不設定此參數 預設就是電腦版顯示
	 
	//$oPayment->SendExtend['PaymentInfoURL']="http://wintopinfo.com/hungrybeeuser/return-ios.php";//接受訂單狀態 回傳程式名稱 可在此程式內將付款方式寫入你的訂單中 payment_info.php 與 return.php 程式內容一樣
	$oPayment->SendExtend['PaymentInfoURL']="https://hungrybeephp.herokuapp.com/return-ios.php";//接受訂單狀態 回傳程式名稱 可在此程式內將付款方式寫入你的訂單中 payment_info.php 與 return.php 程式內容一樣
	
	// 加入選購商品資料。
	array_push($oPayment->Send['Items'], array('Name' => "Hungrybee美食外送", 
												'Price' => (int) $price, 
												'Currency' => "元", 
												'Quantity' => (int) "1", 
												'URL' => "http://hungrybee.net/"));
	 
	/* 產生訂單 */
	$oPayment->CheckOut();
	/* 產生產生訂單 Html Code 的方法 */
	$szHtml = $oPayment->CheckOutString();
 
}
catch (Exception $e)
{ // 例外錯誤處理。
	throw $e;
}
?>