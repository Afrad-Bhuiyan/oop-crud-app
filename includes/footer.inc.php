    </main> 
    <script>
        $(document).ready(function(){
         

            
            //validating add record form
            $(".add-records form button[type='submit']").click(function(e){
                e.preventDefault();
                const formData=$(".add-records form").serializeArray();
                const formDataObj={};

                for(let i=0; i < formData.length; i++){
                    formDataObj[formData[i].name]=formData[i].value;
                }

                
                formDataObj.request=true;

                $.ajax({
                    url:"<?php echo $functions->domain("backend/save-record.php") ?>",
                    type:"POST",
                    data:formDataObj,
                    dataType:"json",
                    success:function(response){
                        
                        $(".add-records form .form-field .error-msg").remove();

                        if(response==1){

                            $(".add-records form").trigger('reset');

                            window.location.href="<?php echo $functions->domain(); ?>";

                        }else if(response==0){

                            alert("Couldn't be added the value. Please try again");

                        }else{

                            for(const key in response){
                                $(`${response[key].target}`).append(response[key].error_msg);
                            }
                        }

                    }
                })

            })

            //deleting records
            $(".all-records .btn-delete").click(function(){

                if(confirm("This action can't be undo. Are you sure to delete the record")){
                    $.ajax({
                        url:"<?php echo $functions->domain("backend/delete-record.php"); ?>",
                        type:"POST",
                        data:{
                            
                            record_id:$(this).data("id"),
                            request:true

                        },
                        success:function(response){

                            if(response==1){
                                
                                window.location.href="<?php echo $functions->domain(); ?>";
                                
                            }else{

                                alert("Couldn't be deleted the record. Please try again");
                            }
                        }
                    })
                }
            })

            // updating record
            $(".edit-records form .update-btn button").click(function(e){
                
                e.preventDefault();

                const formData=$(".edit-records form").serializeArray();
                const formDataObj={};

                for(let i=0; i < formData.length; i++){
                    formDataObj[formData[i].name]=formData[i].value;
                }
                
                formDataObj.request=true;

                $.ajax({
                    url:"<?php echo $functions->domain('backend/update-record.php') ?>",
                    type:"POST",
                    data:formDataObj,
                    dataType:"json",
                    success:function(response){

                        $(".edit-records form .form-field .error-msg").remove();
                   
                        if(response==1){
                            $(".edit-records form").trigger("reset");

                            window.location.href="<?php echo $functions->domain(); ?>"

                        }else if(response==0){

                            alert("Could not be updated. Please try again");

                        }else{

                            for(const key in response){
                                
                                $(`${response[key].target}`).append(`${response[key].error_msg}`);

                            }
                            
                        }


                    }
                })
                
            })





        })
    </script>
</body>
</html>