<?php


namespace Todo;


use PDO;

class TodoModel
{
    public $dbh;

    public function __construct()
    {
        $this->dbh = new PDO('mysql:host=localhost;dbname=todo', 'admin', 'admin');
    }

    private function query(string $sql,array $params = [],bool $all = false)
    {
        // Подготовка запроса
        $stmt = $this->dbh->prepare($sql);
            // Выполняя запрос
        $stmt->execute($params);
            // Возвращаем ответ
        if (!$all){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
    }

    public function getAllWorks()
    {
        $sql ='SELECT * from worklist';
        $worklist = $this->query( $sql);
        return $worklist;
    }

    public function getWorkByid(int $id)
    {
        $sql = "SELECT * FROM worklist  WHERE id = :id ;";
        $params = [
            ':id' => $id
        ];
        $singleWork = $this->query( $sql, $params,'false');
        return $singleWork;
    }

    public function addNewWork(string $newWork)
    {
        $sql = "INSERT INTO worklist (work_name) VALUES (:name);";
        $params = [':name' => $newWork];
        $this->query( $sql, $params);
    }

    public function updateWork(int $id, string $work)
    {
        $sql = "UPDATE worklist SET  work_name = :work  WHERE id = :id ;";
        $params = [
            ':work' => $work,
            ':id' => $id,
        ];
        $this->query( $sql, $params);
    }

    public function changeStatus($work)
    {
        if ($work['work_status'] == 0) {
            $status =1;
        }else{
            $status =0;
        }
        $sql = "UPDATE worklist SET  work_status = :status  WHERE id = :id ;";
        $params = [
            ':status' => $status,
            ':id' => $work['id'],
        ];
        $this->query( $sql, $params);
    }

    public function delWork(int $id)
    {
        $sql = "DELETE FROM worklist WHERE id = :id";
        $params = [':id' => $id];
        $this->query( $sql, $params);
    }
}