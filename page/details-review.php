<?php include "../include/header.php"; ?>

<?php
$affi = $pdo->query("select * from affi where owner = '$_GET[affi]'")->fetch(2);
?>

    <!-- contents start -->
    <div class="col-12">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;"><?php echo $affi['name']; ?>
                        리뷰작성</h3>
                </div>
                <div class="card-body1 p-5">
                    <form action="/action/addReview.php" method="post">
                        <div class="form-group col-2">
                            <label class="form-label">평점</label>
                            <select class="custom-select" name="star">
                                <option value="">선택</option>
                                <option value="1">1점</option>
                                <option value="2">2점</option>
                                <option value="3">3점</option>
                                <option value="4">4점</option>
                                <option value="5">5점</option>
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <label class="form-label">리뷰내용</label>
                            <textarea class="form-control" name="content" rows="3"></textarea>
                        </div>

                        <input type="hidden" name="affi" value="<?php echo $_GET['affi']; ?>">
                        <input type="hidden" name="code" value="<?php echo $_GET['code']; ?>">

                        <div class="form-footer col-12">
                            <button type="submit" class="btn btn-primary btn-block">리뷰작성</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    <!-- contents end -->

<?php include "../include/footer.php"; ?>