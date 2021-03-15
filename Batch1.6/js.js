// header滚动效果
function topmeau() {
    var width=823;
    if(document.body.clientWidth > width) {
        if (document.documentElement.scrollTop <= 1) {
            document.getElementById("header").className = 'header_off';
            document.getElementById("header_front").className = 'header_off';
            document.getElementById("img_call").className = 'img_off';
            document.getElementById("logo").className = 'logo_off';
            document.getElementById("nav").className = 'nav_off';
            document.getElementById("right_nav").className = 'right_nav_off';
            document.getElementById("info_nav").className = 'info_nav_off';
            document.getElementById("info_phone").className = 'info_phone_off';
            if( document.getElementById('jump')!==null){
                document.getElementById('jump').className = 'jump_off';
            }
            document.getElementById('subtitle_service').style='transition:0.5s ease;';
            document.getElementById('subtitle_product').style='transition:0.5s ease;';
        } else if (document.documentElement.scrollTop > 1) {
            document.getElementById("header").className = 'header_on';
            document.getElementById("header_front").className = 'header_on';
            document.getElementById("logo").className = 'logo_on';
            document.getElementById("img_call").className = 'img_on';
            document.getElementById("nav").className = 'nav_on';
            document.getElementById("right_nav").className = 'right_nav_on';
            document.getElementById("info_nav").className = 'info_nav_on';
            document.getElementById("info_phone").className = 'info_phone_on';
            document.getElementById('menu_section').className = 'menu_section_off';
            if( document.getElementById('jump')!==null){
                document.getElementById('jump').className = 'jump_on';
            }
            document.getElementById('subtitle_service').style='transition:0.5s ease;';
            document.getElementById('subtitle_product').style='transition:0.5s ease;';
        };

    }else {
        if (document.getElementById('menu_content').className == 'menu_content_on') {
            document.getElementById('menu_content').className = 'menu_content_off';
        };
        if (document.documentElement.scrollTop <= 80) {document.getElementById('jump').className = 'jump_off';}
        else{document.getElementById('jump').className = 'jump_on';}
    };
}
// home返回主页
function home() {
    window.location.href = 'index.html';
}
// 子菜单
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
function subtitle_service() {
    document.getElementById('subtitle_product').className='subtitle_off';
    if( document.getElementById('subtitle_service').className=='subtitle_on'){
        document.getElementById('subtitle_service').className='subtitle_off';
    }else{
        document.getElementById('subtitle_service').className='subtitle_on';
    }
    var width=1100;
    if(document.documentElement.clientWidth<width){
        document.getElementById('service_item1').className="item_on";
        document.getElementById('service_item2').className="item_on";
    }
}
function subtitle_product() {
    document.getElementById('subtitle_service').className='subtitle_off';
    if( document.getElementById('subtitle_product').className=='subtitle_on'){
        document.getElementById('subtitle_product').className='subtitle_off';
    }else{
        document.getElementById('subtitle_product').className='subtitle_on';
    }
    var width=1100;
    if(document.documentElement.clientWidth<width){
        document.getElementById('service_item3').className="item_on";
    }
}
function close_subtitle(event) {
    var e=event||window.event;
    var x_ser=document.getElementById('nav').offsetLeft+ document.getElementById('right_nav').offsetLeft+ document.getElementsByClassName('ser').clientWidth;
    var x_pro=document.getElementById('nav').offsetLeft+ document.getElementById('right_nav').offsetLeft+ document.getElementsByClassName('ser').clientWidth*2;
    if(document.getElementById('header').className=='header_on'){
        if((e.pageY-document.documentElement.scrollTop>60)||e.pageX<x_ser||e.pageX>x_ser+document.getElementsByClassName('ser').clientWidth){
            document.getElementById('subtitle_service').className='subtitle_off';
        }
        if((e.pageY-document.documentElement.scrollTop>60)||e.pageX<x_pro||e.pageX>x_pro+document.getElementsByClassName('ser').clientWidth){
            document.getElementById('subtitle_product').className='subtitle_off';
        }
    }else{
        if((e.pageY-document.documentElement.scrollTop)>250||(e.pageY-document.documentElement.scrollTop)<80||e.pageX<x_ser||e.pageX>x_ser+document.getElementsByClassName('ser').clientWidth){
            document.getElementById('subtitle_service').className='subtitle_off';
        }
        if((e.pageY-document.documentElement.scrollTop)>250||(e.pageY-document.documentElement.scrollTop)<80||e.pageX<x_pro||e.pageX>x_pro+document.getElementsByClassName('ser').clientWidth) {
            document.getElementById('subtitle_product').className='subtitle_off';
        }
    }
}
// 跳转页面
var con=0,cn=0;
function open_page(url,elementID) {
    con=1;
    if(elementID==='body1'){
        cn+=1;
    };
    if(cn%2==0&&cn!=0){
        window.location.href='index.html';
    }
    document.getElementById('subtitle_service').className='subtitle_off';
    document.getElementById('subtitle_product').className='subtitle_off';
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
// 轮播图
if(con==1){
    clearInterval(interval);
}
var interval =setInterval(
    function start(){
    var b= $(".slide_on").attr("id");
    switch (b) {
        case "slide1":
            document.getElementById('slide1').className="slide_off";
            document.getElementById('slide3').className="slide_off";
            document.getElementById('slide2').className="slide_on";
            document.getElementById('btn2').style='background-color:gray;';
            document.getElementById('btn1','btn3').style='background-color:transparent;';
            break;
        case "slide2":
            document.getElementById('slide1').className="slide_off";
            document.getElementById('slide2').className="slide_off";
            document.getElementById('slide3').className="slide_on";
            document.getElementById('btn3').style='background-color:gray;';
            document.getElementById('btn1').style='background-color:transparent;';
            document.getElementById('btn2').style='background-color:transparent;';
            break;
        default:
            if(document.getElementById('slide1')!== null){
                document.getElementById('slide1').className="slide_on";
            }
            if(document.getElementById('slide2')!== null){
                document.getElementById('slide2').className="slide_on";
            }
            if(document.getElementById('slide3')!== null){
                document.getElementById('slide3').className="slide_on";
            }
            if(document.getElementById('btn1')!== null){
                document.getElementById('btn1').style='background-color:gray;';
            }
            if(document.getElementById('btn2')!== null){
                document.getElementById('btn2').style='background-color:transparent;';
            }
            if(document.getElementById('btn3')!== null){
                document.getElementById('btn3').style='background-color:transparent;';
            }
            break;
    }
},2000);
var interval1=0;
var interval2=0;
var interval3=0;
function stop(event){
    var e=event || window.event;
    if(e.pageX!==null){
        clearInterval(interval);
        clearInterval(interval2);
        clearInterval(interval3);
    }
}
function restart() {
    clearInterval(interval);
   interval= setInterval(function start(){
        var b= $(".slide_on").attr("id");
        switch (b) {
            case "slide1":
                document.getElementById('slide1').className="slide_off";
                document.getElementById('slide3').className="slide_off";
                document.getElementById('slide2').className="slide_on";
                document.getElementById('btn2').style='background-color:gray;';
                document.getElementById('btn1','btn3').style='background-color:transparent;';
                break;
            case "slide2":
                document.getElementById('slide1').className="slide_off";
                document.getElementById('slide2').className="slide_off";
                document.getElementById('slide3').className="slide_on";
                document.getElementById('btn3').style='background-color:gray;';
                document.getElementById('btn1').style='background-color:transparent;';
                document.getElementById('btn2').style='background-color:transparent;';
                break;
            default:
                if(document.getElementById('slide1')){ document.getElementById('slide1').className="slide_on";}
                if(document.getElementById('slide2')){ document.getElementById('slide2').className="slide_off";}
                if(document.getElementById('slide3')){ document.getElementById('slide3').className="slide_off";}
                if(document.getElementById('btn1')){ document.getElementById('btn1').style='background-color:gray;';}
                if(document.getElementById('btn2')){ document.getElementById('btn2').style='background-color:transparent;';}
                if(document.getElementById('btn3')){ document.getElementById('btn3').style='background-color:transparent;';}
                break;
        }
    },2000)
}
// 页面中的六个learn more button
function test(item){
    switch(item){
        case 'more1':
        if(  document.getElementById('sub_txt1').className=='sub_txt_off'){
            document.getElementById('sub_txt1').className="sub_txt_on";
            document.getElementById('btn1_front').className="btn_front_off";
            document.getElementById('btn1_back').className="btn_back_on";
        }else{
            document.getElementById('sub_txt1').className="sub_txt_off";
            document.getElementById('btn1_front').className="btn_front_on";
            document.getElementById('btn1_back').className="btn_back_off";
        }
        break;
        case 'more2':
            if(  document.getElementById('sub_txt2').className=='sub_txt_off'){
                document.getElementById('sub_txt2').className="sub_txt_on";
                document.getElementById('btn2_front').className="btn_front_off";
                document.getElementById('btn2_back').className="btn_back_on";
            }else{
                document.getElementById('sub_txt2').className="sub_txt_off";
                document.getElementById('btn2_front').className="btn_front_on";
                document.getElementById('btn2_back').className="btn_back_off";
            };break;
        case 'more3':
            if(  document.getElementById('sub_txt3').className=='sub_txt_off'){
                document.getElementById('sub_txt3').className="sub_txt_on";
                document.getElementById('btn3_front').className="btn_front_off";
                document.getElementById('btn3_back').className="btn_back_on";
            }else{
                document.getElementById('sub_txt3').className="sub_txt_off";
                document.getElementById('btn3_front').className="btn_front_on";
                document.getElementById('btn3_back').className="btn_back_off";
            };break;
        case 'pro_more1':
            if(  document.getElementById('sub1_p').className=="sub_p_off"){
                document.getElementById('sub1_p').className="sub_p_on";
                document.getElementById('btn1_txt_front').className="btn_txt_front_off";
                document.getElementById('btn1_txt_back').className="btn_txt_back_on";
            }else{
                document.getElementById('sub1_p').className="sub_p_off";
                document.getElementById('btn1_txt_front').className="btn_txt_front_on";
                document.getElementById('btn1_txt_back').className="btn_txt_back_off";
            };break;
        case 'pro_more2':
            if(  document.getElementById('sub2_p').className=="sub_p_off"){
                document.getElementById('sub2_p').className="sub_p_on";
                document.getElementById('btn2_txt_front').className="btn_txt_front_off";
                document.getElementById('btn2_txt_back').className="btn_txt_back_on";
            }else{
                document.getElementById('sub2_p').className="sub_p_off";
                document.getElementById('btn2_txt_front').className="btn_txt_front_on";
                document.getElementById('btn2_txt_back').className="btn_txt_back_off";
            };break;
        case 'pro_more3':
            if(  document.getElementById('sub3_p').className=="sub_p_off"){
                document.getElementById('sub3_p').className="sub_p_on";
                document.getElementById('btn3_txt_front').className="btn_txt_front_off";
                document.getElementById('btn3_txt_back').className="btn_txt_back_on";
            }else{
                document.getElementById('sub3_p').className="sub_p_off";
                document.getElementById('btn3_txt_front').className="btn_txt_front_on";
                document.getElementById('btn3_txt_back').className="btn_txt_back_off";
            };break;
        default:return;
    }
}
function phone_go() {
    window.location.href='http://www.baidu.com'
}
// product方法
function submit() {
    outter:
        for(let i=0;i<4;i++){
            if(document.querySelectorAll("input").item(i).value==''){
                switch (i) {
                    case 0: alert('Please enter your name.');break;return false;
                    case 1:alert('Please enter your phone.');break;return false;
                    case 2:alert('Please enter your email.');break;return false;
                    default:alert('Please enter your message.');return false;
                }
            }else{
                var value=document.querySelectorAll("input").item(i).value;
                var temp=0;
                var a=/\d{5}/;
                var b=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
                if(i==1 && !a.test(value)){
                    alert('Please enter the right phone number(at least include 5 digitals).');
                    temp+=1;  break outter;return false;
                }else if((i==2)&&(!b.test(value))){
                    alert('Please enter the right email format.');
                    temp+=1;
                    break outter;;return false;
                }else if(i==3) {
                    alert('Submit successful!');
                    return true;
                }
            }
        }
}


