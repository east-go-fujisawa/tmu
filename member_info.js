    var param = "";
    var username = "";
    var loading_status = "run";
function auth_check(){
    loading_status = "run";
    loading();

    var url = location.search; 
    url = new URLSearchParams(url);
    try{
    param = url.get('token');
    username = url.get('username');
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
            loading_status = "r";
            return resjson.json()
        }
    })
    .then(json =>{
        if(json["result"] == "success"){
            //alert("ログインしました");
        }else{
            alert("ログインに失敗しました");
            location.href="login.html";
        }
    })
    .catch(err=>{
        loading_status = "r";
        console.log(err);
        alert("ログインに失敗しました");
        location.href = "login.html";
    })
    console.log(param);
    }catch(err){
        loading_status = "r";
        console.log(err);
        alert("ログインに失敗しました。");
        location.href = "login.html";
    }
}

function register(){
    loading_status = "run";
    loading();

    document.getElementById("regi_bt").innerHTML = "登録中";

    try{
    if(document.getElementById("member_name").value && document.getElementById("member_name_en").value ){
        if(document.getElementById("up_pic").files.length > 0){
            var photo = document.getElementById("up_pic").files[0];
        }else{
            var photo = {"name":"no_image.jpg"};
        }
    
    var json = [{
        "name_ja":document.getElementById("member_name").value,
        "name_en":document.getElementById("member_name_en").value,
        "grade":document.getElementById("grade").value,
        "status":document.getElementById("status").value,
        "major":document.getElementById("major").value,
        "birthplace":document.getElementById("birthplace").value,
        "license":document.getElementById("license").value,
        "intro":document.getElementById("intro").value,
        "photo_name":photo.name,
        "path":document.getElementById("member_name_en").value
    }]
    console.log(JSON.stringify(json));
    var formdata = new FormData();
    formdata.append(
        "member_register",
        JSON.stringify(json)
    )
    var apikey = [];
    apikey.push(param);
    var user = [];
    user.push(username);
    var branch = ["register"];

    formdata.append(
        'apikey',
        JSON.stringify(apikey)
    );
    formdata.append(
        "user",
        JSON.stringify(user)
    );
    formdata.append(
        "branch",
        JSON.stringify(branch)
    );
    formdata.append(
        "images[]",
        photo
    );
    console.log(formdata);
fetch('member_register.php',{
    "method":"post",
    "body":formdata
})
.then(resjson =>{
    if(resjson.ok){
        loading_status = "r";
        return resjson.json()
    }
})
.then(json => {
    if(json["result"] == "Success"){
        document.getElementById("regi_bt").innerHTML = "登録";
        alert("登録しました。")
        location.href="member_info.php?token="+param+"&username="+username;
    }else if(json.indexOf("result") != -1 && json.indexOf("Success") != -1){
        alert("登録しました。")
        location.href="member_info.php?token="+param+"&username="+username;
    }else if(json["result"] == "Error_at_apikey"){
            alert("管理者認証でエラーが発生しました。再度ログインしなおしてください。")
        }else{
        document.getElementById("regi_bt").innerHTML = "登録";
        alert("登録に失敗しました。管理者に報告してください。");
    }
})
.catch(err=>{
    loading_status = "r";
    console.log(err);
    alert("登録に失敗しました。管理者に報告してください。");
})
    }else{
    alert("名前・Nameを入力してください。");
    document.getElementById("regi_bt").innerHTML = "登録";
    }
    }catch(err){
        loading_status = "r";
        console.log(err);
        alert("エラーが発生しました。記入等が正しいか確かめてください。")
    }
}

document.getElementById("members").addEventListener("change",()=>{
    var selected = document.getElementById("members").options[document.getElementById("members").selectedIndex];
    location.href="member_info.php?token="+param+"&username="+username+"&name="+selected.value
})


function change_info(photo_name,path){
    if(path){

    }else{
        alert("選択してください");
        return;
    }
    loading_status = "run";
    loading();

    try{
    console.log(photo_name);
    var formdata = new FormData();
     var photo = document.getElementById("up_pic2").files[0];
        if(document.getElementById("up_pic2").files.length > 0){
            formdata.append(
                "images[]",
                photo
            );    
        var photo_status = ["new"];
        }else{
        var photo = {"name":photo_name};
        var photo_status = ["same"];
        }

    var json = [{
        "name_ja":document.getElementById("member_name2").value,
        "name_en":document.getElementById("member_name_en2").value,
        "grade":document.getElementById("grade2").value,
        "status":document.getElementById("status2").value,
        "major":document.getElementById("major2").value,
        "birthplace":document.getElementById("birthplace2").value,
        "license":document.getElementById("license2").value,
        "intro":document.getElementById("intro2").value,
        "photo_name":photo.name,
        "path":path
    }]
 console.log(JSON.stringify(json));
    
    formdata.append(
        "member_register",
        JSON.stringify(json)
    )
    var apikey = [];
    apikey.push(param);
    var user = [];
    user.push(username);
    var branch = ["change"];
    
    formdata.append(
        'apikey',
        JSON.stringify(apikey)
    );
    formdata.append(
        "user",
        JSON.stringify(user)
    );
    formdata.append(
        "branch",
        JSON.stringify(branch)
    );
    formdata.append(
        "photo_status",
        JSON.stringify(photo_status)
    );

    console.log(formdata);
fetch('member_register.php',{
    "method":"post",
    "body":formdata
})
.then(resjson =>{
    if(resjson.ok){
        loading_status = "r";
        return resjson.json()
    }
})
.then(json => {
      if(json["result"] == "Success"){
        alert("登録しました。")
        location.href="member_info.php?token="+param+"&username="+username;
    }else if(json["result"] == "Error_at_apikey"){
            alert("管理者認証でエラーが発生しました。再度ログインしなおしてください。")
        }else{
        alert("登録に失敗しました。管理者に報告してください。");
    }
})
.catch(err=>{
    loading_status = "r";
    console.log(err);
    alert("登録に失敗しました。管理者に報告してください。");
})
    }catch(err){
        loading_status = "r";
        console.log(err);
        alert("正常に処理が完了しませんでした。記入等が正しいか確認してください。")
    }
}

function delete_info(path){
    loading_status = "run";
    loading();

    var json = [];
    json.push(path);
    var apikey = [];
    apikey.push(param);
    var user = [];
    user.push(username);
    var branch = ["delete"];
    var formdata = new FormData();
    formdata.append(
        "branch",
        JSON.stringify(branch)
    );
    formdata.append(
        "user",
        JSON.stringify(user)
    );
    formdata.append(
        "path",
        JSON.stringify(json)
    );
    formdata.append(
        "apikey",
        JSON.stringify(apikey)
    );
    fetch("member_register.php",{
        "method":"post",
        "body":formdata
    })
    .then(resjson =>{
        if(resjson.ok){
            loading_status = "r";
            return resjson.json()
        }
    })
    .then(json =>{
        if(json["result"] == "Success"){
            alert("削除しました");
            location.href = "member_info.php?token="+param+"&username="+username;
        }else if(json["result"] == "Error_at_apikey"){
            alert("管理者認証でエラーが発生しました。再度ログインしなおしてください。")
        }else{
            alert("削除に失敗しました。管理者に報告してください。");
        }
    })
    .catch(err=>{
        loading_status = "r";
        console.log(err);
        alert("削除に失敗しました。管理者に報告してください。");
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