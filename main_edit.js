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
            alert("ログインに失敗しました");
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
        location.href = "login.html";
    }
}


function background_photos(){
    var back_image = document.getElementById("back_photo").files[0];

    var photo_name = [];
    var branch = [];

    branch.push("register_back");
    photo_name.push(back_image.name);

    var formdata = new FormData();

    formdata.append(
        "photo_name",
        JSON.stringify(photo_name)
    );

    formdata.append(
        "images[]",
        back_image
    );

    formdata.append(
        "branch",
        JSON.stringify(branch)
    );

    fetch("main_page_edit.php",{
        "method":"post",
        "body":formdata
    })
    .then(resjson =>{
        if(resjson.ok){
            return resjson.json();
        }
    })
    .then(json =>{
        if(json["result"] == "success"){
            alert("変更しました");
        }else{
            alert("登録に失敗しました");
        }
    });
}

function intro_text(){
    var text = [];
    var branch = [];
    branch.push("register_intro");
    text.push(document.getElementById("intro_text").value);
    var formdata = new FormData();
    formdata.append(
        "intro",
        JSON.stringify(text)
    );
    formdata.append(
        "branch",
        JSON.stringify(branch)
    )
    fetch("main_page_edit.php",{
        "method":"post",
        "body":formdata
    })
    .then(resjson =>{
        if(resjson.ok){
            return resjson.json()
        }
    })
    .then(json =>{
        if(json["result"] == "success"){
            alert("変更しました");
        }else{
            alert("登録に失敗しました");
        }
    })
}

function intro_photos(){
    document.getElementById("bt3_status").innerHTML = "変更中";
    var intro_photo = document.getElementById("intro_photo");
    var photo_count = intro_photo.files.length;

    var branch = [];
    branch.push("register_photos");

    var formdata = new FormData();

    for(var i = 0; i < photo_count; i++){
        formdata.append(
            "images[]",
            intro_photo.files[i]
        );
    }

    formdata.append(
        "branch",
        JSON.stringify(branch)
    );

    fetch("main_page_edit.php",{
        "method":"post",
        "body":formdata
    })
    .then(resjson =>{
        if(resjson.ok){
            return resjson.json();
        }
    })
    .then(json =>{
        if(json["result"] == "success"){
            alert("変更しました");
        }else{
            alert("登録に失敗しました");
        }
        document.getElementById("bt3_status").innerHTML = "変更";
    })
    .catch(err =>{
        console.log(err);
        alert("登録に失敗しました");
        document.getElementById("bt3_status").innerHTML = "変更";
    })
}

function back(){
    location.href="auth.html?token="+param+"&username="+username;
}