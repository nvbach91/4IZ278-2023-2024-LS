<?php require_once __DIR__ . './../../db/EventsDB.php'; ?>
<?php
include __DIR__ . './../../utils.php';

$eventsDB = new EventsDB;
$category_id = $_GET['category_id'] ?? "all";

$eventCount = $eventsDB->getEventsCount($category_id);

$pagesCount = ceil($eventCount->total / pageLimit);
$page = isset($_GET['page']) ? $_GET['page'] : '';
if (!$page || $page < 1 || $page > $pagesCount) {
    $page = 1;
}
$events = $eventsDB->getEvents($page, $category_id, $_SESSION['customer_id']);

?>
<div class="row my-4">
    <?php foreach ($events as $event) : ?>
        <div class="col-lg-4 col-md-6 mb-4 bbb">
            <div class="card h-100 product">

                <img class="card-img-top product-image img-fluid"
                     src="<?php echo $event['picture'] ?? 'https://i0.wp.com/sigmamaleimage.com/wp-content/uploads/2023/03/placeholder-1-1.png?resize=300%2C200&ssl=1'; ?>"
                     alt="event_picture"
                     onerror="this.onerror=null; this.src='https://i0.wp.com/sigmamaleimage.com/wp-content/uploads/2023/03/placeholder-1-1.png?resize=300%2C200&ssl=1';"
                >

                <div class="card-body">
                    <h4 class="card-title">
                        <?php echo $event['name']; ?>
                    </h4>

                    <div class="event-time">
                        <?php echo formatDateTimestamp($event['time']); ?>
                    </div>
                    <div class="event-address">
                        <?php echo $event['address']; ?>
                    </div>
                    <hr>
                    <p class="card-text"><?php echo $event['description']; ?></p>
                    <hr>
                    <div>Pořadatel:<?php echo " " . $event['advertizer_name']; ?></div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <?php if (!$event['cancelled']): ?>
                        <h5 class="mb-0"><?php echo formatPrice($event['price']); ?></h5>
                        <a class="btn btn-outline-primary rounded"
                           href="event_detail.php?id=<?php echo $event['id']; ?>"><?php echo !$event['user_has_ticket'] ? "Koupit" : "Náhled" ?></a>
                    <?php else: ?>
                        <h5 class="mb-0 text-danger">Zrušeno</h5>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<?php if ($pagesCount > 1): ?>
    <div class="row">
        <div class="col-lg-12">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $pagesCount; $i++) : ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link"
                               href="?category_id=<?php echo $category_id . "&page=" . $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
<?php endif; ?>
