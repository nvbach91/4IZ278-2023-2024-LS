<?php

if (!isset($_COOKIE['email'])) {
    Header('Location: login-page.php');
    exit;
}

if ($_COOKIE['privilege'] < 3) {
    Header('Location: unauthorized-message.php?reason=admin-required');
    exit;
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

?>


<div class="reservation-div">

    <h1>Administrace</h1>
    <hr class="legend">

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
        <?php foreach ($users as $user): ?>
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
        <form class="form-admin"  method="post" action="change-privilege.php">
            <label>Změnit oprávnění uživatele:</label>
            <select required name="user_id">
                <?php foreach ($users as $user): ?>
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
        <form class="form-admin"  method="post" action="change-user-hotel.php">
            <label>Změnit hotel uživatele:</label>
            <select required name="user_id">
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['user_id']; ?>"><?php echo $user['email']; ?></option>
                <?php endforeach; ?>
            </select>
            <select required name="hotel_id">
                <?php foreach ($hotels as $hotel): ?>
                    <option value="<?php echo $hotel['hotel_id']; ?>"><?php echo $hotel['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Změnit hotel</button>
        </form>
    </div>

    <h2>Správa hotelů</h2>
    <table class="users-table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
        </tr>
        <?php foreach ($hotels as $hotel): ?>
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

    <h2>Správa vozidel</h2>
    <table class="users-table">
        <tr>
            <th>ID</th>
            <th>Model</th>
            <th>Kapacita</th>
        </tr>
        <?php foreach ($cars as $car): ?>
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
                <?php foreach ($cars as $car): ?>
                    <option value="<?php echo $car['car_id']; ?>"><?php echo $car['model']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="number" min="1" max="20" required placeholder="Místa" name="capacity">
            <button type="submit">Změnit oprávnění</button>
        </form>
    </div>
</div>