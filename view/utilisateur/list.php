<?php
foreach ($tab_v as $u)
    echo '<p> Utilisateur de login: ' . '<a href="index.php?controller=utilisateur&action=read&login=' . rawurlencode($u->get("login")) . '">' . htmlspecialchars($u->get("login")) . '</a></p>';
?>