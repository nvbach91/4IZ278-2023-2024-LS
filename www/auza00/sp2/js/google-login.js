/*LOG GOOGLE*/

let YOUR_CLIENT_ID = '996218026256-ljoik941samk0fqojt2mea4bn8d0jtpt.apps.googleusercontent.com';
let YOUR_REDIRECT_URI = 'https://iknowaspot.eu';

// Parse query string to see if page request is coming from OAuth 2.0 server.
let fragmentString = location.hash.substring(1);
let params = {};
let regex = /([^&=]+)=([^&]*)/g, m;
while (m = regex.exec(fragmentString)) {
    params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
}
if (Object.keys(params).length > 0 && params['state']) {
    if (params['state'] == localStorage.getItem('state')) {
        localStorage.setItem('oauth2-test-params', JSON.stringify(params));

    } else {
        console.log('State mismatch. Possible CSRF attack');
    }
}

window.history.pushState({}, document.title, "/");
let infoGoogle = JSON.parse(localStorage.getItem('oauth2-test-params'));
console.log(JSON.parse(localStorage.getItem('oauth2-test-params')));
console.log(infoGoogle['access_token']);
console.log(infoGoogle['expires_in']);


function checkEmailExists(googleEmail, userEmails) {
    console.log(googleEmail);
    console.log(userEmails);
    if (typeof googleEmail !== "undefined") {
        if (userEmails.includes(googleEmail)) {
            console.log('email already in use');
            createCookie("googleEmail", googleEmail, "2");
            location.href = './signin-oauth.php';
        }
        else {
            console.log('email not in use');
            createCookie("googleEmail", googleEmail, "2");
            document.getElementById('popup6').style.display = 'block';
            document.getElementById('popup-all7').style.display = 'block';
        }
    }
}

// Function to generate a random state value
function generateCryptoRandomState() {
    const randomValues = new Uint32Array(2);
    window.crypto.getRandomValues(randomValues);

    // Encode as UTF-8
    const utf8Encoder = new TextEncoder();
    const utf8Array = utf8Encoder.encode(
        String.fromCharCode.apply(null, randomValues)
    );

    // Base64 encode the UTF-8 data
    return btoa(String.fromCharCode.apply(null, utf8Array))
        .replace(/\+/g, '-')
        .replace(/\//g, '_')
        .replace(/=+$/, '');
}

/*
 * Create form to request access token from Google's OAuth 2.0 server.
 */

function oauth2SignIn() {
    localStorage.setItem('signinGoogle', 'signing_in');
    // create random state value and store in local storage
    let state = generateCryptoRandomState();
    localStorage.setItem('state', state);

    // Google's OAuth 2.0 endpoint for requesting an access token
    let oauth2Endpoint = 'https://accounts.google.com/o/oauth2/v2/auth';

    // Create element to open OAuth 2.0 endpoint in new window.
    let form = document.createElement('form');
    form.setAttribute('method', 'GET'); // Send as a GET request.
    form.setAttribute('action', oauth2Endpoint);

    // Parameters to pass to OAuth 2.0 endpoint.
    let params = {
        'client_id': YOUR_CLIENT_ID,
        'redirect_uri': YOUR_REDIRECT_URI,
        'scope': 'https://www.googleapis.com/auth/userinfo.email',
        'state': state,
        'include_granted_scopes': 'true',
        'response_type': 'token'
    };

    // Add form parameters as hidden input values.
    for (let p in params) {
        let input = document.createElement('input');
        input.setAttribute('type', 'hidden');
        input.setAttribute('name', p);
        input.setAttribute('value', params[p]);
        form.appendChild(input);
    }

    // Add form to page and submit it to open the OAuth 2.0 endpoint.
    document.body.appendChild(form);
    form.submit();
}

if (localStorage.getItem('signinGoogle') == 'signing_in') {
    localStorage.setItem('signinGoogle', 'signed_in');
    const promise1 =
        fetch('https://www.googleapis.com/oauth2/v3/userinfo', {
            headers: {
                "Authorization": `Bearer ${infoGoogle['access_token']}`
            }
        })
            .then(response => response.json());
    const promise2 =
        fetch("./download-user.php")
            .then(response => response.json() // Parse the JSON data.
            );

    Promise.all([promise1, promise2])
        .then(([data1, data2]) => {
            checkEmailExists(data1.email, data2);
        })
        .catch(error => {
            console.error(error);
        });
}