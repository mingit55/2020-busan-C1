<div class="container">
        <div class="padding">
            <div class="row">
                <!-- 채용 등록 -->
                <div class="col-lg-4">
                    <h1 class="sub-title">채용 등록</h1>
                    <hr>
                    <form method="post">
                        <div class="form-group">
                            <label for="recruit_name">채용명</label>
                            <input type="text" id="recruit_name" class="form-control" name="recruit_name" placeholder="채용명을 입력하세요" required>
                        </div>
                        <div class="form-group">
                            <label for="recruit_type">채용 종류</label>
                            <select name="recruit_type" id="recruit_type" class="form-control">
                                <option value="신입">신입</option>
                                <option value="경력">경력</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="level_type">학력 종류</label>
                            <select name="level_type" id="level_type" class="form-control">
                                <option value="무관">무관</option>
                                <option value="고등학교 재학">고등학교 재학</option>
                                <option value="고등학교 졸업">고등학교 졸업</option>
                                <option value="대학교 재학">대학교 재학</option>
                                <option value="대학교 졸업">대학교 졸업</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="payment">급여</label>
                            <select name="payment" id="payment" class="form-control">
                                <option value="2000만원 이상">2000만원 이상</option>
                                <option value="3000만원 이상">3000만원 이상</option>
                                <option value="4000만원 이상">4000만원 이상</option>
                                <option value="내규에 따름">내규에 따름</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="work_area">근무지역</label>
                            <select name="work_area" id="work_area" class="form-control">
                                <option value="전주시">전주시</option>
                                <option value="익산시">익산시</option>
                                <option value="정읍시">정읍시</option>
                                <option value="남원시">남원시</option>
                                <option value="김제시">김제시</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recruit_area">모집 분야</label>
                            <small class="text-muted">※ 쉼표(,)로 구분지어 입력해 주세요.</small>
                            <input type="text" id="recruit_area" class="form-control" name="recruit_area" placeholder="모집 분야를 입력하세요" required>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary">등록 완료</button>
                        </div>
                    </form>
                </div>
                <!-- /채용 등록 -->
                <!-- 등록 현황 -->
                <div class="col-lg-8">
                    <h1 class="sub-title">등록 현황</h1>
                    <div class="table">
                        <div class="t__head">
                            <div class="cell-30">채용명</div>
                            <div class="cell-10">채용 종류</div>
                            <div class="cell-20">학력 종류</div>
                            <div class="cell-20">급여</div>
                            <div class="cell-10">근무 지역</div>
                            <div class="cell-10">삭제</div>
                        </div>
                        <?php foreach($recruits as $recruit):?>
                        <div class="t__row">
                            <div class="cell-30"><?=$recruit->name?></div>
                            <div class="cell-10"><?=$recruit->recruit_type?></div>
                            <div class="cell-20"><?=$recruit->level_type?></div>
                            <div class="cell-20"><?=$recruit->payment?></div>
                            <div class="cell-10"><?=$recruit->work_area?></div>
                            <div class="cell-10"><button class="btn btn-danger">삭제</button></div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
                <!-- /등록 현황 -->
            </div>
        </div>
    </div>