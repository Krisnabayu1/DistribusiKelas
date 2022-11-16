<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id_tutor'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM tutor WHERE id_tutor= ?');
    $stmt->execute([$_GET['id_tutor']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Tutor doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM tutor WHERE id_tutor= ?');
            $stmt->execute([$_GET['id_tutor']]);
            $msg = 'You have deleted the tutor!';
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
    <h2>Delete Tutor
        #<?= $contact['id_tutor'] ?></h2>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php else : ?>
        <p>Are you sure you want to delete Tutor #<?= $contact['id_tutor'] ?>?</p>
        <div class="yesno">
            <a href="deletetutor.php?id_tutor=<?= $contact['id_tutor'] ?>&confirm=yes">Yes</a>
            <a href="tutor.php?id_tutor=<?= $contact['id_tutor'] ?>&confirm=no">No</a>
        </div>
    <?php endif; ?>
</div>

<?= template_footer() ?>