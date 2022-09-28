<?php

class Snip extends ModelBoss
{
    public $id;
    public $title;
    public $code_text;
    public $id_project;
    public $id_category;
    public $created_at;
    public $updated_at;
    protected $tablename;
    


    public function __construct($id = null)
    {
        $this->tablename = 'snips';
        parent::__construct();
        
        $this->fillObject($id);
    }

    public function requiredFields()
    {
        return array('title', 'code_text', 'id_category', 'id_project');
    }

    public function fillables()
    {
        return array('title', 'code_text', 'id_category', 'id_project', 'created_at', 'updated_at');
    }



    
    public function getTypes($property = '')
    {
        if ($property =='') {
            return '';
        }

        $types = array('id'=>'i', 'title'=>'s', 'code_text'=>'s', 'created_at'=>'s', 'updated_at'=>'s', 'id_project'=>'i', 'id_category'=>'1');
        if (isset($types[$property])) {
            return $types[$property];
        }
        return '';
    }

    
    public function view()
    {
        $allprojects = (new Project())->getAll();
        $allcategories = (new Category())->getAll();

        $html = '<form class="form_for_object_update_add" method="post" action="" data-action="update" data-object="Snip">
        <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Update Snip: '.$this->title.'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="" class="modal-body">
       <div id="object_ajax_reporteri" class="showmessage_heredata"></div>
         <div class="card">
            <div class="card-body">
             <input type="hidden" value="'.$this->id.'" name="id">
              <div class="form-group">
                <label for="title"> Title</label>
                <input type="text" name="title" value="'.$this->title.'" class="form-control" id="title">
              </div>

               <div class="form-group">
                <label for="code_text"> Code Text</label>
                <textarea name="code_text" class="form-control" id="live_code_text">'.$this->code_text.'</textarea>
              </div>

               <div class="row">
                <div class="col-sm-6">
              <div class="form-group">
                <label for="id_project"> Project</label>
                <select name="id_project" class="form-control" id="id_project">';
                  
        if (count($allprojects) >0) :
            foreach ($allprojects as $project) :
                if ($project->id ==$this->id_project) {
                    $select ='selected';
                } else {
                    $select = '';
                }
                $html.= '<option value="'.$project->id.'" '.$select.'> '.$project->name.' </option>';
            endforeach;
        endif;
                 
                $html.='</select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="id_category"> Category</label>
                <select name="id_category" class="form-control" id="id_category">';
                   
        if (count($allcategories) >0) :
            foreach ($allcategories as $category) :
                if ($category->id ==$this->id_category) {
                    $iselected ='selected';
                } else {
                    $iselected = '';
                }
                $html.='<option value="'.$category->id.'" '.$iselected.'> '.$category->name.' </option>';
            endforeach;
        endif;
               $html.='</select>
              </div>
            </div>
          </div>
              
            </div>
            </div>
            </div>

            <div class="modal-footer">
              <button data-action="update" data-object="Snip" class="btn_for_object_update_add btn btn-lg btn-primary">Save</button>
            </div>
           </form>';
          return array('status'=>'OK', 'message'=>'success', 'content'=>$html);
    }


    public function search($info)
    {
        $info ='%'.$info.'%';
        $data = $this->topSql('SELECT a.* FROM '.$this->tablename.' a LEFT JOIN categories c ON c.id =a.id_category LEFT JOIN projects p ON p.id = a.id_project WHERE title LIKE "'.$info.'" OR c.name LIKE "'.$info.'" OR p.name LIKE "'.$info.'"');


         $listdata = '<div class="table-responsive">
        <table class=" table table-striped table-bordered">
          <thead>
        <tr> <th> title </th>  <th> Updated At </th> <th colspan="2">Action </th></tr>
          </thead>

           <tbody>';
        if (!empty($data)) {
            foreach ($data as $code) {
                $listdata .= '<tr> <td> '.$code->title.' </td>  <td>'.$code->updated_at.' </td>  <td> <button data-action="view" data-object="Snip" class="view_action_process btn btn-xs btn-success" data-id="'. $code->id.'">view</button>  </td> <td> <button data-action="delete" data-object="Snip" class="delete_action_process btn btn-xs btn-danger" data-id="'. $code->id.'">delete</button>  </td>  </tr>';
            }
        } else {
            $listdata .= '<tr> <td colspan="5"> No code text found   </td>  </tr>';
        }
        $listdata .= '</tbody> </table> </div>';

        return array('status'=>'OK', 'message'=>'success', 'content'=>$listdata);
    }
}
