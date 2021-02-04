<?php 

    include "../classes/functions.cls.php";
    $functions=new functions();
    $url=$functions->domain();

    if(isset($_POST["request"]) && $_POST["request"]){
        
        include "../classes/database.cls.php";
        $query=new query();

        $result=$query->delete_data(array(
            "table_name"=>"users",
            "where"=>"id='{$_POST['record_id']}'"
        ));

        if($result["status"] == 1){
            
            echo 1;

        }else{
            
            echo 0;
        }


    }else{
        header("Location:{$url}");
    }

?>