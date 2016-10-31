<?php
header("Content-Type:text/html; charset=utf-8");
include_once('./AllPay.Payment.Integration.php');


$result = "fail";

$szMerchantTradeNo = "";
$szTradeNo = "";
$szTradeAmt = "";
$szTradeDate = "";

try{
	$oPayment = new AllInOne();
		
	/* prod env. */
	$oPayment->HashKey = "kfsPM1Mt4giDE6Hn";
	$oPayment->HashIV = "v1iHPQuM28QCsjkd";
	$oPayment->MerchantID = "1140692";
	
	
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
		$(document).on("click", "#closeMe", function(event) {
			//$.mobile.changePage("test-allpay.html");
			window.location = "food-court.html";
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
?>
		<div data-role="page" id="paySuccessPage">
			<div data-role="header">
				<h1>交易結果</h1>
			</div>
			<div data-role="content">
				<ul data-role="listview" >
					<li style="background-color:#FF6F0D">
						<div class="ui-grid-solo">
							<div style="text-align:center;height: 80px;font-size:3em;color:white;padding-top: 12px;">付款成功</div>
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
				</ul>
			</div>
		</div>	
		
		
		<script>
		
			/** prod **/
			var appid = "9O3uQHctMnz86F6m3lifIlwKrMGONwlUjO2OL4uf";
			var jskey = "nbkR1HRcOkFEa4J73rPsWvaZsqa6O6BHI0GSGClz"
			Parse.initialize(appid, jskey);
			
			updateCart();
			
			function updateCart() {
				//更新數量
				Parse.Cloud.run("setCartOnBid", 
					{	
						//cartId: <?php echo "'". $szMerchantTradeNo. "'"?>,
						stamp: "<?php echo $szMerchantTradeNo; ?>",
						allPayNo: "<?php echo $szTradeNo; ?>"
					}, 
					{
					success: function(results) {
						console.log("<?php echo $szMerchantTradeNo; ?> cart submitted");
					},
				 	error: function(error) {
				 		console.log("setCartReady error:" + error.message);
					}
				});	
			}
			
			
			var element = document.getElementById('go');
		
			function myFunction() {
				console.log(" iframe will create");
			  	//generate same domain iframe
			  	if(typeof(exec_obj)=='undefined'){  
			        exec_obj = document.createElement('iframe');  
			        exec_obj.name = 'tmp_frame';  
			        exec_obj.src = 'http://wintopinfo.com/hungrybeeuser/execB.html';
			        exec_obj.style.display = 'block';  
			        document.body.appendChild(exec_obj);  
			        console.log(" iframe did create ");
			    } else {  
			        exec_obj.src = 'http://wintopinfo.com/hungrybeeuser/execB.html?' + Math.random();  
			    }
			}
			
			element.onclick = myFunction; // Assigned	
		</script>
		
<?php
	} else {
?>
		<div data-role="page" id="payFailPage">
			<div data-role="header">
				<h1>交易結果</h1>
			</div>
			<div data-role="content">
				<ul data-role="listview" >
					<li style="background-color:#FF6F0D">
						<div class="ui-grid-solo">
							<div style="text-align:center;height: 80px;font-size:3em;color:white;padding-top: 12px;">交易失敗</div>
						</div>
					</li>
					<li>
						<div class="ui-grid-a">
							<div class="ui-block-a" style="width:30%">請聯絡客服</div>
							<div class="ui-block-b" style="width:70%">03-6230127</div>
						</div>
					</li>
					<li>
						<div class="ui-grid-solo">
							<a href="#" data-role="button"  rel="external" class="app-btn" id="go">回美食地圖</a>
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