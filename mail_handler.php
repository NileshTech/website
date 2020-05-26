

<html>
   
   <head>
      <title>YOUR ORDER HAS BEEN CONFIRMED</title>
   </head>
   
   <body>
      
      <?php


      	$userName = "Suraj Jorwekar";
      	$orderId = "24Y0SJ";

      	$matPrice = "6,000.00";
      	$matStrikePrice = "8,000.00";

      	$planType = "Family Plan";
      	$planPackage = "3 Months subscription";
      	$planPrice = "1,200.00";
      	$subCode = "";//$orderId;

      	$subscriptionDetails = '';

      	$totalAmount = "7,200.00";




     	$to='surajjorwekar@gmail.com'; 
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
		    echo 'Email has sent successfully...'; 
		}else{ 
		   echo 'Email sending failed.'; 
		}
      ?>
      
   </body>
</html>