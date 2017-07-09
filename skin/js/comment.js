/**
 * Created by kisten on 08.07.17.
 */
$(document).ready(function() {
    $('.tree').treegrid({
        saveState : true
    });

    var template = '<form class="comment-answer-form"><div class="form-group"><label for="comment">Comment:</label><textarea class="form-control" rows="2" id="comment" name="comment"></textarea></div>';

    var alertErrorTemplate = '<div class="alert alert-danger fade in alert-dismissable"><strong>{{text}}</strong></div>';

    $(document).on("click", '.answer', function () {
        var thisTemplate = template;
        $('.comment-answer-form').remove();
        var pos = $(this);
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                var parentId = $(pos).parent().parent().find('.entity_id').val();
                thisTemplate += '<input type="hidden" name="parent" value="'+parentId+'"><div class="row"><div class="col-sm-3 col-sm-offset-9"><button type="button" class="btn-primary btn btn-block add-answer-comment">Add Comment</button></div></div>';
            } else {
                thisTemplate += '<div class="alert alert-warning"><strong>Please Login First</strong></div>';
            }
        });
        thisTemplate += '</form>';
        $(this).parent().parent().append(thisTemplate);
    });

    $(document).on('click', '.add-answer-comment', function () {
        var pos = $(this);
        var data = $(this).parent().parent().parent().serialize();
        $.ajax({
            url : 'Controller/Save',
            type: 'post',
            data: data,
            success: function (data) {
                if (data.error == 'no') {
                    location.reload();
                } else {
                    pos.parent().parent().parent().parent().find('.alert-danger').remove();
                    var template = alertErrorTemplate.replace('{{text}}', data.text);
                    pos.parent().parent().parent().before(template);
                }
            },
            error: function (error) {
                pos.parent().parent().parent().parent().find('.alert-danger').remove();
                var template = alertErrorTemplate.replace('{{text}}', 'Some Server Error');
                pos.parent().parent().parent().before(template);
            }
        })
    });

    $(document).on('click', '#add-comment', function () {
        var pos = $(this);
        var data = $('#add-form').serialize();
        $.ajax({
            url : 'Controller/Save',
            type: 'post',
            data: data,
            success: function (data) {
                if (data.error == 'no') {
                    location.reload();
                } else {
                    pos.parent().parent().parent().parent().find('.alert-danger').remove();
                    var template = alertErrorTemplate.replace('{{text}}', data.text);
                    pos.parent().parent().parent().before(template);
                }
            },
            error: function (error) {
                console.log(error.responseText);
                pos.parent().parent().parent().parent().find('.alert-danger').remove();
                var template = alertErrorTemplate.replace('{{text}}', 'Some Server Error');
                pos.parent().parent().parent().before(template);
            }
        })
    });

    $("#add-form").validator();

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
                    var template = alertErrorTemplate.replace('{{text}}', data.text);
                    pos.parent().parent().parent().before(template);
                }
            },
            error: function (error, data) {
                pos.parent().parent().parent().parent().find('.alert-danger').remove();
                var template = alertErrorTemplate.replace('{{text}}', 'Some Server Error');
                pos.parent().parent().parent().before(template);
            }
        })
    });
});
