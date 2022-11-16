<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id_member'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM member WHERE id_member= ?');
    $stmt->execute([$_GET['id_member']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('member doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM member WHERE id_member= ?');
            $stmt->execute([$_GET['id_member']]);
            $msg = 'You have deleted the member from kloter!';
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
    <h2>Delete Member
        #<?= $contact['id_member'] ?></h2>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php else : ?>
        <p>Are you sure you want to delete member #<?= $contact['id_member'] ?>?</p>
        <div class="yesno">
            <a href="deletemember.php?id_member=<?= $contact['id_member'] ?>&confirm=yes">Yes</a>
            <a href="kloter.php?id_member=<?= $contact['id_member'] ?>&confirm=no">No</a>
        </div>
    <?php endif; ?>
</div>

<?= template_footer() ?>