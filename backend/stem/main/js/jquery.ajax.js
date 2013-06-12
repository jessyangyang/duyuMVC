/*global ActiveXObject alert */
;(function($){
    $.fn.ajaxLink = function(settings){
        settings = jQuery.extend({
            type:'GET',
            async:false,
            data:'',
            url:'',
            itemAppend:'body',
            fixedNavigation: false,
            imageLoading: './images/zoomLoading.gif',
            deleteDom:'.wrap',
            activeImage: 0
        },settings);
        var JQueryObj = this;
        function _insertBox(){
            _start(this,JQueryObj);
            return false;
        };
        function _start(objClicked,JQueryObj){
            if(settings.url)
            {
                _set_interface(_get_ajax(settings.url));
            }
            else
            {
                _set_interface(_get_ajax(objClicked.getAttribute('href')));
            }
        };
        function _get_ajax(url)
        {
            htmlObj = $.ajax({type:settings.type,url:url,async:settings.async,data:settings.data}).success(function(){
            }).complete(function(){
            });
            return htmlObj;
        };
        function _set_interface(htmlObj){
            $(settings.deleteDom).remove();
            $(settings.itemAppend).append(htmlObj.responseText);
            return false;
        };
        return this.unbind('click').click(_insertBox);
    };
})(jQuery);