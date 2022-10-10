<?php
function connectDB(){
     static $dbh;
     $dbh = new PDO('mysql:host=localhost;dbname=todo', 'admin', 'admin');
    return $dbh;
}
function showForm(string $action, string $title, string $value =''){
     $form = <<< EOL
        <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">$title</h4>
                        <form action="$action" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="work" value="$value">
                            </div>
                            <button type="submit" name="btnWork" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
    EOL;
   return $form;
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
        $html .= <<<EOT
            <li class="list-group-item ">
                {$row['work_name']} 
                <a href="to_complete.php?id={$row['id']}"class="btn btn-outline-success btn-sm ml-5">
                    <span><i class="fas fa-check-circle "></i></span>
                </a>
                <a href="edit.php?id={$row['id']}" class="btn  btn-outline-primary btn-sm">
                    <i class="fas fa-pen"></i>
                </a>
                <a href="del.php?id={$row['id']}" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </li>
EOT;
    };
    return $html;
}

function showWorkList(){
    echo  generateHtmlWorkList( getAllWorks());
}