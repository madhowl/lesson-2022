<?php
function connectDB(){
     $dbh = new PDO('mysql:host=localhost;dbname=todo', 'admin', 'admin');
    return $dbh;
}

function getAllWorks(){
    $dbh = connectDB();
    $worklist = $dbh->query('SELECT * from worklist')
        ->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    return $worklist;
}

function addNewWork(){
    if (isset($_POST['addWork'])){
        $newWork = $_POST['work'];
        $dbh = connectDB();
        $query = "INSERT INTO worklist (work_name, work_status) VALUES (:name,0);";
        $params = [':name' => $newWork];
        $stmt = $dbh->prepare($query);
        $stmt->execute($params);
        $dbh = null;
        header("Location: index.php");
        die();
    }else{
        header("Location: index.php");
        die();
    };
}

function delWork(int $id){
    $dbh = connectDB();
    $query = "DELETE FROM worklist WHERE ((`id` = :id))";
    $params = [':id' => $id];
    $stmt = $dbh->prepare($query);
    $stmt->execute($params);
    $dbh = null;
    header("Location: index.php");
    die();
}

function generateHtmlWorkList(array $worklist){
    $html = '';
    foreach ($worklist as $row) {
        $html .= '<li class="list-group-item">' . $row['work_name'] . '
    <a href="del.php?id='.$row['id'].'" style="color: red"><i class="fas fa-trash-alt"></i>
</a>
    <a href="to_complete.php" style="color: #44ff00"><i class="fas fa-check-circle"></i></a>
    </li>';
    };
    return $html;
}

function showWorkList(){
    echo  generateHtmlWorkList( getAllWorks());
}