/**
 * Created by kisten on 08.07.17.
 */
$(document).ready(function() {
    $('.tree').treegrid({
        saveState : true
    });

    var templete = '<form class="comment-answer-form"><div class="form-group"><label for="comment">Comment:</label><textarea class="form-control" rows="2" id="comment" name="comment"></textarea></div>';

    var alertErrorTemplate = '<div class="alert alert-danger fade in alert-dismissable"><strong>{{text}}</strong></div>';

    $(document).on("click", '.answer', function () {
        var thisTemplete = templete;
        $('.comment-answer-form').remove();
        var pos = $(this);
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                var parentId = $(pos).parent().parent().find('.entity_id').val();
                thisTemplete += '<input type="hidden" name="parent" value="'+parentId+'"><div class="row"><div class="col-sm-3 col-sm-offset-9"><button type="button" class="btn-primary btn btn-block add-answer-comment">Add Comment</button></div></div>';
            } else {
                thisTemplete += '<div class="alert alert-warning"><strong>Please Login First</strong></div>';
            }
        });
        thisTemplete += '</form>';
        $(this).parent().parent().append(thisTemplete);
    });

    $(document).on('click', '.add-answer-comment', function () {
        var data = $(this).parent().parent().parent().parent().serialize();
        $.ajax({
            url : 'Controller/Save',
            type: 'post',
            data: data,
            success: function (data) {
                location.reload();
            },
            error: function (error, data) {
                console.log(error);
            }
        })
    });

    $(document).on('click', '#add-comment', function () {
        var data = $('#add-form').serialize();
        $.ajax({
            url : 'Controller/Save',
            type: 'post',
            data: data,
            success: function (data) {
                location.reload();
            },
            error: function (error, data) {
                console.log(error);
            }
        })
    });

    $(document).on('click', '.delete', function () {
        var pos = $(this);
        var data = $(this).parent().parent().find('.entity_id').serialize();
        $.ajax({
            url : 'Controller/Delete',
            type: 'post',
            data: data,
            success: function (data) {
                if (data.error == 'no') {
                    location.reload();
                } else {
                    pos.parent().parent().parent().parent().find('.alert-danger').remove();
                    var templete = alertErrorTemplate.replace('{{text}}', data.text);
                    pos.parent().parent().parent().before(templete);
                }
            },
            error: function (error, data) {
                console.log(error);
            }
        })
    });
});
