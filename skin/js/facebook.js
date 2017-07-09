window.fbAsyncInit = function() {
    FB.init({
        appId      : '381912872206892',
        status     : true,
        cookie     : true,
        xfbml      : true,
        version    : 'v2.9'
    });
    $(document).trigger('fbload');
};

$(document).on('fbload', function () {
    FB.Event.subscribe('auth.logout', function() {
        location.reload();
    });

    FB.Event.subscribe('auth.login', function() {
        location.reload();
    });
});
