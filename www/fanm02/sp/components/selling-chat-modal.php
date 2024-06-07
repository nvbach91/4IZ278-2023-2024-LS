<div class='modal fade' id='schatModal<?php echo $meal['meal_id']; ?>' tabindex='-1' role='dialog' aria-labelledby='schatModalLabel<?php echo $meal['meal_id']; ?>' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='schatModalLabel<?php echo $meal['meal_id']; ?>'>Chat</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>

            <div class='modal-body'>
                <div class='chat-messages'>
                </div>
            </div>
            <div class='modal-footer'>
                <input type='text' class='form-control chat-input' placeholder='Type your message...'>
                <button type='button' onclick="sendMessage(
                                            document.querySelector('#schatModal<?php echo $meal['meal_id']; ?> input'),
                                            <?php echo $meal['meal_id']; ?>,
                                        )" class='btn btn-primary button-send'>Send</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#schatModal<?php echo $meal['meal_id']; ?>').on('shown.bs.modal', function() {
        interval = setInterval(function() {
            updateMessages(
                document.querySelector('#schatModal<?php echo $meal['meal_id']; ?> .chat-messages'),
                <?php echo $meal['meal_id']; ?>,
                false);
        }, 1000);
    });

    $('#schatModal<?php echo $meal['meal_id']; ?>').on('hidden.bs.modal', function() {
        clearInterval(interval);
    });

    $('#schatModal<?php echo $meal['meal_id']; ?> .chat-input').on('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.querySelector('#schatModal<?php echo $meal['meal_id']; ?> .button-send').click(); 
        }
    });
</script>