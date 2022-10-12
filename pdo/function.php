<?php
function connectDB(){
     static $dbh;
     $dbh = new PDO('mysql:host=localhost;dbname=todo', 'admin', 'admin');
    return $dbh;
}
function showForm(string $action, string $title, string $value ='',array $hidden=[]){
     $form = <<< EOL
        <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">$title</h4>
                        <form action="$action" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="work" value="$value">
                            </div>
        EOL;
     if(!empty($hidden)){
         foreach ($hidden as $key => $value ){
             $form .= <<< EOO
    <input type="hidden" class="form-control" name="$key" value="$value">
EOO;
         }


     }
     $form .= <<< EOM
     
                            <button type="submit" name="btnWork" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
 EOM;

   return $form;
}
function getAllWorks(){
    $dbh = connectDB();
    $worklist = $dbh->query('SELECT * from worklist')
        ->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    return $worklist;
}

function getWorkByid(int $id){
    $dbh = connectDB();
    $query = "SELECT * FROM worklist  WHERE id = :id ;";
    $params = [
        ':id' => $id
    ];
    $stmt = $dbh->prepare($query);
    $stmt->execute($params);
    $singleWork = $stmt->fetch(PDO::FETCH_ASSOC);
    $dbh = null;
    return $singleWork;
}

function addNewWork(string $newWork){
        $dbh = connectDB();
        $query = "INSERT INTO worklist (work_name) VALUES (:name);";
        $params = [':name' => $newWork];
        $stmt = $dbh->prepare($query);
        $stmt->execute($params);
        $dbh = null;
        header("Location: index.php");
        die();

}
function updateWork(int $id, string $work){
        $dbh = connectDB();
        $query = "UPDATE worklist SET  work_name = :work  WHERE id = :id ;";
        $params = [
            ':work' => $work,
            ':id' => $id,
            ];
        $stmt = $dbh->prepare($query);
        $stmt->execute($params);
        $dbh = null;
        header("Location: index.php");

}

function delWork(int $id){
    $dbh = connectDB();
    $query = "DELETE FROM worklist WHERE id = :id";
    $params = [':id' => $id];
    $stmt = $dbh->prepare($query);
    $stmt->execute($params);
    $dbh = null;
    header("Location: index.php");
    die();
}

function changeStatus($work){


    $dbh = connectDB();
    if ($work['work_status'] == 0) {
        $status =1;
    }
    if ($work['work_status'] == 1) {
        $status =0;
    }
    $query = "UPDATE worklist SET  work_status = :status  WHERE id = :id ;";
    $params = [
        ':status' => $status,
        ':id' => $work['id'],
    ];
    $stmt = $dbh->prepare($query);
    $stmt->execute($params);
    $dbh = null;
    header("Location: index.php");
};

function generateHtmlWorkList(array $worklist){
    $html = '';
    foreach ($worklist as $row) {
        $html .= '<li class="list-group-item';
        if($row['work_status']==1){
            $html .=' list-group-item-success';
        }
        $html .='">';
        $html .= <<<EOT
            
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