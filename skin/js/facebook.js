window.fbAsyncInit = function() {
    FB.init({
        appId      : '381912872206892',
        status     : true,
        cookie     : true,
        xfbml      : true,
        version    : 'v2.9'
    });

    $(document).trigger('fbload');  //  <---- THIS RIGHT HERE TRIGGERS A CUSTOM EVENT CALLED 'fbload'
};


$(document).on('fbload', function () {
    FB.login(function(response) {
        if (response.status === 'connected') {
            console.log('login');
        } else {
            console.log('not login');
        }
    });

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });

    function statusChangeCallback(response) {
        if (response.status === 'connected') {
            location.replace('/comment');
        } else {
            console.log('not login');
        }
    }
});
