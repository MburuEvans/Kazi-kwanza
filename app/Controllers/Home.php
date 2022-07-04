<?php

namespace App\Controllers;

use App\Models\AutomotiveModel;

class Home extends BaseController
{
    public function index()
    {
        $data=[];
        helper(['form']);

        echo view('templates/header',$data);
        echo view('login');
        echo view('templates/footer');
    }

    public function register(){
        $data=[];
        helper(['form']);

        if($this->request-> getMethod()=='post'){
           $rules=[
               'firstname'=>'required|min_length[3]|max_length[20]',
               'lastname'=>'required|min_length[3]|max_length[20]',
               'email'=>'required|min_length[6]|max_length[60]|valid_email|is_unique[users.email]',
               'password'=>'required|min_length[8]|max_length[60]',
               'confirmpassword'=>'matches[password]',
           ];
           if ($this->validate($rules)){
               $data['validation']=$this->validator;
           }else{
               $model=new AutomotiveModel();
               $newData=[
                   'firstname'=>$this->request->getVar('firstname'),
                   'lastname'=>$this->request->getVar('lastname'),
                   'email'=>$this->request->getVar('email'),
                   'password'=>$this->request->getVar('password'),
                   'confirmpassword'=>$this->request->getVar('confirmpassword'),
                   'phoneno'=>$this->request->getVar('phoneno'),
                   'verificationcode'=>$this->request->getVar('verificationcode'),
                   ];
               $model->save($newData);
               $session=session();
               $session->setFlashdata('success','successful Registration');
               return redirect()->to('/');
           }
        }

        echo view('templates/header',$data);
        echo view('register');
        echo view('templates/footer');
    }
}
