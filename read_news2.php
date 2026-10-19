<!DOCTYPE html>
<html lang="ja">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title>東京都立大学航空部 ニュース・ブログ</title>

    <meta name="destriction" content="東京都立大学航空部のニュース・ブログページ">
    <meta name="keywords" content="航空部,都立大,グライダー,東京都立大学,滑空機,TMU,日野,部活">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!--google アドセンス-->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2346293632116538"
     crossorigin="anonymous"></script>

<!--link rel="stylesheet" href="style.css"-->
<link rel="stylesheet" href="home.css">
</head>
    <body onload='select_status()'>
<!-- ===========================================================
Header
=========================================================== -->

<header class="top">

    <div id="headerLogo" class="header-logo">

        <div class="logo-mark">

            <img src="012.jpg" alt="東京都立大学航空部">

        </div>

        <div class="logo-text">

            <small>

                Tokyo Metropolitan University

                <span>Aviation Club</span>

            </small>

            <h1>

                東京都立大学 航空部

            </h1>

        </div>

    </div>

    <nav>

        <ul>

            <li><a href="index.html">HOME</a></li>

            <!--li><a href="#">ABOUT</a></li-->

            <li><a href="read_news2.php">NEWS</a></li>

            <li><a href="member.php">MEMBER</a></li>

            <li><a href="login.html">AUTH</a></li>

            <li><a href="contact.html">CONTACT</a></li>

        </ul>

    </nav>

</header>
<div id="pre_nav" class="pre_nav">≡</div>
<div class="lis" id="lis">
            <ul>

            <li><a href="index.html"><img src="home.png">HOME</a></li>

            <!--li><a href="#">ABOUT</a></li-->

            <li><img src="news.png"><a href="read_news2.php">NEWS</a></li>

            <li><img src="memebr.png"><a href="member.php">MEMBER</a></li>

            <li><img src="authpng.png"><a href="login.html">AUTH</a></li>

            <li><img src="contact.png"><a href="contact.html">CONTACT</a></li>

        </ul>
</div>
       <div class="middle2 middle" id="middle">
        <div class="top_news2 top_news" id="top_news">
            <div class="theme" id="theme">
                <h2>NEWS</h2>
                <h3>ブログ・お知らせ</h3>
            </div>
            <div class="new" id="new">
            <div class="top_news_body" id="top_news_body">
                <?php
$results = glob('./uploads/news/*.json');
$amount = count($results);
$count3 = 0;
foreach ($results as $path) {
    $count3++;
    if($count3 > $amount-6 ){
    $raw = file_get_contents($path);
    $json = json_decode($raw, true);
    $item = $json[0];
    $count = count($item["article"]);
    $count2 = 0;
    $count3 = 0;
    $theme_photo = '';
    foreach($item["article"] as $content){
        $count3++;
        if(preg_match('/\.(jpg|jpeg|png|gif|heic|JPG|PNG|GIF|HEIC|JPEG)$/i', $content) && strlen($theme_photo)  == 0){
        $theme_photo = $content;
        }else if($count3 == 1){
            $category = $content;
            if($category == "合宿報告"){
                    $color = "#4366B0";
            }else if($category == "新勧"){
                    $color = "#43b053";
            }else if($category == "その他"){
                    $color = "#b04343";
            }
        }else{
            $count2++;
            if($count2 == 1){
                $theme_text = $content;
                if(strlen($theme_text) > 80){
                    $theme_text = substr($theme_text,0,80)."...";
                }else{
                    $theme_text = $theme_text."...";
                }
            }
        }
    }
    
?>
    <div class="block3" id="block1" onclick='location.href="read_content.php?content=<?=urlencode($path)?>"'>
        <img src="./uploads/photos/<?= htmlspecialchars($theme_photo)?>" alt="">
        <div class="block2">
        <h3><?= htmlspecialchars($item["title"]) ?><small class="cate" id="cate" style="background-color:<?=htmlspecialchars($color)?>"><?=htmlspecialchars($category)?></small><small class="time" id="time"><?= htmlspecialchars($item["date_write"]) ?></small></h3>
        <p><?=htmlspecialchars($theme_text)?></p>
        </div>
    </div>
<?php
    }
} // ← foreach の閉じタグ
?>
            </div>
            </div>
            <div class="past" id="past">
                <h4>すべてのNEWS</h4>
                <div class="time_ta" id="time_ta">
                    <p class="news_cate">時間で調べる</p>
                    <p id="this_year" onclick='select("this_year")'>今年</p>
                    <p id="past_year" onclick='select("past_year")'>過去</p>
                    <p class="news_cate">種類で調べる</p>
                    <p id="report" onclick='select("report")'>合宿報告</p>
                    <p id="intro" onclick='select("intro")'>新歓</p>
                    <p id="other" onclick='select("other")'>その他</p>
                </div>
                <div class="order" id="order">
                    <p>表示項目：</p>
                    <p id="this_year2" onclick='d_select("this_year")'>今年</p>
                    <p id="past_year2" onclick='d_select("past_year")'>過去</p>
                    <p id="report2" onclick='d_select("report")'>合宿報告</p>
                    <p id="intro2" onclick='d_select("intro")'>新歓</p>
                    <p id="other2" onclick='d_select("other")'>その他</p>
                </div>
                <div class="news_body2" id="news_body">

