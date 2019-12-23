<?php
include "../include/lib.php";
if ($_GET) {
    $idx = $_GET['idx'];

    $menu = $pdo->query("select * from menus where idx = '$idx'")->fetch(2);


    // 현재 메뉴의 배송중이 있는 지 확인
    $cnt = $pdo->query("select * from orderbox where name = '$menu[name]' and status = '배송중'")->rowCount();

    // 배송중이 없을 때 삭제
    if (!$cnt) {
        $pdo->query("delete from menus where idx = '$idx'");
    } else {
        alert('배송중인 상품이 있어 삭제할 수 없습니다!');
    }
    back();
}