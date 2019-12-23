<?php
include "../include/lib.php";

if ($_POST) {
    $star = $_POST['star'];
    $content = $_POST['content'];

    $affi = $_POST['affi'];
    $customer = $_SESSION['id'];

    $code = $_POST['code'];

    $chk = $pdo->query("select * from reviews where code = '$code'")->rowCount();
    if (!$chk) {
        $pdo->query("insert into reviews(star, content, affi, customer, code, date) values('$star', '$content', '$affi', '$customer', '$code', now())");
        alert('리뷰가 작성되었습니다!');
    }
    move('/page/details.php');
}
?>