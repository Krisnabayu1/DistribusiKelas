<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM subject LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_subjects = $pdo->query('SELECT COUNT(*) FROM subject   ')->fetchColumn();
?>


<?= template_header('Read') ?>

<div class="content read">
    <h2>Jumlah Subject : <?= $num_subjects ?></h2>
    <a href="create.subject.php" class="create-subject">Tambah Subject</a>
    <table>
        <thead>
            <tr>
                <td>ID Subject</td>
                <td>Nama Subject </td>



            </tr>
        </thead>
        <tbody>
            <?php foreach ($subjects as $subject) : ?>
                <tr>
                    <td><?= $subject['id_subject'] ?></td>
                    <td><?= $subject['nama_subject'] ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="subject.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_subjects) : ?>
            <a href="subject.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>

<?= template_footer() ?>