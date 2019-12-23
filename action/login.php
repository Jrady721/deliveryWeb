<?php
include "../include/lib.php";

$id = $_POST['id'];
$pw = $_POST['pw'];

if ($id === '' || $pw === '') {
    alert('로그인 폼을 정확히 채워주세요.');
} else {
    $member = $pdo->query("select * from member where id = '$id'")->fetch(2);

    if (!$member) {
        alert('존재하지 않는 아이디입니다!');
    } else if ($member['pw'] === $pw) {
        $_SESSION['id'] = $id;
        $_SESSION['auth'] = $member['auth'];
        alert('로그인 완료');
        move('/');
    } else {
        alert('비밀번호를 확인해주세요.');
    }
}
back();
?>