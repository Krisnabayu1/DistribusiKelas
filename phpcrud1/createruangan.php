<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id_ruangan = isset($_POST['id_ruangan']) && !empty($_POST['id_ruangan']) && $_POST['id_ruangan'] != 'auto' ? $_POST['id_ruangan'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nama_ruangan = isset($_POST['nama_ruangan']) ? $_POST['nama_ruangan'] : '';


    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO ruangan VALUES (?, ?)');
    $stmt->execute([$id_ruangan, $nama_ruangan]);
    // Output message
    $msg = 'Created New Class Successfully!';
}
?>


<?= template_header('Create') ?>

<div class="content update">
    <h2>Create Ruangan</h2>
    <form action="createruangan.php" method="post">
        <label for="id_ruangan">ID Ruangan</label>
        <label for="nama_ruangan">Nama Ruangan</label>
        <input type="text" name="id_ruangan" id="id_ruangan" autocomplete="off" autofocus>
        <input type="text" name="nama_ruangan" id="nama_ruangan">



        <input type="submit" value="Create">
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>