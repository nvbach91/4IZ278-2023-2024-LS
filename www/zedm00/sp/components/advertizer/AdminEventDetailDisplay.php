<?php require_once __DIR__ . './../../db/EventsDB.php'; ?>
<?php require_once __DIR__ . './../../db/CustomerDB.php'; ?>
<?php
include __DIR__ . './../../utils.php';

$eventsDB = new EventsDB;
$customerDB = new CustomerDB;
$id = $_GET['id'] ?? null;
$state = $_GET['state'] ?? null;

if ($state == 'deleted') {
    $eventsDB->deleteEvent($id);
    header("Location: admin_index.php");
}

if ($state == 'canceled') {
    $eventsDB->cancelEvent($id);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim($_POST['name']));
    $time = htmlspecialchars(trim($_POST['time']));
    $type = htmlspecialchars(trim($_POST['type']));
    $price = htmlspecialchars(trim($_POST['price']));
    $capacity = htmlspecialchars(trim($_POST['capacity']));
    $advertizer_id = $_SESSION['advertizer_id'];
    $description = htmlspecialchars(trim($_POST['description']));
    $address = htmlspecialchars(trim($_POST['address']));
    $picture = htmlspecialchars(trim($_POST['picture']));

    if (!is_numeric($capacity)) {
        $errors[] = "Kapacita není číslo.";
    }

    if ($capacity < 0) {
        $errors[] = "Kapacita je menší než 0.";
    }

    if ($price < 0) {
        $errors[] = "Cena je menší než 0.";
    }

    if (!is_numeric($price)) {
        $errors[] = "Cena není číslo.";
    }

    if ($name == '') {
        $errors[] = "Jméno je prázdné.";
    }

    $format = 'Y-m-d\TH:i';
    $dateTime = DateTime::createFromFormat($format, $time);

    if ($dateTime && $dateTime->format($format) === $time) {
        $errors[] = "Datum není ve správném formátu.";
    }


    if ($id) {
        $eventsDB->updateEvent($id, $name, $time, $type, $price, $capacity, $description, $address, $picture);
    } else {
        $eventsDB->saveNewEvent($name, $time, $type, $price, $capacity, $advertizer_id, $description, $address, $picture);
        header("Location: admin_index.php");
    }


}

if (isset($_GET['id'])) {
    $event = $eventsDB->findEvent($_GET['id']);
    $name = $event['name'];
    $time = $event['time'];
    $type = $event['type'];
    $price = $event['price'];
    $capacity = $event['capacity'];
    $description = $event['description'];
    $address = $event['address'];
    $picture = $event['picture'];
    $errors = [];

    $customers = $customerDB->findCustomersByEvent($_GET['id']);


}

$canceled = $state == 'canceled' || (isset($event) && $event['cancelled']);

if (!empty($errors)) {
    echo '<div class="alert alert-danger mt-5 gap-3">';
    foreach ($errors as $error) {
        echo '<div>' . $error . '</div>';
    }
    echo '</div>';
}


?>

<div class="container d-flex flex-grow-1">
    <div class="row">
        <div class="col-3 text-center">
            <div class="mt-4">
                <a href="admin_index.php" class="btn btn-lg btn-outline-secondary"> Zpět</a>
            </div>
        </div>
        <div class="col-9 ">
            <div>
                <form class="row row-cols-3 g-4  my-4" method="POST"
                      action="<?php echo $_SERVER["PHP_SELF"] ?>?id=<?php echo $id ?>" enctype="multipart/form-data">

                    <div class="col-12">
                        <label>Název*</label>
                        <input class="form-control" name="name"
                               value="<?php echo htmlspecialchars(trim($name ?? '')); ?>" required>
                    </div>

                    <div class="">
                        <label>Adresa*</label>
                        <input class="form-control" name="address"
                               value="<?php echo htmlspecialchars(trim($address ?? '')); ?>" required>
                    </div>


                    <div>
                        <label>Čas*</label>
                        <input type="datetime-local" class="form-control" name="time" min="2024-01-01T00:00"
                               value="<?php echo htmlspecialchars(trim($time ?? '')); ?>" required>
                    </div>
                    <div>
                        <label>Typ*</label>
                        <select class="form-control" name="type" required>
                            <?php
                            $first = true;
                            foreach (TYPES as $type_el):
                                if ($type_el['key'] !== 'all'):
                                    $selected = '';
                                    if ($first) {
                                        $selected = 'selected';
                                        $first = false;
                                    }
                                    if (isset($type) && $type == $type_el['key']) {
                                        $selected = 'selected';
                                    }
                                    ?>
                                    <option value="<?php echo $type_el['key']; ?>" <?php echo $selected; ?>>
                                        <?php echo $type_el['translation']; ?>
                                    </option>
                                <?php
                                endif;
                            endforeach;
                            ?>
                        </select>

                    </div>
                    <div class="col-12 ">
                        <label>Popis</label>
                        <textarea class="form-control" placeholder="Co se bude dít..." name="description"
                                  style="height: 100px">
    <?php echo htmlspecialchars(trim($description ?? '')); ?>
</textarea>
                    </div>


                    <div class="col-6">
                        <label>Kapacita*</label>
                        <input type="number" class="form-control" name="capacity" min="0"
                               value="<?php echo htmlspecialchars(trim($capacity ?? 0)); ?>">

                    </div>

                    <div class="col-6">
                        <label>Cena lístku*</label>
                        <input type="number" class="form-control" name="price" min="0"
                               value="<?php echo htmlspecialchars(trim($price ?? 0)); ?>">
                    </div>


                    <div class="col-12">
                        <label>Obrázek</label>
                        <input type="text" class="form-control" name="picture" placeholder="URL obrázku"
                               value="<?php echo $picture ?? ''; ?>">
                    </div>

                    <?php if (isset($picture) && $picture != ''): ?>
                        <div class="col-12 ">
                            <img src="<?php echo htmlspecialchars(trim($picture)); ?>" alt="Event Image"
                                 class="img-fluid product-image">
                        </div>
                    <?php endif; ?>



                    <?php if (!$canceled): ?>
                        <button class="btn btn-primary col-12" type="submit">Uložit</button>
                    <?php endif; ?>
                    <?php if (isset($event) && !$canceled): ?>
                        <a class="btn btn-secondary col-6"
                           href="admin_create_event.php?id=<?php echo $id . "&state=canceled" ?>">Zrušit</a>
                    <?php endif; ?>
                    <?php if (isset($event)): ?>
                        <a class="btn btn-danger col-6 "
                           href="admin_create_event.php?id=<?php echo $id . "&state=deleted" ?>">Smazat</a>
                    <?php endif; ?>
                </form>

                <hr>
                <h3>Seznam zákazníků s lístkem</h3>

                <div class="row mb-5 ">
                    <div class="col-4"><b>Jméno</b></div>
                    <div class="col-4"><b>E-mail</b></div>
                    <div class="col-4"> <b>Kód vstupenky</b></div>
                    <hr>
                    <?php foreach ($customers as $customer): ?>
                        <div class="col-4"><?php echo $customer["name"]; ?></div>
                        <div class="col-4"><?php echo $customer["email"]; ?></div>
                        <div class="col-4"><?php echo $customer["code"]; ?></div>
                    <?php endforeach; ?>
                    <?php echo count($customers) === 0 ? "Žádné vstupenky" : "" ?>
                </div>
            </div>
        </div>
    </div>
</div>
