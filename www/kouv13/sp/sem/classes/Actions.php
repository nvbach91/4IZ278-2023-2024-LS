<?php
class Actions
{
    public $conn;

    public function __construct()
    {
    }

    public function getSports($idfield)
    {
        require_once __DIR__ . '../../db/db.class.php';
        $db = new db();
        $sports = $db->getFieldSports($idfield);
        $first = true;
        foreach ($sports as $s): ?>

            <div class="position-relative radio-container me-3">
                <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5 mt-30<?php if ($first)
                    echo ' radio-checked'; ?>" type="radio" name="sport" id="<?php echo $s->sport_id; ?>"
                    value="<?php echo $s->sport_id; ?>" <?php if ($first)
                           echo 'checked'; ?>> <label
                    class="list-group-item py-3 pe-5" for="<?php echo $s->sport_id; ?>">
                    <strong class="fw-semibold"><?php echo $s->name; ?></strong>
                </label>
            </div>

            <?php $first = false;
        endforeach;
    }

    private function getWeekRange($date)
    {
        $date = new DateTime($date);

        $monday = clone $date;
        $monday->modify('this week monday');

        $sunday = clone $date;
        $sunday->modify('this week sunday');

        $mondayString = $monday->format('d.m.');
        $sundayString = $sunday->format('d.m.');
        $m = $monday->format('Y-m-d');
        $s = $sunday->format('Y-m-d');

        return ['monday' => $mondayString, 'sunday' => $sundayString, 'm' => $m, 's' => $s];
    }

    private function getTimes()
    {
        for ($i = 9; $i <= 21; $i++): ?>
            <div class="col"><?php echo $i; ?>:00 - <?php echo $i; ?>:55</div>
        <?php endfor;
    }

    private function get_day($n)
    {
        switch ($n) {
            case 0:
                $day = "po";
                break;
            case 1:
                $day = "ut";
                break;
            case 2:
                $day = "st";
                break;
            case 3:
                $day = "ct";
                break;
            case 4:
                $day = "pa";
                break;
            case 5:
                $day = "so";
                break;
            case 6:
                $day = "ne";
                break;
        }
        return $day;
    }

    public function get_dayNum($day)
    {
        switch ($day) {
            case "po":
                $n = 0;
                break;
            case "ut":
                $n = 1;
                break;
            case "st":
                $n = 2;
                break;
            case "ct":
                $n = 3;
                break;
            case "pa":
                $n = 4;
                break;
            case "so":
                $n = 5;
                break;
            case "ne":
                $n = 6;
                break;
        }
        return $n;
    }

