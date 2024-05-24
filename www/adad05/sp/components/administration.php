<?php

if (!isset($_COOKIE['email'])) {
    Header('Location: login-page.php');
    exit;
}

if ($_COOKIE['privilege'] < 3) {
    Header('Location: unauthorized-message.php?reason=admin-required');
    exit;
}

if (!empty($_POST)) {
    $year = $_POST['year'];
    $month = $_POST['month'];
} else {
    $year = date('Y');
    $month = date('n');
}

require __DIR__ . '/../classes/UsersDB.php';
$usersDB = new UsersDB();
$users = $usersDB->findWithHotel();

require __DIR__ . '/../classes/CarsDB.php';
$carsDB = new CarsDB();
$cars = $carsDB->find();

require __DIR__ . '/../classes/HotelsDB.php';
$hotelsDB = new HotelsDB();
$hotels = $hotelsDB->find();

require __DIR__ . '/../classes/AssociatonDB.php';
$associationsDB = new AssociationDB();
$associations = $associationsDB->findOverview($year, $month);
$reservationsObject = ['2024-05-05' => []];
foreach ($associations as $association) {
    if (array_key_exists($association['date'], $reservationsObject)) {
        array_push($reservationsObject[$association['date']], $association);
    } else {
        $reservationsObject[$association['date']] = [$association];
    }
}

?>


