/**
 * 1. 첫 페이지 로드 시, Ajax로 데이터를 가져와서 이력서를 재구성할 수 있어야함
 * 2. 페이지 내 모든 <input>은 변경되면 Ajax를 통해 데이터가 변동되어야 함
 */

function Resume(){
    this.user_id = document.querySelector("#user_id").value;
    this.rows = {
        education: function(data){
            var data = data ? data : {};
            var edu_period = data.edu_period ? data.edu_period : "";
            var edu_type = data.edu_type ? data.edu_type : "";
            var edu_school = data.edu_school ? data.edu_school : "";
            var edu_major = data.edu_major ? data.edu_major : "";
            var edu_score = data.edu_score ? data.edu_score : "";

            var tr = document.createElement("tr");
            tr.innerHTML = '<td class="resume__input"><input type="text" name="edu_period" value="' + edu_period + '"></td>'
                            +'<td class="resume__input">'
                                +'<select name="type" name="edu_type">'
                                    +'<option value="재학"' + (edu_type == "재학" ? " selected" : "") + '>재학</option>'
                                    +'<option value="졸업"' + (edu_type == "졸업" ? " selected" : "") + '>졸업</option>'
                                +'</select>'
                            +'</td>'
                            +'<td class="resume__input"><input type="text" name="edu_school" value="' + edu_school + '"></td>'
                            +'<td class="resume__input"><input type="text" name="edu_major" value="' + edu_major + '"></td>'
                            +'<td class="resume__input"><input type="text" name="edu_score" value="' + edu_score + '"=></td>'
                            +'<td class="resume__remove">'
                                +'<button class="btn-remove">삭제 <i class="fa fa-times"></i></button>'
                            +'</td>';
            return tr;
        },
        career: function(data){
            var data = data ? data : {};
            var car_company = data.car_company ? data.car_company : "";
            var car_period = data.car_period ? data.car_period : "";
            var car_rank = data.car_rank ? data.car_rank : "";

            var tr = document.createElement("tr");
            tr.innerHTML = '<td class="resume__input"><input type="text" name="car_company" value="' + car_company + '"></td>'
                            +'<td class="resume__input"><input type="text" name="car_period" value="' + car_period + '"></td>'
                            +'<td class="resume__input"><input type="text" name="car_rank" value="' + car_rank + '"></td>'
                            +'<td class="resume__remove">'
                                +'<button class="btn-remove">삭제 <i class="fa fa-times"></i></button>'
                            +'</td>'
            return tr;
        },
        outside: function(data){
            var data = data ? data : {};
            var out_period = data.out_period ? data.out_period : "";
            var out_place = data.out_place ? data.out_place : "";
            var out_content = data.out_content ? data.out_content : "";

            var tr = document.createElement("tr");
            tr.innerHTML = '<td class="resume__input"><input type="text" name="out_period" value="' + out_period + '"></td>'
                            +'<td class="resume__input"><input type="text" name="out_place" value="' + out_place + '"></td>'
                            +'<td class="resume__input"><input type="text" name="out_content" value="' + out_content + '"></td>'
                            +'<td class="resume__remove">'
                                +'<button class="btn-remove">삭제 <i class="fa fa-times"></i></button>'
                            +'</td>'
            return tr;
        },
        license: function(data){
            var data = data ? data : {};
            var lic_date = data.lic_date ? data.lic_date : "";
            var lic_type = data.lic_type ? data.lic_type : "";
            var lic_name = data.lic_name ? data.lic_name : "";
            var lic_pub = data.lic_pub ? data.lic_pub : "";

            var tr = document.createElement("tr");
            tr.innerHTML = '<td class="resume__input"><input type="text" name="lic_date" value="' + lic_date + '"></td>'
                            +'<td class="resume__input">'
                                +'<select name="type" nmae="lic_type">'
                                    +'<option value="자격증"' + (lic_type == "자격증" ? " selected" : "") + '>자격증</option>'
                                    +'<option value="어학"' + (lic_type == "어학" ? " selected" : "") + '>어학</option>'
                                +'</select>'
                            +'</td>'
                            +'<td class="resume__input"><input type="text" name="lic_name" value="' + lic_name + '"></td>'
                            +'<td class="resume__input"><input type="text" name="lic_pub" value="' + lic_pub + '"></td>'
                            +'<td class="resume__remove">'
                                +'<button class="btn-remove">삭제 <i class="fa fa-times"></i></button>'
                            +'</td>'
            return tr;
        }
    };

    this.init();
    this.setEvents();
}

/**
 * 데이터 재조립
 */
