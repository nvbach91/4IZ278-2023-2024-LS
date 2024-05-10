<?php include '../controller/prepareMessageModal.php'; ?>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Zpráva realitní kanceláři</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <textarea name="message"></textarea> 
      </div>
      <div class="modal-footer">
        <button type="button" id="secondary-button" data-bs-dismiss="modal">Zavřít</button>
        <button type="submit" id="primary-button">Odeslat</button>
      </div>
    </div>
  </div>
</div>
</form>
