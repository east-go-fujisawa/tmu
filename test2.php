<?php

    $upload_information = json_decode(
        file_get_contents("./uploads/auth/login_log.json"),
        true
    );

    echo $upload_information;
    echo $upload_information[0];
    echo $upload_information[0]["username"];

    
    ?>