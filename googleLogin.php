<?php

require_once 'Database.php';
require_once 'GoogleClient.php';

$database = new Database();
$googleClient = new GoogleClient();

if (isset($_GET['code']) && isset($_GET['state']) && isset($_GET['scope'])) {
    $googleTokens = $googleClient->getTokensByAuthCode($_GET['code']);
    if (isset($googleTokens)) {
        $query = 'INSERT INTO users(
                user_name, 
                access_token, 
                refresh_token, 
                expires_in) 
            VALUES (
                "' . $_GET['state'] . '",
                "' . $googleTokens['access_token'] . '",
                "' . $googleTokens['refresh_token'] . '",
                ' . (time() + $googleTokens['expires_in']) . '
            )';
        $result = $database->query($query);
    }
}
?>
<script>
    window.location.replace('http://localhost');
</script>