<?php
    include('db.php');
    if (isset($_GET['id'])) {
        $lessonId = $_GET['id'];
        $lesson_q = $db->prepare('SELECT lesson.id as "lesson_id", lesson.name as "lesson_name", series.name as "series_name", class.name as "class_name", series.id as "series_id", team.alias FROM lesson JOIN series ON series.id=lesson.series_id JOIN class ON class.id=lesson.class_id JOIN team ON team.id=class.team_id WHERE lesson.id=?');
        $lesson_q->execute(array($lessonId));
        $lesson = $lesson_q->fetch(PDO::FETCH_OBJ);

        $section_q = $db->prepare('SELECT id, name, header FROM section WHERE section.lesson_id=? ORDER BY display_order ASC');
        $item_q = $db->prepare("SELECT icon.image, item.header, item.body, item.type, item.description, item.tip, item.tipphrase FROM item JOIN icon ON icon.id=item.icon_id where item.section_id=? ORDER BY display_order ASC");
        
        $section_q->execute(array($lesson->lesson_id));
        $sections = $section_q->fetchAll(PDO::FETCH_OBJ);
        
        $classAlias = $lesson->alias;
        include('includes/header.php');
        echo '<div class="row">
        <div class="small-12 columns">
            <p><img src="images/series' . $lesson->series_id . '.jpg"></p>
        </div>';
        foreach ($sections as $section) {
        echo '<section>
            <div class="small-12 columns section-header">
                <div><h4 class="text-center txt-' . $lesson->alias . '">' . $section->header . '</h4></div>
                    <div class="section-header-inner text-center bg-' . $lesson->alias . '">' . $section->name . '</div>
            </div>';
            $item_q->execute(array($section->id));
            foreach ($item_q->fetchAll(PDO::FETCH_OBJ) as $item) {
               
                echo '<div class="small-12 columns"><div class="row">
                    <div><p class=description>' . $item->description . '</p></div>
                        <div class="small-2 medium-1 columns icon-column"><img src="/images/' . $item->image . '"></div>';
                if ($item->type == 2) {
                          echo '<div class="small-10 medium-11 columns">
                            <p><span class="txt-' . $lesson->alias . '">' . $item->header . ': </span>' . $item->body . '</p>
                            <p><span class="description">' . $item->tip . ' </span>' . $item->tipphrase . '</p>
                        </div>
                    </div></div>';   
                } else {
                     echo '<div class="small-10 medium-11 columns">
                            <h4 class="txt-' . $lesson->alias . '">' . $item->header . '</h4>
                            <p>' . $item->body . '</p>
                        </div>
                    </div></div>';
                  
                }
            }
            echo "</section><p> </p>";
        }
        echo '</div>';
        include('includes/footer.php');
    } else {
        header('Location: /');
    }
?>