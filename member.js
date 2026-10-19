
document.getElementById("close").addEventListener("click",()=>{
    document.getElementById("pop").style.display = "none";
    document.getElementById("pop").style.opacity = "0";
})

function pop(number,path){
    fetch("member_datas.php?path="+path,{
        "method":"GET",
        "mode":"cors"
    })
    .then(resjson =>{
        if(resjson.ok){
            return resjson.json()
        }
    })
    .then(json =>{
        console.log(json);
        document.getElementById("name").firstChild.textContent = json[0]["name_ja"];
        document.getElementById("name_eng").innerHTML = json[0]["name_en"];
        document.getElementById("grade").innerHTML = "学年："+json[0]["grade"];
        document.getElementById("status").innerHTML = "役職："+json[0]["status"];
        document.getElementById("major").innerHTML = "学科："+json[0]["major"];
        document.getElementById("birth").innerHTML = "出身："+json[0]["birthplace"];
        document.getElementById("license").innerHTML = "資格："+json[0]["license"];
        document.getElementById("com").innerHTML = json[0]["intro"];
        document.getElementById("pop_img").src = "./uploads/member/"+json[0]["photo_name"];
        
    })
    var posi = "block"+number;
    var z = document.getElementById(posi).getBoundingClientRect();
    console.log("width:"+z.width);
    /*window.scrollTo({
        top:z.top,
        behavior:'smooth'
    });*/
    
    z = document.getElementById(posi).getBoundingClientRect();
    document.getElementById("pop").style.display = "block";
    document.getElementById("pop").style.position = "absolute";
    document.getElementById("pop").style.left = z.left+window.scrollX+"px";
    document.getElementById("pop").style.top = z.top+window.scrollY+"px";
    /*window.scrollTo({
        top:z.top+"px"
    })*/
   var screen_width = window.innerWidth;
   console.log(screen_width);
    if(screen_width > 900){
        var height = "43vw";
        var width = "35vw";
        var height_img = "28vw";
        var width_img = "33vw";
    }else if(screen_width < 900 && screen_width > 600){
        var height = "53vw";
        var width = "42vw";
        var height_img = "34vw";
        var width_img = "40vw";
    }else if(screen_width < 600 && screen_width > 500){
        var height = "82vw";
        var width = "55vw";
        var height_img = "56vw";
        var width_img = "50vw";
    }else{
        var height = "110vw";
        var width = "85vw";
        var height_img = "76vw";
        var width_img = "82vw";
    }
    
    $("#pop").animate({
        "width":0,
        "height":0
    },0)
    $("#pop_block2").animate({
        "opacity":0,
        "width":0,
        "height":0
    },0)
        $("#pop_img").animate({
        /*"width":0,
        "height":0,*/
        "opacity":0
    },0)
    $("#pop").animate({
        "opacity":1,
        "width":width,
        "height":height
    },250)
    $("#pop_img").animate({
        "width":width_img,
        "height":height_img,
        "opacity":1
    },700)
    $("#pop_block2").animate({
        "opacity":1,
        "width":width,
        "height":"auto"
    },500)

}