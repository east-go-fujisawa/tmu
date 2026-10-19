<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$api_key = json_decode(
    $_POST["apikey"],
    true
);
$api = "abcdefg";
if($api_key[0] == $api){

$article = json_decode(
    $_POST["send_data"],
    true
);



$count = count($_FILES["images"]["name"]);

for($i=0;$i<$count;$i++){
    $tmp = $_FILES["images"]["tmp_name"][$i];
    move_uploaded_file(
        $tmp,
        "./uploads/photos/".$_FILES["images"]["name"][$i]
    );
}

file_put_contents(
    "./uploads/news/".time().".json",
    json_encode(
        $article,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    )
);

header("Content-Type: application/json; charset=utf-8");
echo json_encode([
    "result" => "success"
]);

}elseif($api_key[0] != $api){
    header("Content-Type: application/json; charset=utf-8");
echo json_encode([
    "result" => "fail_api_authorization"
]);
}else{
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode([
        "result" => "error"
    ]);
}
?>