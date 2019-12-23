<?php include '../include/header.php'; ?>

    <!-- contents start -->
    <div class="col-6 mx-auto mt-9">
        <div class="row">
            <form class="card" action="/action/login.php" method="post">
                <div class="card-body p-6 col-12">
                    <div class="card-title">회원로그인</div>
                    <div class="form-group">
                        <label class="form-label">아이디</label>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                    </div>
                    <div class="form-group">
                        <label class="form-label">비밀번호</label>
                        <input type="password" class="form-control" name="pw" id="pw" placeholder="PASSWORD">
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block">로그인</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- contents end -->
<?php include '../include/footer.php'; ?>