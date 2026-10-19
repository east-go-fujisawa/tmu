var article_title = "";
var article_date_from = "";
var article_date_to = "";
var article_date = "";
var article_date_post = "";
var text = "";
var cate = "";
var order = [];
var photo_order = [];
var send_data = []
var text_count = 0;
var photo_count = 0; 
var loading_status = "run";

document.getElementById("art_ti_in").addEventListener('change',(text)=>{
    article_title = document.getElementById("art_ti_in").value;
    document.getElementById("post-title").innerHTML = article_title;
})

document.getElementById("art_date_from").addEventListener('change',(text)=>{
    article_date_from = document.getElementById("art_date_from").value;
    article_date_from = article_date_from.substring(5,);
    //article_date_from = article_date_from.replace("-","/");
    article_date = article_date_from+"-"+article_date_to;
    document.getElementById("post-date").innerHTML = article_date;
})

document.getElementById("art_date_to").addEventListener('change',(text)=>{
    article_date_to = document.getElementById("art_date_to").value;
    article_date_to = article_date_to.substring(5,);
    //article_date_to = article_date_to.replace("-","/");
    article_date = article_date_from+"-"+article_date_to;
    document.getElementById("post-date").innerHTML = article_date;
})

document.getElementById("art_date_post").addEventListener("change",()=>{
    article_date_post = document.getElementById("art_date_post").value;
    /*article_date_post =  article_date_post.replace("-","年");
    article_date_post =  article_date_post.replace("-","月");
    article_date_post = article_date_post + "日";*/
    document.getElementById("post-cat").innerHTML = article_date_post;
})
document.getElementById("categ").addEventListener("change",()=>{
    cate = document.getElementById("categ").options[document.getElementById("categ").selectedIndex].value;
    send_data.push(cate);
    document.getElementById("post-cate").innerHTML = document.getElementById("categ").options[document.getElementById("categ").selectedIndex].value;
})
document.getElementById("set_text").addEventListener("click",()=>{
    if(cate.length == 0){
        alert("カテゴリーを入力してください。")
        return;
    }
    text_count++;
    order.push("t"+text_count);
    //input_text.replace(/\n/g,"LF")
    text = '<div id="block'+text_count+'"><textarea id="textarea'+text_count+'">'+document.getElementById("text_write").value+'</textarea><p onclick="del('+text_count+')">×削除</p></div>';
    document.getElementById("insert_area").insertAdjacentHTML("beforeend",text);
})

document.getElementById("set_pic").addEventListener("click",()=>{
    if(cate.length == 0){
        alert("カテゴリーを入力してください。")
        return;
    }
    photo_count++;
    order.push("p"+photo_count);
    var up_image = document.getElementById("up_pic");
    photo_order.push(up_image.files[0]);
    up_image = up_image.files[0];
    
    var reader = new FileReader()
    reader.onload = (e) => {
        var base64 = e.currentTarget.result;
        document.getElementById("insert_area").insertAdjacentHTML("beforeend",'<div id="photo'+photo_count+'"><img src="'+base64+'"><p onclick="del_pho('+photo_count+')">×削除</p></div>')
    }
    reader.readAsDataURL(up_image)
})
    var param = "";
    var username = "";
