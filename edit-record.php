
<?php 
      
    include "includes/header.inc.php";
    $functions=new functions();
    $location=$functions->domain();
   
?>

<?php 

    if(isset($_GET["id"])):
        $query=new query();
        $result=$query->get_data(array(
            "table_name"=>"users",
            "column_name"=>"*",
            "where"=>"id='{$_GET['id']}'"
        ));

        if($result["status"] == 1):

            if($result["num_rows"] == 1):

?>
                <section class='edit-records'>
                    <div class="container">
                        <div class="row">
                        <div class="col-12 col-md-10 col-lg-8 mx-auto">
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="col-wrap">
                                            <h2>Edit a record</h2>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <form class="col-wrap full-width">
                                            <div class="row form-field first_last_name">
                                                <div class="col-12 col-lg-6 first_name">
                                                    <input type="text" name="first_name" placeholder='First Name' value="<?php echo $result["fetch_all"][0]["first_name"]; ?>">
                                                    <input type="hidden" name="record_id" value="<?php echo $result["fetch_all"][0]["id"] ?>">
                                                </div>
                                                <div class="col-12 col-lg-6 last_name">
                                                    <input type="text" name="last_name" placeholder='First Name' value="<?php echo $result["fetch_all"][0]["last_name"]; ?>">
                                                
                                                </div>
                                            </div>
                                            <div class="row form-field age">
                                                <div class="col-12">
                                                    <input type="text" name="age" placeholder='Age' value="<?php echo $result["fetch_all"][0]["age"]; ?>">
                                                </div>
                                            </div>
                                            <div class="row form-field gender">
                                                <div class="col-12">
                                                    <select name="gender">
                                                        <?php 
                                                            $male="";
                                                            $female="";
                                                            
                                                              if($result["fetch_all"][0]["gender"]=="Male"){
                                                                  $male="selected";
                                                              }

                                                              if($result["fetch_all"][0]["gender"]=="Female"){
                                                                  $female="selected";
                                                              }

                                                              echo "
                                                                    <option value=''>Select Gender</option>
                                                                    <option {$male} value='Male'>Male</option>
                                                                    <option {$female} value='Female'>Female</option>
                                                              ";
                                                        ?>
                                                        
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="row form-field city">
                                                <div class="col-12">
                                                    <select name="city">
                                                        <option value="">Select City</option>
                                                        <?php 
                                                            
                                                              $cities=["Dhaka","Narayanganj","Barisal"];

                                                              foreach($cities as $value){

                                                                if($value == $result["fetch_all"][0]["city"]){
                                                                    
                                                                    echo "
                                                                        <option selected value='{$value}'>{$value}</option>
                                                                    ";

                                                                }else{
                                                                    echo "
                                                                        <option value='{$value}'>{$value}</option>
                                                                    ";
                                                                }
                                                               
                                                              }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-field update-btn">
                                                <div class="col-12">
                                                    <button class='btn btn-full btn-primary' type='submit'>Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>      
                        </div>
                        </div>
                    </div>
                </section>

<?php 
            else:
                
                echo "You may be looking somthing else. You may visit our <a href='{$location}'>home page</a>";
                
            endif;
        else:

            echo $result["error"];

        endif;
    else:

        header("Location:{$location}");

    endif;
?>

<?php
    include "includes/footer.inc.php";
?>


