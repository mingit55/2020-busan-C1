<?php
namespace Controller;

use App\DB;

class CompanyController {
    // 채용 등록
    function recruitPage(){
        view("recruit__register", [
            "recruits" => DB::fetchAll("SELECT * FROM recruits WHERE cid = ?", [user()->id])
        ]);
    }
    function registerRecruit(){
        checkInput();
        extract($_POST);

        DB::query("INSERT INTO recruits(cid, name, recruit_type, level_type, payment, work_area, recruit_area) VALUES (?, ?, ?, ?, ?, ?, ?)", [
            user()->id,
            $recruit_name,
            $recruit_type,
            $level_type,
            $payment,
            $work_area,
            json_encode( split(",", $recruit_area), JSON_UNESCAPED_UNICODE )
        ]);
        go("/recruits/register");
    }

    // 면접 등록
    function interviewPage(){
        $recruits = DB::fetchAll("SELECT id, name FROM recruits WHERE cid = ?", [user()->id]);
        $interviews = DB::fetchAll("SELECT DISTINCT I.*, cid, name recruit_name, cnt
                                    FROM interviews I 
                                    LEFT JOIN recruits R ON R.id = I.rid
                                    LEFT JOIN (SELECT COUNT(*) cnt, rid FROM interviews GROUP BY rid) C ON C.rid = I.rid
                                    WHERE cid = ?
                                    ORDER BY rid ASC, interview_at ASC", [user()->id]);

        view("interview__register", compact("recruits", "interviews"));
    }

    function registerInterview(){
        checkInput();
        extract($_POST);       

        DB::query("INSERT INTO interviews(rid, interviewer, interview_at, duration) VALUES (?, ?, ?, ?)", [
            $rid,
            $interviewer,
            $interview_at,
            $duration
        ]);
        go("/interviews/register");
    }
}