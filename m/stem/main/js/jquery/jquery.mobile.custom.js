;$(function(){
    $(document).bind("mobileinit", function()  
    {  
       if (navigator.userAgent.indexOf('iPhone') != -1 || navigator.userAgent.indexOf('iPad') != -1 || navigator.userAgent.indexOf('Blackberry') != -1 || navigator.userAgent.indexOf('Android') != -1) {
            $.mobile.defaultPageTransition = 'none'; 
            $.mobile.defaultDialogTransition = 'none';
        }
        $.mobile.page.prototype.options.keepNative = "input, textarea";
        $.mobile.loading( 'show', {
            text: 'foo',
            textVisible: true,
            theme: 'a',
            html: ""
        });
    }); 
});