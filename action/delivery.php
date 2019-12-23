<?php
include "../include/lib.php";

if ($_GET) {
    $code = $_GET['code'];
    $pdo->query("update orderbox set status = '배송완료' where code = '$code'");
    back();
}
?>