<?php declare(strict_types=1);

use SwagLebk\Entity\WeeklyReportEntity;

require_once __DIR__.'/autoload.php';

$message = '';

if (isset($_POST['submit'])) {
    $entity = new WeeklyReportEntity();
    foreach ($_POST as $key => $value) {
        if (property_exists(WeeklyReportEntity::class, $key)) {
            if ($key === 'weeknumber') {
                $value = (int) $value;
            }
            $entity->{$key} = $value;
        }
    }

    $result = $repository->create($entity);
    if ($result) {
        $message = '<div class="alert alert-success" role="alert">
                        Weekly Report created successfully!
                    </div>';
    } else {
        $message = '<div class="alert alert-primary" role="alert">
                        The Weekly Report cannot be created! 
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
            <form method="post" action="create.php">
                <div class="form-group row">
                    <label for="weeknumber" class="col-sm-2 col-form-label">Weeknumber</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="weeknumber" id="weeknumber"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="positive" class="col-sm-2 col-form-label">Positive</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="positive" name="positive"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="negative" class="col-sm-2 col-form-label">Negative</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="negative" name="negative"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="learned" class="col-sm-2 col-form-label">Learned</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="learned" name="learned"></textarea>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/templates/footer.html' ?>
