<?php 
    include('db.php');
    if (isset($_GET['id'])) {
        $seriesId = $_GET['id']; 
        
        $lesson_q = $db->prepare("SELECT * FROM series JOIN lesson ON series.id=lesson.series_id WHERE lesson.series_id=? AND NOW() BETWEEN start_date AND end_date ORDER BY start_date DESC LIMIT 1");
        $lesson_q->execute(array($seriesId));
        $lesson = $lesson_q->fetch(PDO::FETCH_OBJ);
        header('Location:/lessonplan.php?id=' . $lesson->id);
    }   else {
        header('Location: /');
}
  /* changed <a href="lesson.php?id= to <a href="lessonplan.php*/      
        
?>