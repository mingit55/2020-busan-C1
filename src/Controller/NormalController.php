<?php
namespace Controller;

use App\DB;

class NormalController {
    // 이력서 관리
    function resumePage(){
        view("resume");
    }
    function getResume($user_id){
        $user = DB::who($user_id);
        if(!$user || $user->id !== user()->id) json_response("요청 정보와 일치하는 회원을 찾을 수 없습니다.");
        
        $resume = DB::fetch("SELECT * FROM resumes WHERE uid = ?", [$user->id]);

        json_response(["resume" => $resume]);
    }
    function setResume($user_id){
        $in = @json_decode( file_get_contents("php://input") );
        if(!$in) json_response("변경할 내용을 찾을 수 없습니다.");

        $user = DB::who($user_id);
        if(!$user || $user->id !== user()->id) json_response("요청 정보와 일치하는 회원을 찾을 수 없습니다.");

        $resume = DB::fetch("SELECT * FROM resumes WHERE uid = ?", [$user->id]);
        
        // 1. 새로 이력을 작성하는 경우
        if(!$resume){
            $filename = $in->user_image ? base64_upload($in->user_image) : "";
             
            
            DB::query("INSERT 
                        INTO resumes(uid, user_image, user_name, user_birthday, user_phone, user_email, education, career, outside, license)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                        [$user->id, $filename, $in->user_name, $in->user_birthday, $in->user_phone, $in->user_email, json_encode($in->education), json_encode($in->career), json_encode($in->outside), json_encode($in->license)]
                    );
        }
        // 2. 기존 이력을 수정하는 경우
        else {
            $filename = $resume->user_image;
            if($resume->user_image !== $in->user_image){
                if(is_file(UPLOAD.DS.$resume->user_image)){
                    unlink(UPLOAD.DS.$resume->user_image);
                }
                $filename = $in->user_image ? base64_upload($in->user_image) : "";
            }


            DB::query("UPDATE resumes SET user_image = ?, user_name = ?, user_birthday = ?, user_phone = ?, user_email = ?, education = ?, career = ?, outside = ?, license = ?
                        WHERE id = ?",
                        [$filename, $in->user_name, $in->user_birthday, $in->user_phone, $in->user_email, json_encode($in->education), json_encode($in->career), json_encode($in->outside), json_encode($in->license), $resume->id]);
        }

        json_response(['status' => true]);
    }
    
    // 면접 요청
    function requestPage(){
        view("interview__request", [
            "interviews" => DB::fetchAll("SELECT DISTINCT Q.*, CONCAT(I.interviewer, ' ', I.duration, '분') i_name, R.name r_name
                                    FROM requests Q
                                    LEFT JOIN recruits R ON R.id = Q.rid
                                    LEFT JOIN interviews I ON I.id = Q.iid
                                    WHERE uid = ?", [user()->id])
        ]);
    }

    function requestInterview(){
        checkInput();
        extract($_POST);

        $exist = DB::fetch("SELECT * FROM requests WHERE uid = ? AND rid = ? AND iid = ?", [user()->id, $rid, $iid]);
        if($exist) back("이미 신청한 면접입니다. 다른 면접을 선택해 주세요.");

        DB::query("INSERT INTO requests(uid, rid, iid, field) VALUES (?, ?, ?, ?)", [user()->id, $rid, $iid, $field]);
        go("/interviews/request", "요청이 완료되었습니다.");
    }

    function getInterviews(){
        $data = DB::fetchAll("SELECT I.*, R.name recruit_name, R.recruit_area field
                                FROM interviews I
                                LEFT JOIN recruits R ON R.id = I.rid");
        $interviews = [];
        foreach($data as $item){
            $exist = count($interviews) > 0 && $interviews[count($interviews) - 1]->recruit_name == $item->recruit_name;
            if(!$exist){
                $interviews[] = (object)[
                    "id" => $item->rid,
                    "recruit_name" => $item->recruit_name,
                    "interview" => [
                        (object)["id" => $item->id, "label" => "{$item->interviewer} {$item->duration}분"]
                    ],
                    "field" => json_decode($item->field)
                ];
            } 
            else {
                $interviews[count($interviews) - 1]->interview[] = (object)["id" => $item->id, "label" => "{$item->interviewer} {$item->duration}분"];
            }
        }
        
        json_response(["interviews" => $interviews]);
    }
}