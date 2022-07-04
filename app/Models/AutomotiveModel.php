<?php namespace App\Models;

use codeIgniter\Model;

 class AutomotiveModel extends Model{
    protected $table='registration';
    protected $allowedFields=['firstname','lastname','email','password','confirmpassword','phoneno','verificationcode'];
    protected $beforeInsert=['beforeInsert'];
    protected $beforeUpdate=['beforeUpdate'];

    protected function beforeInsert(array $data ){
     $data= $this->passwordHash($data);
        return $data;
    }
    protected function beforeUpdate(array $data ){
        $data= $this->passwordHash($data);
        return $data;
    }
    protected function passwordHash(array $data){
        if(isset($data['data']['password']))
            $data['data']['password']= password_hash($data['data']['password'].PASSWORD_DEFAULT);
        return $data;
    }
}


