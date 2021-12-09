<?php

require_once 'Database.php';

$database = new Database();
?>

<select onchange="select_options()">
    <option value="new_user">Новый пользователь</option>
    <?php
        $users = $database->query('SELECT * FROM users');
        while ($user = mysqli_fetch_assoc($users)) {
            echo '<option value="' . $user['access_token'] . '">' . $user['user_name'] . '</option>';
        }
    ?>
</select>
<br>
<br>
<div id="user_options">
    <input value="Пользователь" onchange="document.querySelector('#login').setAttribute('href', 'https://accounts.google.com/o/oauth2/v2/auth?scope=https%3A//www.googleapis.com/auth/drive&amp;access_type=offline&amp;include_granted_scopes=true&amp;response_type=code&amp;redirect_uri=http://localhost/googleLogin.php&amp;client_id=863746956179-ag8sa55jtnfsmbdepf58842qs6i22218.apps.googleusercontent.com&amp;state=' + this.value)">
    <a id="login" href="https://accounts.google.com/o/oauth2/v2/auth?scope=https%3A//www.googleapis.com/auth/drive&amp;access_type=offline&amp;include_granted_scopes=true&amp;response_type=code&amp;redirect_uri=http://localhost/googleLogin.php&amp;client_id=863746956179-ag8sa55jtnfsmbdepf58842qs6i22218.apps.googleusercontent.com&amp;state=Пользователь">logIn</a>
</div>

<script>
    select_options = function() {
        var select = document.querySelector('select');
        var user_options = document.querySelector('#user_options');
        if (select.value == 'new_user') {
            var href = 'https://accounts.google.com/o/oauth2/v2/auth?scope=https%3A//www.googleapis.com/auth/drive&access_type=offline&include_granted_scopes=true&response_type=code&redirect_uri=http://localhost/googleLogin.php&client_id=863746956179-ag8sa55jtnfsmbdepf58842qs6i22218.apps.googleusercontent.com&state=';
            user_options.innerHTML = '<input value="Пользователь" onchange="document.querySelector(\'#login\').setAttribute(\'href\', \'' + href + '\' + this.value)">\
                <a id="login" href="' + href + 'Пользователь">logIn</a>';
        } else {
            user_options.innerHTML = '<a href="googleLogout.php?token=' + select.value + '">logOut</a>';
        }
    }
</script>