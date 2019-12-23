<?php
include "../include/lib.php";
if (isset($_GET['idx'])) {
    $pdo->query("delete from orderbox where customer = '$_SESSION[id]' and idx= '$_GET[idx]' and status = '주문대기'");
} else {
    $pdo->query("delete from orderbox where customer = '$_SESSION[id]' and status = '주문대기'");
}
back();
?>