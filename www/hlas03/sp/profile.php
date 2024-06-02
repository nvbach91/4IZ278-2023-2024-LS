<?php require __DIR__ . '/include/profile-navigation.php'; ?>

<div class="container mt-5">
    <div id="basic-info">
        <h3>Základní údaje</h3>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row">Jméno</th>
                    <td><?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); ?></td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><?php echo htmlspecialchars($_SESSION['email']); ?></td>
                </tr>
                <tr>
                    <th scope="row">Telefon</th>
                    <td><?php echo htmlspecialchars($_SESSION['phone']); ?></td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex">
            <a href="./profile-edit.php" class="btn btn-primary mr-2">Upravit profil</a>
            <a href="./change-password.php" class="btn btn-primary mr-2">Změnit heslo</a>
            <form action="scripts/delete-profile.php" method="post" onsubmit="return confirm('Opravdu chcete smazat svůj profil?');">
                <button type="submit" class="btn btn-danger">Odstranit profil</button>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