Resume.prototype.init = function(){
    var app = this;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/resumes/" + this.user_id);
    xhr.onload = function(){
        var res = JSON.parse(xhr.responseText);
        if(res.message) {
            alert(res.message);
        } 
        else if(res.resume) {
            res.resume.education = JSON.parse(res.resume.education);
            res.resume.career = JSON.parse(res.resume.career);
            res.resume.outside = JSON.parse(res.resume.outside);
            res.resume.license = JSON.parse(res.resume.license);

            app.assemble(res.resume);
        }
    }
    xhr.send();
};
Resume.prototype.assemble = function(resume){
    var tbody, add_row; 

    // 개인 정보
    resume.user_image && this.setImage(resume.user_image);
    document.querySelector("#info__name").value = resume.user_name;
    document.querySelector("#info__birthday").value = resume.user_birthday;
    document.querySelector("#info__phone").value = resume.user_phone;
    document.querySelector("#info__email").value = resume.user_email;

    // 학력 사항
    tbody = document.querySelector(".resume__table[data-info='education'] > tbody");
    add_row = tbody.querySelector(".resume__add").parentElement;
    tbody.insertBefore( this.rows.education(resume.education), add_row );

    // 경력 사항
    tbody = document.querySelector(".resume__table[data-info='career'] > tbody");
    add_row = tbody.querySelector(".resume__add").parentElement;
    tbody.insertBefore( this.rows.career(resume.career), add_row );

    // 대외 활동
    tbody = document.querySelector(".resume__table[data-info='outside'] > tbody");
    add_row = tbody.querySelector(".resume__add").parentElement;
    tbody.insertBefore( this.rows.outside(resume.outside), add_row );

    // 자격증
    tbody = document.querySelector(".resume__table[data-info='license'] > tbody");
    add_row = tbody.querySelector(".resume__add").parentElement;
    tbody.insertBefore( this.rows.license(resume.license), add_row );
}

/**
 * 데이터 저장
 */
Resume.prototype.save = function(){
    var data = {
        user_image: document.querySelector("#profile__url").value,
        user_name: document.querySelector("#info__name").value,
        user_birthday: document.querySelector("#info__birthday").value,
        user_phone: document.querySelector("#info__phone").value,
        user_email: document.querySelector("#info__email").value
    };

    var tables = document.querySelectorAll(".resume__table:not(.avoid_save)");
    for(var i = 0; i < tables.length; i++){
        var table = tables[i];
        data[table.dataset.info] = {};

        var inputs = table.querySelectorAll("input, select");
        for(var j = 0; j < inputs.length; j++){
            var input = inputs[j];
            data[table.dataset.info][input.name] = input.value;
        }
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/resumes/" + this.user_id);
    xhr.onload = function(){
        var res = JSON.parse(xhr.responseText);
        if(res.message) alert(res.message);
    }
    xhr.send(JSON.stringify(data));
}

/**
 * 이벤트 설정
 */
Resume.prototype.setEvents = function(){
    var app = this;

    // 이미지 INPUT
    var input__image = document.querySelector("#profile")
    input__image.addEventListener("change", function(e){
        var file = this.files.length > 0 ? this.files[0] : null;
        if(file) {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(){
                app.setImage(this.result);
                app.save();
            }
        }
    });

    // 추가하기 BUTTON
    var btns__add = document.querySelectorAll(".btn-add");
    for(var i = 0; i < btns__add.length; i++){
        var btn = btns__add[i];
        btn.addEventListener("click", function(){
            var table = closest(this, ".resume__table");
            var infoName = table.dataset.info;
            
            var tbody = table.firstElementChild;
            var autoSize = tbody.querySelector(".resume__autosize");
            var length = tbody.querySelectorAll("tr").length;
            var row__add = tbody.querySelector(".resume__add").parentElement;
            
            var row = app.rows[infoName]();
            tbody.insertBefore(row, row__add);
        
            autoSize.rowSpan = length + 1;
        });
    }
    

    var tables = document.querySelectorAll(".resume__table");
    for(var i = 0; i < tables.length; i++){
        var table = tables[i];

        // 삭제하기 BUTTON
        table.addEventListener("click", function(e){
            var isBtn = e.target.classList.contains("btn-remove") || closest(e.target, ".btn-remove");
            if(!isBtn) return;

            var table = closest(e.target, ".resume__table");
            var length = table.querySelectorAll("tr").length;
            var autoSize = table.querySelector(".resume__autosize");

            var row = closest(e.target, ".resume__table tr");
            row.remove();

            autoSize.rowSpan = length - 1;
        });

        // INPUT CHANGE
        table.addEventListener("change", function(e){
            app.save();
        });
    }
    
};

/**
 * 이미지 업로드
 */
Resume.prototype.setImage = function(imageURL){
    document.querySelector("#profile__url").value = imageURL;

    var img__exist = document.querySelector(".resume__image img");
    img__exist && img__exist.remove();

    var img = document.createElement("img");
    img.src = imageURL;
    img.alt = "프로필 사진";
    img.onload = function(){
        document.querySelector(".resume__image").append(img);
    };
};

window.onload = function(){
    var app = new Resume();
};