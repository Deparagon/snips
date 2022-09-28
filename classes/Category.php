<?php

class Category extends ModelBoss
{
    public $id;
    public $name;
    public $description;
    public $created_at;
    public $update_at;
    protected $tablename;
    


    public function __construct($id = null)
    {
        $this->tablename = 'categories';
        parent::__construct();
        $this->fillObject($id);
    }


    public function requiredFields()
    {
        return array('name', 'description');
    }

    public function fillables()
    {
        return array('name', 'description', 'created_at');
    }




    
    public function getTypes($property = '')
    {
        if ($property =='') {
            return '';
        }

        $types = array('id'=>'i', 'name'=>'s', 'description'=>'s', 'created_at'=>'s', 'updated_at'=>'s');
        if (isset($types[$property])) {
            return $types[$property];
        }
        return '';
    }


    

    public function view()
    {

        $html = '<form method="post" class="form_for_object_update_add" data-action="update" data-object="Category">
        <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Update Snip: '.$this->name.'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="" class="modal-body"> 
             <div id="object_ajax_reporteri" class="showmessage_heredata"></div>

      <div class="card">
            <div class="card-body">
             <input type="hidden" value="'.$this->id.'" name="id">
              <div class="form-group">
                <label for="name"> Name</label>
                <input type="text" name="name" value="'.$this->name.'" class="form-control" id="name">
              </div>

               <div class="form-group">
                <label for="description"> description </label>
                <textarea name="description" class="form-control" id="description">'.$this->description.'</textarea>
              </div>

       
            </div>
            </div>
            </div>
      
            <div class="modal-footer">
              <button data-action="update" data-object="Category" class="btn_for_object_update_add btn btn-lg btn-primary">Save</button>
            </div>
           </form>';
         return array('status'=>'OK', 'message'=>'success', 'content'=>$html);
    }


    public function search($info)
    {
        $info ='%'.$info.'%';
        $data = $this->topSql('SELECT * FROM '.$this->tablename.' WHERE name LIKE "'.$info.'" OR description LIKE "'.$info.'"');


         $listdata = '<div class="table-responsive">
        <table class=" table table-striped table-bordered">
          <thead>
        <tr> <th> Name </th><th> Description </th>  <th> Created At </th> <th colspan="2">Action </th></tr>
          </thead>

           <tbody>';
        if (!empty($data)) {
            foreach ($data as $code) {
                $listdata .= '<tr> <td> '.$code->name.' </td> <td> '.$code->description.'</td> <td>'.$code->created_at.' </td>  <td> <button data-action="view" data-object="Category" class="view_action_process btn btn-xs btn-success" data-id="'. $code->id.'">view</button>  </td> <td> <button data-action="delete" data-object="Category" class="delete_action_process btn btn-xs btn-danger" data-id="'. $code->id.'">delete</button>  </td>  </tr>';
            }
        } else {
            $listdata .= '<tr> <td colspan="5"> No category found   </td>  </tr>';
        }
        $listdata .= '</tbody> </table> </div>';

        return array('status'=>'OK', 'message'=>'success', 'content'=>$listdata);
    }
}
