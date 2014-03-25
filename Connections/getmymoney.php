<?php //initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php require_once('chanceamigo.php'); ?>
<?php


mysql_select_db($database_chanceamigo, $chanceamigo);
$query_transactions = sprintf("SELECT price as money, type FROM transactions WHERE id_user_to = " . $_SESSION['MM_Usernameid']);
$transactions = mysql_query($query_transactions, $chanceamigo) or die(mysql_error());
$row_transactions = mysql_fetch_assoc($transactions);
$totalRows_transactions = mysql_num_rows($transactions);

$mymoney = 0;
do {
        if ($row_transactions['type'] == "D") {
                $mymoney  =  $mymoney  + $row_transactions['money'];
        } else if ($row_transactions['type'] == "R") {
                $mymoney  =  $mymoney  - $row_transactions['money'];
        }
} while ($row_transactions = mysql_fetch_assoc($transactions));



?>

<div class="panel">
	<img src="images/boy/money.svg" />
	<h1>$  <?php  printf("%1\$.2f", $mymoney); ?></h1>
    <h2>Saldo a la Fecha</h2>
    <p><?php $mydate=getdate(date("U"));echo "$mydate[mday]/$mydate[mon]/$mydate[year]";?></p>

</div>
    