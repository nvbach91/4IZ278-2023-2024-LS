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
        window.location.href = '../components/BlacksmithDisplay.php';
    })
    .catch((error) => {
      console.error('Error:', error);
    });
};

    noButton.onclick = function() {
        dialog.className = 'confirm-dialog-hidden';
    };
}

function confirmInventoryAction(itemName) {
    console.log("confirmInventoryAction called with item:", itemName);
    var dialog = document.getElementById('inventoryActionDialog');
    var dialogText = document.getElementById('inventoryActionDialogText');
    var equipButton = document.getElementById('inventoryActionDialogEquip');
    var sellButton = document.getElementById('inventoryActionDialogSell');
    var cancelButton = document.getElementById('inventoryActionDialogCancel');

    dialogText.textContent = "What do you want to do with " + itemName + "?";
    dialog.className = 'action-dialog-visible';

    equipButton.onclick = function() {
        dialog.className = 'action-dialog-hidden';
    
        fetch('../store_item_to_equip_in_session.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'item_name=' + encodeURIComponent(itemName),
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            window.location.href = '../components/CharacterDisplay.php';
        })
        .catch((error) => {
          console.error('Error:', error);
        });
    };

    sellButton.onclick = function() {
        dialog.className = 'action-dialog-hidden';

    fetch('../store_item_to_sell_in_session.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'item_name=' + encodeURIComponent(itemName),
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        window.location.href = '../components/BlacksmithDisplay.php';
    })
    .catch((error) => {
      console.error('Error:', error);
    });
};

    cancelButton.onclick = function() {
        dialog.className = 'action-dialog-hidden';
    };
}
function deleteCharacter() {
    if (confirm('Are you sure you wish to delete this character?')) {
        location.href='delete_character.php';
    }
}