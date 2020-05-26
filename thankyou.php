<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Thank You, Mojo</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>

  <body>
    <div class="container">

      <div class="page-header">
        <h1><a href="index.php">PLAY YIPLI </a></h1>
        <p class="lead">Your order has been confirmed. Please check mail and store below ORDER ID for further queries</p>
      </div>

      <h3 style="color:#6da552">Thank You, Payment success!!</h3>


 <?php

include 'src/instamojo.php';


$api = new Instamojo\Instamojo('9326a9e66973314439cc8a3d22910e7b', '821c33177885793a28ba331af861dd6e','https://www.instamojo.com/api/1.1/');


/*$api = new Instamojo\Instamojo('test_d55d253d8863880dcd6d9bf4dcd', 'test_69b53826a51744eaf753256859a','https://test.instamojo.com/api/1.1/');*/

$payid = $_GET["payment_request_id"];


try {
    $response = $api->paymentRequestStatus($payid);

   


    echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>" ;
    echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>" ;
    echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>" ;
    echo '<a href="index.html">Go to Home</a>';

 

    echo "<pre>";

    //print_r($response);



    $testData =  explode(" ",$response['purpose']);

    $subCode = "";
    $orderId = $response['payments'][0]['payment_id'];


    $userName = $response['buyer_name'];
    
    $matPrice = "6000.00";
    $matPriceNumeric = 6000;
    $matStrikePrice = "8000.00";


    if(count($testData) > 1){

      $totalAmount = $response['amount'];


      //Yipli SmartMat-Family-1 Month Subcription
      $planType = $testData[1]." Plan";
      $planPackage = $testData[2];
      $planPrice = $response['amount'] - $matPriceNumeric;
      $subCode = $orderId;

    }

    //$orderId;

    

    $to=$response['email']; 
    $from = 'sales@playyipli.com'; 
    $fromName = 'Sales Team'; 

    $subject = "Your order #".$orderId." has been confirmed"; 



    ob_start();
    include('email_template.php');
    $htmlContent = ob_get_clean();


    //$htmlContent = file_get_contents("email_template.php");


    // Set content-type header for sending HTML email 
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 

    // Additional headers 
    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 


    // Send email 
    if(mail($to, $subject, $htmlContent, $headers)){ 
      echo '<p>Email has been sent successfully...</p>'; 
    }else{ 
      echo '<p>Email sending failed.</p>'; 
    }

/*
    [id] => c13b9b2a8372468ba8facf5f9377eb4d
    [phone] => +917588031035
    [email] => suraj@playyipli.com
    [buyer_name] => Fitmat Smart Solutions
    [amount] => 7800.00
    [purpose] => Yipli-SmartMat+Family-1-Month-Subcription
    [expires_at] => 
    [status] => Completed
    [send_sms] => 1
    [send_email] => 1
    [sms_status] => Pending
    [email_status] => Sent
    [shorturl] => 
    [longurl] => https://test.instamojo.com/@fitmatsolutions/c13b9b2a8372468ba8facf5f9377eb4d
    [redirect_url] => http://playyipli.com/thankyou.php
    [webhook] => http://playyipli.com/webhook.php
    [payments] => Array
        (
            [0] => Array
                (
                    [payment_id] => MOJO0513205A29705020
                    [status] => Credit
                    [currency] => INR
                    [amount] => 7800.00
                    [buyer_name] => Fitmat Smart Solutions
                    [buyer_phone] => +917588031035
                    [buyer_email] => suraj@playyipli.com
                    [shipping_address] => 
                    [shipping_city] => 
                    [shipping_state] => 
                    [shipping_zip] => 
                    [shipping_country] => 
                    [quantity] => 1
                    [unit_price] => 7800.00
                    [fees] => 148.20
                    [variants] => Array
                        (
                        )

                    [custom_fields] => Array
                        (
                        )

                    [affiliate_commission] => 0
                    [payment_request] => https://test.instamojo.com/api/1.1/payment-requests/c13b9b2a8372468ba8facf5f9377eb4d/
                    [instrument_type] => CARD
                    [billing_instrument] => Corporate Card
                    [tax_invoice_id] => 
                    [failure] => 
                    [payout] => 
                    [created_at] => 2020-05-13T11:47:25.228226Z
                )

        )

    [allow_repeated_payments] => 
    [customer_id] => 
    [created_at] => 2020-05-13T11:46:52.651658Z
    [modified_at] => 2020-05-13T11:47:42.573766Z


    */
echo "</pre>";
    ?>


    <?php
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}



  ?>



    </div> <!-- /container -->


  </body>
</html>
