<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 10;


// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM member ORDER BY nama LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM member   ')->fetchColumn();
?>


<?= template_header('Read') ?>

<div class="content read">
    <h2>Jumlah Member : <?= $num_contacts ?></h2>
    <a href="create.member.php" class="create-contact">Tambah Member</a>
    <table>
        <thead>
            <tr>
                <td>ID Member</td>
                <td>Nama </td>
                <td>Subject</td>
                <td>No Telpon</td>
                <td> Alamat</td>
                <td> Action</td>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact) : ?>
                <tr>
                    <td><?= $contact['id_member'] ?></td>
                    <td><?= $contact['nama'] ?></td>
                    <td><?= $contact['id_kloter'] ?></td>
                    <td><?= $contact['notelp'] ?></td>
                    <td><?= $contact['alamat'] ?></td>
                    <td class="actions">
                        <a href="updatemember.php?id_member=<?= $contact['id_member'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="deletemember.php?id_member=<?= $contact['id_member'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="member.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_contacts) : ?>
            <a href="member.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>

<?= template_footer() ?>