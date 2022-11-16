<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id_tutor = isset($_POST['id_tutor']) && !empty($_POST['id_tutor']) && $_POST['id_tutor'] != 'auto' ? $_POST['id_tutor'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $tutor = isset($_POST['tutor']) ? $_POST['tutor'] : '';


    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO tutor VALUES (?, ?)');
    $stmt->execute([$id_tutor, $tutor]);
    // Output message
    $msg = 'Created New Tutor Successfully!';
}
?>


<?= template_header('Create') ?>

<div class="content update">
    <h2>Create Contact</h2>
    <form action="create.tutor.php" method="post">
        <label for="id_tutor">ID Tutor</label>
        <label for="tutor">Nama Tutor</label>
        <input type="text" name="id_tutor" value="auto" id="id_tutor">
        <input type="text" name="tutor" id="tutor">



        <input type="submit" value="Create">
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>