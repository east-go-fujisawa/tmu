<?php

$request_state = "no";

$post_data = json_decode(
    $_POST["login_auth"],
    true
    );

$json_data = json_decode(
    file_get_contents("./uploads/auth/login_log.json"),
    true
);
$user_information = json_decode(
    file_get_contents("./uploads/auth/user_information.json"),
    true
);

try{
    if(mb_strlen($post_data[2]) > 0){
        $request_state = $post_data[2];
    }
}catch(Exception $err){
$request_state = "no";
}

        $count2 = -1;
        $login_status = "no";
        
foreach($json_data[0]["token"] as $login_data){
        
        $count2++;
        $now_date = new DateTime();
        $now_date -> format("Y-m-d H:i");
        $past_date = new DateTime($json_data[0]["date"][$count2]["date"]);
        
        $diff = $now_date->diff($past_date);
        $hours = (int)$diff->format('%H');
        
if($post_data[0] == $login_data && $post_data[1] == $json_data[0]["username"][$count2] && $hours < 1 && $request_state == "no"){
    $login_status = "yes";
    echo json_encode([
        "result"=>"success"
    ]);
}else if($post_data[0] == $login_data && $post_data[1] == $json_data[0]["username"][$count2] && $hours < 1 && $request_state == "get_state"){
    $login_status = "yes";
    $count = -1;
    foreach($user_information[0]["username"] as $usr_name){
        $count++;
        if($usr_name == $post_data[1]){
            $state = $user_information[0]["state"][$count];
        }
    }

    echo json_encode([
        "result"=>"success",
        "state"=> $state
    ]);
}
}

if($login_status == "no"){
    echo json_encode([
        "result"=>"fail",
        "token"=>$hour
    ]);
}
?>  