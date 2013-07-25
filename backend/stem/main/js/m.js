;$(function(){
    $(".book-item-article").on('click',function(){
        $('.form-horizontal').attr('action',$(this).attr('data'));
    });

    var WindowsMenuH = $("header").height();
    //获取要定位元素距离浏览器顶部的距离
    $(window).scroll(function(){
        //滚动条事件
        var WinscroH = $(this).scrollTop();
        //获取滚动条的滑动距离
        if(WinscroH>=WindowsMenuH){
            //滚动条的滑动距离大于等于定位元素距离浏览器顶部的距离，就固定，反之就不固定
            $("nav").addClass("fixed-layer");
        //  $(".search-blue-line-bg").css({"position":"fixed","top":"0","left":"50%","margin-left":"-500px","width":"1000px"});
        }else if(WinscroH<WindowsMenuH){
            $("nav").removeClass("fixed-layer");
        //  $(".search-blue-line-bg").css({"position":"static"});
        }
    })
});