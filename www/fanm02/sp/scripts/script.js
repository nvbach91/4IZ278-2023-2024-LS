function openTab(evt, tabName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

let interval;

$(document).ready(function () {
  if($("#defaultOpen").length){
    document.getElementById("defaultOpen").click();
  }

  if($("#datetime").length){
    let dateElement = document.getElementById("datetime");
    dateElement.min = new Date().toISOString().slice(0,new Date().toISOString().lastIndexOf(":"));
  }
})

function sendMessage(element, mealId, sender, receiver) {
  $.ajax({
    type: 'POST',
    url: 'send-message.php',
    data: {
      content: escapeHtml(element.value),
      meal_id: mealId,
      sender_id: sender,
      receiver_id: receiver
    },
    success: function (response) {
      console.log('message sent');
      element.value = "";
    }
  });
}

function updateMessages(element, mealId, boughtChat) {
  $.ajax({
    type: 'POST',
    url: 'get-messages.php',
    data: {
      meal_id: mealId,
    },
    success: function (response) {
      let messages = JSON.parse(response);
      element.innerHTML = "";

      for (const message of messages) {
        if (message['sender_id'] == registeredUserId) {
          element.innerHTML += `
                        <div class='message'>
                            <div class='message-sender'>You:&nbsp;</div>
                            <div class='message-content'>${message['content']}</div>
                        </div>
                    `;
        } else {
          element.innerHTML += `
                            <div class='message'>
                                <div class='message-sender'>${boughtChat ? 'Seller' : 'Buyer'}:&nbsp;</div>
                                <div class='message-content'>${message['content']}</div>
                            </div>
                        `;
        }
      }
    }
  });
}

function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  
  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}