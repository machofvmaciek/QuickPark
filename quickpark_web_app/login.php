<?php 
	session_start();
	require_once "db_connection.php";
	
	if((!isset($_POST['login'])) || (!isset($_POST['password']))){
		header('Location: adminPage.php');
		exit();
	}

			//zmienna, do ktorej przypisujemy parametry polaczenia z MySql
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($connection->connect_errno != 0){
		echo "Error".$connection->connect_errno;
	}
	else{
			//odebranie z metody post w "adminPage.php" wartosci 'login' i 'password' oraz 
			//zapisanie ich do zmiennych php o tych samych nazwach
		$login = $_POST['login'];			 
		$password = $_POST['password'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$password = htmlentities($password, ENT_QUOTES, "UTF-8");
		
		//zapisanie tresci kwerendy
		
		if($answer = @$connection -> query(sprintf("SELECT * FROM users WHERE login='%s' AND password='%s' ",
		mysqli_real_escape_string($connection,$login),
		mysqli_real_escape_string($connection,$password)))){
			$howmanyusers = $answer->num_rows;			//zapisanie ilosci znalezionych rekordow, w celu sprawdzenia czy takie "konto" zostalo znalezione
			if($howmanyusers == 1){
				$_SESSION['userislogged'] = true;					//zmienna boolean zapisujaca, czy uzytkownik w sesji jest zalogowany
				
				$row = $answer -> fetch_assoc();					//utworzenie tablicy asocjacyjnej zapisanej w zmiennej $row
				$_SESSION['loggeduserid'] = 	$row['userid'];	//zapisanie, o jakim userid uzytkownik zalogowal sie
				$_SESSION['user'] = $row['login']; 					//przypisanie do zmiennej w sesji $user wartosci zapisanej w kolumnie login z pobranego rekordu
				$_SESSION['password'] = $row['password'];
				$answer -> free_result();								//uwolnienie pamieci zajetej przez rekordy odczytane z bazy
				unset($_SESSION['loggingerror']);					//odowolanie komunikatu o blednych danych logowania
				header('Location: adminControlPanel.php');
			}
			else{
				//echo "<h2> cos sie popsulo </h2>";
				$_SESSION['loggingerror'] = '<span style="color:red"> Invalid login or password! </span>';
				header('Location: adminPage.php');
				
			}
		}
		$connection->close();
	}
?>