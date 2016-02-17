<?php
    include('db.php');
    if (isset($_GET['id'])) {
        $sectionId = ($_GET['id']);
        $section_q = $db->prepare("SELECT id, lesson_id, name FROM section WHERE id=? ORDER BY display_order ASC LIMIT 1")
        $section_q->execute(array($sectionId));
        
        $sectionconnect = $db->prepare("SELECT * FROM section JOIN item ON section.id=item.section_id WHERE item.section_id=?");
    
    /*  $_q = $db->prepare("SELECT * FROM lesson JOIN series ON series.id=lesson.series_id
WHERE lesson.class_id=?");
    $_q->execute(array($classId); */
           