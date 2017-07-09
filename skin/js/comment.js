/**
 * Created by kisten on 08.07.17.
 */
$(document).ready(function() {
    $('.tree').treegrid();

    var templete = '<form><div class="comment-answer-form"><div class="form-group"><label for="comment">Comment:</label><textarea class="form-control" rows="2" id="comment" name="comment"></textarea></div>';

    $(document).on("click", '.answer', function () {
        var thisTemplete = templete;
        $('.comment-answer-form').remove();
        var pos = $(this);
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                var parentId = $(pos).parent().parent().find('.parent').val();
                thisTemplete += '<input type="hidden" name="parent" value="'+parentId+'"><input type="hidden" name="user_id" value="'+response.authResponse.userID+'"></input><div class="row"><div class="col-sm-3 col-sm-offset-9"><button type="button" class="btn-primary btn btn-block add-answer-comment">Add Comment</button></div></div>';
            } else {
                thisTemplete += '<div class="alert alert-warning"><strong>Please Login First</strong></div>';
            }
        });
        thisTemplete += '</form></div>';
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
});
