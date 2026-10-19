<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <style>
            ::-webkit-scrollbar {
             height:0px;   /* 横スクロールなら height */
            }
            body{
                width:1000000vw;
                height: min-content;
                /*さすがに計算*/
                margin:0;
                padding: 0;
            }
            img{
                height: 90vh;
                width:auto;
                margin:0;
                margin-right:5px;
                padding:0;
                display: inline-block;
                border-radius: 10px;
            }
        </style>
        <?php
        $all = json_decode(
            file_get_contents("./uploads/main_page/intro_photos.json"),
            true
        );
        foreach($all as $path){
        ?>
        <img src="./uploads/main_page/<?=htmlspecialchars($path)?>" id="">
        <?php
        }
        ?>
        <img src="./images/home-bg.jpg" id="">
    </body>
</html>