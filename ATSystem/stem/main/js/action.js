;$(function(){
    // $("body").on('submit','.form-horizontal',function(){
    //     $(".form-horizontal").ajaxSubmit({
    //         target: 'body'
    //     });
    //     return false; 
    // });
    $("body").on('click',".btn-next,.btn-commit",function(){
        $(".form-horizontal").submit();
        return false; 
    });
    $("body").on('click','.edit-setting-title',function(){
        $(".edit-title-subitem").slideToggle('fast',function(){
            $(".edit-setting-title-img").css("transform",function(index,value)
            {

                if(value !== 'none')
                {
                    var values = value.split('(')[1].split(')')[0].split(',');
                    var a = values[0];
                    var b = values[1];
                    var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
                    if (angle == 0) return "rotate(-180deg)";
                    else return "rotate(-0deg)";
                }
            });
        });
    });

    $("body").on('click','.edit-chapter',function(){
        $(".edit-setting-chapter").slideToggle('fast',function(){
            // if(!$(this).is(':hidden'))
            // {
            //     $(".form-horizontal").submit();
            //     return false; 
            // }
        });
    });

    
});