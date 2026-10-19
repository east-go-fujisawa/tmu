<?php

$user_info = json_decode(
    file_get_contents("./uploads/auth/user_information.json"),
    true
);

$json_data = json_decode(
    file_get_contents("./uploads/auth/login_log.json"),
    true
);

$branch = json_decode(
    $_POST["branch"],
    true
);

$register_information = json_decode(
    $_POST["info"],
    true
);

$auth_information = json_decode(
    $_POST["auth"],
    true
);



$permittion = "deny";
$per_count = -1;
$count = -1;



foreach($json_data[0]["token"] as $login_data){

        $count++;
        $now_date = new DateTime();
        $now_date -> format("Y-m-d H:i");
        $past_date = new DateTime($json_data[0]["date"][$count]["date"]);
        $diff = $now_date->diff($past_date);
        $hours = (int)$diff->format('%H');
        //24時間立った１時間後でもOKになってしまう

if($auth_information[0] == $login_data && $auth_information[1] == $json_data[0]["username"][$count] && $hours < 1 && $auth_information[2] == 1){
    //再度パスワード認証にしても良いかも
    $permittion = "success";
    
    
}
}

if($branch[0] == "register" && $permittion == "success"){
    
    $check_count = 0;
    foreach($user_info[0]["username"] as $usr_name){
        if($usr_name == $register_information[0]){
            $check_count++;
        }
    }
    if($check_count == 0){
        
        array_push($user_info[0]["username"],$register_information[0]);
        array_push($user_info[0]["password"],$register_information[1]);
        array_push($user_info[0]["state"],$register_information[2]);
        
        file_put_contents(
            "./uploads/auth/user_information.json",
            json_encode(
                $user_info,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );

        echo json_encode([
            "result" => "success"
        ]);
    }else{
        echo json_encode([
            "result" => "fail_username"
        ]);
    }
}else if($branch[0] == "change" && $permittion == "success"){ 
//権限に差をつけて、できる操作を決める。
    $count2=-1;
    foreach($user_info[0]["username"] as $usr_name){
        $count2++;
        if($usr_name == $register_information[0]){
            $per_count = $count2;
        }
    }

    $user_info[0]["username"][$per_count] = $register_information[0];
    $user_info[0]["password"][$per_count] = $register_information[1];
    $user_info[0]["state"][$per_count] = $register_information[2];

        file_put_contents(
            "./uploads/auth/user_information.json",
            json_encode(
                $user_info,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );
        
    echo json_encode([
        "result" => "success"
    ]);
}else{
    echo json_encode([
        "result" => "faild"
    ]);
}
?>