<?php


namespace Todo;


/**
 * Class TodoController
 * @package Todo
 */
class TodoController
{
    /**
     * @var TodoModel
     */
    private TodoModel $todoModel;
    /**
     * @var TodoView
     */
    private TodoView $todoView;

    /**
     * TodoController constructor.
     */
    public function __construct()
    {
        $this->todoModel = new namespace\TodoModel();
        $this->todoView = new namespace\TodoView();
    }

    /**
     *
     */
    public function index()
    {
        $work_list = $this->todoModel->getAllWorks();
        $this->todoView->showIndexTwig($work_list);

    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $work = $this->todoModel->getWorkByid($id);
        $this->todoView->showEditTwig($work);
    }

    /**
     *
     */
    public function update()
    {
        $id = (int) $_POST['id'];
        $work = htmlspecialchars( $_POST['work']);
        $this->todoModel->updateWork($id,$work);
        header("Location: /");
        die();
    }

    /**
     *
     */
    public function add()
    {
        $newWork = htmlspecialchars( $_POST['work']);
        $this->todoModel->addNewWork($newWork);
        header("Location: /");
        die();
    }

    /**
     * @param $id
     */
    public function del($id)
    {
        $this->todoModel->delWork($id);
        header("Location: /");
        die();
    }

    /**
     * @param $id
     */
    public function change($id)
    {
        $work = $this->todoModel->getWorkByid($id);
        $this->todoModel->changeStatus($work);
        header("Location: /");
        die();
    }






}