<!--恥ずかしいくらいくそコード書いてるから早く美しくしたい-->
                    <?php
                     $results = glob("./uploads/news/*.json");
                     $writed = [];

                        if(isset($_GET["sort"])){
                            $sort = json_decode($_GET["sort"],true);
                            foreach($sort as $rule){
                                
                                if($rule == "this_year"){
                                    
                        foreach($results as $path){//なぜか複数回カウントされちゃってる 8/28
                            $date = json_decode(
                            file_get_contents($path),
                            true
                        );
                    $date2 = substr($date[0]["date_write"],0,4);
                    $cate = $date[0]["article"][0];
                    $date_this_year = date("Y");
                    if($date2 == $date_this_year){
                        $w_count = 0;
                        foreach($writed as $path2){
                            if($path == $path2){
                                $w_count++;
                            }
                        }
                        if($w_count == 0){
                        $raw = file_get_contents($path);
                        array_push($writed,$path);
                        $json = json_decode($raw, true);
                        $item = $json[0];
                        $count = count($item["article"]);
                        $count2 = 0;
                        $count3 = 0;
                        $theme_photo = '';
    foreach($item["article"] as $content){
        $count3++;
        if(preg_match('/\.(jpg|jpeg|png|gif|heic|JPG|PNG|GIF|HEIC|JPEG)$/i', $content) && strlen($theme_photo)  == 0){
        $theme_photo = $content;
        }else if($count3 == 1){
            $category = $content;
            if($category == "合宿報告"){
                    $color = "#4366B0";
            }else if($category == "新勧"){
                    $color = "#43b053";
            }else if($category == "その他"){
                    $color = "#b04343";
            }
        }else{
            $count2++;
            if($count2 == 1){
                $theme_text = $content;
                if(strlen($theme_text) > 80){
                    $theme_text = substr($theme_text,0,80)."...";
                }else{
                    $theme_text = $theme_text."...";
                }
            }
        }
    }
        ?>

            <div class="block3" id="block1" onclick='location.href="read_content.php?content=<?=urlencode($path)?>"'>
        <img src="./uploads/photos/<?= htmlspecialchars($theme_photo)?>" alt="">
        <div class="block2">
        <h3><?= htmlspecialchars($item["title"]) ?><small class="cate" id="cate" style="background-color:<?=htmlspecialchars($color)?>"><?=htmlspecialchars($category)?></small><small class="time" id="time"><?= htmlspecialchars($item["date_write"]) ?></small></h3>
        <p><?=htmlspecialchars($theme_text)?></p>
        </div>
    </div>

        <?php 
    }
    }
                    }
                        
                    
                        
        }else if($rule == "past_year"){
            
                        foreach($results as $path){
                            $date = json_decode(
                            file_get_contents($path),
                            true
                        );
                    $date2 = substr($date[0]["date_write"],0,4);
                    $cate = $date[0]["article"][0];
                    $date_this_year = date("Y");
                    if($date2 != $date_this_year){
                                                $w_count = 0;
                        foreach($writed as $path2){
                            if($path == $path2){
                                $w_count++;
                            }
                        }
                        if($w_count == 0){
                        $raw = file_get_contents($path);
                        array_push($writed,$path);
                        $json = json_decode($raw, true);
                        $item = $json[0];
                        $count = count($item["article"]);
                        $count2 = 0;
                        $count3 = 0;
                        $theme_photo = '';
    foreach($item["article"] as $content){
        $count3++;
        if(preg_match('/\.(jpg|jpeg|png|gif|heic|JPG|PNG|GIF|HEIC|JPEG)$/i', $content) && strlen($theme_photo)  == 0){
        $theme_photo = $content;
        }else if($count3 == 1){
            $category = $content;
            if($category == "合宿報告"){
                    $color = "#4366B0";
            }else if($category == "新勧"){
                    $color = "#43b053";
            }else if($category == "その他"){
                    $color = "#b04343";
            }
        }else{
            $count2++;
            if($count2 == 1){
                $theme_text = $content;
                if(strlen($theme_text) > 80){
                    $theme_text = substr($theme_text,0,80)."...";
                }else{
                    $theme_text = $theme_text."...";
                }
            }
        }
    }

                ?>

            <div class="block3" id="block1" onclick='location.href="read_content.php?content=<?=urlencode($path)?>"'>
        <img src="./uploads/photos/<?= htmlspecialchars($theme_photo)?>" alt="">
        <div class="block2">
        <h3><?= htmlspecialchars($item["title"]) ?><small class="cate" id="cate" style="background-color:<?=htmlspecialchars($color)?>"><?=htmlspecialchars($category)?></small><small class="time" id="time"><?= htmlspecialchars($item["date_write"]) ?></small></h3>
        <p><?=htmlspecialchars($theme_text)?></p>
        </div>
    </div>

        <?php 
                        }
                    }
                        }
                                }else if($rule == "report"){
                        foreach($results as $path){
                            $date = json_decode(
                            file_get_contents($path),
                            true
                        );
                    $cate = $date[0]["article"][0];
                    if($cate == "合宿報告"){
                        $w_count = 0;
                        foreach($writed as $path2){
                            if($path == $path2){
                                $w_count++;
                            }
                        }
                        if($w_count == 0){
                        $raw = file_get_contents($path);
                        array_push($writed,$path);
                        $json = json_decode($raw, true);
                        $item = $json[0];
                        $count = count($item["article"]);
                        $count2 = 0;
                        $count3 = 0;
                        $theme_photo = '';
    foreach($item["article"] as $content){
        $count3++;
        if(preg_match('/\.(jpg|jpeg|png|gif|heic|JPG|PNG|GIF|HEIC|JPEG)$/i', $content) && strlen($theme_photo)  == 0){
        $theme_photo = $content;
        }else if($count3 == 1){
            $category = $content;
            if($category == "合宿報告"){
                    $color = "#4366B0";
            }else if($category == "新勧"){
                    $color = "#43b053";
            }else if($category == "その他"){
                    $color = "#b04343";
            }
        }else{
            $count2++;
            if($count2 == 1){
                $theme_text = $content;
                if(strlen($theme_text) > 80){
                    $theme_text = substr($theme_text,0,80)."...";
                }else{
                    $theme_text = $theme_text."...";
                }
            }
        }
    }
                ?>

            <div class="block3" id="block1" onclick='location.href="read_content.php?content=<?=urlencode($path)?>"'>
        <img src="./uploads/photos/<?= htmlspecialchars($theme_photo)?>" alt="">
        <div class="block2">
        <h3><?= htmlspecialchars($item["title"]) ?><small class="cate" id="cate" style="background-color:<?=htmlspecialchars($color)?>"><?=htmlspecialchars($category)?></small><small class="time" id="time"><?= htmlspecialchars($item["date_write"]) ?></small></h3>
        <p><?=htmlspecialchars($theme_text)?></p>
        </div>
    </div>

        <?php 

                    }
                    }
                        }

                                }else if($rule == "intro"){
                       foreach($results as $path){
                            $date = json_decode(
                            file_get_contents($path),
                            true
                        );
                    $cate = $date[0]["article"][0];
                    if($cate == "新勧"){
                        $w_count = 0;
                        foreach($writed as $path2){
                            if($path == $path2){
                                $w_count++;
                            }
                        }
                        if($w_count == 0){
                        $raw = file_get_contents($path);
                        array_push($writed,$path);
                        $json = json_decode($raw, true);
                        $item = $json[0];
                        $count = count($item["article"]);
                        $count2 = 0;
                        $count3 = 0;
                        $theme_photo = '';
    foreach($item["article"] as $content){
        $count3++;
        if(preg_match('/\.(jpg|jpeg|png|gif|heic|JPG|PNG|GIF|HEIC|JPEG)$/i', $content) && strlen($theme_photo)  == 0){
        $theme_photo = $content;
        }else if($count3 == 1){
            $category = $content;
            if($category == "合宿報告"){
                    $color = "#4366B0";
            }else if($category == "新勧"){
                    $color = "#43b053";
            }else if($category == "その他"){
                    $color = "#b04343";
            }
        }else{
            $count2++;
            if($count2 == 1){
                $theme_text = $content;
                if(strlen($theme_text) > 80){
                    $theme_text = substr($theme_text,0,80)."...";
                }else{
                    $theme_text = $theme_text."...";
                }
            }
        }
    }
                ?>

            <div class="block3" id="block1" onclick='location.href="read_content.php?content=<?=urlencode($path)?>"'>
        <img src="./uploads/photos/<?= htmlspecialchars($theme_photo)?>" alt="">
        <div class="block2">
        <h3><?= htmlspecialchars($item["title"]) ?><small class="cate" id="cate" style="background-color:<?=htmlspecialchars($color)?>"><?=htmlspecialchars($category)?></small><small class="time" id="time"><?= htmlspecialchars($item["date_write"]) ?></small></h3>
        <p><?=htmlspecialchars($theme_text)?></p>
        </div>
    </div>

        <?php 
    
                        }
                    }
                        }
                                }else if($rule == "other"){
                       foreach($results as $path){
                            $date = json_decode(
                            file_get_contents($path),
                            true
                        );
                    $cate = $date[0]["article"][0];
                    if($cate == "その他"){
                        $w_count = 0;
                        foreach($writed as $path2){
                            if($path == $path2){
                                $w_count++;
                            }
                        }
                        if($w_count == 0){
                        $raw = file_get_contents($path);
                        array_push($writed,$path);
                        $json = json_decode($raw, true);
                        $item = $json[0];
                        $count = count($item["article"]);
                        $count2 = 0;
                        $count3 = 0;
                        $theme_photo = '';
    foreach($item["article"] as $content){
        $count3++;
        if(preg_match('/\.(jpg|jpeg|png|gif|heic|JPG|PNG|GIF|HEIC|JPEG)$/i', $content) && strlen($theme_photo)  == 0){
        $theme_photo = $content;
        }else if($count3 == 1){
            $category = $content;
            if($category == "合宿報告"){
                    $color = "#4366B0";
            }else if($category == "新勧"){
                    $color = "#43b053";
            }else if($category == "その他"){
                    $color = "#b04343";
            }
        }else{
            $count2++;
            if($count2 == 1){
                $theme_text = $content;
                if(strlen($theme_text) > 80){
                    $theme_text = substr($theme_text,0,80)."...";
                }else{
                    $theme_text = $theme_text."...";
                }
            }
        }
    }
                ?>

            <div class="block3" id="block1" onclick='location.href="read_content.php?content=<?=urlencode($path)?>"'>
        <img src="./uploads/photos/<?= htmlspecialchars($theme_photo)?>" alt="">
        <div class="block2">
        <h3><?= htmlspecialchars($item["title"]) ?><small class="cate" id="cate" style="background-color:<?=htmlspecialchars($color)?>"><?=htmlspecialchars($category)?></small><small class="time" id="time"><?= htmlspecialchars($item["date_write"]) ?></small></h3>
        <p><?=htmlspecialchars($theme_text)?></p>
        </div>
    </div>

        <?php 
    
                        }
                    }
                        }
                                }
                            }
                        }

            ?>

        </div>
    </div>
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <script src="home.js"></script>
    
    </body>
    </html>