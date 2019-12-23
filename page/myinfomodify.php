<?php include "../include/header.php"; ?>
    <script type="text/javascript">
        $(function () {
            mapMarker();
        })
    </script>
<?php
$member = $pdo->query("select * from member where id = '$_SESSION[id]'")->fetch(2);
?>
    <!-- contents start -->
    <div class="col-8 mx-auto mt-2">
        <div class="row">
            <form class="card" action="/action/modifyMember.php" method="post">
                <div class="card-body p-6">
                    <div class="card-title">내 정보변경</div>
                    <div class="form-group">
                        <label class="form-label">아이디</label>
                        <input type="text" class="form-control" value="<?php echo $member['id']; ?>"
                               readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label class="form-label">성명</label>
                        <input type="text" class="form-control" value="<?php echo $member['name']; ?>"
                               readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label class="form-label">비밀번호</label>
                        <input type="password" name="pw" class="form-control" placeholder="영문숫자조합 4~8자이내">
                    </div>
                    <div class="form-group">
                        <label class="form-label">회원구분</label>
                        <div>
                            <select class="form-control custom-select">
                                <option value="">선택</option>
                                <option value="M" <?php if ($member['auth'] === 'M') echo 'selected'; ?>>일반회원</option>
                                <option value="P" <?php if ($member['auth'] === 'P') echo 'selected'; ?>>가맹회원</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">전화번호</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $member['phone']; ?>"
                               placeholder="0000-0000-0000형식">
                    </div>
                    <div class="form-group">
                        <label class="form-label">위치정보</label>
                        <div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">위치좌표(x, y)</h3>
                                    <div class="col-3">
                                        <input type="text" class="form-control position" name="pos" readonly="readonly"
                                               value="<?php echo $member['pos']; ?>">
                                    </div>
                                    <span>지도에 위치를 클릭해주세요.</span>
                                </div>
                                <div class="card-map card-map-placeholder">
                                    <div id="map">
                                        <img src="../assets/images/map.jpg" id="map">
                                        <img src="../assets/images/red_map_marker.png" id="marker">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <div class="btn-list mt-4 text-center">
                            <button type="reset" class="btn btn-secondary btn-space">다시작성하기</button>
                            <button type="submit" class="btn btn-primary btn-space">회원정보변경</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- contents end -->

<?php include "../include/footer.php"; ?>