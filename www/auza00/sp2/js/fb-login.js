window.fbAsyncInit = function () {
    FB.init({
        appId: '1018750993105271',
        oauth: true,
        status: true, // check login status
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true, // Parse social plugins on this webpage.
        version: 'v20.0'
    });

    FB.getLoginStatus(function (response) {   // Called after the JS SDK has been initialized.
        statusChangeCallback(response);        // Returns the login status.
    });

};

function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
        if (localStorage.getItem("facebookLoggedIn") != true && localStorage.getItem("facebookLoggedIn") != 'true') {
            testAPI();
        }
    } else {                                 // Not logged into your webpage or we are unable to tell.
        console.log('Please log into this webpage.');
    }
}

function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', { fields: 'name, email' }, function (response) {
        console.log('Successful login for: ' + response.email);
        //if (getCookie('oAuthEmail') == undefined || getCookie('oAuthEmail') == null || getCookie('oAuthEmail') == 'null'){
        console.log('Successful login for2: ' + response.email);
        fetch("./download-user.php")
            .then(response => response.json() // Parse the JSON data.
            )
            .then((data) => {
                console.log('checkemailexists');
                checkEmailExists(response.email, data);
            })
            .catch(error => {
                console.error(error);
            });

        //}
    });
}

function fb_login() {
    FB.login(function (response) {

        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            //console.log(response); // dump complete info
            access_token = response.authResponse.accessToken; //get access token
            user_id = response.authResponse.userID; //get FB UID

            FB.api('/me', { fields: 'name, email' }, function (response) {
                user_email = response.email; //get user email
                console.log('Successful login for: ' + user_email);
                location.href = 'index.php';
            });

        } else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');

        }
    }, {
        scope: 'public_profile,email'
    });
};