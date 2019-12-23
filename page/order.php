<?php include "../include/header.php"; ?>

<?php
// 카테고리 & 검색 & 정렬 설정
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$cate = isset($_GET['cate']) ? $_GET['cate'] : '';
?>
    <!-- contents start -->
    <div class="col-12">
        <div class="row">
            <div class="form-group col-12">
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="50" class="selectgroup-input" checked="">
                        <span class="selectgroup-button"
                              onclick="location.href='?cate=&search=<?php echo $search; ?>&sort=<?php echo $sort; ?>'">전체보기</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="value" <?php if ($cate === 'kr') echo 'checked' ?> value="100"
                               class="selectgroup-input">
                        <span class="selectgroup-button"
                              onclick="location.href='?cate=kr&search=<?php echo $search; ?>&sort=<?php echo $sort; ?>'">한식</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="100"
                               class="selectgroup-input" <?php if ($cate === 'cn') echo 'checked' ?>>
                        <span class="selectgroup-button"
                              onclick="location.href='?cate=cn&search=<?php echo $search; ?>&sort=<?php echo $sort; ?>'">중식</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="100"
                               class="selectgroup-input" <?php if ($cate === 'jp') echo 'checked' ?>>
                        <span class="selectgroup-button"
                              onclick="location.href='?cate=jp&search=<?php echo $search; ?>&sort=<?php echo $sort; ?>'">일식</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="100"
                               class="selectgroup-input" <?php if ($cate === 'ck') echo 'checked' ?>>
                        <span class="selectgroup-button"
                              onclick="location.href='?cate=ck&search=<?php echo $search; ?>&sort=<?php echo $sort; ?>'">치킨</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="100"
                               class="selectgroup-input" <?php if ($cate === 'pz') echo 'checked' ?>>
                        <span class="selectgroup-button"
                              onclick="location.href='?cate=pz&search=<?php echo $search; ?>&sort=<?php echo $sort; ?>'">피자</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="100"
                               class="selectgroup-input" <?php if ($cate === 'nm') echo 'checked' ?>>
                        <span class="selectgroup-button"
                              onclick="location.href='?cate=nm&search=<?php echo $search; ?>&sort=<?php echo $sort; ?>'">야식</span>
                    </label>
                </div>
            </div>

            <div class="form-group col-4">
                <div class="row gutters-xs">
                    <div class="col">
                        <input type="text" class="form-control" id="search" placeholder="가맹점검색" onclick="">
                    </div>
                    <span class="col-auto">
                      <button class="btn btn-secondary" type="button"
                              onclick="location.href=`?cate=<?php echo $cate; ?>&search=${$('#search').val()}&sort=<?php echo $sort; ?>`"><i
                                  class="fe fe-search"></i></button>
                    </span>
                </div>
            </div>

            <div class="form-group col-8 mt-2">
                <div class="custom-controls-stacked">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="example-inline-radios"
                               value="option1" <?php if ($sort === 'star') echo 'checked'; ?>>
                        <span class="custom-control-label"
                              onclick="location.href=`?cate=<?php echo $cate; ?>&search=<?php echo $search; ?>&sort=star`">평점순</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="example-inline-radios"
                               value="option2" <?php if ($sort === 'review') echo 'checked'; ?>>
                        <span class="custom-control-label"
                              onclick="location.href=`?cate=<?php echo $cate; ?>&search=<?php echo $search; ?>&sort=review`">리뷰순</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="example-inline-radios"
                               value="option3" <?php if ($sort === 'd') echo 'checked'; ?>>
                        <span class="custom-control-label"
                              onclick="location.href=`?cate=<?php echo $cate; ?>&search=<?php echo $search; ?>&sort=d`">가까운지점</span>
                    </label>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-map card-map-placeholder">
                        <div id="map" style="float: left">
                            <img src="../assets/images/map.jpg" id="map">
                        </div>
                        <h3 class="text-center mt-6">전체보기</h3>
                        <table style="width: 433px; height: 220px;">
                            <tr>
                                <td style="vertical-align: middle;" class="text-left">
                                    <p><img src="../assets/images/red_map_marker.png"
                                            style="vertical-align: bottom; margin-left: 150px;"> &nbsp;&nbsp;회원위치</p>
                                    <p><img src="../assets/images/blue_map_marker.png"
                                            style="vertical-align: bottom; margin-left: 150px;"> &nbsp;&nbsp;가맹점위치</p>
                                    <p><img src="../assets/images/pink_map_marker.png"
                                            style="vertical-align: bottom; margin-left: 150px;"> &nbsp;&nbsp;위치표시 가맹점
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <table class="table card-table table-vcenter affiliationList">
                        <tbody>
                        <?php
                        // 평점, 리부갯수, 가맹점 위치 구하기
                        $member = $pdo->query("select * from member where id = '$_SESSION[id]'")->fetch(2);

                        $affies = $pdo->query("select * from affi")->fetchAll(2);
                        foreach ($affies as $affi) {
                            // 메뉴 갯수
                            $menus = $pdo->query("select * from menus where affi = '$affi[owner]'")->rowCount();

                            // 리뷰 갯수
                            $reviews = $pdo->query("select * from reviews where affi = '$affi[owner]'");
                            $cnt = $reviews->rowCount();

                            // 평점 구하기
                            $reviews = $reviews->fetchAll(2);
                            $sum = 0;
                            foreach ($reviews as $review) {
                                $sum += $review['star'];
                            }
                            // sum이 0일 경우 평점은 0점
                            $star = ($sum) ? round($sum / $cnt) : 0;

                            $ownerPos = $pdo->query("select * from member where id = '$affi[owner]'")->fetch(2)['pos'];

                            // 거리구하기
                            $pos = explode(',', $member['pos']);

                            $affiPos = explode(',', $ownerPos);

                            $x = $pos[0] - $affiPos[0];
                            $y = $pos[1] - $affiPos[1];

                            // 제곱
                            $x = pow($x, 2);
                            $y = pow($y, 2);

                            // 제곱근
                            $d = sqrt($x + $y);

                            $pdo->query("update affi set menus = '$menus', review = '$cnt', star = '$star', pos = '$ownerPos',  d = '$d' where owner = '$affi[owner]'");
                        }

                        // 카데고리가 있을경우
                        if ($cate !== '') $cate = " cate = '" . $cate . "' and ";

                        $sql = "select * from affi where " . $cate . " name like '%$search%' and menus > 0";

                        if ($sort === 'star') {
                            $sql .= " order by star desc, review desc";
                        } else if ($sort === 'review, star desc') {
                            $sql .= " order by review desc";
                        } else if ($sort === 'd') {
                            $sql .= " order by d asc";
                        }
                        $affies = $pdo->query($sql)->fetchAll(2);
                        foreach ($affies as $affi) { ?>
                            <tr>
                                <td style="width: 10%;"><img src="/logo/<?php echo $affi['logo']; ?>" alt=""
                                                             class="h-8">
                                </td>
                                <td>
                                    <a href='/page/order-menu.php?name=<?php echo $affi['name']; ?>&affi=<?php echo $affi['owner']; ?>'>
                                        <h5><?php echo $affi['name']; ?></h5>
                                        <ul class="list">
                                            <li>
                                                <span class="title">평점</span>
                                                <span class="badge badge-primary"><?php echo number_format($affi['star']); ?>
                                                    점</span>
                                            </li>
                                            <li>
                                                <span class="title">리뷰</span>
                                                <span class="badge badge-primary"><?php echo number_format($affi['review']); ?>
                                                    개</span>
                                            </li>
                                        </ul>
                                    </a>
                                </td>
                                <td>
                                    가맹점위치<br>
                                    회원위치정보(<span class="position"><?php echo $member['pos']; ?></span>),
                                    가맹점위치정보(<?php echo $affi['pos']; ?>)<br>
                                    회원위치와 가맹점간의 거리 = <?php echo $affi['d']; ?>
                                </td>
                                <td class="text-right">
                                    <label class="custom-switch">
                                        <span class="pos" style="display: none;"><?php echo $affi['pos']; ?></span>
                                        <input type="radio" name="option" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">위치표시</span>
                                    </label>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            mark();
            posToggle();
            searchToggle();
        });

        $(document).on("click", '.custom-switch-input', function () {
            let cl = $(this).prev().attr('class');
            if (cl === 'pos') {
                $('.custom-switch > span:first-child').attr('class', 'pos');
                $(this).prev().attr('class', 'chkPos');
            } else {
                $(this).prev().attr('class', 'pos');
            }
            mark();
        });

        function mark() {
            var user = '<?php echo $member['pos']; ?>';

            let mark = '';
            $('.pos').each(function () {
                mark += $(this).text();
                mark += '/';
            });

            let chk = $(document).find('.chkPos').text();

            var img = `/action/img.php?user=${user}&mark=${mark}&chk=${chk}`;
            $('#map img').attr('src', img);
        }
    </script>

    <!-- contents end -->
<?php include "../include/footer.php"; ?>