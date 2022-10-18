<?php


namespace Todo;


class TodoView
{
    public function showIndex(array $work_list)
    {
        include 'templates/header.php';
        $form = $this->showForm('/add', 'Add new work') ;
        echo $this->getRow($form);
        $list  = $this->generateHtmlWorkList($work_list);
        echo $this->getRow($list);
        include 'templates/footer.php';
    }

    public function showEdit(array $work)
    {
        include 'templates/header.php';
        $form = $this->showForm(
            '/update',
            'Редактирование',
            $work['work_name'],
            [
                'id'=>$work['id']
            ]);
        echo $this->getRow($form);
//        $list  = $this->generateHtmlWorkList($work_list);
//        echo $this->getRow($list);
        include 'templates/footer.php';
    }

    public function getRow($content)
    {
        $html ='<div class="row my-2"><div class="col">';
        $html .= $content;
        $html .='</div></div>';
        return $html;
    }

    public function showForm(string $action, string $title, string $value ='',array $hidden=[]){
        $form = '<div class="card"><div class="card-body"><h4 class="card-title">';
        $form .=$title;
        $form .='</h4><form action="'.$action.'" method="post">';
        $form .='<div class="form-group">';
        $form .='<input type="text" class="form-control" name="work" value="'.$value.'">';
        $form .='</div>';
        if(!empty($hidden)){
            foreach ($hidden as $key => $value ){
                $form .= '<input type="hidden" class="form-control" name="'.$key;
                $form .='" value="'.$value.'">';
            }
        }
        $form .= '<button type="submit" name="btnWork" class="btn btn-primary">';
        $form .='Submit</button></form></div></div>';
        return $form;
    }

    public function generateHtmlWorkList(array $worklist){
        $html = '';
        foreach ($worklist as $row) {
            $html .= '<li class="list-group-item';
            if($row['work_status']==1){
                $html .=' list-group-item-success';
            }
            $html .='">'.$row['work_name'];
            $html .='<a href="change/'.$row['id'].'"class="btn btn-outline-success btn-sm ml-5">';
            $html .='<span><i class="fas fa-check-circle "></i></span></a>';
            $html .='<a href="edit/'.$row['id'];
            $html .='" class="btn  btn-outline-primary btn-sm">';
            $html .='<i class="fas fa-pen"></i></a>';
            $html .='<a href="del/'.$row['id'];
            $html .='" class="btn btn-outline-danger btn-sm">';
            $html .='<i class="fas fa-trash-alt"></i></a></li>';
        };
        return $html;
    }

}