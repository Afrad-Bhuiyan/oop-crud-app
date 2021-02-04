
<?php 
    include "includes/header.inc.php";
?>

    
    <section class='all-records'>
        <div class="container">
            <div class="row">
               <div class="col-12 col-lg-10 mx-auto">
                    <div class="row mb-4">
                        <div class="col-8">
                            <div class="col-wrap">
                                <h2>All Records</h2>
                            </div>
                        </div>
                        <div class="col-4"> 
                            <div class="col-wrap d-flex">
                                <a href="<?php echo $functions->domain('add-record.php') ?>" class='btn btn-primary my-auto ml-auto'>Add a record</a>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $query=new query();

                        $result=$query->get_data(array(
                            "table_name"=>"users",
                            "column_name"=>"*",
                        ));

                     
                        if($result["status"] == 1):

                            if($result['num_rows'] > 0):

                    ?>
                    <div class="row  mt-4">
                        <div class="col-12">
                            <div class="col-wrap">
                                <table class='table table-bordered table-striped'>
                                    <thead>
                                        <tr>
                                            <th>Seial No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>City</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $a=0;
                                            foreach($result["fetch_all"] as $key=>$value){
                                                $a++;
                                                $url=$functions->domain("edit-record.php?id={$value['id']}");
                                                echo "
                                                    <tr>
                                                        <td>{$a}</td>
                                                        <td>{$value['first_name']}</td>
                                                        <td>{$value['last_name']}</td>
                                                        <td>{$value['age']}</td>
                                                        <td>{$value['gender']}</td>
                                                        <td>{$value['city']}</td>
                                                        <td>
                                                            <a href='{$url}' class='btn btn-edit'>
                                                                <i class='fa fa-edit'></i>
                                                            </a>
                                                            <button type='button' class='btn btn-delete' data-id='{$value['id']}'>
                                                                <i class='fa fa-trash'></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                
                                                ";
                                            }
                                        
                                        ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                                
                    <?php   else:
                                echo "
                                    <div class='row'>
                                        <div class='col-12'>
                                            <div class='col-wrap'>
                                                <h3>No record found</h3>
                                            </div>
                                        </div>
                                    </div>
                                ";

                            endif;
                        else:
                            echo "
                                <div class='row'>
                                    <div class='col-12'>
                                        <div class='col-wrap'>
                                            <h3>{$result['error']}</h3>
                                        </div>
                                    </div>
                                </div>
                            ";
                             
                        endif;
                    ?>
               </div>
            </div>
        </div>
    </section>






<?php 
    include "includes/footer.inc.php";
?>


