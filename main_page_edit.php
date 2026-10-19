<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);

    $branch = json_decode(
        $_POST["branch"],
        true
        );
    
    if($branch[0] == "register_photos"){
        $photos = [];
        $count = count($_FILES["images"]["name"]);
        for($i=0;$i<$count;$i++){
            $tmp = $_FILES["images"]["tmp_name"][$i];
            move_uploaded_file(
            $tmp,
            "./uploads/main_page/".$_FILES["images"]["name"][$i]
            );
            array_push($photos,$_FILES["images"]["name"][$i]);
        }
        file_put_contents(
            "./uploads/main_page/intro_photos.json",
            json_encode(
                $photos,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );
        echo json_encode([
            "result" => "success"
        ]);
    }else if($branch[0] == "register_intro"){
        file_put_contents(
            "./uploads/main_page/intro_text.json",
            $_POST["intro"]
        );
        echo json_encode([
            "result" => "success"
        ]);
    }else if($branch[0] == "register_back"){
        $photos = [];
        $count = count($_FILES["images"]["name"]);
        for($i=0;$i<$count;$i++){
            $tmp = $_FILES["images"]["tmp_name"][$i];
            move_uploaded_file(
            $tmp,
            "./uploads/main_page/".$_FILES["images"]["name"][$i]
            );
            array_push($photos,$_FILES["images"]["name"][$i]);
        }
        file_put_contents(
            "./uploads/main_page/back_photo.json",
            json_encode(
                $photos,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );
        echo json_encode([
            "result" => "success"
        ]);
    }else if($branch[0] == "get_all"){
        $back_photo = json_decode(
            file_get_contents("./uploads/main_page/back_photo.json"),
            true
        );
        $intro_photos = json_decode(
            file_get_contents("./uploads/main_page/intro_photos.json"),
            true
        );
        $intro_text = json_decode(
            file_get_contents("./uploads/main_page/intro_text.json"),
            true
        );
        echo json_encode([
            "back_photo" => $back_photo,
            "intro_photos" => $intro_photos,
            "intro_text" => $intro_text
        ]);
    }else{
        echo json_encode([
            "result" => "fail"
        ]);
    }
    
    

?>