;$(function(){
    // $("body").on('submit','.form-horizontal',function(){
    //     $(".form-horizontal").ajaxSubmit({
    //         target: 'body'
    //     });
    //     return false; 
    // });
    $(".btn-next,.btn-commit").on('click',function(){
        $(".form-horizontal").attr('title')
        {
            $(".form-horizontal").attr('action',function(){ return $(this).attr('title');});
        }
        $(".form-horizontal").submit();
        return false; 
    });


    // edit
    $(".edit-setting-title").on('click',function(){
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

    $(".edit-chapter").on('click',function(){
        $(".edit-setting-chapter").slideToggle('fast',function(){
            if($(this).is(':hidden'))
            {
                $('.form-horizontal').attr('action','/writer/edit/sort/0');
                $(".form-horizontal").ajaxSubmit();
                return false; 
            }
        });
    });

    $(".edit-delete-button").on('click',function(){
        var button = $(this);
        $('#edit-delete-modal .modal-body p').append(function(){
            return button.parents('tr').find('.edit-item-title a').html() + '"?';
        });
        $('#edit-delete-modal .modal-footer .btn-primary').attr('href',function(){
            return $(this).attr('title') + button.parents('tr').find('.edit-item-id').attr('title');
        });
        $('#edit-delete-modal').modal({
            backdrop:true,
            keyboard:true,
            show:true
        });
        return false;
    });

    $(".edit-action-button").on('click',function(){
        $('.form-horizontal').attr('action',$(this).attr('data'));
    });


    $("#edit-setting-table").tableDnD({
        onDrop: function(table, row) {
            var rows = table.tBodies[0].rows;
            var debugStr = "Row dropped was "+row.id+". New order: ";
            for (var i=0; i<rows.length; i++) {
                debugStr += rows[i].id+" ";
            }
            $("#edit-setting-table").append(debugStr);
        }
    });

});