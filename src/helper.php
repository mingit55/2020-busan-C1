<?php
function user(){
    return isset($_SESSION['user']) ? $_SESSION['user'] : false;
}

function dump(){
    foreach(func_get_args() as $arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
        echo "<br/>";
    }
}

function dd(){
    dump(...func_get_args());
    exit;
}

function go($url, $message = ""){
    echo "<script>";
    if($message !== "") echo "alert('$message');";
    echo "location.href='$url';";
    echo "</script>";
    exit;
}

function back($message = ""){
    echo "<script>";
    if($message !== "") echo "alert('$message');";
    echo "history.back();";
    echo "</script>";   
    exit;
}

function json_response($JSON = []){
    if(is_array($JSON)) $JSON['message'] = "";
    else $JSON = ['message' => $JSON];
    
    header("Content-Type: application/json");
    echo json_encode($JSON, JSON_UNESCAPED_UNICODE);
    exit;

}

function view($viewName, $data = []){
    extract($data);

    $viewName = str_replace("/", DS, $viewName);
    $viewPath = VIEW.DS.$viewName.".php";

    if(is_file($viewPath)){
        require VIEW.DS."layouts".DS."header.php";
        require $viewPath;
        require VIEW.DS."layouts".DS."footer.php";
    }
    exit;
}

function checkInput(){
    foreach($_POST as $input){
        if(trim($input) == "") back("모든 정보를 입력해 주세요!");
    }
    foreach($_FILES as $file){
        if(!is_file($file['tmp_name'])) back("모든 파일을 업로드해 주세요!");
    }
}

function split($delimiter, $string){
    $arr = explode($delimiter, $string);
    $_arr = [];
    foreach($arr as $item){
        $_arr[] = trim($item);
    }
    return $_arr;
}

function base64_upload($base64){
    $split = explode(";base64,", $base64);
    $dataType = $split[0];
    $imageData = base64_decode($split[1]);
    $split = explode("/", $dataType);
    $extname = $split[1];
    
    $filename = time() . "." . $extname;
    file_put_contents(UPLOAD.DS.$filename, $imageData);

    return "/uploads/".$filename;
}