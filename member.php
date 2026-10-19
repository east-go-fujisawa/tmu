<!DOCTYPE html>
<html lang="ja">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title>東京都立大学航空部 メンバー紹介</title>
    <meta name="destriction" content="東京都立大学航空部のメンバー紹介ページ">
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
    <body>
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


       <div class="middle2 middle" id="middle3">
            <div class="top_news2 top_news" id="top_news">
                <div class="theme" id="theme">
                    <h2>MEMBER</h2>
                    <h3>部員紹介</h3>
                </div>
            </div>
       </div>
       <div class="members" id="members">
<?php
    $result = glob("./uploads/member/*.json");
    $count = 0;
    foreach($result as $path){
        $data = json_decode(
            file_get_contents($path),
            true
        );
        $count++;
?>
           <div class="block1" id="block<?=htmlspecialchars($count)?>">
                <img src="./uploads/member/<?=htmlspecialchars($data[0]["photo_name"])?>" alt="">
                <div class="titles" id="titles">
                    <ruby><?=htmlspecialchars($data[0]["name_ja"])?><rt><?=htmlspecialchars($data[0]["name_en"])?></rt></ruby>
                    <small><?=htmlspecialchars($data[0]["grade"])?>/<?=htmlspecialchars($data[0]["status"])?></small>
                </div>
                <div class="detail" id="detail2" onclick='pop(<?=htmlspecialchars($count)?>,"<?=htmlspecialchars($path)?>")'>もっと詳しく</div>
            </div>
<?php
    }
?>

 
       </div>
       <div class="pop" id="pop">
            <div class="block2" id="pop_block2">
                <img src="./uploads/member/no_image.jpg" alt="" id="pop_img">
                <div class="titles" id="titles">
                    <ruby id="name">都立 太郎<rt id="name_eng">Toritsu Taro</rt></ruby>
                    <p id="grade">学年：1年</p>
                    <p id="status">役職：機体</p>
                    <p id="major">学科：航空宇宙</p>
                    <p id="birth">出身：埼玉</p>
                    <p id="license">資格：自家用操縦士</p>
                </div>
                <div class="com" id="com">
                    <p>北の国での生活に嫌気がさしたようで大学受験をへて東京にやってきた。 本人は東京移住のことを脱北と言っている。 MT免許を持っているということで 動力担当になったが運転が笑えないくらいド下手という致命的な欠陥がある。</p>
                </div>
                <p id="close" class="close">閉じる</p>
            </div>
       </div>
       <script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
        <script src="home.js"></script>
        <script src="member.js"></script>
    </body>
</html>