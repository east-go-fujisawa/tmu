
var count = 0;
function next(num){
    $("#about_us_theme").animate({
        "opacity":1,
        "left":'15vw'
    },0)
    $("#about_us_theme").animate({
        "opacity":1,
        "left":'10vw'
    },250)
    $("#our_photos").animate({
        "opacity":0.75
    },0)
    $("#our_photos").animate({
        "opacity":1
    },200)
    if(num == 1 && count < 6){
        count++;
    }else if(num == 2 && count > 0){
        count--;
    }
    if(count == 0){
        document.getElementById("about_us_h2").innerHTML = "About Us";
        document.getElementById("about_us_h3").innerHTML = "航空部ってなに？";
        document.getElementById("intro_text").innerHTML = "東京都立大学航空部は、グライダーを使って実際に空を飛ぶことを目標に活動している部活です！週末は飛行場で、機体の組み立てや点検、飛行訓練などを行っています。操縦だけでなく、機体を安全に飛ばすための準備や運航も学生自身が担当するので、航空について幅広く学べるのも魅力です！部員のほとんどが大学から始めているため、経験や知識は一切必要ありません。飛行機や空が好きな人、新しいことに挑戦してみたい人は、ぜひ一度見学に来てください！";
        document.getElementById("our_photos").src = 'ujklPdxJSWO03hKADODUhg.jpg';
        document.getElementById("nt_bt2").style.display = "none";
    }
    else if(count == 1){
        document.getElementById("about_us_h2").innerHTML = "Introduction";
        document.getElementById("about_us_h3").innerHTML = "自己紹介";
        document.getElementById("intro_text").innerHTML = "こんにちは！東京都立大学航空部です！私たちは、3年が2名、2年が10名、1年が10名の計22名で活動しています！私たちは通常、1泊2日の合宿を月に一度行います！長期休み期間中は、4泊5日など長期間の合宿を行います！主な活動場所は、埼玉県熊谷市にある妻沼滑空場というところです！";
        document.getElementById("our_photos").src = 'H4RNuCDCSkuc_W5aLMLgSg.jpg';
        document.getElementById("nt_bt2").style.display = "block";
    }else if(count == 2){
        document.getElementById("about_us_h2").innerHTML = "Activity";
        document.getElementById("about_us_h3").innerHTML = "活動紹介";
        document.getElementById("intro_text").innerHTML = "私たちの活動は大きく分けて2つです！一つは、実際に機体に乗り込み自ら操縦すること。もう一つは地上において、機体の離陸を準備したり着陸後の機体を移動したりすることです！そのほかにも、滑空場を出ると飛行力学や操縦方法などの座学を受けたり、機体の整備を行ったり、グライダー発航に欠かせない機材の点検などさまざまな活動をしています。";
        document.getElementById("our_photos").src = 'member-bg.jpg';
    }else if(count == 3){
        document.getElementById("about_us_h2").innerHTML = "Prepare";
        document.getElementById("about_us_h3").innerHTML = "発航前準備";
        document.getElementById("intro_text").innerHTML = "離陸に向け、準備を始めます。パイロットは決まった手順に沿って、発航前点検を行い待機します。その他の部員は、グライダーを発航点まで移動させ、離陸させるための機材を準備し、機体と接続し離陸準備を整えます。準備ができると、翼端者(地上のパイロット)はピスト(管制塔)のGOサインと離陸準備が完了していることを確認し、パイロットに向けて発航可能の合図を出します。";
        document.getElementById("our_photos").src = 'photo1.JPG';
    }else if(count == 4){
        document.getElementById("about_us_h2").innerHTML = "Take off";
        document.getElementById("about_us_h3").innerHTML = "離陸";
        document.getElementById("intro_text").innerHTML = "大空へ飛んでいきます。パイロットからのGOサインが出ればあとは大空へ向かって飛んでいくまでです。";
        document.getElementById("our_photos").src = 'photo2.JPG';
    }else if(count == 5){
        document.getElementById("about_us_h2").innerHTML = "Soaring";
        document.getElementById("about_us_h3").innerHTML = "滞空";
        document.getElementById("intro_text").innerHTML = "大空を自由自在に飛びます";
        document.getElementById("our_photos").src = 'IMG_1084_Original.jpeg';
        document.getElementById("nt_bt").style.display = "block";
    }
    else if(count == 6){
        document.getElementById("about_us_h2").innerHTML = "Landing";
        document.getElementById("about_us_h3").innerHTML = "着陸";
        document.getElementById("intro_text").innerHTML = "滑走路に向かって着陸します";
        document.getElementById("our_photos").src = 'photo3.JPG';
        document.getElementById("nt_bt").style.display = "none";
    }
}

var ex_about_us = "";
function explaination_get(){
    var formdata = new FormData();
    var branch = ["get_ex"];

    formdata.append(
        "branch",
        JSON.stringify(formdata)
    )

    fetch("explain.json",{
        "method":"post",
        "body":formdata
    })
    .then(resjson =>{
        if(resjson.ok){
            return resjson.json()
        }
    })
    .then(json =>{
        console.log(json);
        ex_about_us = json;
    })
    .catch(err =>{
        console.log(err);
        alert("読み込みエラーが発生しました");
    })
}

function write_ex(){
    var count = -1;
    var html_text = '<select id="ex_se">';
    for(var intro of ex_about_us[0]["intro"]){
        html_text+='<option value="'+intro+'">'+intro+'</option>';
    }
    html_text+='</select>';

}
function change_ex(){
    var write_data = document.getElementById("text_ex").value();

}