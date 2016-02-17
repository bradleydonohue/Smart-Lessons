<?php
    include('db.php');
if (isset($_GET['id'])) {
    $classId = $_GET['id'];
    $class_q = $db->prepare("SELECT id, team_id, name FROM class WHERE id=? ORDER BY id ASC LIMIT 1");
    $class_q->execute(array($classId));
    $class = $class_q->fetch(PDO::FETCH_OBJ);
        
        $lesson_q = $db->prepare("SELECT lesson.id FROM series JOIN lesson ON series.id=lesson.series_id WHERE lesson.class_id=? AND NOW() BETWEEN start_date AND end_date ORDER BY start_date DESC LIMIT 1");
        $lesson_q->execute(array($class->id));
    if ($lesson_q->rowCount() === 1) {
        $lesson = $lesson_q->fetch(PDO::FETCH_OBJ);
        header('Location:/lessonplan.php?id=' . $lesson->id);
    } else {
        header('Location: /');
    }
    /*
    include('includes/header.php');
        echo '<div class="row">
        <div class="small-12 columns">
            <p><img src="images/series' . $lesson->series_id . '.jpg"></p>
        </div>';
    
    $series_q = $db->prepare("SELECT series.name, series.id FROM series JOIN lesson ON series.id=lesson.series_id WHERE lesson.class_id=?");
    $series_q->execute(array($class->id));
    $series = $series_q->fetchAll(PDO::FETCH_OBJ);
    foreach ($series as $serie) {
        echo '<div><a href="series.php?id=' . $serie->id . '">' . $serie->name . '</a></div>';
    }
    include('includes/footer.php');
    */
}  else {
        header('Location: /');
}