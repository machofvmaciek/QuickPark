<?php
    session_start();
    if(isset($_POST['string']) && (!empty($_POST['string']))){
        $_SESSION['passhash'] = password_hash($_POST['string'], PASSWORD_DEFAULT);
        unset($_POST['string']);
        //echo $passhash;
    }

?>
<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8" />
	<title>SANDBOX QUICPARK</title>
	<meta name="description" content="Intelligent shopping mall parking system" />

	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="icon" href="img/parking_icon.jpg">
	<style>


	</style>
</head>

<body>

	<div id="container"><center>
    <form method = "post">
        <h1> Insert receiver's email </h1>
        <input type = "submit" name = "submit">
        <?php
            if(isset($_POST['submit'])){
                $tickettime = 3;
                $placeid = 10;
                $regplate = "SMY3R33";

                $to = "olszewski.maciej.mo@gmail.com";              
                $topic = "QuickPark ticket";
               
				$ticketexpiration = new DateTime();
				$ticketexpiration -> modify('+'.$tickettime.'hours');
                $ticketexpstring = $ticketexpiration -> format('Y-m-d H:i:s');
				$message = "You bought a ticket\nPlace number: ".$placeid."\nRegistration plates of the car: ".$regplate."\nTicket expires at: ".$ticketexpstring."\nThank you for using QuickPark";
                mail($to, $topic, $message);
				
                
                //unset($_POST['submit']);
            }
           // $message = "You bought a ticket\nPlace number: ".$_SESSION['placeid']."\nRegistration plates of the car: ".$_SESSION['regplate']."Ticket expires at: ".now() + INTERVAL {$_SESSION['tickettime']} HOUR."\nThank you for using QuickPark";
            //echo $message;
        ?>
    </form>
	</div></center>



</body>

</html>