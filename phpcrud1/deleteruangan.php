<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id_ruangan'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM ruangan WHERE id_ruangan= ?');
    $stmt->execute([$_GET['id_ruangan']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Class doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM ruangan WHERE id_ruangan= ?');
            $stmt->execute([$_GET['id_ruangan']]);
            $msg = 'You have deleted the the class!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?= template_header('Delete') ?>

<div class="content delete">
    <h2>Delete Class #<?= $contact['id_ruangan'] ?></h2>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php else : ?>
        <p>Are you sure you want to delete class #<?= $contact['id_ruangan'] ?>?</p>
        <div class="yesno">
            <a href="deleteruangan.php?id_ruangan=<?= $contact['id_ruangan'] ?>&confirm=yes">Yes</a>
            <a href="ruangan.php?id_ruangan=<?= $contact['id_ruangan'] ?>&confirm=no">No</a>
        </div>
    <?php endif; ?>
</div>

<?= template_footer() ?>