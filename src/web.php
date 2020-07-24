<?php

use App\Router;


// 메인 페이지
Router::get("/", "MainController@indexPage");

// 이력서 관리
Router::get("/resumes", "NormalController@resumePage");
Router::get("/resumes/{user_id}", "NormalController@getResume");
Router::post("/resumes/{user_id}", "NormalController@setResume");

// 면접 요청
Router::get("/interviews/request", "NormalController@requestPage");
Router::post("/interviews/request", "NormalController@requestInterview");
Router::get("/interviews", "NormalController@getInterviews");

// 채용 등록
Router::get("/recruits/register", "CompanyController@recruitPage");
Router::post("/recruits/register", "CompanyController@registerRecruit");

// 면접 등록
Router::get("/interviews/register", "CompanyController@interviewPage");
Router::post("/interviews/register", "CompanyController@registerInterview");


// 유저 관리
Router::post("/login", "UserController@login");
Router::post("/join", "UserController@join");
Router::get("/logout", "UserController@logout");

Router::connect();