    private function getTable($weekRange, $reserved)
    {
        $actions = new Actions();
        for ($n = 0; $n <= 6; $n++):
            $day = $actions->get_day($n);
            $todayNumber = date("N") - 1;
            $today = date("Y-m-d");


            ?>
            <div class="row justify-content-center small-text align-items-center mb-2">
                <div class="col normal-text">
                    <?php
                    if ($todayNumber == $n && $today >= $weekRange["m"] && $today <= $weekRange["s"]) {
                        ?>
                        <span class="text-success">DNES</span>
                        <?php
                    } else {
                        echo strtoupper($day);
                    } ?>
                </div>
                <?php
                if ($today >= $weekRange["m"] && $today <= $weekRange["s"]) {
                    $todayNum = date('N') - 1;
                }
                for ($i = 9; $i <= 21; $i++): ?>
                    <div class="col reservation rounded-2 mx-1 <?php if (!empty($reserved)) {
                        $actions->isFull($i, $day, $reserved);
                    }
                    if (!empty($todayNum)) {
                        if ($todayNum > $n) {
                            echo ' bg-dark full ';
                        } else if ($todayNum == $n && date('H') > $i + 1) {
                            echo ' bg-dark full ';
                        }
                        echo date('H') . ' ';
                        echo $i + 2;
                    }
                    ?>" id="<?php echo $day . $i; ?>" title="<?php $actions->getTitle($i, $day, $reserved); ?>"></div>
                <?php endfor; ?>
            </div>
        <?php endfor;
    }

    private function isFull($n, $day, $reserved)
    {
        foreach ($reserved as $res) {
            if ($n == "9") {
                $n = "09";
            }
            if ($res->day === $day && $res->time === $n . ":00:00") {
                if ($res->user_id == $_SESSION['iduser']) {
                    echo ' bg-success full ';
                } else if ($res->user_id != $_SESSION['iduser']) {
                    echo ' bg-danger full ';
                }
            }
        }
    }

    private function getTitle($n, $day, $reserved)
    {
        $title = strtoupper($day) . " " . $n . ":00";
        foreach ($reserved as $res) {
            if ($res->day === $day && $res->time === $n . ":00:00") {
                if (isset($_SESSION['admin'])) {
                    $title = $res->name . " | " . strtoupper($day) . " " . $n . ":00";
                }
            }
        }
        echo $title;
    }

    public function getTodayReservations()
    {
        require_once __DIR__ . '../../classes/Reservation.php';
        $reservation = new Reservation();
        $reservations = $reservation->getTodayReservations();
        foreach ($reservations as $res): ?>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $res->reservation_id; ?></th>
                    <td><?php echo $res->field; ?></td>
                    <td><?php echo $res->sport; ?></td>
                    <td><?php echo $res->user; ?></td>
                    <td><?php echo $res->time; ?></td>
                    <td><?php echo $res->price; ?></td>
                </tr>
            </tbody>
        <?php endforeach;
    }

    public function getLastTen($reservations)
    {
        require_once __DIR__ . '../../config.php';
        foreach ($reservations as $res): ?>
            <tbody>
                <tr>
                    <th scope="row" class="next-id"><?php echo $res->reservation_id; ?></th>
                    <td><?php echo $res->field; ?></td>
                    <td><?php echo $res->sport; ?></td>
                    <td><?php echo $res->user; ?></td>
                    <td><?php echo date("d.m.y", strtotime($res->date)); ?></td>
                    <td><?php echo $res->time; ?></td>
                    <td><?php echo $res->price; ?></td>
                    <td><a href="includes/reservation/cancel.php?idRes=<?php echo $res->reservation_id; ?>">Smazat</a></td>
                </tr>
            </tbody>
            <?php
        endforeach;
    }


    public function getCalendar($date)
    {
        $actions = new Actions();
        $weekRange = $actions->getWeekRange($date);
        $monday = $weekRange["monday"];
        $sunday = $weekRange["sunday"];
        $m = $weekRange["m"];
        require_once __DIR__ . '../../config.php';
        require_once __DIR__ . '../../classes/Reservation.php';
        $reservation = new Reservation();
        $reserved = $reservation->getReserved($weekRange["m"], $weekRange["s"], $_SESSION['idfield']);
        $previous = (new DateTime($weekRange["m"] . ' -7 days'))->format('Y-m-d');
        $next = (new DateTime($weekRange["m"] . ' +7 days'))->format('Y-m-d');
        $thisWeekMonday = (new DateTime('monday this week'))->format('Y-m-d');
        $sunday_next_next_week = ((new DateTime('sunday this week'))->modify('+14 days'))->format('Y-m-d');
        if (isset($_SESSION['admin'])) {
            require_once "../includes/reservation/calendarBody.php";

        } else {
            require_once "../../includes/reservation/calendarBody.php";
        }
    }

    public function getNewReservations()
    {
        require_once __DIR__ . '../../config.php';
        require_once BASE_PATH . '/classes/Field.php';
        require_once BASE_PATH . '/db/db.class.php';
        $db = new db();
        $field = new Field();
        $fields = $field->getFields();
        foreach ($fields as $f): ?>
            <?php $sports = $db->getFieldSports($f->field_id);
            $sports_names = array_map(function ($s) {
                return $s->name;
            }, $sports);
            ?>
            <div class="col p-3 bg-picture rounded-2" id="h<?php echo $f->field_id; ?>">
                <img src="./imgs/<?php echo $f->img; ?>" alt="hala" class="bg-image rounded-2">
                <div class="overlay rounded-2"></div>
                <div class="row abs">
                    <div class="col-12 text-end">
                        <h4 class="m-0"><?php echo $f->name; ?></h4>
                        <p class="mb-2"><?php echo implode(", ", $sports_names); ?></p>
                        <?php if (isset($_SESSION['admin'])) { ?>
                            <a href="./admin/field.php?idfield=<?php echo $f->field_id; ?>" class="btn btn-success">Přejít</a>
                        <?php } else { ?>
                            <a href="./u/reservation?idfield=<?php echo $f->field_id; ?>" class="btn btn-success">Zarezervovat</a>
                        <?php } ?>
                    </div>
                </div>

            </div>
        <?php endforeach;
    }


    public function getMyReservations()
    {
        require_once __DIR__ . '../../config.php';
        include BASE_PATH . '/includes/incl.php';
        $reservations = $reservation->getMyReservations($_SESSION['iduser']);
        $actions->getReservationsBody($reservations);
    }

    public function sortArray($array)
    {
        $objectArray = array_map(function ($item) {
            $day = substr($item, 0, 2);
            $time = substr($item, 2);
            return (object) array(
                "day" => $day,
                "time" => $time
            );
        }, $array);

        return $objectArray;
    }

    public function correctDates($array, $monday)
    {
        foreach ($array as $element) {
            $actions = new Actions();
            $num = $actions->get_dayNum($element->day);
            $element->date = date('Y-m-d', strtotime($monday . ' + ' . $num . ' days'));
            $element->time = $element->time . ":00:00";
        }
        return $array;
    }

    public function getCheckoutReservations($reservations)
    {
        $string = "";
        foreach ($reservations as $res): ?>
            <?php
            $date = (new DateTime($res->date))->format('d.m.');
            $time = (new DateTime($res->time))->format('H');


            $string = $string . '<div class="col-12 p-0 mb-2 border-bottom">
                <h3>' . $res->sport_name . '</h3>
                <div class="row">
                    <div class="col-6">
                        <p>' . $date . ' ' . $time . ':00 - ' . $time . ':55, ' . $res->field_name . '</p>
                    </div>
                    <div class="col-6 text-end">
                        <p>' . $res->price . ' Kč</p>
                    </div>
                </div>
            </div>';
        endforeach;
        return $string;
    }

    public function sendCheckout($html)
    {
        $to = $_SESSION['email'];

        $subject = 'Tvoje rezervace v MOJE HALA';

        $message = $html;

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


        if (mail($to, $subject, $message, $headers)) {
            echo 'Email byl úspěšně odeslán.';
        } else {
            echo 'Chyba při odesílání emailu.';
        }
    }

    public function getTotalPrice($ids)
    {
        $price = $_SESSION['price'];
        return $price * count($ids);
    }

    public function getReservationsBody($reservations)
    {
        if (empty($reservations)) {
            ?>
            <p class="p-0 text-danger">Momentálně nemáš žádné aktivní rezervace.</p>
            <?php
        } else {
            foreach ($reservations as $res): ?>
                <?php
                $date = (new DateTime($res->date))->format('d.m.');
                $time = (new DateTime($res->time))->format('H');
                ?>
                <div class="col-3 bg-grey rounded-2 mb-3">
                    <div class="row p-3">
                        <div class="col-6 p-0">
                            <h4><?php echo $res->sport_name; ?></h4>
                        </div>
                        <div class="col-6 text-end p-0"><button class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#delete<?php echo $res->reservation_id; ?>">Zrušit</button></div>
                        <div class="col p-0">
                            <p class="m-0"><?php echo $date . " " . $time . ":00 - " . $time . ":55, " . $res->field_name; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="delete<?php echo $res->reservation_id; ?>" tabindex="-1" aria-labelledby="deleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="deleteModalLabel">Opravdu chcete zrušit rezervaci
                                    <?php echo $res->sport_name; ?>?
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>(<?php echo $date . " " . $time . ":00 - " . $time . ":55, " . $res->field_name; ?>)</p>
                                <p>Toto zrušení je bezplatné. Kdykoliv si můžete termín znovu zarezervovat.</p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Ne</button>
                                <a type="button" href="../sem/includes/reservation/cancel.php?idRes=<?php echo $res->reservation_id; ?>"
                                    class="btn btn-danger">Ano, zrušit</a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach;
        }
    }
}
