<?php
header("Content-Type:text/html; charset=utf-8");
require_once("./parse-conf.php");
include_once('./AllPay.Payment.Integration.php');

use Parse\ParseCloud;

$result = "fail";

$szMerchantTradeNo = "";
$szTradeNo = "";
$szTradeAmt = "";
$szTradeDate = "";

try{
	$oPayment = new AllInOne();
	
	/* test env */
	$oPayment->HashKey = "5294y06JbISpM5x9";
	$oPayment->HashIV = "v77hoKGq4kWxNNIS";
	$oPayment->MerchantID = "2000132";
	
	
	/*  */
	$arFeedback = $oPayment->CheckOutFeedback();
	/*  */
	
	
	if (sizeof($arFeedback) > 0) {
		foreach ($arFeedback as $key => $value) {
			switch ($key)
			{
				/*  */
				case "MerchantID": $szMerchantID = $value; break;						
				case "MerchantTradeNo": $szMerchantTradeNo = $value; break;
				case "PaymentDate": $szPaymentDate = $value; break;
				case "PaymentType": $szPaymentType = $value; break;
				case "PaymentTypeChargeFee": $szPaymentTypeChargeFee = $value; break;
				case "RtnCode": $szRtnCode = $value; break;
				case "RtnMsg": $szRtnMsg = $value; break;
				case "SimulatePaid": $szSimulatePaid = $value; break;
				case "TradeAmt": $szTradeAmt = $value; break;
				case "TradeDate": $szTradeDate = $value; break;
				case "TradeNo": $szTradeNo = $value; break;
				default: break;
			}
		}
		
		$result = "success";
		
		print '1|OK';
	} else {
		print '0|Fail';
		
	}
}
catch (Exception $e){
	// 
	print '0|' . $e->getMessage();
}
 
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
    
    <!------------------------------ css --------------------------------->
    <!-- jquery mobile -->
	<link rel="stylesheet" href="external/jquery-mobile/jquery.mobile-1.4.5.css" />
	
	
	<!---------------------------- javascript lib ------------------------>
	<!-- jquery & jquery mobile -->
	<script src="external/jquery/jquery-1.12.2.min.js"></script>
	<script src="external/jquery-mobile/jquery.mobile-1.4.5.min.js"></script>
	
	<!-- parse lib -->
    <script src="external/parse-1.6.14.js"></script>

	<script>
		$(document).on("click", "#transaction-failed", function(event) {
			//$.mobile.changePage("test-allpay.html");
			window.location = "./fail#cartToBeUpdate=<?php echo $szMerchantTradeNo; ?>&allPayNo=<?php echo $szTradeNo; ?>";
		});
		$(document).on("click", "#transaction-success", function(event) {
			//$.mobile.changePage("test-allpay.html");
			window.location = "./success#cartToBeUpdate=<?php echo $szMerchantTradeNo; ?>&allPayNo=<?php echo $szTradeNo; ?>";
		});
		
	</script>
	
	<style>
		.app-btn {	
			background: #F25B20 !important;
			border: none !important; 
			color: #fff !important;
			text-shadow:none !important;
		}
		
		.a-color {
			color: #FF6F0D !important;
		}
	</style>
</head>

<body>
	
<?php 
	if ($result == "success") {
		$results = ParseCloud::run("setCartOnBid" , array("stamp"=> $szMerchantTradeNo, 
														"allPayNo"=> $szTradeNo));	
?>
		<div data-role="page" id="paySuccessPage">
			<div data-role="content">
				<ul data-role="listview" >
					<li style="background-color:#FF6F0D">
						<div class="ui-grid-solo">
							<div style="text-align:center;height:25px;font-size:20px;color:white;padding-top: 1px;">付款成功</div>
						</div>
					</li>
					
					<li>
						<div class="ui-grid-a">
							<div class="ui-block-a" style="width:30%">交易金額</div>
							<div class="ui-block-b" style="width:70%">$<?php echo $szTradeAmt ?></div>
						</div>
					</li>
					<li>
						<div class="ui-grid-a">
							<div class="ui-block-a" style="width:30%">交易時間</div>
							<div class="ui-block-b" style="width:70%"><?php echo $szTradeDate ?></div>
						</div>
					</li>
					<li>
						<div class="ui-grid-a">
							<div class="ui-block-a" style="width:30%">交易序號</div>
							<div class="ui-block-b" style="width:70%"><?php echo $szTradeNo ?></div>
						</div>
					</li>
					<li>
						<div class="ui-grid-solo">
							<span class="a-color" style="white-space: normal;">感謝您，訂單已收到。若10分鐘內沒有運送人員接單，平台保有取消此訂單的權利。訂單取消後，我們將會全額退刷。</span>
						</div>
					</li>
					<li>
						<div class="ui-grid-a">
							<div class="ui-block-a a-color" style="width:30%">客服專線</div>
							<div class="ui-block-b a-color" style="width:70%">03-6230127</div>
						</div>
					</li>
					<li>
						<div class="ui-grid-solo">
							<a href="#" data-role="button"  rel="external" class="app-btn" id="transaction-success">回美食地圖</a>
						</div>
					</li>
				</ul>
			</div>
		</div>	
		
		
		<script>
			
			
		</script>
		
<?php
	} else {
?>
		<div data-role="page" id="payFailPage">
			<div data-role="content">
				<ul data-role="listview" >
					<li style="background-color:#FF6F0D">
						<div class="ui-grid-solo">
							<div style="text-align:center;height:25px;font-size:20px;color:white;padding-top: 1px;">交易失敗</div>
						</div>
					</li>
					<li>
						<div class="ui-grid-solo">
							<span class="a-color" style="white-space: normal;">信用卡交易失敗，交易編號 <?php echo $szMerchantTradeNo; ?>。</span>
						</div>
					</li>
					<li>
						<div class="ui-grid-solo">
							<span class="a-color" style="white-space: normal;">請聯絡客服協助處理或回購物車重新結帳。</span>
						</div>
					</li>
					<li>
						<div class="ui-grid-a">
							<div class="ui-block-a a-color" style="width:30%">客服專線</div>
							<div class="ui-block-b a-color" style="width:70%">03-6230127</div>
						</div>
					</li>
					<li>
						<div class="ui-grid-solo">
							<a href="#" data-role="button"  rel="external" class="app-btn"  id="transaction-failed">回購物車重新結帳</a>
						</div>
					</li>
				</ul>
			</div>
		</div>	
<?php		
	}	
?>	


</body>
</html>