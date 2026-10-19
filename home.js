var pre_nav_count = 0;

document.getElementById("pre_nav").addEventListener("click",()=>{
    pre_nav_count++;
    if(pre_nav_count == 1){
        document.getElementById("lis").style.display = "block";
        document.getElementById("pre_nav").innerHTML = "×";
        $("#lis").animate({
            "opacity":1
        },250)
    }else{
        pre_nav_count = 0;
        document.getElementById("pre_nav").innerHTML = "≡";
        $("#lis").animate({
            "opacity":0
        },250)
        setTimeout(()=>{
            document.getElementById("lis").style.display = "none";
            
        },250)
    }

})

document.getElementById("top").addEventListener("click",()=>{
    location.href = "home.html"
})

var photo_name = ["news-bg.jpg","news2-bg.jpg","home-bg.jpg"];
    var length = photo_name.length;
    
    var count = 0;

function photo_change(){
    
    document.getElementById("cir"+count).style.backgroundColor = "gray"
    try{
    var num = count-1;
    document.getElementById("cir"+num).style.backgroundColor = "lightgray"
    }catch(err){
        //めんどかった。。。。
    }
    try{
        var num1 = count+2;
        document.getElementById("cir"+num1).style.backgroundColor = "lightgray"
    }catch(err){
        //めんどい
    }
        $("#home_photos").animate({
            opacity:1
        },2000)
        $("#home_photos").animate({
            opacity:1
        },2000)
        $("#home_photos").animate({
            opacity:0
        },2000)
        $("#home_photos").attr("src","./images/"+photo_name[count])
        //document.getElementById("home_photos").src = "./images/"+photo_name[count];
        count++;
        if(count == length){
            count = 0;
        }
        setTimeout(photo_change,6000);
}

function photo_status_set(){
    
    
    for(var i = 0; i<length; i++){
        var text = ""
    }
}

function select(param){
    document.getElementById(param).style.display = "none";
    document.getElementById(param).style.opacity = "0";
    document.getElementById(param+"2").style.display = "inline-block";
    document.getElementById(param+"2").style.opacity = "1";
    //仕分け表示めんどくさすぎる　8/17

    var url = location.search;
    console.log(url);   
    url = new URLSearchParams(url);
    try{
        var sort = url.get("sort");
        sort = JSON.parse(sort);
        sort.push(param);
    }catch(err){
        console.log(err);
        var sort = [];
        sort.push(param);
    }
    sort = JSON.stringify(sort);
    location.href = "read_news2.php?sort="+sort;
}
function d_select(param){
    document.getElementById(param).style.display = "inline-block";
    document.getElementById(param).style.opacity = "1";
    document.getElementById(param+"2").style.display = "none";
    document.getElementById(param+"2").style.opacity = "0";
     var url = location.search;
    console.log(url);   
    url = new URLSearchParams(url);
    try{
        var sort = url.get("sort");
        var count = -1;
        sort = JSON.parse(sort);
        for(var content of sort){
            count++;
            if(content == param){
                sort.splice(count,1);
                sort = JSON.stringify(sort);
                location.href = "read_news2.php?sort="+sort;
            }
        }
    }catch(err){
        console.log(err);
        alert("エラーが発生しました");
        location.href = "read_news2.php";
    }
}

function select_status(){
    var url = location.search;
    console.log(url);   
    url = new URLSearchParams(url);
    try{
        var sort = url.get("sort");
        sort = JSON.parse(sort);
        for(var content of sort){
            document.getElementById(content).style.opacity = "0";
            document.getElementById(content).style.display = "none";
            document.getElementById(content+"2").style.opacity = "1";
            document.getElementById(content+"2").style.display = "inline-block";
            
        }
    }catch(err){
        console.log(err);

    }
}


