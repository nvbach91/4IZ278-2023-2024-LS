<div class="modal fade" id="new-sport" tabindex="-1" aria-labelledby="deleteModalLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Přidat nový sport</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="admin/addNewSport.php" method="post" id="form-add-sport">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control focus-ring focus-ring-success" id="ns" placeholder="Jméno sportu" name="name" required>
                        <label for="floatingPassword">Jméno sportu</label>
                    </div>
                    <button type="submit" class="btn btn-success">Přidat</button>
                </form>
            </div>

        </div>
    </div>
</div>