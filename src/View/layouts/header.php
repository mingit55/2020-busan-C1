<!-- 메인 페이지 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>전북중소기업취업박람회</title>
    <script src="/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="/bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <script src="/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/fontawesome-free-5.1.0-web/css/all.css">
    <script src="/fontawesome-free-5.1.0-web/js/all.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/lib.js"></script>
</head>
<body>
    <!-- 회원가입 모달 -->
    <form id="join-modal" class="modal fade" method="post" action="/join">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="sub-title">회원가입</h1>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="join__email">이메일</label>
                        <input type="email" id="join__email" name="email" class="form-control" placeholder="이메일을 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="join__password">비밀번호</label>
                        <input type="password" id="join__password" name="password" class="form-control" placeholder="비밀번호을 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="join__passconf">비밀번호 재확인</label>
                        <input type="password" id="join__passconf" name="passconf" class="form-control" placeholder="비밀번호을 다시 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="join__name">이름/업체명</label>
                        <input type="text" id="join__name" name="name" class="form-control" placeholder="이름/업체명을 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="join__type">회원구분</label>
                        <select name="type" id="join__type" class="form-control">
                            <option value="normal">일반 회원</option>
                            <option value="company">기업 회원</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button class="btn btn-primary" type="submit">회원가입</button>
                    <button class="btn btn-light" type="reset" data-dismiss="modal">취소</button>
                </div>
            </div>
        </div>
    </form>
    <!-- /회원가입 모달 -->

    <!-- 로그인 모달 -->
    <form id="login-modal" class="modal fade" method="post" action="/login">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="sub-title">로그인</h1>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="login__email">이메일</label>
                        <input type="email" id="login__email" name="email" class="form-control" placeholder="이메일을 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="login__password">비밀번호</label>
                        <input type="password" id="login__password" name="password" class="form-control" placeholder="비밀번호를 입력하세요" minlength="4" required>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button class="btn btn-primary" type="submit">로그인</button>
                    <button class="btn btn-light" type="reset" data-dismiss="modal">취소</button>
                </div>
            </div>
        </div>
    </form>
    <!-- /로그인 모달 -->

    <!-- 헤더 영역 -->
    <div id="top">
        <div class="container d-flex justify-content-between h-100">
            <div class="sotial">
                <a href="#" class="s-icon">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="s-icon">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="s-icon">
                    <i class="fab fa-google-plus-g"></i>
                </a>
            </div>
            <div class="auth">
                <?php if(user()):?>
                    <a href="/logout">로그아웃</a>
                <?php else:?>
                    <a href="#" data-target="#login-modal" data-toggle="modal">로그인</a>
                    <a href="#" data-target="#join-modal" data-toggle="modal">회원가입</a>
                <?php endif;?>
            </div>
        </div>
    </div>
    <header>
        <div class="container d-flex align-items-center justify-content-between h-100">
            <a href="/" class="logo">전북중소기업취업박람회</a>
            <div class="nav">
                <div class="nav-item">
                    <a href="/">전북중소기업취업박람회</a>
                    <div class="sub-list">
                        <a href="/">행사소개</a>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="/recruits/register">기업 회원</a>
                    <div class="sub-list">
                        <a href="/recruits/register">채용 등록</a>
                        <a href="/interviews/register">면접 등록</a>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="/resumes">개인 회원</a>
                    <div class="sub-list">
                        <a href="/resumes">이력서 관리</a>
                        <a href="/interviews/request">면접 요청</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- /헤더 영역 -->