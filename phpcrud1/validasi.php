<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $jam = isset($_POST['jam']) ? $_POST['jam'] : '';
        $Kelas = isset($_POST['Kelas']) ? $_POST['Kelas'] : '';
        $pekerjaan = isset($_POST['tutor']) ? $_POST['tutor'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE kontak SET id = ?, nama = ?, jam = ?, Kelas = ?, tutor = ? WHERE id = ?');
        $stmt->execute([$id, $nama, $jam, $Kelas, $pekerjaan, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM kontak WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?= template_header('Read') ?>

<div class="content update">
    <h2>Update Contact #<?= $contact['id'] ?></h2>
    <form action="jadwal.php?id=<?= $contact['id'] ?>" method="post">
        <label for="id">ID</label>
        <label for="nama">Nama</label>
        <input type="text" name="id" value="<?= $contact['id'] ?>" id="id">
        <input type="text" name="nama" value="<?= $contact['nama'] ?>" id="nama">
        <label for="jam">Jam</label>
        <label for="notelp">Ruangan</label>
        <input type="text" name="jam" value="<?= $contact['jam'] ?>" id="jam">
        <input type="text" name="Kelas" value="<?= $contact['Kelas'] ?>" id="Kelas">
        <label for="pekerjaan">Tutor</label>
        <input type="text" name="tutor" value="<?= $contact['tutor'] ?>" id="tutor">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>