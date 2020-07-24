<div class="container">
    <div class="padding">
        <div class="row">
            <!-- 면접 요청 -->
            <div class="col-lg-4">
                <h1 class="sub-title">면접 요청</h1>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <label for="recruit_name">채용명</label>
                        <select id="recruit_name" name="rid" class="form-control" required></select>
                    </div>
                    <div class="form-group">
                        <label for="interview">면접명</label>
                        <select id="interview" name="iid" class="form-control" required></select>
                    </div>
                    <div class="form-group">
                        <label for="field">지원 부문</label>
                        <select id="field" name="field" class="form-control" required></select>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary">면접 요청</button>
                    </div>
                </form>
            </div>
            <!-- /면접 요청 -->
            <!-- 요청 현황 -->
            <div class="col-lg-8">
                <h1 class="sub-title">요청 현황</h1>
                <div class="table">
                    <div class="t__head">
                        <div class="cell-40">채용명</div>
                        <div class="cell-40">면접명</div>
                        <div class="cell-20">지원부문</div>
                    </div>
                    <?php foreach($interviews as $interview):?>
                    <div class="t__row">
                        <div class="cell-40"><?=$interview->r_name?></div>
                        <div class="cell-40"><?=$interview->i_name?></div>
                        <div class="cell-20"><?=$interview->field?></div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
            <!-- /요청 현황 -->
        </div>
    </div>
</div>
<script src="/js/Interview.js"></script>