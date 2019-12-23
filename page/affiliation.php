<?php include "../include/header.php"; ?>

<?php
$owner = isset($_GET['owner']) ? $_GET['owner'] : '';
?>
    <!-- contents start -->
    <div class="col-12">
        <div class="row">
            <div class="card">
                <?php
                $name = '';
                $cate = '';
                $affi = $pdo->query("select * from affi where owner = '$_SESSION[id]'")->fetch(2);
                $chk = $affi['idx'];
                $name = $affi['name'];
                $cate = $affi['cate'];
                ?>
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">가맹정등록</h3>
                </div>
                <div class="card-body1 p-5">
                    <form action="/action/addAffi.php" method="post" enctype="multipart/form-data">
                        <div class="form-group col-12">
                            <label class="form-label">가맹점분류</label>
                            <select class="custom-select col-2" name="cate">
                                <option value="">가맹점분류선택</option>
                                <option value="kr" <?php if ($cate === 'kr') echo 'selected'; ?>>한식</option>
                                <option value="ch" <?php if ($cate === 'ch') echo 'selected'; ?>>중식</option>
                                <option value="jp" <?php if ($cate === 'jp') echo 'selected'; ?>>일식</option>
                                <option value="ck" <?php if ($cate === 'ck') echo 'selected'; ?>>치킨</option>
                                <option value="pz" <?php if ($cate === 'pz') echo 'selected'; ?>>피자</option>
                                <option value="nm" <?php if ($cate === 'nm') echo 'selected'; ?>>야식</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label">가맹점로고</label>
                            <input type="file" class="form-control" value="logo_1.png" name="logo">
                        </div>

                        <div class="form-group col-12">
                            <label class="form-label">가맹점명</label>
                            <input type="text" class="form-control" value="<?php echo $name; ?>" name="name">
                        </div>
                        <?php if ($chk) { ?>
                            <div class="col-12"
                                 onclick="location.href='/page/affiliation.php?idx=<?php echo $affi['idx']; ?>'">
                                <img src="/logo/<?php echo $affi['logo']; ?>">
                                <strong><?php echo $affi['name']; ?></strong>
                            </div>
                        <?php } ?>
                        <input type="hidden" name="chk" value="<?php echo $chk; ?>">
                        <div class="form-footer col-12">
                            <button type="submit" class="btn btn-primary btn-block">가맹점등록</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-7">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">메뉴등록</h3>
                </div>
                <div class="card-body1 p-5">
                    <form action="/action/addMenu.php" method="post">
                        <div class="form-group col-12">
                            <label class="form-label">메뉴이름</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group col-12">
                            <label class="form-label">가격</label>
                            <input type="text" name="price" class="form-control">
                        </div>
                        <input type="hidden" name="chk" value="<?php echo $chk; ?>">
                        <div class="form-footer col-12">
                            <button type="submit" class="btn btn-primary btn-block">메뉴등록</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-7">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">메뉴목록</h3>
                </div>
                <div class="card-body1 p-5">
                    <div class="table-responsive">
                        <table class="table table-bordered table-vcenter text-nowrap card-table menuTable"
                               style="border-top: 1px solid rgba(0, 40, 100, 0.12)">
                            <thead>
                            <tr>
                                <th>메뉴이름</th>
                                <th>가격</th>
                                <th>판매수량</th>
                                <th>등록일</th>
                                <th>메뉴삭제</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $menus = $pdo->query("select * from menus where affi = '$_SESSION[id]' order by idx desc")->fetchAll(2);

                            foreach ($menus as $menu) {
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $menu['name']; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo number_format($menu['price']); ?>원
                                    </td>
                                    <td class="text-center">
                                        <?php echo number_format($menu['cnt']); ?>개
                                    </td>
                                    <td class="text-center">
                                        <?php echo $menu['date']; ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-secondary btn-space m-1"
                                                onclick="location.href = '/action/deleteMenu.php?idx=<?php echo $menu['idx']; ?>'">
                                            삭제
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="card mt-7">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">주문목록</h3>
                </div>
                <div class="card-body1 p-5">
                    <div class="table-responsive">
                        <table class="table table-bordered table-vcenter text-nowrap card-table"
                               style="border-top: 1px solid rgba(0, 40, 100, 0.12)">
                            <thead>
                            <tr>
                                <th>주문일자</th>
                                <th>아이디</th>
                                <th>성명</th>
                                <th>전화번호</th>
                                <th>위치정보</th>
                                <th>메뉴이름</th>
                                <th>수량</th>
                                <th>가격</th>
                                <th>총 합계</th>
                                <th>주문상태</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php
                            // 배송완료 버튼을 클릭할 수 있는데 열 병합이 안되어 있는건 이상하다.. 날짜는 귀찮아서 안함 ㅎㅎ
                            $boxs = $pdo->query("select * from orderbox where affi = '$_SESSION[id]' order by idx desc")->fetchAll(2);

                            $rowCnt = 0;

                            foreach ($boxs as $i => $box) {
                                $row = $pdo->query("select * from orderbox where code = '$box[code]' and affi = '$_SESSION[id]'")->rowCount();
                                $code[$i] = $box['code'];
                                if ($i) {
                                    if ($code[$i] === $code[$i - 1]) {
                                        $row = 0;
                                    } else {
                                        $rowCnt++;
                                    }
                                }

                                $rowSpan[$i] = $row;
                            }
                            foreach ($boxs as $i => $box) {
                                $member = $pdo->query("select * from member where id = '$box[customer]'")->fetch(2);
                                $price = $pdo->query("select * from orderlist where idx=  '$box[code]'")->fetch(2)['price'];
                                ?>
                                <tr>
                                    <td <?php if ($rowSpan[$i]) echo "rowspan=" . $rowSpan[$i]; else echo "style='display:none'" ?>><?php echo $box['date']; ?></td>
                                    <td <?php if ($rowSpan[$i]) echo "rowspan=" . $rowSpan[$i]; else echo "style='display:none'" ?>><?php echo $member['id'] ?></td>
                                    <td <?php if ($rowSpan[$i]) echo "rowspan=" . $rowSpan[$i]; else echo "style='display:none'" ?>><?php echo $member['name']; ?></td>
                                    <td <?php if ($rowSpan[$i]) echo "rowspan=" . $rowSpan[$i]; else echo "style='display:none'" ?>><?php echo $member['phone']; ?></td>
                                    <td <?php if ($rowSpan[$i]) echo "rowspan=" . $rowSpan[$i]; else echo "style='display:none'" ?>>
                                        (<?php echo $member['pos']; ?>)
                                    </td>
                                    <td><?php echo $box['name']; ?></td>
                                    <td><?php echo $box['cnt']; ?>개</td>
                                    <td><?php echo number_format($box['price']); ?>원</td>
                                    <td <?php if ($rowSpan[$i]) echo "rowspan=" . $rowSpan[$i]; else echo "style='display:none'" ?>><?php echo number_format($price); ?>
                                        원
                                    </td>
                                    <td <?php if ($rowSpan[$i]) echo "rowspan=" . $rowSpan[$i]; else echo "style='display:none'" ?>>
                                        <?php if ($box['status'] !== '배송완료') { ?>
                                            <button type="button" class="btn btn-secondary btn-space"
                                                    onclick="location.href='/action/delivery.php?code=<?php echo $box['code']; ?>'">
                                                배송
                                            </button>
                                        <?php } else {
                                            echo '배송완료';
                                        } ?>
                                    </td>
                                </tr>

                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 관리자모드 -->
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] === 'C') { ?>
                <div class="card mt-7">
                    <div class="card-header">
                        <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">가맹점 메뉴목록</h3>
                        <div class="col text-right">
                            <select class="custom-select col-2">
                                <option value="">가맹회원선택</option>
                                <?php
                                $affies = $pdo->query("select * from affi")->fetchAll(2);
                                foreach ($affies as $affi) {
                                    ?>
                                    <option value="<?php echo $affi['owner']; ?>" <?php if ($owner === $affi['owner']) echo "selected"; ?>><?php echo $affi['name']; ?></option>
                                <?php } ?>
                            </select>
                            <button type="button" class="btn btn-secondary btn-space"
                                    onclick="location.href=`?owner=${$('.custom-select:eq(1) option:selected').val()}`">
                                확인
                            </button>
                        </div>
                    </div>
                    <div class="card-body1 p-5">
                        <div class="table-responsive">
                            <table class="table table-bordered table-vcenter text-nowrap card-table"
                                   style="border-top: 1px solid rgba(0, 40, 100, 0.12)">
                                <thead>
                                <tr>
                                    <th>메뉴이름</th>
                                    <th>가격</th>
                                    <th>판매수량</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $menus = $pdo->query("select * from menus where affi = '$owner'")->fetchAll(2);

                                foreach ($menus as $menu) {
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <?php echo $menu['name']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo number_format($menu['price']); ?>원
                                        </td>
                                        <td class="text-center">
                                            <?php echo number_format($menu['cnt']); ?>개
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            <?php } ?>
            <div class="card mt-7">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">메뉴랭킹</h3>
                </div>
                <div class="card-body1 p-5">
                    <div class="table-responsive">
                        <table class="table table-bordered table-vcenter text-nowrap card-table"
                               style="border-top: 1px solid rgba(0, 40, 100, 0.12)">
                            <thead>
                            <tr>
                                <th>랭킹</th>
                                <th>가맹점명</th>
                                <th>메뉴이름</th>
                                <th>가격</th>
                                <th>판매수량</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $rankings = $pdo->query("select * from menus order by cnt desc limit 5 ")->fetchAll(2);

                            $i = 1;
                            foreach ($rankings as $ranking) {
                                $affi = $pdo->query("select * from affi where owner = '$ranking[affi]'")->fetch(2);
                                ?>
                                <tr>
                                    <td class="text-center" style="width: 5%">
                                        <?php echo $i++; ?>위
                                    </td>
                                    <td class="text-center">
                                        <?php echo $affi['name']; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $ranking['name']; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo number_format($ranking['price']); ?>원
                                    </td>
                                    <td class="text-center">
                                        <?php echo number_format($ranking['cnt']); ?>개
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contents end -->
<?php include "../include/footer.php"; ?>