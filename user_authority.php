<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.cdnfonts.com/css/now" rel="stylesheet">
      <link rel="stylesheet" href="member_info.css"></link>
    </head>
    <body onload="auth_check()">
        <section class="top" id="top">
            <img src="012.jpg"><h1>東京都立大学航空部 管理者ページ</h1>
        </section>
    <div class="bl1" id="bl1">
    <h1>新規ユーザー登録</h1>
        <div class="block1">
        <p>ユーザー名</p>
        <input type="text" id="register_username" value="" placeholder = "username">
        </div>
        <div class="block1">
        <p>パスワード</p>
        <input type="password" id="register_password" value="" placeholder = "password">
        </div>
        <div class="block1">
        <p>権限</p>
        <input type="number" id="register_state" value="" placeholder = "3">
        </div>
        <button onlick="register()">登録</button>
    </div>
    <div class="bl1" id="bl1">
    <h1>登録情報変更</h1>
<!--どうやって外部から見えないように、登録情報を表示するか-->
    </div>
    <style>
        .bl1{
            margin-left:5vw;
        }
        .bl1 a{
            width:10vw;
            height:4vw;
            text-align: center;
            line-height: 4vw;
            color:white;
            margin:1vw;
            font-size:15px;
            background-color: #4366B0;
            display: inline-block;
            text-decoration: none;
        }
    </style>
    <script src="auth.js"></script>
    </body>
</html>