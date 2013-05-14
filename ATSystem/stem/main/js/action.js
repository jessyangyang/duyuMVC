;$(function(){
    // $(".submitpublish,.add-column-ajax,.column-page > a,.publish_list,.set-recommend-one").live('click',function(event){
    //     $(this).css("background-color","#FFFFCC");
        
    //     var postContent = {magazine_index:$('select[name=magazine_index]').val(),magazine_self:$('select[name=magazine_self]').val(),magazine_issued:$('select[name=magazine_issued]').val(),continue_search:$('#post-continue-search-input').val()};
        
    //     $(this).ajaxSubmit({ 
    //         target:'#fix',
    //         url:$(this).attr('href'),
    //         type:'POST',
    //         data:postContent
    //     });
    //     return false;
    // });
    // $(".postselect").live('change',function(){
    //     $(this).css("background-color","#FFFFCC");
    //     $(this).ajaxLink({
    //         itemAppend:'#fix',
    //         url:'add',
    //         type:'POST',
    //         data:'magazine_index= ' + $('select[name=magazine_index]').val() + '& magazine_self= ' + $('select[name=magazine_self]').val() + '& magazine_issued= ' + $('select[name=magazine_issued]').val()
    //     });
    // });
    // $(".index_postselect").live('change',function(){
    //     $(this).ajaxLink({
    //         itemAppend:'#fix',
    //         url:'index',
    //         type:'POST',
    //         data:$(this).attr('name') + '=' +$(this).val()
    //     });
    // });
    $("body").on('submit','.form-horizontal',function(){
        $(".form-horizontal").ajaxSubmit({
            target: 'body'
        });
        return false; 
    });
    $("body").on('click',".right-button,.btn-commit",function(){
        $(".form-horizontal").ajaxSubmit({
            target: 'body'
        });
        return false; 
    });
    // $(".column-top-id").live('click',function() {
    //     $("input[name='object_ids[]']").attr("checked",this.checked);
    // });

    
});