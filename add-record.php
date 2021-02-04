
<?php 
    include "includes/header.inc.php";
?>

    
    <section class='add-records'>
        <div class="container">
            <div class="row">
               <div class="col-12 col-md-10 col-lg-8 mx-auto">
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="col-wrap">
                                <h2>Add a record</h2>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row  mt-4">
                        <div class="col-12">
                            <form class="col-wrap full-width">
                                <div class="row form-field first_last_name">
                                    <div class="col-12 col-lg-6 first_name">
                                        <input type="text" name="first_name" placeholder='First Name'>
                                    </div>
                                    <div class="col-12 col-lg-6 last_name">
                                        <input type="text" name="last_name" placeholder='First Name'>
                                       
                                    </div>
                                </div>
                                <div class="row form-field age">
                                    <div class="col-12">
                                        <input type="text" name="age" placeholder='Age'>
                                    </div>
                                </div>
                                <div class="row form-field gender">
                                    <div class="col-12">
                                        <select name="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
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
                                                    echo "<option value='{$value}'>{$value}</option>";
                                                }
                                            
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-field add-btn">
                                    <div class="col-12">
                                        <button class='btn btn-full btn-primary' type='submit'>Add</button>
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
    include "includes/footer.inc.php";
?>


