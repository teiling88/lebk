<?php declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

if (isset($_POST['submit'])) {
    (new \SwagLebk\Database\Setup($connection))->setup();
}

require_once __DIR__ . '/templates/head.html'
?>

<div class="container">
    <h1>Database Setup</h1>
    <div class="row">
        <div class="col-sm">
            <form method="post" action="setup.php">
                <button type="submit" name="submit" class="btn btn-primary">Setup new DB</button>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/templates/footer.html' ?>
