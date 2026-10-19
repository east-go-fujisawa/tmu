<!DOCTYPE html>
<html lang="ja">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title>東京都立大学 航空部</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">


<!--link rel="stylesheet" href="style.css"-->
<link rel="stylesheet" href="home.css">

  <!--google アドセンス-->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2346293632116538"
     crossorigin="anonymous"></script>
</head>
    <body onload="photo_change()">
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

            <li><a href="read_news.html">NEWS</a></li>

            <li><a href="member.html">MEMBER</a></li>

            <li><a href="#">AUTH</a></li>

            <li><a href="#">CONTACT</a></li>

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
<?php
$param = $_GET['content'];
    $raw = file_get_contents($param);
    $json = json_decode($raw, true);
    $item = $json[0];
    $count = count($item["article"]);
    $category = $item["article"][0];
            if($category == "合宿報告"){
                    $color = "#4366B0";
            }else if($category == "新勧"){
                    $color = "#43b053";
            }else if($category == "その他"){
                    $color = "#b04343";
            }   
?>

<div class="options" id="options">
    <p onclick='location.href="read_news2.php"'>< 一覧に戻る</p>
</div>
<div class="news_content" id="news_content">
    <div class="theme" id="theme">
        <h1 class="title" id="title"><?= htmlspecialchars($item["title"]) ?></h1>
        <small class="cate" id="cate" style="background-color:<?=htmlspecialchars($color)?>;"><?=htmlspecialchars($item["article"][0])?></small>
        <div class="ps" id="ps">
        <p class="term" id="term">合宿期間：<?= htmlspecialchars($item["date_train"]) ?></p>
        <p class="post" id="post">投稿日：<?= htmlspecialchars($item["date_write"]) ?></p>
        </div>
    </div>
    <div class="body" id="body">
    <pre>
        <?php for($i=1; $i<$count; $i++): ?>
        <?php 
            $value = $item["article"][$i];
            $isImage = preg_match('/\.(jpg|jpeg|png|gif)$/i', $value);
        ?>

        <?php if($isImage): ?>
            <img src="./uploads/photos/<?= htmlspecialchars($value) ?>">
        <?php else:
            $value = str_replace("LF","\n",$value);
            echo htmlspecialchars($value);
            ?>
        <?php endif; ?>
    <?php endfor; ?>
        <!--画像のサイズがでかすぎると、アップロードできていないっぽいから、ブログ投稿ページの段階で、画像のアップロードが完了していることを確認するように仕様を変更した方が良いかもしれない。
        アップロードされていなければ、別手段でアップロードするページを作っとくとか、
        手動でアップロードさせるといった方法をとらないとまずいかも？
        とりあえず、画像サイズの問題であることは確実だと思う。
        -->
    </pre>
    </div>
    <p onclick='location.href="read_news2.php"' class="options2">< 一覧に戻る</p>
</div>
</div>
<script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
<script src="home.js"></script>
</body>
</html>