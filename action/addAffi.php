<?php
include "../include/lib.php";

if ($_POST) {
    $cate = $_POST['cate'];
    $logo = $_FILES['logo']['name'];
    $name = $_POST['name'];
    $chk = $_POST['chk'];

    if ($cate === '') {
        alert('가맹점 분류를 선택하세요!');
    } else if ($logo === '') {     // logo가 선택되지 않았을 경우
        alert('로고를 등록하세요!');
    } else if ($name === '') {
        alert('가맹점 이름을 등록하세요!');
    } else if (is_uploaded_file($_FILES['logo']['tmp_name'])) { // logo가 업로드 되었을 경우
        $file = '../logo/' . $logo;

        if (move_uploaded_file($_FILES['logo']['tmp_name'], $file)) {
            // 수정일 경우
            if ($chk) {
                $pdo->query("update affi set cate = '$cate', logo = '$logo', name = '$name' where idx = '$chk'");
                alert('가맹정 수정이 완료되었습니다!');
            } else {
                $pdo->query("insert into affi(cate, logo, name, owner) values('$cate', '$logo', '$name', '$_SESSION[id]')");
                alert('가맹점이 등록되었습니다.');
            }
        }
    }
    back();
}
?>