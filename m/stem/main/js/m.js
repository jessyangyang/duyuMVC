;$(function(){


    // $(".book-item-article").on('click',function(){
    //     $('.form-horizontal').attr('action',$(this).attr('data'));
    // });

    // var WindowsMenuH = $("header").height();
    // //获取要定位元素距离浏览器顶部的距离
    // $(window).scroll(function(){
    //     //滚动条事件
    //     var WinscroH = $(this).scrollTop();
    //     //获取滚动条的滑动距离
    //     if(WinscroH>=WindowsMenuH){
    //         //滚动条的滑动距离大于等于定位元素距离浏览器顶部的距离，就固定，反之就不固定
    //         $("#header").addClass("fixed-layer");
    //     //  $(".search-blue-line-bg").css({"position":"fixed","top":"0","left":"50%","margin-left":"-500px","width":"1000px"});
    //     }else if(WinscroH<WindowsMenuH){
    //         $("#header").removeClass("fixed-layer");
    //     //  $(".search-blue-line-bg").css({"position":"static"});
    //     }
    // })
    
    $(".book-item-article").on('click',function(){
        // location.href = $(this).attr('href');
    });

    $("#app-download").on('click',function(){
        $("#app-download").fadeOut();
        $.cookie('isFirst', 1);
    });

    $(".app-close").on('click',function(){
        $("#app-download").fadeOut();
    });

    if ($.cookie('isFirst') == 1) {
        $("#app-download").remove();
    } else {
        $.cookie('isFirst', 0);
    };

    $(".article-show-button").on('click',function(){
        var button = $(this);
        var content = button.parent("div").find(".article-show-content");
        if (content.height() > 135)
        {
            button.html('展开');
            button.css ('background-image',"url('../img/m/more-2x.png')");
            content.css ("height","132px");
        }
        else
        {
            button.html('收起');
            button.css ('background-image',"url('../img/m/less-2x.png')");
            content.css ("height","auto");
        }
        return false;
        // $(content).css('height',function(){
        //     $(".edit-setting-title-img").css("transform",function(index,value)
        //     {

        //         if(value !== 'none')
        //         {
        //             var values = value.split('(')[1].split(')')[0].split(',');
        //             var a = values[0];
        //             var b = values[1];
        //             var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
        //             if (angle == 0) return "rotate(-180deg)";
        //             else return "rotate(-0deg)";
        //         }
        //     });
        // });
    });
    $(".scrollLoading").scrollLoading();
    $('.retina').retina();
});