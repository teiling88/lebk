<?php declare(strict_types=1);

use SwagLebk\Entity\WeeklyReportEntity;

require_once __DIR__.'/autoload.php';

$entity = new WeeklyReportEntity();
$entity->id = 1;

$weeklyReports = $repository->read();
?>

<?php require_once __DIR__ . '/templates/head.html' ?>

<div class="container">
    <h1><a href="index.php">Weekly Reports</a></h1>
    <div class="row">
        <div class="col-sm">
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Weeknumber</th>
                    <th scope="col">Positive</th>
                    <th scope="col">Negative</th>
                    <th scope="col">Learned</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($weeklyReports as $report): ?>
                    <tr>
                        <td><?= $report->id ?></td>
                        <td><?= $report->weeknumber ?></td>
                        <td><?= $report->positive ?></td>
                        <td><?= $report->negative ?></td>
                        <td><?= $report->learned ?></td>
                        <td>
                            <a href="edit.php?id=<?= $report->id ?>">
                                <img src="templates/edit.svg" alt="delete"/>
                            </a>
                            <a href="delete.php?id=<?= $report->id ?>">
                                <img src="templates/delete.svg" alt="delete"/>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <a class="btn btn-primary" href="create.php" role="button">Create new Report</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/templates/footer.html' ?>
