<?php
function getAllWorks(){
    $dbh = new PDO('mysql:host=localhost;dbname=todo', 'admin', 'admin');
    $worklist = $dbh->query('SELECT * from worklist')
        ->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    return $worklist;
}
function generateHtmlWorkList(array $worklist){
    $html = '';
    foreach ($worklist as $row) {
        $html .= '<li class="list-group-item">' . $row['work_name'] . '
    <a href="delete.php" style="color: red"><i class="fas fa-trash-alt"></i>
</a>
    <a href="to_complete.php" style="color: #44ff00"><i class="fas fa-check-circle"></i></a>
    </li>';
    };
    return $html;
}

function showWorkList(){
    echo  generateHtmlWorkList( getAllWorks());
}