<?php 
include 'includes/sessions.php';
include 'includes/header-member.php'; 
?>

<h1>Home</h1>
<p>Current Time:: <?php echo date('m-d-Y H:i:s A'); ?></p>
<p><b>Not logged in:</b> navigation bar shows a link to log in.</p>
<p><b>Logged in:</b> navigation bar shows a link to log out.</p>

<?php include 'includes/footer.php'; ?>