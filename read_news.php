<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="home.css">
    </head>
    <body onload="photo_change()">
       <div class="top" id="top">
        
        <img src="012.jpg" alt="航空部">
        <div class="theme" id="theme">
        <small>Tokyo&nbsp;Metropolitan&nbsp;University&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aviation Club</small>
        <h1>東京都立大学 航空部</h1>
        </div>
        <div class="menus" id="menus">
            <p class="news" id="news">お知らせ</p>
            <p class="us" id="us">メンバー</p>
            <p class="other" id="other" onclick='location.href="login.html"'>部員向け</p>
        </div>
       </div> 
       <div class="middle2 middle" id="middle">
        <div class="top_news2 top_news" id="top_news">
            <div class="theme" id="theme">
            <h2>NEWS</h2>
            <h3>ブログ・お知らせ</h3>
            </div>
            <div class="top_news_body" id="top_news_body">
                <div class="block" id="block1">
                    <img src="./images/home-bg.jpg" alt="">
                    <div class="block2">
                    <h3>5月前半合宿</h3>
                    <p>こんにちは、2年の松尾です。今合宿は天候に恵まれず...</p>
                    </div>
                </div>
                <div class="block" id="block1">
                    <img src="./images/home-bg.jpg" alt="">
                    <div class="block2">
                    <h3>5月前半合宿</h3>
                    <p>こんにちは、2年の松尾です。今合宿は天候に恵まれず...</p>
                    </div>
                </div>
                <div class="block" id="block1">
                    <img src="./images/home-bg.jpg" alt="">
                    <div class="block2">
                    <h3>5月前半合宿</h3>
                    <p>こんにちは、2年の松尾です。今合宿は天候に恵まれず...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$results = glob('./uploads/news/*.json');

foreach ($results as $path) {
    $raw = file_get_contents($path);
    $json = json_decode($raw, true);
    $item = $json[0];
    $count = count($item["article"]);
?>
    <div class="news-item">
        <h1><?= htmlspecialchars($item["title"]) ?></h1>
        <p><?= htmlspecialchars($item["date_train"]) ?></p>
        <p><?= htmlspecialchars($item["date_write"]) ?></p>
    </div>

    <?php for($i=0; $i<$count; $i++): ?>
        <?php 
            $value = $item["article"][$i];
            $isImage = preg_match('/\.(jpg|jpeg|png|gif)$/i', $value);
        ?>

        <?php if($isImage): ?>
            <img src="./uploads/photos/<?= htmlspecialchars($value) ?>">
        <?php else: ?>
            <p><?= htmlspecialchars($value) ?></p>
        <?php endif; ?>
    <?php endfor; ?>

<?php
} // ← foreach の閉じタグ
?>
</body>
</html>