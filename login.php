<?php
    $username = json_decode(
        $_POST["login_data"],
        true
        );
    $user_information = json_decode(
        file_get_contents("./uploads/auth/user_information.json"),
        ture
    );

    $upload_information = json_decode(
        file_get_contents("./uploads/auth/login_log.json"),
        true
    );

    $count = -1;
    $status = "no";
    foreach($user_information[0]["username"] as $info){
        $count++;
    if($username[0] == $info && $username[1] == $user_information[0]["password"][$count]){
        $status = "yes";

        $now_date = new DateTime();
        $now_date -> format("Y-m-d H:i");
        $api_token = rand();

        array_push($upload_information[0]["username"],$info);
        array_push($upload_information[0]["ip"],"000.000.00.0");
        array_push($upload_information[0]["date"],$now_date);
        array_push($upload_information[0]["token"],$api_token);

        file_put_contents(
            "./uploads/auth/login_log.json",
            json_encode(
                $upload_information
            )
        );
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode([
            "result"=>"success",
            "url"=>"auth.html",
            "api_token"=>$api_token
        ]);
    }
    }

    if($status == "no"){
        echo json_encode([
            "result"=>"fail"
        ]);
    }
?>