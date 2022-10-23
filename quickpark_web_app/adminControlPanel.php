<?php
session_start();
if(!isset($_SESSION['userislogged'])){
	header('Location: adminPage.php');
	exit();
}

switch($_POST['sortorder']){
	case "Ticket ID":
		$orderby = "idticket";
		break;
	case "Place ID":
		$orderby = "idmiejsca";
		break;
	case "Registration plates":
		$orderby = "rejestracja";
		break;
	case "Newest":
		$orderby = "czas_start";
		break; 
	default:
		echo "Wrong order property";
}
//echo $orderby;
/*
$time = new DateTime();
switch($_POST['filter']){
	case "Today":
		$time -> modify('-1 day');	
		break;
	case "This week":
		break;
		
}

if(isset($_POST['filter'])){
	$querystr = "SELECT * FROM tickets WHERE (`data_czas` < .$time.)";
}
*/
$querystr = "SELECT * FROM tickets";
if(isset($orderby)){
	$querystr = "SELECT * FROM tickets ORDER BY `tickets`.`".$orderby."` ASC";
}
if($orderby == "czas_stop"){
	$querystr = "SELECT * FROM tickets ORDER BY `tickets`.`".$orderby."` DESC";
}


/*
$order = "ASC";
if($order == "ASC"){
	$order = "DESC";
	//echo "warunek order to desc spelniony";
}
else {
	$order = "ASC";
}
if(isset($_POST['sortTicketID'])){
	
	echo $order;
	//$querystr = "SELECT * FROM tickets ORDER BY ticketid DESC";
	//$querystr = "SELECT * FROM `tickets` ORDER BY `tickets`.`idticket` DESC";
	$querystr = "SELECT * FROM `tickets` ORDER BY `tickets`.`idticket`".$order;
	 

	//unset($_POST['sortTicketID']);
}
*/
require_once "db_connection.php";
mysqli_report(MYSQLI_REPORT_STRICT);

try{
	$connection = new mysqli($host, $db_user, $db_password, $db_name);
	if($connection -> connect_errno != 0){
		throw new Exception(mysqli_connect_errno());
	}
	else{
		$answer = $connection -> query($querystr);	//zapisanie statusu miejsc
		if(!$answer) throw new Exception($connection -> error);
		
	}
}
catch(Exception $e){
	echo '<div class = "error">Server error, we apologize for inconvenience</div>';
	echo '<br/> devinfo:'.$e;
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Admin Panel - QuickPark</title>
	<meta name="description" content="Intelligent shopping mall parking system" />
	
	<link rel="stylesheet" href="style_adminpage.css" type="text/css"/>
	<link rel="icon" href="img/parking_icon.jpg">
	<style>
	

	</style>
</head>

<body>
	<div id="container">
		<div id="logo">
			<center> <img src = "img/logo1.png" width="261" height="121"/> </center>
		</div>
			
		<div id="TopText">
			<h1  style="margin-left:220px"> Welcome to the Admin Control Panel </h1>
		</div>
		
		<div id="logout">
			<form action="logout.php">
				<button class="button buttonAdmin" style="width: 100px"><span style="color: green"> Log out </span></button>
			</form>
		</div>
		
		
		
		<div id="jakies">
			<?php
				echo "<center><h2> You are logged as ".$_SESSION['user'] ;
			?>
		</div>
		<div class = "sort">
			<form action="adminControlPanel.php" method="post">
  				<label for="sortorders">Sort by:</label>
  				<input list="sortorders" name="sortorder" id="sortorder">
  					<datalist id="sortorders">
    					<option value="Ticket ID">
    					<option value="Place ID">
					    <option value="Registration plates">
    					<option value="Newest">
    					<option value="Oldest">
  					</datalist>
  				<input type="submit">
			</form>
		</div>
		<div class = "filter">
			<form action="adminControlPanel.php" method="post">
  				<label for="filters">Filter:</label>
  				<input list="filters" name="filter" id="filter">
  					<datalist id="filters">
    					<option value="Today">
    					<option value="This week">
  					</datalist>
  				<input type="submit">
			</form>
		</div>
		<form action = "adminControlPanel.php" method = "post">
			<input type="submit" name="sortTicketID" value="TicketID">
		</form>

		<table class = "TicketsTable">
			<tr>
				<th><a class="column-sort" id="ticketid" data-order="desc" href="#">Ticket ID</a></th>
				<th><a class="column-sort" id="idmiejsca" data-order="desc" href="#">Place ID</a></th>
				<th><a class="column-sort" id="regplate" data-order="desc" href="#">Registration Plates</a></th>
				<th><a class="column-sort" id="timestart" data-order="desc" href="#">Time start</a></th>
				<th><a class="column-sort" id="timestop" data-order="desc" href="#">Time stop</a></th>
			</tr>
			<?php
				//while($row = $answer ->fetch_assoc()){
				while($row = mysqli_fetch_array($answer))
				{
			?>
			<tr>
				<td><?php echo $row['idticket'];?></td>
				<td><?php echo $row['idmiejsca'];?></td>
				<td><?php echo $row['rejestracja'];?></td>
				<td><?php echo $row['czas_start'];?></td>
				<td><?php echo $row['czas_stop'];?></td>
			</tr>
			<?php	
				}
			?>
		</table>
	</div>
		


</body>

</html>
