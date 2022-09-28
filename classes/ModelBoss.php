<?php


class ModelBoss extends Db
{

    public function __construct($id = null)
    {
        parent::__construct();
    }
     
    public function requiredFields()
    {
        return array();
    }

    public function fillObject($id)
    {
        if (!is_null($id)) {
            $row = $this->getById($id);
            if (is_object($row)) {
                foreach (get_object_vars($row) as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }
    public function add()
    {
        $types = [];
        $vars = [];
        $ppties = get_object_vars($this);
        $fillables = $this->fillables();
       
        if (count($ppties) >0) {
            foreach ($ppties as $kk => $pp) {
                if (!in_array($kk, $fillables)) {
                    continue;
                }
                if ($kk =='created_at') {
                    $vars[$kk] = date('Y-m-d H:i:s');
                } else {
                    $vars[$kk] = $pp;
                }

                $types[] = $this->getTypes($kk);
            }
        }

        if ($id = $this->insertID($vars, $types)) {
            return $this->getRow('SELECT * FROM ', array('id'=>$id));
        }

        return false;
    }

    public function save()
    {
        $types = [];
        $vars = [];
        $ppties = get_object_vars($this);
        $fillables = $this->fillables();
       
        if (count($ppties) >0) {
            foreach ($ppties as $kk => $pp) {
                if (!in_array($kk, $fillables)) {
                    continue;
                }
                $vars[$kk] = $pp;
                $types[] = $this->getTypes($kk);
            }
        }

             $this->update($vars, array('id'=>$this->id));
            return $this->getRow('SELECT * FROM ', array('id'=>$this->id));
    }

    

    public function doUpdate()
    {
        return $this->save();
    }

    public function doDelete()
    {
        $this->delete(array('id'=>$this->id));
        return true;
    }


    public function validate()
    {
        $rs = $this->requiredFields();
        if (count($rs) >0) {
            foreach ($rs as $f) {
                $n  = Tools::getValue($f);
                if ($n =='') {
                    echo json_encode(array('status'=>'NK', 'message'=>$f.' is required'));
                    exit;
                } else {
                    $this->$f= $n;
                }
            }
        }
        return $this;
    }

    public function getAll()
    {
        return $this->doSelection();
    }

    public function getById($id)
    {
        return $this->getRow('SELECT * FROM ', array('id'=>$id));
    }
}
