<?php
namespace App;

use Controller\CompanyController;
use Controller\NormalController;

class Router {
    static $pages = [];
    static function __callStatic($name, $args){
        if($name === strtolower($_SERVER['REQUEST_METHOD'])){
            self::$pages[] = $args;
        }
    }

    static function connect(){
        $currentURL = explode("?", $_SERVER['REQUEST_URI'])[0];
        foreach(self::$pages as $page){
            $regex = preg_replace("/({[^\/]+})/", "([^/]+)", $page[0]);
            $regex = preg_replace("/\//", "\\/", $regex);
            if(preg_match("/^". $regex . "$/", $currentURL, $matches)){
                unset($matches[0]);
                self::execute($page[1], $matches);
                exit;
            }
        }
        http_response_code(404);
        exit;
    }

    static function execute($action, $args){
        $action = explode("@", $action);
        $conName = "Controller\\{$action[0]}";
        $con = new $conName();

        if($con instanceof NormalController){
            if(!user()) go("/", "로그인 후 사용 가능합니다.");   
            else if(user()->type !== "normal") go("/", "일반 회원만 사용 가능합니다.");
        }

        if($con instanceof CompanyController){
            if(!user()) go("/", "로그인 후 사용 가능합니다.");
            else if(user()->type !== "company") go("/", "기업 회원만 사용 가능합니다.");
        }
        
        $con->{$action[1]}(...$args);
    }
}