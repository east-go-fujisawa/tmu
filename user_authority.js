    var param = "";
    var username = "";
    var state = "";
    var loading_status = "run";
function auth_check(){
    loading();
    var url = location.search;
    console.log(url);   
    url = new URLSearchParams(url);
    try{
    param = url.get('token');
    username = url.get('username');
    console.log(param);
    console.log(username);
    var json = [];
    json.push(param);
    json.push(username);
    json.push("get_state")//これを直接JSに記述するのはあまり良くない気がする

    var formdata = new FormData();
    formdata.append(
        "login_auth",
        JSON.stringify(json)
    );
    fetch('login_check.php',{
        "method":"post",
        "body":formdata
    })
    .then(resjson=>{
        if(resjson.ok){
            return resjson.json()
        }
    })
    .then(json =>{
        console.log(json);
        //ここのif分岐がうまくいってない
        if(json["result"] == "success" && json["state"] == 1){
            //alert("ログインしました");
            state = json['state'];
            document.getElementById("usr_name").innerHTML = username;
            document.getElementById("cha_state").value = state;
            loading_status = "stop";
        }else{
            loading_status = "stop";
            alert("ログインに失敗しました");
            location.replace="login.html";
        }
    })
    .catch(err=>{
        console.log(err);
        loading_status = "stop";
        alert("ログインに失敗しました2");
        location.replace = "login.html";
    })
    console.log(param);
    }catch(err){
        console.log(err);
        loading_status = "stop";
        alert("ログインに失敗しました。");
        location.replace = "login.html";
    }
}

var branch = [];
var info = [];
var auth = [];

function register(){

    var regi_username = document.getElementById("register_username").value;
    var regi_password = document.getElementById("register_password").value;
    var regi_state = document.getElementById("register_state").value;

    if(regi_username.length == 0 || regi_password.length == 0 || regi_state.length == 0){
        alert("空欄があります");
        return;
    }else if(regi_state < state){
        alert("権限を下げてください");
        return;
    }
    loading_status = 'run';
    loading();


    branch.push("register");
    info.push(regi_username);
    info.push(regi_password);
    info.push(regi_state);
    auth.push(param);
    auth.push(username);
    auth.push(state);
    var formdata = new FormData();
    formdata.append(
        "branch",
        JSON.stringify(branch)
    );
    formdata.append(
        "auth",
        JSON.stringify(auth)
    );
    formdata.append(
        "info",
        JSON.stringify(info)
    );

    fetch("user_register.php",{
        "method":"post",
        "body":formdata
    })
    .then(resjson => {
        if(resjson.ok){
            return resjson.json()
        }
    })
    .then(json =>{
        loading_status = 'stop';
        if(json["result"] == "success"){
            alert("登録が完了しました");
        }else if(json["result"] == "fail_username"){
            alert("このユーザー名は登録できません");
        }else{
            alert("エラーが発生しました");
        }
    })
    .catch(err =>{
        loading_status = 'stop';
        console.log(err);
        alert("エラーが発生しました2");
    })
}

function change(){
    var branch = [];
    var info = [];
    var auth = [];
    
    var cha_pass = document.getElementById("cha_password").value;
    var cha_state = document.getElementById("cha_state").value;
    if(cha_pass.length == 0 || cha_state == 0){
        alert("空欄があります");
        return;
    }else if(cha_state < state){
        alert("権限を下げてください");
        return;
    }
    loading_status = 'run';
    loading();

    branch.push("change");
    info.push(username);
    info.push(cha_pass);
    info.push(cha_state);
    auth.push(param);
    auth.push(username);
    auth.push(state);

    var formdata = new FormData();
    formdata.append(
        "branch",
        JSON.stringify(branch)
    )
    formdata.append(
        "info",
        JSON.stringify(info)
    );
    formdata.append(
        "auth",
        JSON.stringify(auth)
    );

     fetch("user_register.php",{
        "method":"post",
        "body":formdata
    })
    .then(resjson => {
        if(resjson.ok){
            return resjson.json()
        }
    })
    .then(json =>{
        loading_status = 'stop';
        if(json["result"] == "success"){
            alert("変更が完了しました");

        }else{
            alert("エラーが発生しました");
        }
    })
    .catch(err =>{
        loading_status = 'stop';
        console.log(err);
        alert("エラーが発生しました2");
    })   
}

function back(){
    location.href="auth.html?token="+param+"&username="+username;
}


function loading(){
    if(loading_status == "run"){
        document.getElementById("loading").style.display = "block";
        document.getElementById("l_text").style.display = "block";
        $("#l_text").animate({
            "opacity":1
        },0);
        $("#l_text").animate({
            "opacity":0
        },500);
        setTimeout(()=>{
            loading();
        },500)
    }else{
        document.getElementById("loading").style.display = "none";
        document.getElementById("loading").style.opacity = "0";
        document.getElementById("l_text").style.display = "none";
        document.getElementById("l_text").style.opacity = "0";
    }

}