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
        <h1> Insert a password you'd like to hash </h1><br/>
        <form method = "post">
            <input type = "text" name = "string"><br/>
            <button class="button buttonTicket" style="width:176px"> Submit </button>	
        </form>
        <?php
            if(isset($_SESSION['passhash'])){
                echo $_SESSION['passhash'];
                unset($_SESSION['passhash']);
                unset($_POST['string']);
            }
        ?>
    <form method = "post">
        <h1> Insert receiver's email </h1>
        <input type = "submit" name = "submit">
        <?php
            if(isset($_POST['submit'])){
                $to = "olszewski.maciej.mo@gmail.com";
                $subject = "Test mail sended from PHP";
                $message = "This message was sent to you via PHP";
                //mail($to, $subject, $message);
                //unset($_POST['submit']);
                
            }
            $hours = 2;
            //$ticketexpiration = new DateTime();
            //echo $ticketexpiration->format('Y-m-d H:i:s');
            //$ticketexpiration ->modify('+'.$hours.'hours');
            //echo "<br/>".$ticketexpiration->format('Y-m-d H:i:s');

            //$ticketexpiration -> modify('+'.$_SESSION['tickettime'].'hours');
            
            echo "<br/>".$ticketexpiration->format('Y-m-d H:i:s');
        ?>
    </form>
	</div></center>



</body>

</html>


