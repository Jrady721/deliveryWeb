<?php
header('Content-Type: image/png');

// map 붙이기
$bg = imagecreatetruecolor(717, 350);
$map = imagecreatefromjpeg('../assets/images/map.jpg');

$userMark = imagecreatefrompng('../assets/images/red_map_marker.png');
$blueMark = imagecreatefrompng('../assets/images/blue_map_marker.png');
$pinkMark = imagecreatefrompng('../assets/images/pink_map_marker.png');

// map
imagecopy($bg, $map, 0, 0, 0, 0, 717, 350);

// get
$user = explode(',', $_GET['user']);
$marks = $_GET['mark'];
$chk = explode(',', $_GET['chk']);

// user
imagecopy($bg, $userMark, $user[0] - 10, $user[1] - 31, 0, 0, 20, 31);

// marks
$marks = explode('/', $marks);
for ($i = 0; $i < count($marks) - 1; $i++) {
    $mark = explode(',', $marks[$i]);
    imagecopy($bg, $blueMark, $mark[0] - 10, $mark[1] - 31, 0, 0, 20, 31);
}

// chk
if ($chk[0] !== '') imagecopy($bg, $pinkMark, $chk[0] - 10, $chk[1] - 31, 0, 0, 20, 31);

imagegif($bg);
imagedestroy($bg);
?>