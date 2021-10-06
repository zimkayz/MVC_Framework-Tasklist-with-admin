<?php
class Pages extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
        $this->taskModel = $this->model('Task'); 
    }

    public function index() {
        $tasks = $this->taskModel->findAlltasks();
      $data =[
        'tasks'=> $tasks
      ];
        $this->view('index', $data);
    }

    public function ajax() {
  
    $data =[
      
    ];
      $this->view('Ajax/ajax', $data);
  }
}
