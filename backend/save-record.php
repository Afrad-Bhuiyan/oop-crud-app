<?php 

    include "../classes/functions.cls.php";
    $functions=new functions();
    $url=$functions->domain();
    
    if(isset($_POST["request"]) && $_POST["request"]){

        $first_name=htmlspecialchars($_POST["first_name"]);
        $last_name=htmlspecialchars($_POST["last_name"]);
        $age=htmlspecialchars($_POST["age"]);
        $gender=htmlspecialchars($_POST["gender"]);
        $city=htmlspecialchars($_POST["city"]);

        $errors=[];

        if(empty($first_name)){

            $errors["first_name_error"]=[
                "target"=>".add-records form .form-field .first_name",
                "error_msg"=>"
                    <div class='error-msg'>
                        <span>First name is required</span>
                    </div>
                "
            ];

        }
        if(empty($last_name)){

            $errors["last_name_error"]=[
                "target"=>".add-records form .form-field .last_name",
                "error_msg"=>"
                    <div class='error-msg'>
                        <span>Last name is required</span>
                    </div>
                "
            ];

        }

        if(empty($age)){

            $errors["age_error"]=[
                "target"=>".add-records form .form-field.age > div",
                "error_msg"=>"
                    <div class='error-msg'>
                        <span>Age is required</span>
                    </div>
                "
            ];

        }

        if(empty($gender)){

            $errors["gender_error"]=[
                "target"=>".add-records form .form-field.gender > div",
                "error_msg"=>"
                    <div class='error-msg'>
                        <span>Please select your gender</span>
                    </div>
                "
            ];

        }
        
        if(empty($city)){

            $errors["city_error"]=[
                "target"=>".add-records form .form-field.city > div",
                "error_msg"=>"
                    <div class='error-msg'>
                        <span>Please select your city</span>
                    </div>
                "
            ];

        }

        if(!empty($errors)){

            echo json_encode($errors);

        }else{

          
            include "../classes/database.cls.php";
            $query=new query();

            $result=$query->insert_data(array(
                "table_name"=>"users",
                "fields"=>array(
                    "first_name"=>$first_name,
                    "last_name"=>$last_name,
                    "age"=>$age,
                    "gender"=>$gender,
                    "city"=>$city,
                )
            ));

            if($result["status"]==1){

                echo 1;


            }else{
                echo 0;
            }
            
        }



    }else{

        header("Location:{$url}");
    }




?>