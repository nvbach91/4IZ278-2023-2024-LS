<?php session_start();

if (!empty($_SESSION["role"])) {
    if ($_SESSION["role"] == 1) {
        $role = "user";
    } else if ($_SESSION["role"] == 2) {
        $role = "manager";
    } else if ($_SESSION["role"] == 3) {
        $role = "admin";
    }
}
?>
<div style="position: absolute; bottom: 5px; left: 5px;"><?php echo !empty($_SESSION["role"]) ? "Přihlášený jako: " . $role : "Not logged in" ?></div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>

<?php


?>