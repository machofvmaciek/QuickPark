<!DOCTYPE HTML>
<html lang="eng">

<head>
	<meta charset="utf-8" />
	<title>QuickPark</title>

	<meta name="description" content="Intelligent shopping mall parking system" />

	<link rel="stylesheet" href="style_grid.css" type="text/css" />
	<link rel="icon" href="img/parking_icon.jpg">

	<style>
	</style>
</head>

<body>
	<div class="container ">
		<div class="logo grid_column_span_3">
			<center><img src="img/logo4.png" width="523" height="242" /></center>
		</div>
		<div class="FatText grid_column_span_3">
			<center>
				Welcome to QuickPark - intelligent parking!
			</center>
		</div>
		<div class = "buttons">
			<div class="TicketBuy">
				<form action="biletomat.php">
					 <button class="button buttonTicket"> Buy a ticket! </button> 
				</form>

			</div>

			<div class="CustomerMap">
				<form action="customerMap.php">
					<button class="button buttonMap"> Open interactive map </button> 
				</form>

			</div>

			<div class="AdminPage">
				<form action="adminPage.php">
					 <button class="button buttonAdmin"> Administration panel </button>
				</form>
			</div>
			
		</div>
		<div class = "footer">
			<span style="font-weight: 700;">QuickPark.com &copy; 2021</span>
		</div>
		
	</div>

</body>

</html>