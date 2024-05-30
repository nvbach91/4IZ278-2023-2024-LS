function confirmPurchase(itemName, itemPrice) {
    var dialog = document.getElementById('confirmDialog');
    var dialogText = document.getElementById('confirmDialogText');
    var yesButton = document.getElementById('confirmDialogYes');
    var noButton = document.getElementById('confirmDialogNo');

    dialogText.textContent = "Do you want to buy " + itemName + " for " + itemPrice + " gold?";
    dialog.className = 'confirm-dialog-visible';

    yesButton.onclick = function() {
    dialog.className = 'confirm-dialog-hidden';

    fetch('../store_item_in_session.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'item_name=' + encodeURIComponent(itemName),
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        window.location.href = '../components/CharacterDisplay.php'; // Redirect to buy_item.php
    })
    .catch((error) => {
      console.error('Error:', error);
    });
};

    noButton.onclick = function() {
        dialog.className = 'confirm-dialog-hidden';
    };
}