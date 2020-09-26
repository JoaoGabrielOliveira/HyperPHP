<?php

namespace Hyper\Model;

use Hyper\Database\CRUD\select;
use Hyper\Database\DbConnection;

require_once dirname(__FILE__) . '/../main.php';

class model_base
{
    protected $table;

    public static function find(int $id)
    {
        $object = select::execute(DbConnection::getInstance(), 'tb_cliente', '*', "id = $id");
        return(new model_base($object));
    }

    public static function find_by($params)
    {

    }

    public static function all()
    {
        
    }

    public static function where($condition)
    {

    }

    public static function create($params)
    {

    }

    public static function update()
    {

    }

    public static function delete()
    {

    }

    public function save()
    {

    }    

}

?>