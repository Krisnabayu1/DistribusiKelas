<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 20;


// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
if (isset($_GET['nama'])) {
    $nama = $_GET['nama'];
} else {
    exit('No ID specified!');
}


$stmt = $pdo->prepare("SELECT * FROM kloter join member on kloter.nama = member.id_kloter 
WHERE id_kloter='$nama' LIMIT  :current_page, :record_per_page");
$stmt1 = $pdo->prepare("SELECT * FROM kloter  LIMIT  :current_page, :record_per_page");
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

$stmt1->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt1->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt1->execute();

$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
$_GET = $stmt1->fetchAll(PDO::FETCH_ASSOC);
$contacts1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);




// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM member ')->fetchColumn();
?>


<?= template_header('Read') ?>

<div class="content read">

    <h4 style="text-align: center;"> Nama Tutor = <?= $contacts1["tutor"]; ?> </h4>
    <h4 style="text-align: center;"> Kelas = <?= $_GET["kelas"]; ?> </h4>
    <h4 style="text-align: center;"> Jam = <?= $_GET["jam"]; ?> </h4>
    <a href="create.member.php" class="create-contact">Tambah Member</a>
    <table>
        <thead>
            <tr>
                <td>No</td>
                <td>ID Member</td>
                <td>Nama </td>
                <td>Subject</td>
                <td>No Telpon</td>
                <td> Action</td>


            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($contacts as $contact) : ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $contact['id_member'] ?></td>
                    <td><?= $contact['nama'] ?></td>
                    <td><?= $contact['id_kloter'] ?></td>
                    <td><?= $contact['notelp'] ?></td>
                    <td class="actions">
                        <a href="updatemember.php?id_member=<?= $contact['id_member'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="deletemember.php?id_member=<?= $contact['id_member'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>

                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="View.member.kloter.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_contacts) : ?>
            <a href="View.member.kloter.php?nama=<?= $page + 1 ?><?= $nama ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>

<?= template_footer() ?>