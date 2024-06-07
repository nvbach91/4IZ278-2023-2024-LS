<?php
session_start();
require_once __DIR__ . '/db/OrdersDB.php';
require __DIR__ . '/include/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    echo "Nemáte oprávnění přistupovat na tuto stránku.";
    exit();
}

$ordersDB = new OrdersDB();
$currentYear = date('Y');
$currentMonth = date('m');
$selectedYear = isset($_GET['year']) ? $_GET['year'] : $currentYear;
$selectedMonth = isset($_GET['month']) ? $_GET['month'] : $currentMonth;
$earnings = $ordersDB->getMonthlyEarnings($selectedYear, $selectedMonth);
?>

<div class="container mt-5">
    <h2>Statistiky</h2>
    <form method="get" class="mb-4">
        <div class="form-group">
            <label for="year">Vyberte rok:</label>
            <select id="year" name="year" class="form-control">
                <?php for ($year = $currentYear; $year >= 2000; $year--): ?>
                    <option value="<?php echo $year; ?>" <?php echo $year == $selectedYear ? 'selected' : ''; ?>>
                        <?php echo $year; ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="month">Vyberte měsíc:</label>
            <select id="month" name="month" class="form-control">
                <?php for ($month = 1; $month <= 12; $month++): ?>
                    <option value="<?php echo str_pad($month, 2, '0', STR_PAD_LEFT); ?>" <?php echo $month == $selectedMonth ? 'selected' : ''; ?>>
                        <?php echo $month; ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Zobrazit statistiky</button>
    </form>

    <?php if ($earnings): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Rok-Měsíc</th>
                    <th>Obrat (Kč)</th>
                    <th>Počet objednávek</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($earnings as $earning): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($earning['month'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars(number_format($earning['total'], 2), ENT_QUOTES, 'UTF-8'); ?> Kč</td>
                        <td><?php echo htmlspecialchars($earning['order_count'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Žádné statistiky nejsou k dispozici pro vybraný rok a měsíc.</p>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
