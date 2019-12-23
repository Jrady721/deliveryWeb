<?php
include "../include/lib.php";

if ($_POST) {
    $pw = $_POST['pw'];
    $phone = $_POST['phone'];
    $pos = $_POST['pos'];

    if ($pw === '') {
        alert('비밀번호를 입력되지 않아 수정이 불가합니다!');
    } else {
        $error = '';
        // 형식 검증
        if (!ctype_alnum($pw) || strlen($pw) < 4 || strlen($pw) > 8) $error .= '비밀번호[영문, 숫자 조합 4~8자 이내]\n';
        if (!preg_match("/^[0-9]{4}-[0-9]{4}-[0-9]{4}$/", $phone)) $error .= '전화번호[000-0000-0000 형식]\n';
        if ($pos === '') $error .= '위치 정보[필수 입력]\n';

        if ($error !== '') {
            alert($error . '* 위의 형식에 따라 작성해주세요! *');
        } else {
            $pdo->query("update member set pw = '$pw', phone= '$phone', pos = '$pos' where id = '$_SESSION[id]'");
            alert('회원정보가 수정되었습니다!');
        }
    }
    move('/page/myinfomodify.php');
}
?>