<?php
session_start();

if (isset($_POST['placenumber'])) {
	//udana walidacja formularza
	$formOK = true;
	//sprawdzenie poprawnosci wpisanego adresu email
	$email_unsafe = $_POST['email'];
	$_SESSION['email'] = filter_var($email_unsafe, FILTER_SANITIZE_EMAIL);
	if((filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL) == false) || ($_SESSION['email'] != $email_unsafe )){
		$formOK = false;
		$_SESSION['e_email'] = "Enter a valid email address!";
	}
	//sprawdzenie poprawnosci numeru miejsca
	$_SESSION['placeid'] = $_POST['placenumber'];
	//sprawdzenie, czy placeid skalda sie tylko z cyfr
	if (!(ctype_digit($_SESSION['placeid']))) {
		$formOK = false;
		$_SESSION['e_placeid'] = "Enter a valid place number";
	}
	//sprawdzenie poprawnosci numeru tablicy rejestracyjnej	
	$_SESSION['regplate'] = $_POST['plates'];
	//sprawdzenie dlugosci tablicy rejestracyjnej
	if ((strlen($_SESSION['regplate']) < 7) || (strlen($_SESSION['regplate']) > 9)) {
		$formOK = false;
		$_SESSION['e_regplate'] = "Enter a registration plates number of a valid length";
	}
	//sprawdzenie czy regplate jest alfanumeryczne
	if (!(ctype_alnum($_SESSION['regplate']))) {
		$formOK = false;
		$_SESSION['e_regplate'] = "Enter a valid registration plates number</br> It should not contain any special signs";
	}
	//przetworzenei czasu waznosci biletu
	//sprawdzenie czy zostala wybrana ilosc czasu

	if ((empty($_POST['tickettime']))) {
		$formOK = false;
		$_SESSION['e_tickettime'] = "Choose ticket time";
	} else {
		$_SESSION['tickettime'] = $_POST['tickettime'];
	}

	//sprawdzenie, czy checkbox terms zostal zazanczony
	if (!(isset($_POST['regulations']))) {
		$formOK = false;
		$_SESSION['e_regulations'] = "Please accept Terms of use before continuing";
	}
	
	//sprawdzenie, czy recaptcha zostala potwierdzona
	$CAPTCHAsecretkey = "6LfWMhcdAAAAAGtG6nS9XefXFkS8HUSeaBaaP10w";
	$CAPTCHAanswer = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$CAPTCHAsecretkey.'&response='.$_POST['g-recaptcha-response']));
	if($CAPTCHAanswer->success == false){
		$formOK = false;
		$_SESSION['e_captcha'] = "Please confirm you're a human!";
	}



	//wszystkie dane z formularza sa poprawne
	if ($formOK == true) {
		//przesylamy formularz z ticketem do bazy danych
		//echo "Jest git";
		$_SESSION['TicketCheckOK'] = true;
		$_SESSION['regplate'] = strtoupper($_SESSION['regplate']);
		header('Location: TicketCheck.php');
		//exit();
	}
}

?>
<!DOCTYPE HTML>
<html lang="eng">

<head>
	<meta charset="utf-8" />
	<title>Tickets - QuickPark</title>
	<meta name="description" content="Intelligent shopping mall parking system" />
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<link rel="stylesheet" href="style_subpage_grid_v2.css" type="text/css" />
	<link rel="icon" href="img/parking_icon.jpg">


</head>

<body>
	<div id="container">

		<div id="logo">
			<center> <img src="img/logo4.png" width="261" height="121" /> </center>
		</div>
		<div class="navigation">
			
			<ul>
				<li><a href="index.php" style="text-decoration:none">Homepage</a></li>
				<li><a href="biletomat.php" style="text-decoration:none">Ticket shop</a></li>
				<li><a href="customerMap.php" style="text-decoration:none">Parking map</a></li>
				<li><a href="terms.php" style="text-decoration:none">Terms of use</a></li>
			</ul>
			
		</div>

		<form method="post">
			<div class = "HeaderText grid_column_span_3">Buy a ticket</div>
			
			<div class = "SubHeaderText grid_column_span_3 bottom_underline">To order a ticket you're ought to insert following informations:</div>
						
				<div class = "InputText InputTextEmail">Your email:</div>
				<div class = "JustInput JustInputEmail">
					<input type = "email" name = "email" placeholder="Email address">
				</div>
				<div class = "error errorEmail">
					<?php	//wyswietlanie bledu wpisanego adresu email							
						if (isset($_SESSION['e_email'])) {
							echo $_SESSION['e_email']; 
							unset($_SESSION['e_email']);
						}
					?>
				</div>		
				
				<div class = "InputText InputTextPlaceNumber">Parking lot number:</div>
				<div class = "JustInput JustInputPlaceNumber">
					<input type="number" name="placenumber" min="1" max="10" placeholder="Where have you parked?">
					
				</div>
				<div class = "error errorPlaceNumber">
					<?php	//wyswietlanie bledu wpisanych danych
						if (isset($_SESSION['e_placeid'])) {
							echo $_SESSION['e_placeid'];
							unset($_SESSION['e_placeid']);
						}
					?>
				</div>

				<div class = "InputText InputTextRegplate">Registration plates:</div>
				<div class = "JustInput JustInputRegplate">
					<input type="text" name="plates" placeholder="Your plates">
				</div>
				<div class = "error errorRegplate">
					<?php	//wyswietlanie bledu wpisanych danych
						if (isset($_SESSION['e_regplate'])) {
							echo $_SESSION['e_regplate'];
							unset($_SESSION['e_regplate']);
						}
					?>
				</div>
				
				<div class = "InputText InputTextExpTime">Expiration time:</div>
				<div class = "JustInput JustInputExpTime">
					<input type="number" name="tickettime" min="1" max="5" placeholder = "How many hours?">
				</div>
				<div class = "error errorExpTime">
					<?php	//wyswietlanie bledu nie wybrania czasu
						if (isset($_SESSION['e_tickettime'])) {
							echo $_SESSION['e_tickettime'];
							unset($_SESSION['e_tickettime']);
						}
					?>
				</div>
			
				<div class = "checkbox">
						<label>
							<input type="checkbox" name="regulations"><span style = "color: rgb(19, 10, 78);">Accept <a href="terms.php">Terms & Rules</a></span>
						</label>
				</div>
				<div class = "error errorCheckbox">
					<?php	//wyswietlanie nie zaznaczenia checkboxa
						if (isset($_SESSION['e_regulations'])) {
							echo '<div class = "error">' . $_SESSION['e_regulations'] . '</div>';
							unset($_SESSION['e_regulations']);
						}
					?>
				</div>
						
				<div class="g-recaptcha" data-sitekey="6LfWMhcdAAAAAMynWuiq-PhUkzglZEMLhGf0iJlm"></div>
				<div class = "error errorCaptcha">
					<?php	//wyswietlanie niepotwierdzonej recaptchy
						if(isset($_SESSION['e_captcha'])){
							echo '<div class = "error">' . $_SESSION['e_captcha'] . '</div>';
							unset($_SESSION['e_captcha']);
						}
					?>
				</div>

				<button class="button buttonSubmit grid_column_span_3" >Get a ticket!</button>

		</form>
		<div class = "footer">
			<span style="font-weight: 700;">QuickPark.com &copy; 2021</span>
		</div>
</body>

</html>