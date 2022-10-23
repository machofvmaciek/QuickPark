<?php
require_once "db_connection.php";
$connection = new mysqli($host, $db_user, $db_password, $db_name);
$output = ' ';
$order = $_POST['order'];       //jak cos tutaj cudzyslowy zamiast apostrofow
if($order == 'desc'){
    $order = 'asc';
}
else{
    $order = 'desc';
}
//query = "
$result = $connection -> query("SELECT * FROM tickets ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."");
$output .= '
    <table class = "TicketsTable">
        <tr>
            <th><a class="column-sort" id="ticketid" data-order="'.$order.'" href="#">Ticket ID</a></th>
            <th><a class="column-sort" id="idmiejsca" data-order="'.$order.'" href="#">Place ID</a></th>
            <th><a class="column-sort" id="regplate" data-order="'.$order.'" href="#">Registration Plates</a></th>
            <th><a class="column-sort" id="timestart" data-order="'.$order.'" href="#">Time start</a></th>
            <th><a class="column-sort" id="timestop" data-order="'.$order.'" href="#">Time stop</a></th>
        </tr>
        ';
while($row = mysqli_fetch_array($result))
{
    $output .='
    <tr>
        <td>' . $row['idticket'] . '</td>
        <td>' . $row['idmiejsca'] . '</td>
        <td>' . $row['rejestracja'] . '</td>
        <td>' . $row['czas_start'] . '</td>
        <td>' . $row['czas_stop'] . '</td>
    </tr>
    ';
}
$output .= '</table>';
echo $output;
?>