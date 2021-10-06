<?php
class Tasks extends Controller{
    public function __construct()
    {
      $this->taskModel = $this->model('Task');  
    
    }
    public function index(){
      $tasks = $this->taskModel->findAlltasks();
      $data =[
        'tasks'=> $tasks
      ];
        $this->view('tasks/index',$data);
    }
    public function create()
      {
        $data =[
          'user_name'=>'',
          'user_email'=>'',
          'user_task'=>'',
          'user_status'=> '',
          'edited'=>'',
          'user_name_error'=>'',
          'user_email_error'=>'',
          'user_task_error'=>''
         
         

        ];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
          $data =[
            'user_name'=> trim($_POST['user_name']),
            'user_email'=> trim($_POST['user_email']),
            'user_task'=> trim($_POST['user_task']),
            'user_status'=> trim($_POST['user_status']),
            'edited'=> trim($_POST['edited']),
           
            
  
          ];
          if(empty($data['user_name'])){
            $data ['user_name_error'] = 'the username cannot be empty';
          }
         
          if(empty($data['user_email'])){
            $data ['user_email_error'] = 'the email cannot be empty';
          }
          if(empty($data['user_task'])){
            $data ['user_task_error'] = 'the task cannot be empty';
          }
          

          if(empty($data['user_name_error']) && empty($data['user_email_error']) && empty($data['user_task_error'])){
            if($this->taskModel->addTask($data)){
             $_SESSION['upload'] = "Task succesfully added";
              header("Location: " . URLROOT . "/index",'task created');
            }else{
              die("something went wrong,please try again");
            }
          }else{
            $this->view('tasks/create',$data);
          }
         

        }
        $this->view('tasks/create',$data);
      }
    public function update($id)
      {
        $task = $this->taskModel->findTaskById($id);
        if(!isLoggedIn()){
          header("Location: ". URLROOT . "/index");
        }
          $data =[
            'task'=>$task,
            'user_name' => '',
            'user_email' => '',
            'user_task' => '',
            'user_status'=> '',
            'edited'=>'',
            'user_name_error'=>'',
            'user_email_error'=>'',
            'user_task_error'=>''

          ];
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $data =[
              'id'=>$id,
              'task'=>$task,
              'user_name'=> trim($_POST['user_name']),
              'user_email'=> trim($_POST['user_email']),
              'user_task'=> trim($_POST['user_task']),
              'user_status'=> trim($_POST['user_status']),
              'edited'=> trim($_POST['edited']),
             
              
    
            ];
            if(empty($data['user_name'])){
              $data ['user_name_error'] = 'the username cannot be empty';
            }
            if(empty($data['user_email'])){
              $data ['user_email_error'] = 'the email cannot be empty';
            }
            if(empty($data['user_task'])){
              $data ['user_task_error'] = 'the task cannot be empty';
            }
            
  
            if(empty($data['user_name_error']) && empty($data['user_email_error']) && empty($data['user_task_error'])){
              if($this->taskModel->updateTask($data)){
                $_SESSION['updated'] = "Task succesfully updated";
                header("Location: " . URLROOT . "/tasks/index");
              }else{
                die("something went wrong,please try again");
              }
            }else{
              $this->view('tasks/update',$data);
            }
           
  
          }

          $this->view('tasks/update',$data);
      }
    public function delete()
      {


      }
      

}
?>