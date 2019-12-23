<?php
include "../include/lib.php";

if ($_POST) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $chk = $_POST['chk'];

    if ($name === '' || $price === '') {
        alert('메뉴 폼을 정확히 입력해주세요');
        back();
    }

    if ($chk) {
        $pdo->query("insert into menus(name, price, date, affi) values ('$name', '$price', now(), '$_SESSION[id]')");
        alert('메뉴가 등록되었습니다.');
    } else {
        alert('가맹점이 등록되지 않았습니다.');
    }
    back();
}
?>