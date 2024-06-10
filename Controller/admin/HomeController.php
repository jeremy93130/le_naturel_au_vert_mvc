<?php 

namespace Controller\Admin;

use Controller\BaseController;

class HomeController extends BaseController
{
    public function index(){
        $this->render('admin/index.html.php');
    }
}