function auth_check(){
    loading_status = "run";
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
            data_get();
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

function del(d_num){
document.getElementById("block"+d_num).textContent = "";
var count = -1;
for(var block of order){
    count++;
    if(block == "t"+d_num){
        order.splice(count,1);
    }
}
}

function del_pho(d_num){
document.getElementById("photo"+d_num).textContent = "";
var count = -1;
var p_count = -1;
for(var block of order){
    count++;
    if(block.indexOf("p") != -1 && block == "p"+d_num){
        p_count++;
        order.splice(count,1);
        photo_order.splice(p_count,1);
    }else if(block.indexOf("p") != -1){
        p_count++;
    }
}
}

async function pre_send(){
    loading_status = "run";
    loading();

    document.getElementById("pre_bt").innerHTML = "投稿中";
    var photo_count = -1;

    for(var block of order){
        if(block.indexOf("t") !=-1){
            var num = block.substring(1,)
            var text = document.getElementById("textarea"+num).value;
            text = text.replace(/\n/g,"LF");
            send_data.push(text);
        }else{
            photo_count++;
            var photo_name = photo_order[photo_count].name;
            /*var photo_extension = photo_name.substring(photo_name.indexOf("."),);
            photo_extension = photo_extension.toLowerCase();
            photo_name = photo_name.substring(0,photo_name.indexOf("."))+photo_extension;
            console.log(photo_name);*/
            send_data.push(photo_name);
        }
    }

    var title_data = [{
        "title":document.getElementById("post-title").innerHTML ,
        "date_train":document.getElementById("post-date").innerHTML,
        "date_write":document.getElementById("post-cat").innerHTML,
        "article":send_data
    }];

    var api_key = ["abcdefg"]
    var formData = new FormData();
    formData.append(
        "apikey",
        JSON.stringify(api_key)
    );
    formData.append(
        "send_data",
        JSON.stringify(title_data)
    );
    console.log(JSON.stringify(title_data));

try {
    console.log("photo_order:", photo_order);
    console.log("length:", photo_order.length);
} catch(e) {
    console.error(e);
}

   for (const photo of photo_order) {
    console.log("圧縮開始");
    const compressed = await compressImage(photo, 0.2);
    console.log("圧縮完了");
    console.log(compressed.size);
    formData.append(
        "images[]",
        compressed
    );
}
    
   fetch('test.php',{
        "method":"POST",
        "body":formData
    })
    .then(resjson=>{
        if(resjson.ok){
            loading_status = "r";
            return resjson.json()
        }
    })
    .then(json =>{
        document.getElementById("pre_bt").innerHTML = "投稿";
        if(json["result"] == "success"){
            alert("投稿しました。");
            location.href="write_news.html?token="+param+"&username="+username;   
        }else{
            alert("投稿に失敗しました");
        }
    })
    .catch(err =>{
        loading_status = "r";
        console.log(err);
        document.getElementById("pre_bt").innerHTML = "投稿";
    })
    

}

/*圧縮関数*/
async function compressImage(file, quality = 0.2, maxWidth = 1280) {
    return new Promise((resolve, reject) => {
        const img = new Image();

        img.onload = () => {
            let width = img.width;
            let height = img.height;

            // 横幅を制限
            if (width > maxWidth) {
                height = Math.round(height * (maxWidth / width));
                width = maxWidth;
            }

            const canvas = document.createElement("canvas");
            canvas.width = width;
            canvas.height = height;

            const ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, width, height);

            canvas.toBlob(
                blob => {
                    if (!blob) {
                        reject("圧縮失敗");
                        return;
                    }

                    const compressedFile = new File(
                        [blob],
                        file.name,
                        {
                            type: file.type
                        }
                    );

                    resolve(compressedFile);
                },
                file.type,
                quality
            );
        };

        img.onerror = reject;

        const reader = new FileReader();

        reader.onload = e => {
            img.src = e.target.result;
        };

        reader.readAsDataURL(file);
    });
}

function back(){
    location.href="auth.html?token="+param+"&username="+username;
}

/*ここから下はコーディングしかしてない　8/13 */
var all_news = "";
function delete_data(){
    loading_status = "run";
    loading();

    document.getElementById("dl_bt").innerHTML = "削除中";
    var apikey = ["abcdefg"];
    var branch = ["delete_data"];
    var delete_path = [];
    if(path == "none"){
        alert("削除するニュースを選択してください")
        return;
    }
    delete_path.push(path);

    var formdata = new FormData();

    formdata.append(
        "apikey",
        JSON.stringify(apikey)
    );
    formdata.append(
        "branch",
        JSON.stringify(branch)
    );
    formdata.append(
        "path",
        JSON.stringify(delete_path)
    );

    fetch('delete_news.php',{
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
        document.getElementById("dl_bt").innerHTML = "削除";
        if(json["result"] == "success"){
            alert("削除しました");
            location.href="write_news.html?token="+param+"&username="+username;
        }else{
            alert("削除できませんでした。")
        }
    })
    .catch(err=>{
        loading_status = "r";
        console.log(err);
        document.getElementById("dl_bt").innerHTML = "削除";
        alert("エラーが発生しました。");
    })
}

var path = "";

function data_get(){
    var apikey = ["abcdefg"];
    var branch = ["data_get"];
    var formdata = new FormData();
    formdata.append(
        "apikey",
        JSON.stringify(apikey)
    );
    formdata.append(
        "branch",
        JSON.stringify(branch)
    );
    fetch("delete_news.php",{
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

         var text = '<select id="chose_news"><option value="none">選択してください</option>';
         var count = -1;
        for(var content of json[0]["title"]){
            count++;
            text += '<option value="'+json[0]["path"][count]+'">'+content+"</option>";
        }
        text+='</select>';
        document.getElementById("select_area").insertAdjacentHTML("beforeend",text);
       /* text = '<script>var path = "";document.getElementById("chose_news").addEventListener("change",()=>{ path = document.getElementById("chose_news").options[document.getElementById("chose_news").selectedIndex]; console.log(path);});</script>';
        document.getElementById("select_area").insertAdjacentHTML("beforeend",text);*/
document.getElementById("chose_news").addEventListener("change",()=>{
    path = document.getElementById("chose_news").options[document.getElementById("chose_news").selectedIndex].value;
    console.log(path);
});
    })
    .catch(err =>{
        console.log(err);
        alert("データ取得に失敗しました。");
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