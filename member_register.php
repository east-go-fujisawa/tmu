<?php 


    try{
    $apikey = json_decode(
        $_POST["apikey"],
        true
    );
    $user = json_decode(
        $_POST["user"],
        true
    );
    $auth_data = json_decode(
        file_get_contents("./uploads/auth/login_log.json"),
        true
    );
    }catch(Throwable $err){
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode(["result" => "apikey_error"]);
    return;
    }
    $count = -1;
    $data_order = "";
    foreach($auth_data[0]["token"] as $token){
        $count++;
        if($token == $apikey[0]){
            $data_order = $count;
        }
    }
    if($apikey[0] == $auth_data[0]["token"][$data_order] && $user[0] == $auth_data[0]["username"][$data_order]){
        $branch = json_decode(
            $_POST["branch"],
            true
        );
        if($branch[0] == "register"){
        $post_data = json_decode(
            $_POST["member_register"],
            true
        );
        file_put_contents(
            "./uploads/member/".$post_data[0]["path"].".json",
            json_encode(
                $post_data,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );
        
        $tmp = $_FILES["images"]["tmp_name"][0];
        move_uploaded_file(
            $tmp,
            "./uploads/member/".$_FILES["images"]["name"][0]
        );
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(["result" => "Success"]);
        }else if($branch[0] == "change"){
        $post_data = json_decode(
            $_POST["member_register"],
            true
        );
            $photo_status = json_decode(
                $_POST["photo_status"],
                true
            );
            file_put_contents(
            "./uploads/member/".$post_data[0]["path"].".json",
            json_encode(
                $post_data,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );
            if($photo_status[0] == "new"){
            $tmp = $_FILES["images"]["tmp_name"][0];
            move_uploaded_file(
            $tmp,
            "./uploads/member/".$_FILES["images"]["name"][0]
        );
            }
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(["result" => "Success"]);
        }else if($branch[0] == "delete"){
            $path = json_decode(
                $_POST["path"],
                true
            );
            $path = "./uploads/member/".$path[0].".json";
            //画像はどうやって削除しようかな。
            if(unlink($path)){
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["result" => "Success"]);
            }else{
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["result" => "fail"]);
            }
        }else{
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["result" => "Error_at_branch"] );
        }
    }else{
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(["result" => "Error_at_apikey"]);
    }
?>