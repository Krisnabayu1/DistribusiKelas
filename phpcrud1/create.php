<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

$stmt = $pdo->prepare('SELECT nama_subject FROM subject');
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt1 = $pdo->prepare('SELECT sesi_jam FROM jam ');
$stmt1->execute();
$contactss = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $pdo->prepare('SELECT nama_ruangan FROM ruangan ');
$stmt2->execute();
$contactsss = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$stmt3 = $pdo->prepare('SELECT tutor FROM tutor ');
$stmt3->execute();
$contactssss = $stmt3->fetchAll(PDO::FETCH_ASSOC);



// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != '' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nama = isset($_POST['nama_subject']) ? $_POST['nama_subject'] : '';

    $jam = isset($_POST['sesi_jam']) ? $_POST['sesi_jam'] : '';
    $nama_ruangan = isset($_POST['nama_ruangan']) ? $_POST['nama_ruangan'] : '';
    $tutor = isset($_POST['tutor']) ? $_POST['tutor'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO kloter VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nama, $jam, $nama_ruangan, $tutor]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Kloter</h2>
    <form action="create.php" method="post">

    
        <label for="id">ID Kloter</label>
        <input type="text" name="id" value="auto" id="id" autocomplete="off">


        <label for="nama">NAMA KLOTER</label>
        <select type="option" name="nama_subject" id="nama" required>
            <option>
                <?php foreach ($contacts as $contact) : ?>
            <option><?= $contact['nama_subject'] ?></option>
          
        <?php endforeach; ?>
        </option>
      
      
        <label for="kl">ID Kloter</label>
        <input type="text" name="kl" value="" id="kl">

        <label for="jam"> JAM </label>
        <select type="option" name="sesi_jam" id="jam" required>
            <option>
                <?php foreach ($contactss as $contac) : ?>
            <option><?= $contac['sesi_jam'] ?></option>
          
        <?php endforeach; ?>
        </option>


        <label for="kl">ID Kloter</label>
        <input type="text" name="kl" value="" id="kl">

        <label for="nama_ruangan"> RUANGAN </label>
        <select type="option" name="nama_ruangan" id="nama_ruangan" required>
            <option>
                <?php foreach ($contactsss as $conta) : ?>
            <option><?= $conta['nama_ruangan'] ?></option>
          
        <?php endforeach; ?>
        </option>

        <label for="kl">ID Kloter</label>
        <input type="text" name="kl" value="" id="kl">

        <label for="tutor"> TUTOR </label>
        <select type="option" name="tutor" id="tutor" required>
            <option>
                <?php foreach ($contactssss as $conta) : ?>
            <option><?= $conta['tutor'] ?></option>
          
        <?php endforeach; ?>
        </option>

        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
