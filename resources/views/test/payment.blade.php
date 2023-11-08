<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BillDesk Payment</title>

	 <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	 <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script type="module" src="https://pay.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.esm.js"></script>
	<script nomodule="" src="https://pay.billdesk.com/jssdk/v1/dist/billdesksdk.js"></script>
	<link href="https://pay.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.css" rel="stylesheet">

	   <script>

        var flow_config = {
            merchantId: "XXXXXXX", //mechant id given by billdesk
            bdOrderId: "{{$order_id}}", // get from orderCreate response
            authToken: "<?php echo $authorization_token; ?>", // get from orderCreate response
            childWindow: false,
            returnUrl: "callbackurl.php",
            crossButtonHandling: 'Y',
            retryCount: 0
        };
        var responseHandler = function (txn) {
         
                console.log(txn.status)
                console.log(txn.response)
            
        };

        var config = {
            flowConfig: flow_config,
            flowType: "payments"
        };
        window.onload = function () {
            window.loadBillDeskSdk(config);
        };

    </script>

</head>
<body>

</body>
</html>