<?php
include "../include/lib.php";

// 판매수량 증가
$orders = $pdo->query("select * from orderbox where customer = '$_SESSION[id]' and status = '주문대기'")->fetchAll(2);
$sum = 0;
foreach ($orders as $order) {
    $pdo->query("update menus set cnt = cnt + $order[cnt] where name = '$order[name]'");
    // 임시.. DB를 초기화 안하고 할 시 에러
    $code = $pdo->query("select * from orderlist")->rowCount() + 1;
    $pdo->query("update orderbox set status = '배송중', code = '$code' where customer = '$_SESSION[id]' and status = '주문대기'");
    $sum += $order['price'] * $order['cnt'];
}
$pdo->query("insert into orderlist(price, customer, date) values('$sum', '$_SESSION[id]', now())");
back();
?>
