<?php 

   
    class database{

        protected $mysqli="";
        protected $conn=false;

        protected function db_info($param){

            /**
             * $condition==true (for live server)
             * $condition==false (for local server)
             */

            $condition=($_SERVER["SERVER_NAME"]=="localhost" || $_SERVER["SERVER_NAME"] == $_SERVER["SERVER_ADDR"]) ? false : true;


            if($param == "db_host"){

                return ($condition) ? "live_server_db_name" : "localhost";
            }

            if($param == "db_user"){

                return ($condition) ? "live_server_db_user" : "root";
            }

            if($param == "db_pass"){

                return ($condition) ? "live_server_db_pass" : "";
            }

            if($param == "db_name"){

                return ($condition) ? "live_server_db_name" : "oop";
            }
        }
    
        public function __CONSTRUCT(){

            if(!$this->conn){

                $this->mysqli=new mysqli($this->db_info("db_host"),$this->db_info("db_user"), $this->db_info("db_pass"), $this->db_info("db_name"));
                
                if($this->mysqli->connect_error){
                    die("Database connection failed");
                }

                $this->conn=true;
        
            }
        }
        
        public function __DESTRUCT(){

            if($this->conn){

                if($this->mysqli->close()){
                    
                    $this->conn=false;
            
                }else{

                    return false;
                }
            }
        
        }
    }
    
    class query extends database{

        //if_table_exist() for checking the table from database
        protected function if_table_exist($table){

            $db_name=$this->db_info('db_name');

            $sql="SHOW TABLES FROM {$db_name} LIKE '{$table}';";
            $sql_run=$this->mysqli->query($sql);
            
            if($sql_run && $sql_run->num_rows == 1){

                return true;

            }else{

                return false;
            }
        }//ends if_table_exist()

        //error_msg() for showing the error message
        protected function error_msg($param){

            /**
             * table_name_error=Did not set the table name
             * table_exist_error=Table doesn't exist
             * query_error=Query failed to execute
             * success=success
             */

             if($param=="table_name_error"){

                 return "'table_name' Key is required";
             }

             if($param=="table_exist_error"){

                return "Table doesn't exist";

             }

             if($param=="query_error"){

                 return "Query failed to excute";
             }

           

        }//ends error_msg()


        //get_data() for fateching data from database
        public function get_data(array $values){
            
            $output=[];

            if(isset($values["table_name"])){

                if($this->if_table_exist($values["table_name"])){

                    $sql="";

                    if(isset($values["column_name"])){

                        $sql .="SELECT {$values["column_name"]}FROM";

                    }else{

                        $sql .="SELECT * FROM";
                    }

                    $sql .=" {$values['table_name']} ";

                    if(isset($values["join"])){

                        $sql .= " INNER JOIN  {$values["join"]}";
                    }
        
                    if(isset($values["where"])){

                        $sql .= " WHERE {$values['where']} ";
                    }

                    if(isset($values['order'])){

                        $sql .= " ORDER BY {$values["order"]["column"]} {$values["order"]["type"]} ";
                    }

                    
                    if(isset($values['limit'])){
                        $sql .= " LIMIT {$values['limit']}";

                    }

                    $sql_run=$this->mysqli->query($sql);

                    if($sql_run){

                        $output['status']=1;
                        $output["num_rows"]=$sql_run->num_rows;
                        $output["fetch_all"]=$sql_run->fetch_all(MYSQLI_ASSOC);
                        

                        return $output;
                 

                    }else{
                        $output['status']=0;
                        $output['error']=$this->error_msg("query_error");
                        
                        return $output;
                    }

                }else{
                    $output['status']=0;
                    $output['error']=$this->error_msg("table_exist_error");

                    return $output;

                }
            
            }else{
                
                $output['status']=0;
                $output['error']=$this->error_msg("table_name_error");

                return $output;
              
            }
        }//ends get_data()


        //insert_data() for inserting data into database
        public function insert_data(array $values){
        
            $output=[];

            if(isset($values["table_name"])){

                
                if($this->if_table_exist($values["table_name"])){

                    $table_col=implode(", ",array_keys($values["fields"]));
                    $table_col_value=implode("', '",$values["fields"]);

                    $sql="INSERT INTO {$values["table_name"]} ({$table_col})  VALUES('{$table_col_value}')";
                    $sql_run=$this->mysqli->query($sql);

                    if($sql_run){

                        $output['status']=1;

                        return $output;

                    }else{
                        $output['status']=0;
                        $output['error']=$this->error_msg('query_error');
                        
                        return $output;
                    }
                
                }else{

                    $output['status']=0;
                    $output['error']=$this->error_msg('table_exist_error');

                    return $output;
                }

            }else{
                $output['status']=0;
                $output['error']=$this->error_msg('table_name_error');

                return $output;
                
            }

        }//ends insert_data()


        //update_data() for updating data in database
        public function update_data(array $values){

            $output=[];

            if(isset($values["table_name"])){

                if($this->if_table_exist($values["table_name"])){


                    $modified_value=[];

                    foreach($values["fields"] as $key=>$value){

                        $modified_value[]="{$key}='{$value}'";
                    }

                    $sql="UPDATE {$values["table_name"]} SET ". implode(", ", $modified_value);

                    if(isset($values['where'])){
        
                        $sql .= " WHERE {$values["where"]}";
                    }
                    
                    $sql_run=$this->mysqli->query($sql);

                    if($sql_run){
                        
                        $output["status"]=1;
                        $output["affected_rows"]=$this->mysqli->affected_rows;

                        return $output;

                    }else{

                        $output["status"]=0;
                        $output["error"]=$this->error_msg("query_error");

                        return $output;

                    }
                
                }else{

                    $output["status"]=0;
                    $output["error"]=$this->error_msg("table_exist_error");
                    
                    return $output;

                }
                
            }else{

                $output["status"]=0;
                $output["error"]=$this->error_msg("table_name_error");
                return $output;

            }
        }//ends update_data()


        //delete_data() for deleting data from database
        public function delete_data(array $values){

            $output=[];

            if(isset($values["table_name"])){
                
                if($this->if_table_exist($values["table_name"])){
                    
                    $sql="DELETE FROM {$values["table_name"]}";

                    if(isset($values["where"])){
                        $sql .= " WHERE {$values["where"]}";
                    }
                    
                    $sql_run=$this->mysqli->query($sql);

                    if($sql_run){

                        $output["status"]=1;
                        $output["affected_rows"]=$this->mysqli->affected_rows;

                        return $output;

                    }else{
                        $output["status"]=0;
                        $output["error"]=$this->error_msg("query_error");

                        return $output;
                    }
                    


                }else{

                    $output["status"]=0;
                    $output["error"]=$this->error_msg("table_exist_error");

                    return $output;
                }

            }else{
                $output["status"]=0;
                $output["error"]=$this->error_msg("table_name_error");

                return $output;
                

            }

        }//ends delete_data()
    }

    
    $query=new query();

    $result=$query->get_data(array(
        "table_name"=>"users",
        "column_name"=>"*",
        "where"=>"first_name LIKE '%A%' OR last_name LIKE '%B%'",
       
       
    ));



  


    


    
  









   


  


?>