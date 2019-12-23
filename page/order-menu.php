<?php include "../include/header.php"; ?>
    <script type="text/javascript">
        $(function () {
            qt();
        })
    </script>

    <!-- contents start -->
    <div class="col-12">
        <div class="row">

            <div class="card"
                 style="position: fixed; margin-left: 1180px; top: 210px; max-height: 600px; width: 350px; z-index: 900;">
                <div class="card-header">
                    <?php
                    $orderbox = $pdo->query("select * from orderbox where customer = '$_SESSION[id]' and status = '주문대기'");
                    $cnt = $orderbox->rowCount();
                    ?>
                    <h4 class="card-title" style="font-size: 1.2em; font-weight: bold;">주문함
                        (<?php echo number_format($cnt); ?>개)</h4>
                    <div class="col text-right">
                        <a href="/action/deleteOrderBox.php" class="btn btn-sm btn-outline-primary">비우기</a>
                    </div>

                </div>
                <div class="card-body1 o-auto p-3" style="height: 600px">
                    <ul class="list-unstyled list-separated">
                        <?php
                        $sum = 0;
                        foreach ($orderbox->fetchAll(2) as $box) {
                            $sum += $box['price'] * $box['cnt'];
                            ?>
                            <li class="list-separated-item">
                                <div class="row align-items-center">
                                    <div class="col" style="word-break: break-all;">
                                        <strong><?php echo $box['name']; ?></strong><br>
                                        주문수량 : <?php echo number_format($box['cnt']); ?> 개<br>
                                        가 격 : <?php echo number_format($box['price']); ?>원<br>
                                        합 계 : (<?php echo number_format($box['price'] * $box['cnt']); ?>원)
                                    </div>
                                    <div class="col-auto">
                                        <a href="/action/deleteOrderBox.php?code=<?php echo $box['code']; ?>"
                                           class="icon"><i
                                                    class="fe fe-x"></i></a>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="text-right" style="border-top: #dfdfdf solid 1px">
                    <div style="color: blue; font-size: 1.3em" class="mt-2 mr-3">총 주문금액
                        : <?php echo number_format($sum); ?>원
                    </div>
                    <button type="button" class="btn btn-primary btn-space mt-3 mb-3 mr-3"
                            onclick="location.href='/action/order.php'">결제하기
                    </button>
                </div>
            </div>

            <div class="col-12">
                <div class="mb-2 text-right">
                    <?php
                    $affi = $pdo->query("select * from affi where owner = '$_GET[affi]'")->fetch(2);
                    ?>
                    <button type="submit" class="btn btn-primary"
                            onclick="location.href='order-review.php?name=<?php echo $affi['name']; ?>&affi=<?php echo $affi['owner']; ?>'">
                        리뷰보기<span
                                class="badge badge-primary"><?php echo number_format($affi['review']); ?>개</span>
                        <!-- 현재 페이지에서 DB에서 강제 삭제시 갯수 표시가 제대로 되지않음. -->
                    </button>
                </div>
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                            <thead>
                            <tr class="text-center">
                                <th><strong>메뉴이름</strong></th>
                                <th><strong>가격</strong></th>
                                <th><strong>수량</strong></th>
                                <th><strong>합계</strong></th>
                                <th><strong>주문함담기</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $menus = $pdo->query("select * from menus where affi = '$_GET[affi]'")->fetchAll(2);
                            foreach ($menus as $menu) {
                                ?>
                                <form action="/action/addOrderBox.php" method="post">
                                    <tr class="text-center">
                                        <td>
                                            <input type="hidden" name="affi" value="<?php echo $_GET['affi']; ?>">
                                            <input type="hidden" name="name" value="<?php echo $menu['name']; ?>">
                                            <?php echo $menu['name']; ?>
                                        </td>
                                        <td data-price="<?php echo $menu['price']; ?>">
                                            <input type="hidden" name="price" value="<?php echo $menu['price']; ?>">
                                            <?php echo number_format($menu['price']); ?>원
                                        </td>
                                        <td style="width: 10%">
                                            <input type="number" class="form-control qt" name="cnt" placeholder="1"
                                                   min="1" value="1">
                                        </td>
                                        <td style="width: 20%">
                                            <input type="text" class="form-control text-right price" readonly="readonly"
                                                   value="<?php echo $menu['price'] ?>">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-secondary btn-space">주문함담기
                                            </button>
                                        </td>
                                    </tr>
                                </form>
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