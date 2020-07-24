// @ IE
// Element.remove() 추가
if(!('remove' in Element.prototype)){
    Element.prototype.remove = function(){
        if(this.parentNode){
            this.parentNode.removeChild(this);
        }
    };
}

// Nodelist.includes로 Array.includes와 동작하도록 작성
NodeList.prototype.includes = function(node){
    for(var i = 0; i < this.length; i++){
        if(node == this[i]) return node;
    }
    return null;
}

// jQuery의 cloeset 구현
function closest(elem, parentSelector){
    var candidates = document.querySelectorAll(parentSelector);
    var parent = elem.parentElement;

    while(parent.nodeName != "BODY"){
        if(candidates.includes(parent)) return parent;
        parent = parent.parentElement;
    }
    return null;
}



window.addEventListener("load", function(){
    // 숫자만 입력받도록 클래스 지정
    var inputs__onlynumber = document.querySelectorAll("input.only-number");

    for(var i = 0; i < inputs__onlynumber.length; i++){
        input = inputs__onlynumber[i];
        input.addEventListener("input", function(){
            var value = this.value;
            if(value !== ""){
                value = parseInt(value);
                if(isNaN(value)){
                    value = 1;
                }
            }
            this.value = value;
        });
    }
});