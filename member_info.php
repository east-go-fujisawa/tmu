<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.cdnfonts.com/css/now" rel="stylesheet">
      <link rel="stylesheet" href="member_info.css"></link>
    </head>
    <body onload="auth_check()">
        <section class="top" id="top" onclick='back()'>
            <img src="012.jpg"><h1>東京都立大学航空部 メンバー編集ページ</h1>
        </section>
        <div class="new_member" id="new_member">
            <h2>メンバー追加<button id="regi_bt" onclick="register()">登録</button></h2>
            <div>
            <p>名前</p>
            <input type="text" id="member_name" placeholder="都立太郎" value="">
            </div><div>
            <p>Name</p>
            <input type="text" id="member_name_en" placeholder="ToritsuTarou" value="">
            </div><div>
            <p>学年</p>
            <input type="text" id="grade" placeholder="B1" value="">            
            </div><div>
            <p>役職</p>
            <input type="text" id="status" placeholder="機体係・首相" value="">
            </div><div>
            <p>学科</p>
            <input type="text" id="major" placeholder="航空宇宙" value="">
            </div><div>
            <p>出身</p>
            <input type="text" id="birthplace" placeholder="神奈川県" value="">
            </div><div>
            <p>資格</p>
            <input type="text" id="license" placeholder="自家用操縦士" value="">
            </div><div>
            <p>紹介文</p>
            <textarea id="intro" value=""></textarea>
            </div><div>
            <p>写真</p>
            <input type="file" id="up_pic">
            </div>
        </div>
        <div class="member_change new_member " id="member_change">
<?php
    if(isset($_GET["name"])){
        $name = $_GET["name"];
        $path = './uploads/member/'.$name.'.json';
        $member_info = json_decode(
            file_get_contents($path),
            true
        );
?>

      
            <h2>メンバー編集<button onclick='change_info("<?= htmlspecialchars($member_info[0]["photo_name"]) ?>","<?= htmlspecialchars($member_info[0]["path"]) ?>")'>変更</button><button class="de_bt"id="regi_bt" onclick='delete_info("<?= htmlspecialchars($member_info[0]["path"]) ?>")'>削除</button></h2>
            <div>
            <p>選択</p>
            <select id="members">

    <option value="<?= htmlspecialchars($member_info[0]["path"]) ?>"><?= htmlspecialchars($member_info[0]["name_ja"]) ?></option>

<?php
    }else{
    ?>
    <h2>メンバー編集<button id="regi_bt" onclick='change_info()'>変更</button></h2>
    <div>
    <p>選択</p>
    <select id="members">
    <option value="">選択してください</option>
    <?php
    }

    $results = glob('./uploads/member/*.json');

    foreach($results as $path){
    $data = json_decode(
        file_get_contents($path),
        true
        );
?>
    <option value="<?= htmlspecialchars($data[0]["path"]) ?>"><?= htmlspecialchars($data[0]["name_ja"]) ?></option>
<?php
    }
?>
            </select>
            </div><div>
            <p>名前</p>
            <input type="text" id="member_name2" placeholder="都立太郎" value="<?=htmlspecialchars($member_info[0]["name_ja"])?>">
            </div><div>
            <p>Name</p>
            <input type="text" id="member_name_en2" placeholder="ToritsuTarou" value="<?=htmlspecialchars($member_info[0]["name_en"])?>">
            </div><div>
            <p>学年</p>
            <input type="text" id="grade2" placeholder="B1" value="<?=htmlspecialchars($member_info[0]["grade"])?>">            
            </div><div>
            <p>役職</p>
            <input type="text" id="status2" placeholder="機体係・首相" value="<?=htmlspecialchars($member_info[0]["status"])?>">
            </div><div>
            <p>学科</p>
            <input type="text" id="major2" placeholder="航空宇宙" value="<?=htmlspecialchars($member_info[0]["major"])?>">
            </div><div>
            <p>出身</p>
            <input type="text" id="birthplace2" placeholder="神奈川県" value="<?=htmlspecialchars($member_info[0]["birthplace"])?>">
            </div><div>
            <p>資格</p>
            <input type="text" id="license2" placeholder="自家用操縦士" value="<?=htmlspecialchars($member_info[0]["license"])?>">
            </div><div>
            <p>紹介文</p>
            <textarea id="intro2" value="<?=htmlspecialchars($member_info[0]["intro"])?>"><?=htmlspecialchars($member_info[0]["intro"])?></textarea>
            </div><div>
            <p>写真</p>
            <input type="file" id="up_pic2">
            </div>
        </div>
                <div class="loading" id="loading"><p class="l_text" id="l_text">Loading...</p></div>
        <style>
            .loading{
            position:absolute;
            top:0;
            left:0;
            width:100vw;
            height: 100vh;
            padding:0;
            margin:0;
            text-align:center;
            line-height:100vh;
            font-size:20px;
            font-weight:600;
            background-color: rgba(0, 0, 0, 0.2);
            z-index:1000;
            display: none;
            opacity: 0;
        }
        .l_text{
            display: none;
            opacity: 0;
        }
        </style>
        <script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
        <script src="member_info.js"></script>
    </body>
</html>