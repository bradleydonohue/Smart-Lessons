<?php
    include('db.php');
    
    $icon_q = $db->prepare('SELECT * FROM item JOIN icon ON icon.id=item.icon_id WHERE item.icon_id=?');
    $icon_q->execute(array(8));
    