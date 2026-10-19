<?php
$instraction = "get_information";




if($instraction == "file_put"){
$posted_files = json_decode(
    $_POST["posted_information"],
    true
);
}else if($instraction == "get_information"){
    function dirToStructure(string $dir): array
{
    $result = [];
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($path)) {
            $result[] = [
                'name'     => $file,
                'type'     => 'directory',
                'children' => dirToStructure($path)
            ];
        } else {
            $result[] = [
                'name' => $file,
                'type' => 'file'
            ];
        }
    }

    return $result;
}

$targetDir = __DIR__ . '/uploads'; 

if (is_dir($targetDir)) {
    $dirArray = dirToStructure($targetDir);
    //$jsonResult = json_encode($dirArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    header('Content-Type: application/json; charset=utf-8');
    //$jsonResult;
    echo json_encode([
        "result"=>"success",
        "directory_info"=>$dirArray
    ]);
} else {
    echo json_encode([
        "result"=>"fail"
    ]);
}
}
?>