
var loading_status = "run";

function login(){


    var json = [];
    var username = document.getElementById("usr_id").value;
    var password = document.getElementById("usr_pass").value;
    //noIPとかで適当にIPは取得する予定
    var ip = "000.000.00.0";
    if(username.length < 1 || password.length < 1){
        alert("空欄があります");
        return
    }
    loading_status = "run";
    loading();

    json.push(username);
    json.push(password);
    json.push(ip);

    var formdata = new FormData();
    formdata.append(
        "login_data",
        JSON.stringify(json)
    )
    fetch('login.php',{
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
        loading_status = "r";
        console.log(json);
        if(json["result"] == "success"){
                location.href= json["url"]+"?token="+json["api_token"]+"&username="+username;
        }else{
            alert("ユーザー名またはパスワードが間違っています");
        }
    })
    .catch(err=>{
        loading_status = "r";
        console.log(err);
        alert("エラーが発生しました");
    })
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