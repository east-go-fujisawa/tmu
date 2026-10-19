
<?php
    
    $results = glob("./uploads/news/*.json");
    $pathes = [];
    $contents = [];
    foreach($results as $path){
        array_push($pathes,$path);
        $content = json_decode(
            file_get_contents($path),
            true
        );
        array_push($contents,$content);
    }
    header("Content-Type: application/json; charset=utf-8");
    $json = json_encode([
        "contents" => $contents,
        "path" => $pathes
    ]);
    echo $json;
?>