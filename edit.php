<?php declare(strict_types=1);

use SwagLebk\Entity\WeeklyReportEntity;

require_once __DIR__.'/autoload.php';

$message = '';

$reportId = (int) $_GET['id'];

$report = $repository->readById($reportId);

if (isset($_POST['submit'])) {
    foreach ($_POST as $key => $value) {
        if (property_exists(WeeklyReportEntity::class, $key)) {
            if (in_array($key, ['weeknumber', 'id'])) {
                $value = (int) $value;
            }
            $report->{'set' . ucwords($key)}($value);
        }
    }

    $result = $repository->update($report);

    if ($result) {
        $message = '<div class="alert alert-success" role="alert">
                        Weekly Report updated successfully!
                    </div>';
    } else {
        $message = '<div class="alert alert-primary" role="alert">
                        The Weekly Report cannot be updated! 
                    </div>';
    }
}
?>

<?php require_once __DIR__ . '/templates/head.html' ?>

<div class="container">
    <h1><a href="index.php">Weekly Reports</a></h1>
    <?= $message ?>
    <div class="row">
        <div class="col-sm">
            <form method="post" action="edit.php?id=<?= $report->getId() ?>">
                <div class="form-group row">
                    <label for="weeknumber" class="col-sm-2 col-form-label">Weeknumber</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="weeknumber" id="weeknumber"
                               value="<?= $report->getWeeknumber() ?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="positive" class="col-sm-2 col-form-label">Positive</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="positive" name="positive"><?= $report->getPositive() ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="negative" class="col-sm-2 col-form-label">Negative</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="negative" name="negative"><?= $report->getNegative() ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="learned" class="col-sm-2 col-form-label">Learned</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="learned" name="learned"><?= $report->getLearned() ?></textarea>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/templates/footer.html' ?>
