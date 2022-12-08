<?php

class TaskModel{
    private $arrFields= array (
        'id_task' => '0',
        'description' => '',
        'currentStatus' => 'initiated',
        'created_at' => '', 
        'done' => '',
        'masterUsr_id'=>'',
        'slaveUsr_id'=>''
    );
   
    private $arrTasks;
    public function __contructor($arrFields){
        
        if (!file_exists(__DIR__.'../db/tasks.json')) {
            $this->arrTasks = $this->putJson('[]');
        }else {
            $this->arrTasks = json_decode(file_get_contents(ROOT_PATH.'/db/tasks.json',true)); 
        }
        $this->arrFields = array(
            '"id_task"' => "0",
            'created_at' => date("Y-m-d"),
            'description' => $arrFields['description'],
            'masterUsr_id' => $arrFields['masterUsr_id'],
            'slaveUsr_id'  => $arrFields['slaveUsr_id'],
            'done' => date("Y-m-d")
        );  
    }
    public function putJson($arrFields)
    {
        json_encode(file_put_contents(ROOT_PATH. '/db/tasks.json', $arrFields));
        
    }
    
    public function getTasks(){
        $tasks = json_decode(file_get_contents(ROOT_PATH.'/db/tasks.json'),true);
        return $tasks;
    }
    public function getTaskById($taskId){
        $tasks = $this->arrTasks;
        foreach ($tasks as $task) {
            if ($task['id_task']== $taskId) {
                return json_encode($task);
            }
        }return null;
        // $tasks = $this->getTasks();
        // $key = array_column($tasks,'id_task');
        // return json_encode($tasks[$key]);
    }
    
    public function getId(){
        $tasks = $this->arrTasks;
        foreach ($tasks as $task) {
          $taskid = $task ['id_task'];
           return json_encode($taskid);
        }
    }
    // public function setId(){
    //     $record_number = count($this->arrTasks);
    //     for ($i=0; $i <= $record_number ; $i++) { 
            
    //         if ($this->arrFields['id_task'] == 0) {
    //             $this->arrFields['id_task']=1;
    //         }else{
    //             $this->arrFields['id_task']=+1;
    //         }
    //     }        
    // }
   
    public function completedTask($taskid){
        $tasks = $this->arrTask;
        if (is_array($tasks)){
            foreach ($tasks as $task) {
                if($task['id_task'] === $taskid){
                $task['currentStatus'] = 'completed';
                $task['done'] = date("Y-m-d");
                }
            }
         $this->putJson($task);
        }
    }
    public function initiatedTask($taskid){
        $tasks = $this->arrTask;
        if (is_array($tasks)){
            foreach ($tasks as $task) {
                if($task['id_task'] === $taskid){
                    $task['currentStatus'] = 'in progress';
                    
                }
            }
            $this->putJson($task);
        }
    }
    public function deletedTask($taskid){
        $tasks = $this->arrTask;
        if (is_array($tasks)){
            foreach ($tasks as $task) {
                if($task['id_task'] === $taskid){
                    $task['currentStatus'] = 'deleted';
                    $task['done'] = date("Y-m-d") ;
                }
            }
            $this->putJson($task);
        }
    }
    public function createTask($arrFields){
        $tasks = self::getTasks();
        $arrFields['id_task']=0;
        if ($this->arrFields['id_task']=0) {
            $this->arrFields['id_task']=1;
        }else {
            $this->arrFields['id_task']=+1;
        }
        $tasks[]=$this->arrFields;
        self::putJson($tasks);
        return $this->arrFields;
    }
}




?>