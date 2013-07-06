;$(function(){
    $(".book-item-article").on('click',function(){
        $('.form-horizontal').attr('action',$(this).attr('data'));
    });
});