<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
//
$stmt = $pdo->prepare('SELECT nama FROM kloter ');
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id_member = isset($_POST['id_member']) && !empty($_POST['id_member']) && $_POST['id_member'] != 'auto' ? $_POST['id_member'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
  
    $notelp = isset($_POST['notelp']) ? $_POST['notelp'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
    $id_kloter = isset($_POST['id_kloter']) ? $_POST['id_kloter'] : '';
    


    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO member VALUES (?, ?,?, ?, ?)');
    $stmt->execute([$id_member, $nama, $id_kloter, $notelp, $alamat]);
    // Output message
    $msg = 'Created New Member Successfully!';
}
?>


<?= template_header('Create') ?>

<div class="content update">
    <h2>Create Contact</h2>
    <form action="create.member.php" method="post">
        <label for="id_member">ID Member</label>
        <input type="text" name="id_member" value="auto" id="id_member">
        <label for="nama">Nama Member</label>
        <input type="text" name="nama" id="nama" required>
        <label for="notelp">No Telepon</label>
        <input type="text" name="notelp" id="notelp" required>


        <label for="notelp">Alamat</label>
        <input type="text" name="alamat" id="alamat" required>

        <label for="id_kloter">Subject</label>
        <select type="option" name="id_kloter" id="id_kloter" required>
            <option>
                <?php foreach ($contacts as $contact) : ?>
            <option><?= $contact['nama'] ?></option>
          
        <?php endforeach; ?>
        </option>


    </form>

    <br> <input type="submit" value="Create"><br>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>