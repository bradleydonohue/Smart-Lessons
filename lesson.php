<?php 
    include('db.php');
    if (isset($_GET['id'])) {
        $lessonId = $_GET['id'];
        $lesson_q = $db->prepare("SELECT name FROM lesson WHERE id=? ORDER BY series_id ASC LIMIT 1");
        $lesson_q->execute(array($lessonId));
        $lessons = $lesson_q->fetchAll(PDO::FETCH_OBJ);
        foreach ($lessons as $lesson) {
          echo '<div><a href="lessonplan.php?id=' . $lesson->id . '">' . $lesson->name . '</a></div>';
        }
    } else {
        header('location: /');
    }

/* for some reason, there is a weird file path. Everything seems to be working when following index.php to class.php to series.php to lessonplan.php */