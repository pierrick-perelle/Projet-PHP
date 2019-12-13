<?php

foreach ($tab_u as $u)
    echo '<p> Utilisateur de login: ' . '<a href="index.php?controller=utilisateur&action=read&login=' . rawurlencode($u->get("login")) . '">' . htmlspecialchars($u->get("login")) . '</a></p>';
?>