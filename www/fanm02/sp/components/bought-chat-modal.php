<div class='modal fade' id='bchatModal<?php echo $meal['meal_id']; ?>' tabindex='-1' role='dialog' aria-labelledby='bchatModalLabel<?php echo $meal['meal_id']; ?>' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='bchatModalLabel<?php echo $meal['meal_id']; ?>'>Chat</h5>
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
                                            document.querySelector('#bchatModal<?php echo $meal['meal_id']; ?> input'),
                                            <?php echo $meal['meal_id']; ?>
                                        )" class='btn btn-primary button-send'>Send</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#bchatModal<?php echo $meal['meal_id']; ?> .chat-input').on('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.querySelector('#bchatModal<?php echo $meal['meal_id']; ?> .button-send').click(); 
        }
    });

    $('#bchatModal<?php echo $meal['meal_id']; ?>').on('shown.bs.modal', function() {
        interval = setInterval(function() {
            updateMessages(
                document.querySelector('#bchatModal<?php echo $meal['meal_id']; ?> .chat-messages'),
                <?php echo $meal['meal_id']; ?>,
                true);
        }, 1000);
    });

    $('#bchatModal<?php echo $meal['meal_id']; ?>').on('hidden.bs.modal', function() {
        clearInterval(interval);
    });
</script>