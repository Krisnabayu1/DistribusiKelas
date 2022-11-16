<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 10;


// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM kloter ORDER BY nama LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
$nama = $stmt->fetchAll(PDO::FETCH_ASSOC);



// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
if (isset($_GET['nama'])) {
    $nama = $_GET['nama'];
}
$num_contacts1 = $pdo->query('SELECT COUNT(*) FROM member where id_kloter ="Speaking 1"')->fetchColumn();
$num_contacts2 = $pdo->query('SELECT COUNT(*) FROM kloter ')->fetchColumn();
$num_contacts3 = $pdo->query("SELECT COUNT(id_kloter) FROM member join kloter on  member.id_kloter = kloter.nama 
WHERE  id_kloter = kloter.nama  group by id_kloter  ")->fetchColumn();

?>


<?= template_header('Read') ?>


<div class="content read">
    <h2> Jumlah Kloter : <?= $num_contacts2 ?></h2>
    <a href="create.php" class="create-contact">Tambah Kloter</a>

    <table>
        <thead>
            <tr>
                <td>ID Kloter</td>
                <td>Nama Kloter</td>
                <td>Jam</td>
                <td>Ruangan </td>
                <td>Tutor</td>
                <td> Jumlah Member</td>
                <td> Action</td>

            </tr>
        </thead>
        <tbody>
            <?php
            if ($num_contacts3 < 5) {
                $status = 'Pending';
            } else {
                $status = 'Buka';
            }

            ?>
            <?php foreach ($contacts as $contact) : ?>
                <tr>
                    <td><?= $contact['id']; ?></td>
                    <td><?= $contact['nama']; ?></td>
                    <td><?= $contact['jam']; ?></td>
                    <td><?= $contact['Kelas']; ?></td>
                    <td><?= $contact['tutor']; ?></td>
                    <td> <?= $num_contacts3 ?>/ 20 (<?= $status ?>)</td>

                    <td class="actions">
                        <a href="update.php?id=<?= $contact['id'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="delete.php?id=<?= $contact['id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                        <a href="View.member.kloter.php?nama=<?= $contact['nama'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="create.member.php" class="create-contact">Tambah Member</a>
                        <h2></h2>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="kloter.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_contacts2) : ?>
            <a href="kloter.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>

<?= template_footer() ?>