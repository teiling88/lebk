<?php declare(strict_types=1);

require_once __DIR__.'/autoload.php';

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
                        <td><?= $report->getId() ?></td>
                        <td><?= $report->getWeeknumber() ?></td>
                        <td><?= $report->getPositive() ?></td>
                        <td><?= $report->getNegative() ?></td>
                        <td><?= $report->getLearned() ?></td>
                        <td>
                            <a href="edit.php?id=<?= $report->getId() ?>">
                                <img src="templates/edit.svg" alt="delete"/>
                            </a>
                            <a href="delete.php?id=<?= $report->getId() ?>">
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
