<div class="row justify-content-center align-items-center mt-5">
    <div class="col-12 col-md-8 col-lg-6 rounded-2 p-2">
        <form action="admin/editField.php" method="post" enctype="multipart/form-data">
            <h2 class=" mb-3">Upravit halu</h2>
            <div class="form-floating mb-3">
                <input type="text" class="form-control focus-ring focus-ring-success" id="floatingInput" placeholder="Pepa Novák" name="name" value="<?php echo $field->name; ?>">
                <label for="floatingInput">Jméno</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control focus-ring focus-ring-success" placeholder="Popisek" id="floatingTextarea2" style="height: 100px" name="description"><?php echo $field->description; ?></textarea>
                <label for="floatingTextarea2">Popisek</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control focus-ring focus-ring-success" id="floatingInput" placeholder="kapacita" name="capacity" value="<?php echo $field->capacity; ?>">
                <label for="floatingInput">Kapacita</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control focus-ring focus-ring-success" id="floatingInput" placeholder="cena" name="price" value="<?php echo $field->price; ?>">
                <label for="floatingInput">Cena</label>
            </div>
            <input type="hidden" value="<?php echo $field->field_id; ?>" name="id">
            <button type="submit" name="submit" class="btn btn-success">Upravit</button>
        </form>
    </div>
</div>