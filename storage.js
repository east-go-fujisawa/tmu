    var formdata = new FormData();
    var file_names = [];
    var file_pathes = [];
    var file_sizes = [];
    var file_types = [];
    var directory_info = "";

function get_information(){
    var branch = [];
    var formdata = new FormData();
    branch.push("get_information");

    formdata.append(
        "instraction",
        JSON.stringify(formdata)
    );

    fetch('storage.php',{
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
        if(json["result"] == "success"){
            directory_info = json["directory_info"];
            var text = '';
            var count = 0;
            for(var dirc of directory_info){
                count++;
                if(dirc["type"] == "file"){
                    text += '<p class="ct" id="ct'+count+'">'+dirc["name"]+'</p>';
                }else{
                    text += '<p class="ct ct2" id="ct'+count+'" onclick="detail('+count+')">'+dirc["name"]+'</p>';
                }
            }

            document.getElementById("content").insertAdjacentHTML("beforeend",text);    
        }else{
            alert("エラーが発生しました");
        }
    })
    .catch(err=>{
        console.log(err);
        alert("エラーが発生しました");
    })
}
function storage(){
    var files = document.getElementById("upload_files").files;
    var count = -1;
    for(var file of files){
        file_names.push(file.name);
        file_sizes.push(file.size);
        file_types.push(file.type);

        formdata.append(
            "upload_files[]",
            file
        );

        var text = '<div class="upload_f" id="upload_f'+count+'"><input type="text" class="file_name" id="file_name'+count+'" value="'+file.name+'"></input><small class="file_size" id="file_size">'+file.size+'B</small><div class="directory" id="directory" onclick="save_dirc('+count+')">保存先を選ぶ</div><div class="file_delete" id="file_delete'+count+'">削除</div></div>';
        document.getElementById("block_ins").insertAdjacentHTML("beforeend",text);
    }
}


function upload_files(){
    var datas = [{
        "file_name":file_names,
        "file_pathes":file_pathes
    }]

    formdata.append(
        "posted_information",
        JSON.stringify(datas)
    );

    fetch("storage.php",{
        "method":"post",
        "body":formdata
        })
    .then(resjson=>{
        if(resjson.ok){
            return resjson.json()
        }
    })
    .then(json=>{
        console.log(json);
    })
    .catch(err=>{
        console.log(err);

    })
}
