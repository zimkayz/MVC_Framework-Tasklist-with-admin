<?php
class Task{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findAllTasks(){
        $this->db->query('SELECT * FROM tasks ' );
        $results = $this->db->resultSet();
        return $results;

    }
    public function addTask($data){
        $this->db->query('INSERT INTO tasks (user_name,user_email,user_task,user_status,edited) 
        VALUES (:user_name, :user_email,:user_task,:user_status,:edited)' );

        $this->db->bind('user_name',$data['user_name']);
        $this->db->bind('user_email',$data['user_email']);
        $this->db->bind('user_task',$data['user_task']);
        $this->db->bind('user_status',$data['user_status']);
        $this->db->bind('edited',$data['edited']);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
            }
        }
    
        public function findTaskById($id){
            $this->db->query('SELECT * FROM tasks WHERE id = :id');

            $this->db->bind(':id',$id);
            $row =$this->db->single();
            return $row;

        }
        public function updateTask($data){
            $this->db->query('UPDATE tasks SET 
            user_name =:user_name,
            user_email =:user_email,
            user_task =:user_task,
            user_status =:user_status,
            edited =:edited
            WHERE id =:id');
            $this->db->bind(':id',$data['id']);
            $this->db->bind(':user_name',$data['user_name']);
            $this->db->bind(':user_email',$data['user_email']);
            $this->db->bind(':user_task',$data['user_task']);
            $this->db->bind(':user_status',$data['user_status']);
            $this->db->bind(':edited',$data['edited']);

            
        if($this->db->execute()){
            return true;
        }else{
            return false;
            }
        }
}

?>
