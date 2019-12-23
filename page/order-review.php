<?php include "../include/header.php"; ?>

    <!-- contents start -->
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <div class="mb-2 text-right">
                    <button type="submit" class="btn btn-primary" onclick="history.back()">메뉴목록</button>
                </div>
            </div>

            <?php
            // 최근 등록 순
            $reviews = $pdo->query("select * from reviews where affi = '$_GET[affi]' order by idx desc")->fetchAll(2);
            foreach ($reviews as $review) {
                ?>
                <div class="card">
                    <div class="card-body1 p-5">
                        <article class="media">
                            <div class="media-body">

                                <div class="content">
                                    <p class="h5">
                                        <?php $member = $pdo->query("select * from member where id = '$review[customer]'")->fetch(2);

                                        // 앞 3자리 제외 별포 표기
                                        $customer = substr($review['customer'], 0, 3);
                                        for ($i = 0; $i < strlen($review['customer']) - 3; $i++) $customer .= '*';
                                        ?>
                                        <small><?php echo $member['name']; ?>
                                            <?php echo $customer; ?>
                                        </small>
                                        <small>평점 : <?php echo $review['star']; ?>점</small>
                                        <small class="float-right text-muted"><?php echo $review['date']; ?></small>
                                    </p>
                                    <p>
                                        <?php echo $review['content']; ?>
                                    </p>
                                </div>
                            </div>
                        </article>

                    </div>

                </div>
            <?php } ?>
        </div>
    </div>
    <!-- contents end -->

<?php include "../include/footer.php"; ?>