<?php
// db connect
$pdo = new PDO('mysql:host=localhost; dbname=delivery2', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('set names utf8');

// default timezone set
date_default_timezone_set('Asia/Seoul');

// session start
session_Start();

// add admin
$chk = $pdo->query("select * from member")->rowCount();
if (!$chk) $pdo->query("insert into member(id, name, pw, auth) values('master', '관리자', '1234', 'C')");

// page title setting
$page = basename($_SERVER['PHP_SELF']);
$page = substr($page, 0, strlen($page) - 4);

switch ($page) {
    case 'login': authChk('A');  $pTitle = '로그인'; break;
    case 'join': authChk('A');  $pTitle = '회원가입'; break;
    case 'myinfomodify': authChk('MP'); $pTitle = '내 정보변경'; break;
    case 'order': authChk('M'); $pTitle = '주문하기'; break;
    case 'order-menu': $pTitle = '메뉴주문'; break;
    case 'order-review': $pTitle = '리뷰보기'; break;
    case 'details': authChk('MC'); $pTitle = '주문내역'; break;
    case 'details-review': $pTitle = '리뷰작성'; break;
    case 'affiliation': authChk('PC'); $pTitle='가맹회원'; break;
    default: $pTitle = '';
}

// functions
function alert($msg) {
    echo("<script>alert('$msg')</script>");
}

function move($url) {
    echo("<script>location.href = '$url'</script>");
}

function back() {
    echo("<script>history.back()</script>");
}

function notAuth() {
    alert('접근권한이 없습니다.');
    move('/');
}

// auth chk
function authChk($auth) {
    switch ($auth) {
        case 'A': if (isset($_SESSION['id'])) notAuth(); break;
        case 'MP': if (!isset($_SESSION['auth']) || ($_SESSION['auth'] !== 'M' && $_SESSION['auth'] !== 'P')) notAuth(); break;
        case 'M': if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== 'M') notAuth(); break;
        case 'MC': if (!isset($_SESSION['auth']) || ($_SESSION['auth'] !== 'M' && $_SESSION['auth'] !== 'C')) notAuth(); break;
        case 'PC': if (!isset($_SESSION['auth']) || ($_SESSION['auth'] !== 'P' && $_SESSION['auth'] !== 'C')) notAuth(); break;
    }
}

?>