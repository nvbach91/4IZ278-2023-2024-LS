function loadCalendar(date) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.querySelector('#calendar').innerHTML = xmlhttp.responseText;
            addReservationListeners();
            clearReservation();
        }
    };
    xmlhttp.open("GET", "/~kouv13/sem/ajax/loadCalendar.php?date=" + date, true);
    xmlhttp.send();
}

function addReservationListeners() {
    var divs = document.querySelectorAll('.reservation:not(.full)');

    divs.forEach(function (div) {
        div.addEventListener('click', function () {
            if (this.classList.contains('reserved')) {
                this.classList.remove('reserved');
                this.style.backgroundColor = 'white';
                decreasePrice();
                if (parseInt(document.querySelector('#price').innerText, 10) == 0) {
                    clearReservation();
                }

            } else {
                this.classList.add('reserved');
                this.style.backgroundColor = `#0d6efd`;
                enableReservation();
                increasePrice();
            }
        });
    });
}

function addRadioListeners() {
    var radios = document.querySelectorAll('.form-check-input');

    radios.forEach(function (radio) {
        radio.addEventListener('click', function () {
            radios.forEach(function (r) {
                r.classList.remove("radio-checked");
            });
            this.classList.add('radio-checked');
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    if (window.location.pathname === '/~kouv13/sem/u/reservation/' || window.location.pathname === '/~kouv13/sem/admin/field.php') {
        addReservationListeners();
        addRadioListeners();
    }
});

function clearReservation() {
    document.querySelector('#price').innerHTML = '0';
    document.querySelector('#confirm-button').classList.add('disabled');
}

function enableReservation() {
    document.querySelector('#confirm-button').classList.remove('disabled');
}

function decreasePrice() {
    var price = parseInt(document.querySelector('#price').innerText, 10);
    document.querySelector('#price').innerHTML = price - parseInt(document.querySelector('#annual-price').innerText, 10);
}

function increasePrice() {
    var price = parseInt(document.querySelector('#price').innerText, 10);
    document.querySelector('#price').innerHTML = price + parseInt(document.querySelector('#annual-price').innerText, 10);
}

function confirmReservation() {
    let selectedDivs = document.querySelectorAll(".reserved");
    let selectedIds = Array.from(selectedDivs).map(div => div.id);

    let form = document.querySelector('#hidden-form');

    let inputIds = document.createElement('input');
    inputIds.type = 'hidden';
    inputIds.name = 'ids';
    inputIds.value = JSON.stringify(selectedIds);
    form.appendChild(inputIds);

    let inputSport = document.createElement('input');
    inputSport.type = 'hidden';
    inputSport.name = 'sport';
    inputSport.value = document.querySelector('.radio-checked').value;
    form.appendChild(inputSport);


    document.body.appendChild(form);
    form.submit();
}

function editSports(idField, idSport) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            getSports(idField);
        }
    };
    xmlhttp.open("GET", "/~kouv13/sem/ajax/editSports.php?idField=" + idField + "&idSport=" + idSport, true);
    xmlhttp.send();
}

function getSports(idField) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.querySelector('#edit-sports').innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "/~kouv13/sem/ajax/getSports.php?idField=" + idField, true);
    xmlhttp.send();
}

function reloadPage() {
    window.location.reload();
}

function getNextRes() {
    let elements = document.querySelectorAll('.next-id');
    let id = elements.length ? elements[elements.length - 1].textContent : null;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.querySelector('#next').innerHTML += xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "/~kouv13/sem/ajax/getLast.php?id=" + id, true);
    xmlhttp.send();
}