<?php 

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $apikey = json_decode(
        $_POST["apikey"],
        true
    );

    if($apikey[0] == "abcdefg"){
        $branch = json_decode(
            $_POST["branch"],
            true
        );
        if($branch[0] == "data_get"){
            $all_files = glob("./uploads/news/*.json");
            $json = [];
            $titles = [];
            foreach($all_files as $path){
                array_push($json,$path);
                $data = file_get_contents($path);
                $data = json_decode($data,true);
                $title = $data[0]["title"];
                array_push($titles,$title);
            }

            $json_data = [[
                "path" => $json,
                "title" => $titles
            ]];

            header("Content-Type: application/json; charset=utf-8");
            echo json_encode($json_data);   
        }else if($branch[0] == "delete_data"){
            $path = json_decode(
                $_POST["path"],
                true
            );
            $path = $path[0];
            if(unlink($path)){
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["result" => "success"]); 
            }else{
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["result" => "fail"]); 
            }
        }
    }else{
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(["result" => "apikey_incorrect"]);   
    }
?>