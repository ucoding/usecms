<?php
class menuMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $id = $_GET["id"];
        $this->list = model('menu')->admin_menu($id);
        $this->formlist =  model('form')->form_list();
        $this->display("menu/expand");
    }

}