<div class="reservation-div">

    <h1>Administrace</h1>
    <hr class="legend">

    <div class="admin-tab-div">
        <a class="admin-tab <?php echo ((isset($_GET['edit-mode']) and $_GET['edit-mode'] == 'users') or !isset($_GET['edit-mode'])) ? 'active-admin-tab' : ''; ?>" href="administration-page.php?edit-mode=users">Uživatelé</a>
        <a class="admin-tab <?php echo (isset($_GET['edit-mode']) and $_GET['edit-mode'] == 'hotels') ? 'active-admin-tab' : ''; ?>" href="administration-page.php?edit-mode=hotels">Hotely</a>
        <a class="admin-tab <?php echo (isset($_GET['edit-mode']) and $_GET['edit-mode'] == 'vehicles') ? 'active-admin-tab' : ''; ?>" href="administration-page.php?edit-mode=vehicles">Vozidla</a>
        <a class="admin-tab <?php echo (isset($_GET['edit-mode']) and $_GET['edit-mode'] == 'overview') ? 'active-admin-tab' : ''; ?>" href="administration-page.php?edit-mode=overview">Přehled</a>
    </div>
    <hr class="legend">

    <?php if ((isset($_GET['edit-mode']) and $_GET['edit-mode'] == 'users') or !isset($_GET['edit-mode'])) { ?>

        <h2>Správa uživatelů</h2>
        <table class="users-table">
            <tr>
                <th>ID</th>
                <th>Jméno</th>
                <th>Email</th>
                <th>Hotel</th>
                <th>Adresa</th>
                <th>Oprávnění</th>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['hotel']; ?></td>
                    <td><?php echo $user['address']; ?></td>
                    <td><?php echo $user['privilege']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="div-update">
            <form class="form-admin" method="post" action="change-privilege.php">
                <label>Změnit oprávnění uživatele:</label>
                <select required name="user_id">
                    <?php foreach ($users as $user) : ?>
                        <option value="<?php echo $user['user_id']; ?>"><?php echo $user['email']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select required name="privilege">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                <button type="submit">Změnit oprávnění</button>
            </form>
            <form class="form-admin" method="post" action="change-user-hotel.php">
                <label>Změnit hotel uživatele:</label>
                <select required name="user_id">
                    <?php foreach ($users as $user) : ?>
                        <option value="<?php echo $user['user_id']; ?>"><?php echo $user['email']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select required name="hotel_id">
                    <?php foreach ($hotels as $hotel) : ?>
                        <option value="<?php echo $hotel['hotel_id']; ?>"><?php echo $hotel['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Změnit hotel</button>
            </form>
        </div>

    <?php } elseif (isset($_GET['edit-mode']) and $_GET['edit-mode'] == 'hotels') { ?>

        <h2>Správa hotelů</h2>
        <table class="users-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
            </tr>
            <?php foreach ($hotels as $hotel) : ?>
                <tr>
                    <td><?php echo $hotel['hotel_id']; ?></td>
                    <td><?php echo $hotel['name']; ?></td>
                    <td><?php echo $hotel['address']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="div-update">
            <form class="form-admin" method="post" action="add-hotel.php">
                <label>Přidat hotel:</label>
                <input type="text" min="1" max="80" required placeholder="Název hotelu" name="name">
                <input type="text" min="1" max="80" required placeholder="Adresa hotelu" name="address">
                <button type="submit">Přidat hotel</button>
            </form>
        </div>

    <?php } elseif (isset($_GET['edit-mode']) and $_GET['edit-mode'] == 'vehicles') { ?>

        <h2>Správa vozidel</h2>
        <table class="users-table">
            <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Kapacita</th>
            </tr>
            <?php foreach ($cars as $car) : ?>
                <tr>
                    <td><?php echo $car['car_id']; ?></td>
                    <td><?php echo $car['model']; ?></td>
                    <td><?php echo $car['capacity']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="div-update">
            <form class="form-admin" method="post" action="add-car.php">
                <label>Přidat vozidlo:</label>
                <input type="text" min="1" max="40" required placeholder="Název vozidla" name="model">
                <input type="number" min="1" max="20" required placeholder="Místa" name="capacity">
                <button type="submit">Přidat vozidlo</button>
            </form>
            <form class="form-admin" method="post" action="change-capacity.php">
                <label>Změnit kapacitu vozidla:</label>
                <select required name="car_id">
                    <?php foreach ($cars as $car) : ?>
                        <option value="<?php echo $car['car_id']; ?>"><?php echo $car['model']; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="number" min="1" max="20" required placeholder="Místa" name="capacity">
                <button type="submit">Změnit kapacitu</button>
            </form>
        </div>
    <?php } elseif (isset($_GET['edit-mode']) and $_GET['edit-mode'] == 'overview') { ?>
        <h2>Přehled rezervací</h2>
        <form class="form-admin form-overview" method="post" action="administration-page.php?edit-mode=overview">
            <label>Rok: </label><input name="year" type="number" min="1900" max="2099" step="1" value="<?php echo $year; ?>">
            <label>Měsíc:</label>
            <select required name="month">
                <option <?php echo ($month == 1) ? 'selected' : ''; ?> value=1>Leden</option>
                <option <?php echo ($month == 2) ? 'selected' : ''; ?> value=2>Únor</option>
                <option <?php echo ($month == 3) ? 'selected' : ''; ?> value=3>Březen</option>
                <option <?php echo ($month == 4) ? 'selected' : ''; ?> value=4>Duben</option>
                <option <?php echo ($month == 5) ? 'selected' : ''; ?> value=5>Květen</option>
                <option <?php echo ($month == 6) ? 'selected' : ''; ?> value=6>Červen</option>
                <option <?php echo ($month == 7) ? 'selected' : ''; ?> value=7>Červenec</option>
                <option <?php echo ($month == 8) ? 'selected' : ''; ?> value=8>Srpen</option>
                <option <?php echo ($month == 9) ? 'selected' : ''; ?> value=9>Září</option>
                <option <?php echo ($month == 10) ? 'selected' : ''; ?> value=10>Říjen</option>
                <option <?php echo ($month == 11) ? 'selected' : ''; ?> value=11>Listopad</option>
                <option <?php echo ($month == 12) ? 'selected' : ''; ?> value=12>Prosinec</option>
            </select>
            <button type="submit">Zvolit</button>
        </form>

        <div>
            <?php
            foreach ($reservationsObject as $key => $value) { ?>
                <?php if (!empty($reservationsObject[$key])) { ?>
                    <div>
                        <h3 class="h3-date"><?php echo $key; ?></h3>
                        <table class="users-table dates-table">
                            <tr>
                                <th>Time</th>
                                <th>Email</th>
                                <th>Hotel</th>
                                <th>Car</th>
                            </tr>
                            <?php foreach ($reservationsObject[$key] as $object) { ?>
                                <tr>
                                    <td><?php
                                        $time_block = $object['time'];
                                        $h0 = 8 + floor($time_block / 2);
                                        $m0 = (($time_block % 2) == 0) ? '00' : '30';
                                        $h1 = 8 + floor(($time_block + 1) / 2);
                                        $m1 = ((($time_block + 1) % 2) == 0) ? '00' : '30';
                                        echo $h0 . ':' . $m0 . ' - ' . $h1 . ':' . $m1; ?></td>
                                    <td><?php echo $object['email']; ?></td>
                                    <td><?php echo $object['name']; ?></td>
                                    <td><?php echo $object['model']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
            <?php }
            }
            ?>
        </div>

    <?php } else {
        header('Location: administration-page.php');
    } ?>
</div>