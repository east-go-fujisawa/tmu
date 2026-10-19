    var param = "";
    var username = "";
function auth_check(){
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
        if(json["result"] == "success"){
            //alert("ログインしました");
        }else{
            alert("ログインに失敗しました1");
            location.href="login.html";
        }
    })
    .catch(err=>{
        console.log(err);
        alert("ログインに失敗しました2");
        location.href = "login.html";
    })
    console.log(param);
    }catch(err){
        console.log(err);
        alert("ログインに失敗しました。");
        //location.href = "login.html";
    }
}

function jump(num){
    if(num == 1){
        location.href="member_info.php?token="+param+"&username="+username;
    }else if(num == 2){
        location.href="write_news.html?token="+param+"&username="+username;
    }else if(num == 3){
        location.href="main_edit.html?token="+param+"&username="+username;
    }else if(num == 4){
        location.href="user_authority.html?token="+param+"&username="+username;
    }
}

function status_check(){
    
}

