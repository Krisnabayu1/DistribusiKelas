<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id_member'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id_member = isset($_POST['id_member']) ? $_POST['id_member'] : NULL;
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $id_kloter = isset($_POST['id_kloter']) ? $_POST['id_kloter'] : '';
        $notelp = isset($_POST['notelp']) ? $_POST['notelp'] : '';
        $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE member SET id_member = ?, nama = ?, id_kloter = ?, notelp = ?, alamat = ? WHERE id_member = ?');
        $stmt->execute([$id_member, $nama, $id_kloter, $notelp, $alamat, $_GET['id_member']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM member WHERE id_member = ?');
    $stmt->execute([$_GET['id_member']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
}
?>



<?= template_header('Read') ?>

<div class="content update">
    <h2>Update Contact #<?= $contact['id_member'] ?></h2>
    <form action="updatemember.php?id_member=<?= $contact['id_member'] ?>" method="post">
        <label for="id_member">ID</label>
        <label for="nama">Nama</label>
        <input type="text" name="id_member" value="<?= $contact['id_member'] ?>" id="id_member">
        <input type="text" name="nama" value="<?= $contact['nama'] ?>" id="nama">
        <label for="id_kloter">Subject</label>
        <label for="notelp">No Telepon</label>
        <input type="text" name="id_kloter" value="<?= $contact['id_kloter'] ?>" id="id_kloter">
        <input type="text" name="notelp" value="<?= $contact['notelp'] ?>" id="notelp">
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" value="<?= $contact['alamat'] ?>" id="alamat">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>