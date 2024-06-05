/*MAIN BUTTONS*/
const buttonMySpots = document.querySelector("#button-list");
const buttonAddAdd = document.querySelector("#button-add-first");
const buttonAddConfirm = document.querySelector("#button-add-second");
const buttonAddCancel = document.querySelector("#button-remove");
const buttonAddLogin = document.querySelector("#button-add-third");
const buttonLogout = document.querySelector("#button-logout");

/*OTHER BUTTONS*/
const buttonLogoutFinal = document.querySelector("#main-button-signout");
const buttoInfoWeb = document.querySelector("#info-button");

/*POPUPS*/
const popupAddFormAll = document.querySelector("#popup-all");
const popupAddForm = document.querySelector("#popup");

const popupInfoMAll = document.querySelector("#popup-all2");
const popupInfoM = document.querySelector("#information-allM");

const popupLogoutAll = document.querySelector("#popup-all3");
const popupLogout = document.querySelector("#popup3");

const popupInfoWebAll = document.querySelector("#popup-all4");
const popupInfoWeb = document.querySelector("#popup4");

const popupMySpotsAll = document.querySelector("#popup-all5");
const popupMySpots = document.querySelector("#popup5");
const mySpotsDiv = document.getElementById('popup5-container');

/*CLICKS*/
$('#button-add-third').on('click', function () { //transfer to signup
    window.location.href = "signup.php";
});

$('#button-logout').on('click', function () { //transfer to signup
    popupLogout.style.display = 'block';
    popupLogoutAll.style.display = 'block';
});

$('#button-add-first').on('click', function () { //show spot point on map
    addPoint();
});

$('#button-remove').on('click', function () { //hide spot point on map
    removePoint();
});

$('#button-add-second').on('click', function () { //show add form
    popupAddForm.style.display = 'block';
    popupAddFormAll.style.display = 'block';

    longitude = marker.getLngLat().lng; //actualize long and lat
    latitude = marker.getLngLat().lat;

    $(document).ready(function () { // save to cookie
        createCookie("longitude-for-form", longitude, "1");
        createCookie("latitude-for-form", latitude, "1");
    });
});

$('#info-button').on('click', function () { //show info about web
    popupInfoWeb.style.display = 'block';
    popupInfoWebAll.style.display = 'block';
});

$('#button-list').on('click', function () { //show mySpots
    mySpots();
    popupMySpots.style.display = 'block';
    popupMySpotsAll.style.display = 'block';
});

$('#main-button-signout').on('click', function () { //logout -> clear
    localStorage.removeItem("signinGoogle");
    myPoints = [];
});

/*SHOW HIDE BKG OF POPUP*/
$('#popup-all').on('click', function () { //add form popup
    popupAddForm.style.display = 'none';
    popupAddFormAll.style.display = 'none';
});

$('#popup-all2').on('click', function () { //Info about spot mobile popup
    popupInfoM.style.display = 'none';
    popupInfoMAll.style.display = 'none';
});

$('#popup-all3').on('click', function () { //logout popup
    popupLogout.style.display = 'none';
    popupLogoutAll.style.display = 'none';
});

$('#popup-all4').on('click', function () { //info about web popup
    popupInfoWeb.style.display = 'none';
    popupInfoWebAll.style.display = 'none';
});

$('#popup-all5').on('click', function () { //my spots
    popupMySpots.style.display = 'none';
    popupMySpotsAll.style.display = 'none';
    mySpotsDiv.innerHTML = '';
    myPoints = [];
});