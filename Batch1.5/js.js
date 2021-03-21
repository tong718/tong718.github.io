function topmeau() {
    var width=1100;
    if(document.body.clientWidth > width) {
        if (document.documentElement.scrollTop <= 1) {
            document.getElementById("header").className = 'header_off';
            document.getElementById("right_li").className = 'right_li_off';
            document.getElementById("img_call").className = 'img_off';
            document.getElementById("logo").className = 'logo_off';
            document.getElementById('jump').className = 'jump_off';
            document.getElementById("sub").className = 'sub_on';
            document.getElementById("sub_services").style = 'top:100%;';
        } else if (document.documentElement.scrollTop > 1) {
            document.getElementById("header").className = 'header_on';
            document.getElementById("right_li").className = 'right_li_on';
            document.getElementById("logo").className = 'logo_on';
            document.getElementById('menu_section').className = 'menu_section_off';
            document.getElementById('jump').className = 'jump_on';
            document.getElementById("sub").className = 'sub_off';
            document.getElementById("sub_services").style = 'top:73%;';
        }
    }else {
        document.getElementById('jump').className = 'jump_off';
        if (document.getElementById('menu_content').className == 'menu_content_on') {
            document.getElementById('menu_content').className = 'menu_content_off';
        }
    };
        if (document.documentElement.scrollTop <= 80) {
            document.getElementById('header').style = 'position:absolute;';
            document.getElementById('menu_content').style = 'position:absolute;top:70px;z-index:100;';

        } else if (document.documentElement.scrollTop > 80) {
            document.getElementById('header').style = 'position:fixed;top:0;left:0;';
            document.getElementById('menu_content').style = 'position:fixed;top:70px;z-index:100;left:0;';

        }
}
function go(url){
    window.location.href = url;
}
function open_menu() {
    if( document.getElementById('menu_content').className=='menu_content_on'){
        document.getElementById('menu_content').className='menu_content_off';
    }else{
        document.getElementById('menu_content').className='menu_content_on';

    }
}
function menu_off() {
    if( document.getElementById('menu_content').className=='menu_content_on'){
        document.getElementById('menu_content').className='menu_content_off';
    }
}
function toggle() {
    jQuery('#right_nav').click(function(e) {
        document.getElementById('header').style = 'position:absolute;';
        document.getElementById('menu_content').style = 'position:absolute;top:70px;z-index:100;';
        e.preventDefault();
    });
}
function open_page(url,elementID) {
    var http=new XMLHttpRequest();
    http.onreadystatechange=function () {
        if(this.readyState==4 && this.status == 200){
            var xhr = new XMLHttpRequest();
            xhr.withCredentials = true;
            $.get(url,function (data) {
                document.getElementById(elementID).innerHTML=data;
            })
        }
    };
    http.open("GET", url,true);
    http.send();
}
function change_value(price,cont,more,on,off) {
    document.getElementById(price).className=on;
    document.getElementById(cont).className=on;
    document.getElementById(more).className=off;
}
function change_price(para) {
    document.getElementById(para).innerText="$5750";
}
function contact_jump(url) {
    window.location.href = url;
}
function apply_button(){
     var cr=document.getElementsByClassName('cr');
     var radio_box=document.getElementsByClassName('radio_box');
     var location_box=document.getElementsByClassName('location_box');
     var num=0;
     for(var i=0;i<cr.length;i++){
         if(cr[i].value==''){
             cr[i].style='box-shadow:0 0 4px #f00;';
             num +=1;
         }
     }
    for(var i=0;i<radio_box.length;i++){
        if(radio_box[i].value==''){
            radio_box[i].style='box-shadow:0 0 4px #f00;';
            num +=1;
        }
    }
    for(var i=0;i<location_box.length;i++){
        if(location_box[i].value==''){
            location_box[i].style='box-shadow:0 0 4px #f00;';
            num +=1;
        }
    }
    if(num==8){
        window.location.href = 'index.html';
    }
}
function services() {
    document.getElementById("sub_services").className="sub_services_on";
}
function for_service(event) {
 var e=event || window.event;
 var X=e.pageX;
 var Y=e.pageY;
 var height_test=document.documentElement.scrollTop+document.getElementById('sub').clientHeight+document.getElementById('sub_services').clientHeight;
 if(X<858 || X>983||Y<document.getElementById('headers').clientHeight ||Y>height_test){
     document.getElementById("sub_services").className="sub_services_off";
 }
}
