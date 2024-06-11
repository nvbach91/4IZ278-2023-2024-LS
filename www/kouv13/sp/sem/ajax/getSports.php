<?php
require_once __DIR__ . '../../config.php';
include BASE_PATH . '/includes/authAdmin.php';
require_once BASE_PATH . '/db/db.class.php';
$db = new db();
$allSports = $db->getAllSports();
$fieldSports = $db->getFieldSports(htmlspecialchars($_GET['idField']));
$fieldSport_ids = array_map(function ($obj) {
    return $obj->sport_id;
}, $fieldSports);

foreach ($allSports as $sport) {
    $is = false;
    if (in_array($sport->sport_id, $fieldSport_ids, true)) {
        $is = true;
    }
?>

    <div class="col-2 sport-editing border rounded-2 p-3 <?php if ($is == true) {
                                                                echo 'is-sport';
                                                            } ?>" role="button" onclick="editSports('<?php echo $_GET['idField']; ?>', '<?php echo $sport->sport_id; ?>');"><strong class="fw-semibold"><?php echo $sport->name; ?></strong></div>

<?php } ?>
<button onclick="reloadPage()" class="reload-btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
    </svg>
</button>