<?php 


    class functions{
        
        public function domain($addtional_path=""){

            //if someone visits by writing localhost
            $condition1= $_SERVER['SERVER_NAME']=="localhost";

            //if someone visits by writing ip address like:192.168.1.42
            $condition2=$_SERVER['SERVER_NAME'] == $_SERVER['SERVER_ADDR']; 

            if($condition1 || $condition2){

                /**
                 * Write local server's URL Information
                 * 
                 * If your project exists directly on your domain/sub-domain 
                 * then @param folder_name=""
                 * OR
                 * If your project exists inside into a sub folder of your domain/sub-domain
                 * then @param folder_name="sub-folder/"
                 */

                $folder_name="oop-crud-app/";
                
            }else{
                /**
                 * Write live server's URL Information
                 * 
                 * If your project exists directly on your domain/sub-domain 
                 * then @param folder_name=""
                 * OR
                 * If your project exists inside into a sub folder of your domain/sub-domain
                 * then @param folder_name="sub-folder/"
                 */

                
                $folder_name="";

            }
            
            return $domain="{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}/{$folder_name}{$addtional_path}";

        }
    }



?>