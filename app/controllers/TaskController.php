<?php
//require_once ('app/models/TaskModel.php');
 require ROOT_PATH.'/app/models/TaskModel.php';
class TaskController extends Controller {

    public function indexAction(){

        echo "hola desde indexAction";
    }
    public function addAction(){
        echo "hola desde addAction";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['masterUsr_id']) && isset($_POST['description']) && isset($_POST['created_at']) && isset($_POST['done']) && isset($_POST['currentStatus'])){
                $arrFields = array(
                    'masterUsr_id' => $_POST["masterUsr_id"],
                    //no logro traer el id del q debe autoasignarse cuando se crea la tarea
                    'id_task' => $_POST["id_Task"],
                    'description' => $_POST["description"],
                    'created_at' => $_POST["created_at"],
                    'done' => $_POST["done"],
                    'currentStatus' => $_POST["currentStatus"]);

                    
                    $taskObj = new TaskModel($arrFields);
                    $result = $taskObj->createTask($arrFields);

                    
                    if ($result==true){
                        header("Location: listtask");
                    }else{
                        echo "Error creating Task";
                    }
            }    return $result;   
        }
        
    }
    public function delAction(){ //dudas sobre el action de delete si las paginas esta bien referenciadas
        echo "hola desde delAction";
        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //     if (isset($_POST['id_task'])){
        //         $arrFields = array(
        //             'masterUsr_id' => $_POST["masterUsr_id"],
        //             'description' => $_POST["description"],
        //             'created_at' => $_POST["created_at"],
        //             'done' => $_POST["done"],
        //             'currentStatus' => $_POST["currentStatus"]);
        //     }
        //     $taskObj= New TaskModel($arrFields);
        //     // if ($arrFields['currentStatus'=='']) {
        //     //     # code...
        //     // }
        // }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset ($_POST['id_task'])) {
                $taskObj = new TaskModel();
                $taskid= $_POST['id_task'];
                $tasks = $taskObj->getTasks();
                foreach ($tasks as $task) {
                    if ($task['id_task']==$taskid){
                        $_POST ['description'] = $task ['description'];
                        $_POST ['created_at'] = $task ['created_at'];
                        $_POST ['done'] = $task ['done'];
                        $_POST ['masterUsr_id'] = $task ['masterUsr_id'];
                        $_POST ['slaveUsr_id'] = $task ['slaveUsr_id'];
                        $_POST ['currentStatus'] = $task ['currentStatus'];
                        return json_encode ($task);
                        
                    }
                }
            ///header('Location: viewtask');

            }
        }
    }
    public function editAction(){
        echo "hola desde editAction";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset ($_POST['id_task'])){}
                if (isset($_POST['masterUsr_id']) && isset($_POST['description']) && isset($_POST['created_at']) && isset($_POST['done']) && isset($_POST['currentStatus'])){
                    $arrFields = array(
                        'masterUsr_id' => $_POST["masterUsr_id"],
                        'description' => $_POST["description"],
                        'created_at' => $_POST["created_at"],
                        'done' => $_POST["done"],
                        'currentStatus' => $_POST["currentStatus"]);
                        
                    $taskObj = new TaskModel($arrFields);
                    if ($_POST ['currentStatus']==='In Progress') {
                        $inprogress = $taskObj->initiatedTask($_POST['id_task']);
                    }elseif ($_POST ['currentStatus']==='Deleted') {
                        $deleted = $taskObj->deletedTask($_POST['id_task']);
                    }elseif ($_POST ['currentStatus']==='Completed') {
                        $completed = $taskObj->completedTask($_POST['id_task']);
                    }elseif ($_POST ['currentStatus']==='Initiated') {
                        $initiated = $taskObj->initiatedTask($_POST['id_task']);
                    $result = $taskObj->putJson($arrFields);
                    if ($result==true){
                        header("Location: listtask");
                    }else{
                        echo "Error creating Task";
                    }
            }  return $result;
        }
          
    }
}
    public function searchAction(){
        echo "hola desde searchAction";
       
    }
    public function viewAction(){
        echo "hola desde viewAction";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset ($_POST['id_task'])) {
                $taskObj = new TaskModel();
                $taskid= $_POST['id_task'];
                $tasks = $taskObj->getTasks();
                foreach ($tasks as $task) {
                    if ($task['id_task']==$taskid){
                        $_POST ['description'] = $task ['description'];
                        $_POST ['created_at'] = $task ['created_at'];
                        $_POST ['done'] = $task ['done'];
                        $_POST ['masterUsr_id'] = $task ['masterUsr_id'];
                        $_POST ['slaveUsr_id'] = $task ['slaveUsr_id'];
                        $_POST ['currentStatus'] = $task ['currentStatus'];
                        return json_encode ($task);
                        
                    }
                }
            ///header('Location: viewtask');

            }
        }
       
    }
    public function searchtodeleteAction(){
        echo "hola desde searchtodeleteAction";
        

    }
    public function viewallAction(){
        
        $taskObj = new TaskModel();
        return $taskObj->getTasks();
  
    }
    
}














?>