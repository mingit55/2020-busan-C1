<input type="hidden" id="user_id" value="<?=user()->email?>">
<link rel="stylesheet" href="/css/resume.css">
<script src="/js/resume.js"></script>

<!-- 이력서 -->
<div class="resume">
    <div class="resume__container">
        <h1 class="resume__title">이력서</h1>
        <!-- 인적 사항 -->
        <table class="resume__table avoid_save" data-info="personal">
            <tbody>
                <tr>
                    <td class="resume__image" rowspan="4">
                        <input type="hidden" id="profile__url" name="imageURL">
                        <input type="file" id="profile" hidden>
                        <small class="d-inline-block mb-2 text-muted">등록된 사진이 없습니다</small>
                        <button>사진 등록</button>
                        <label for="profile"></label>
                    </td>
                    <td class="resume__label">이 름</td>
                    <td class="resume__input"><input type="text" id="info__name"></td>
                </tr>
                <tr>
                    <td class="resume__label">생 년 월 일</td>
                    <td class="resume__input"><input type="text" id="info__birthday"></td>
                </tr>
                <tr>
                    <td class="resume__label">연 락 처</td>
                    <td class="resume__input"><input type="text" id="info__phone"></td>
                </tr>
                <tr>
                    <td class="resume__label">이 메 일</td>
                    <td class="resume__input"><input type="text" id="info__email"></td>
                </tr>
            </tbody>
        </table>
        <!-- /인적 사항 -->
        <!-- 학력 사항 -->
        <table class="resume__table" data-info="education">
            <tbody>
                <tr>
                    <td rowspan="3" class="resume__label resume__autosize">학 력 사 항</td>
                    <td class="resume__head">재학 기간</td>
                    <td class="resume__head">구분(재학/졸업)</td>
                    <td class="resume__head">학교명</td>
                    <td class="resume__head">전공</td>
                    <td class="resume__head">학점</td>
                    <td class="resume__head">삭제</td>
                </tr>
                <tr>
                    <td class="resume__add" colspan="6">
                        <button class="btn-add">추가 <i class="fa fa-plus"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- /학력 사항 -->
        <!-- 경력 사항 -->
        <table class="resume__table" data-info="career">
            <tbody>
                <tr>
                    <td rowspan="3" class="resume__label resume__autosize">경 력 사 항</td>
                    <td class="resume__head">회사명</td>
                    <td class="resume__head">재직기간</td>
                    <td class="resume__head">직급</td>
                    <td class="resume__head">삭제</td>
                </tr>
                <tr>
                    <td class="resume__add" colspan="4">
                        <button class="btn-add">추가 <i class="fa fa-plus"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- /경력 사항 -->
        <!-- 대외 활동 -->
        <table class="resume__table" data-info="outside">
            <tbody>
                <tr>
                    <td rowspan="3" class="resume__label resume__autosize">대 외 활 동</td>
                    <td class="resume__head">기간</td>
                    <td class="resume__head">기관/장소</td>
                    <td class="resume__head">내용</td>
                    <td class="resume__head">삭제</td>
                </tr>
                <tr>
                    <td class="resume__add" colspan="4">
                        <button class="btn-add">추가 <i class="fa fa-plus"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- /대외 활동 -->
        <!-- 자격증/어학 -->
        <table class="resume__table" data-info="license">
            <tbody>
                <tr>
                    <td rowspan="3" class="resume__label resume__autosize">자 격 증</td>
                    <td class="resume__head">취득일</td>
                    <td class="resume__head">구분(자격증/어학)</td>
                    <td class="resume__head">자격/어학명</td>
                    <td class="resume__head">발행처</td>
                    <td class="resume__head">삭제</td>
                </tr>
                <tr>
                    <td class="resume__add" colspan="5">
                        <button class="btn-add">추가 <i class="fa fa-plus"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- /자격증/어학 -->
    </div>
</div>
<!-- /이력서 -->