<?php 
    include('db.php');
if (isset($_GET['id'])) {
    $teamId = $_GET['id'];
    $team_q = $db->prepare("SELECT id, name, alias FROM team WHERE id=? ORDER BY id ASC LIMIT 1");
    $team_q->execute(array($teamId));
    $team = $team_q->fetch(PDO::FETCH_OBJ);
    
    $classAlias = $team->alias;
    include('includes/header.php');
    $class_q = $db->prepare("SELECT * FROM class WHERE team_id=?");
    $class_q->execute(array($team->id));
    $classes = $class_q->fetchAll(PDO::FETCH_OBJ);
    foreach ($classes as $class){
        echo '<section>
            <div class="small-12 columns section-header">
                <div class="section-header-inner text-center bg-' . $team->alias . '"><a href="class.php?id=' . $class->id . '">' . $class->name . '<br><span class="light-text">LESSON PLAN</span></a></div><p></p>
            </div>';
    }  
} else {
    include('includes/header.php');
    $teams = $db->query("SELECT id, name, alias FROM team");   
    foreach ($teams->fetchAll(PDO::FETCH_OBJ) as $team) {
        echo '<section>
            <div class="small-12 columns section-header">
                <div class="section-header-inner text-center bg-' . $team->alias . '"><a href="index.php?id=' . $team->id . '"><img src="/images/' . $team->alias . '-logo.png"></a></div><p></p>
            </div>';
        //echo '<div><a href="index.php?id=' . $team->id . '">' . $team->name . '</a></div>';
    }
}
    include('includes/footer.php');
?>

<!--<a class="button" href="https://elevationchurch.wufoo.com/forms/xz43r700ec4ovj/">Feedback</a>
