;$(function(){
    $("body").on('submit','.form-horizontal',function(){
        $(".form-horizontal").ajaxSubmit({
            target: 'body'
        });
        // return false; 
    });
    $("body").on('click',".btn-next,.btn-commit",function(){
        $(".form-horizontal").submit();
        return false; 
    });

    
});