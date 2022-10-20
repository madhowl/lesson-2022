<?php


namespace Todo;


use PDO;

/**
 * Class TodoModel
 * @package Todo
 */
class TodoModel
{
    /**
     * @var PDO
     */
    protected PDO $dbh;

    /**
     * TodoModel constructor.
     */
    public function __construct()
    {
        $this->dbh = new PDO('mysql:host=localhost;dbname=todo', 'admin', 'admin');
    }

    /**
     * @param string $sql
     * @param array $params
     * @param bool $all
     * @return mixed
     */
    private function query(string $sql, array $params = [], bool $all = false): mixed
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

    /**
     * @return mixed
     */
    public function getAllWorks(): mixed
    {
        $sql ='SELECT * from worklist';
        return $this->query( $sql);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getWorkByid(int $id): mixed
    {
        $sql = "SELECT * FROM worklist  WHERE id = :id ;";
        $params = [
            ':id' => $id
        ];
        return $this->query( $sql, $params,'false');
    }

    /**
     * @param string $newWork
     */
    public function addNewWork(string $newWork)
    {
        $sql = "INSERT INTO worklist (work_name) VALUES (:name);";
        $params = [':name' => $newWork];
        $this->query( $sql, $params);
    }

    /**
     * @param int $id
     * @param string $work
     */
    public function updateWork(int $id, string $work)
    {
        $sql = "UPDATE worklist SET  work_name = :work  WHERE id = :id ;";
        $params = [
            ':work' => $work,
            ':id' => $id,
        ];
        $this->query( $sql, $params);
    }

    /**
     * @param $work
     */
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
            ':id' =>(int) $work['id'],
        ];
        $this->query( $sql, $params);
    }

    /**
     * @param int $id
     */
    public function delWork(int $id)
    {
        $sql = "DELETE FROM worklist WHERE id = :id";
        $params = [':id' => $id];
        $this->query( $sql, $params);
    }
}