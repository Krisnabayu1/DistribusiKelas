<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id_subject = isset($_POST['id_subject']) && !empty($_POST['id_subject']) && $_POST['id_subject'] != 'auto' ? $_POST['id_subject'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nama_subject = isset($_POST['nama_subject']) ? $_POST['nama_subject'] : '';


    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO subject VALUES (?, ?)');
    $stmt->execute([$id_subject, $nama_subject]);
    // Output message
    $msg = 'Created New Subject Successfully!';
}
?>


<?= template_header('Create') ?>

<div class="content update">
    <h2>Tambah Subject</h2>
    <form action="create.subject.php" method="post">
        <label for="id_subject">ID Subject</label>
        <label for="nama_subject">Nama Subject</label>
        <input type="text" name="id_subject" value="" id="id_subject">
        <input type="text" name="nama_subject" id="nama_subject" required>



        <input type="submit" value="Create">
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>