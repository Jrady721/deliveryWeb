<?php include "../include/header.php"; ?>
<?php
// 코드가 지저분함 다음에 풀 때 리팩토링 필요


// memberId;
$memberId = isset($_GET['member']) ? $_GET['member'] : $_SESSION['id'];

$orderlist = $pdo->query("select * from orderlist where customer = '$memberId' order by date desc")->fetchAll(2);

$sum = 0;
$dateCnt = 0;
$oboxCnt = 0;

// rowspan chk
foreach ($orderlist as $i => $order) {
    $sum += $order['price'];

    $date[$i] = $order['date'];
    $obox[$i] = $order['idx'];
    $boxs = $pdo->query("select * from orderbox where code = '$order[idx]' and date = '$order[date]'");
    $rowDate = $boxs->rowCount();
    $rowObox = $rowDate;

    // dateRow and oboxRow
    if ($i !== 0) {
        if ($date[$i] === $date[$i - 1]) {
            $dateRow[$dateCnt] += $rowDate;
            $rowDate = 0;
        } else {
            $dateCnt++;
        }

        if ($obox[$i] === $obox[$i - 1]) {
            $oboxRow[$oboxCnt] += $rowObox;
            $rowObox = 0;
        } else {
            $oboxCnt++;
        }
    }
    $dateRow[$i] = $rowDate;
    $oboxRow[$i] = $rowObox;

    $nameCnt = 0;
    // name and status chk
    foreach ($boxs as $j => $box) {
        $rowName = 1;
        $name[$j] = $box['affi'];

        if ($j !== 0) {
            if ($name[$j] === $name[$j - 1]) {
                $nameRow[$i][$nameCnt] += $rowName;
                $rowName = 0;
            } else {
                $nameCnt = $j;
            }
        }
        $nameRow[$i][$j] = $rowName;
        $j++;
    }
}
?>
    <!-- contents start -->
    <div class="col-12">
        <div class="row">
            <div class="col-6 mb-2 text-left">
                <h3 style="color: red;">총 결제금액 : <?php echo number_format($sum); ?>원</h3>
            </div>
            <!-- 관리자모드 -->
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] === 'C') { ?>
                <div class="col-6 mb-2 text-right">
                    <select class="custom-select col-4">
                        <option value="">회원검색</option>
                        <?php
                        $members = $pdo->query("select * from member where auth = 'M'")->fetchAll(2);

                        foreach ($members as $member) {
                            ?>
                            <option value="<?php echo $member['id']; ?>" <?php if ($memberId === $member['id']) echo 'selected'; ?>>
                                <?php echo $member['name']; ?>[<?php echo $member['id']; ?>]
                            </option>
                        <?php } ?>
                    </select>
                    <button type="button" class="btn btn-secondary btn-space"
                            onclick="location.href=`?member=${$('select:eq(0) option:selected').val()}`">확인
                    </button>
                </div>
            <?php } ?>
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-bordered table-vcenter text-nowrap card-table">
                            <thead>
                            <tr>
                                <th>결제일자</th>
                                <th>가맹점정보</th>
                                <th>메뉴이름</th>
                                <th>가격</th>
                                <th>수량</th>
                                <th>주문상태</th>
                                <th>총 합계</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($orderlist as $i => $order) {
                                $boxs = $pdo->query("select * from orderbox where code = '$order[idx]'")->fetchAll(2);


                                foreach ($boxs as $j => $box) {
                                    $affi = $pdo->query("select * from affi where owner = '$box[affi]'")->fetch(2);
                                    ?>
                                    <tr>
                                        <td class="text-center" <?php if ($dateRow[$i]) {
                                            echo "rowspan=" . $dateRow[$i];
                                            $dateRow[$i] = 0;
                                        } else echo "style='display:none;'" ?>>
                                            <?php echo $order['date']; ?>
                                        </td>
                                        <td class="text-center" <?php if ($nameRow[$i][$j]) {
                                            echo "rowspan=" . $nameRow[$i][$j];
                                        } else echo "style='display:none;'" ?>>
                                            <img src="/logo/<?php echo $affi['logo']; ?>" alt="">
                                            <p class="m-0">
                                                <small><?php echo $affi['name']; ?></small>
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $box['name']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo number_format($box['price']); ?>원
                                        </td>
                                        <td class="text-center">
                                            <?php echo $box['cnt']; ?>개
                                        </td>
                                        <td class="text-center" <?php if ($nameRow[$i][$j]) {
                                            echo "rowspan=" . $nameRow[$i][$j];
                                        } else echo "style='display:none;'" ?>>
                                            <?php echo $box['status']; ?>
                                            <?php if ($box['status'] === '배송완료') {

                                                $chk = $pdo->query("select * from reviews where code = '$box[code]'")->rowCount();
                                                if ($chk) {
                                                    ?>
                                                    <p class="m-0">
                                                        <a href="#" onclick="alert('이미 리뷰를 작성하셨습니다.')"
                                                           class="btn btn-sm btn-outline-primary">리뷰작성</a>
                                                    </p>
                                                <?php } else { ?>
                                                    <p class="m-0">
                                                        <a href="details-review.php?affi=<?php echo $box['affi']; ?>&code=<?php echo $box['code']; ?>"
                                                           class="btn btn-sm btn-outline-primary">리뷰작성</a>
                                                    </p>
                                                    <?php
                                                }
                                            } ?>
                                        </td>
                                        <td class="text-center" <?php if ($oboxRow[$i]) {
                                            echo "rowspan=" . $oboxRow[$i];
                                            $oboxRow[$i] = 0;
                                        } else echo "style='display:none;'" ?> >
                                            <?php echo number_format($order['price']); ?>원
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contents end -->
<?php include "../include/footer.php"; ?>