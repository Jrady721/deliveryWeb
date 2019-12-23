<?php
include "../include/lib.php";

if ($_POST) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $cnt = $_POST['cnt'];
    $affi = $_POST['affi'];

    $pdo->query("insert into orderbox(name, price, cnt, affi, status, customer, date) values ('$name', '$price', '$cnt', '$affi', '주문대기', '$_SESSION[id]', now())");
//    alert('주문함에 등록되었습니다.');
    back();
}
?>