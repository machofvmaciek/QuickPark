<?php
	require_once "db_connection.php";
	header("Refresh: 3");
	mysqli_report(MYSQLI_REPORT_STRICT);
	try{
		$connection = new mysqli($host, $db_user, $db_password, $db_name);
		if($connection -> connect_errno != 0){
			throw new Exception(mysqli_connect_errno());
		}
		else{
			$answer = $connection -> query("SELECT status FROM places");	//zapisanie statusu miejsc
			if(!$answer) throw new Exception($connection -> error);
			$i = 0;
			$freespaces = 2;
			$text_color = '#28dd7a';
			$text_color_shadow = '#166e45';
			while($row = $answer ->fetch_assoc()){
				
				$places[$i] = $row['status'];
				//echo $i."   ".$row['status']."</br>";
				//echo $freespaces;		//ttuaj
				if($places[$i] == 0){
					//$color[$i] = '#FF0000';
					$color[$i] = '#ee6055';
					$freespaces--;
				}
				else{
					//$color[$i] = '#00FF00';
					$color[$i] = '#28dd7a';
					
				}
				if($freespaces == 0){
					$text_color = '#ee6055';
					$text_color_shadow = '#a13028';
				}
				$i++;
				
			}
		}
	}
	catch(Exception $e){
		echo '<div class = "error">Server error, we apologize for inconvenience</div>';
		echo '<br/> devinfo:'.$e;
	}
?>
<!DOCTYPE HTML>
<html lang="eng">

<head>
	<meta charset="utf-8" />
	<title>Map - QuickPark</title>
	<meta name="description" content="Intelligent shopping mall parking system" />
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<link rel="stylesheet" href="style_map_grid.css" type="text/css" />
	<link rel="icon" href="img/parking_icon.jpg">
    <style>
		
		.placeind0{
			background-color: <?php echo $color[0]?>;
		}
		.placeind1{
			background-color: <?php echo $color[1]?>;
		}
		.greentext{
    		font-size: 50px;
			color: <?php	echo $text_color?>;
    		text-shadow: 3px 3px <?php	echo $text_color_shadow?>
		}		
	</style>

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

		<div id="content">
            <div class = "HeaderText">Parking Map diagram</div>
			<div class = "SubHeaderText SubHeaderTextFreeSpaces">
				<span class = "greentext"><?php	echo $freespaces; ?></span> free spaces!
			</div>
			
            <div class = "placeindicator placeind0">
		    	Place 1
		    </div>

            <div class = "placeindicator placeind1">
				Place 2
		    </div>
        </div>
    </div>
	<div class = "footer">
		<span style="font-weight: 700;">QuickPark.com &copy; 2021</span>
	</div>

		
</body>

</html>