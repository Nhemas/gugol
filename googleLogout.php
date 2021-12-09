<?php

require_once 'Database.php';

$database = new Database();

if (isset($_GET['token'])) {
    
    $database->query('DELETE FROM users WHERE access_token = "' . $_GET['token'] . '"');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/revoke?token=' . $_GET['token']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_exec($ch);
    curl_close($ch);
}
?>
<script>
    window.location.replace('http://localhost');
</script>