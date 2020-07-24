<?php
namespace Controller;

use App\DB;

class UserController {
    // 로그인
    function login(){
        checkInput();
        extract($_POST);

        $user = DB::who($email);
        if(!$user) back("입력 정보와 일치하는 회원을 찾을 수 없습니다...");
        if($user->password !== hash("sha256", $password)) back("비밀번호가 일치하지 않습니다.");

        $_SESSION['user'] = $user;

        go("/", "정상적으로 로그인 되었습니다.");
    }

    // 회원가입
    function join(){
        checkInput();
        extract($_POST);        

        // 이메일 검사
        $exist = DB::who($email);
        if($exist) back("이미 존재하는 아이디입니다.");
        else if(!preg_match("/^([a-zA-Z0-9]+)@([a-zA-Z0-9]+)\.([a-zA-Z]{2,4})$/", $email)) back("아이디가 이메일 형식이 아닙니다.");
        
        // 비밀번호 검사
        if(strlen($password) < 4) back("비밀번호는 4자 이상이여야 합니다.");
        else if($password !== $passconf) back("비밀번호와 비밀번호 확인이 일치하지 않습니다.");
        $password = hash("sha256", $password);

        DB::query("INSERT INTO users(email, password, name, type) VALUES (?, ?, ?, ?)", [
            $email, $password, $name, $type
        ]);

        go("/", "정상적으로 회원가입 되었습니다.");
    }

    // 로그아웃
    function logout(){
        unset($_SESSION['user']);
        go("/", "로그아웃 되었습니다.");
    }
}