<div class="container">
        <div class="padding">
            <div class="row">
                <!-- 채용 등록 -->
                <div class="col-lg-4">
                    <h1 class="sub-title">채용 등록</h1>
                    <hr>
                    <form method="post">
                        <div class="form-group">
                            <label for="rid">채용</label>
                            <select name="rid" id="rid" class="form-control">
                                <?php foreach($recruits as $recruit):?>
                                    <option value="<?=$recruit->id?>"><?=$recruit->name?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="interviewer">면접관 명</label>
                            <input type="text" id="interviewer" class="form-control" name="interviewer" placeholder="면접관 명을 입력하세요" required>
                        </div>
                        <div class="form-group">
                            <label for="interview_at">면접 날짜</label>
                            <input type="date" id="interview_at" class="form-control" name="interview_at" required>
                        </div>
                        <div class="form-group">
                            <label for="duration">진행 시간</label>
                            <small class="text-muted">(단위: 분)</small>
                            <input type="text" id="duration" class="form-control only-number" name="duration" placeholder="면접 진행 시간을 입력하세요" require>
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
                    <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>채용명</th>
                                    <th>면접관 명</th>
                                    <th>면접일</th>
                                    <th>진행시간(분)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $rid = null;
                                    foreach($interviews as $interview):
                                ?>
                                <tr>
                                    <?php 
                                        if($rid != $interview->rid):
                                            $rid = $interview->rid;
                                    ?>
                                        <td class="align-middle" rowspan="<?=$interview->cnt?>"><?=$interview->recruit_name?></td>
                                    <?php endif;?>
                                    <td><?=$interview->interviewer?></td>
                                    <td><?=$interview->interview_at?></td>
                                    <td><?=$interview->duration?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                </div>
                <!-- /등록 현황 -->
            </div>
        </div>
    </div>