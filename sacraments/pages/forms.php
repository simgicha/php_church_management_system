<?php
include('top.php');

 ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form  id="members" action="post-registration-details.php" method="post" >
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">

                        <div class="panel-heading">
                            Christian Birth Details
                        </div>
                        <div class="panel-body">
                            <div class="row">
                            	
                                	<div class="col-lg-6">

                                        <div class="form-group">

                                            <label>Register No</label>
                                            <input class="form-control" type="text" id="reg_register_no" name ="reg_register_no">
                                        </div>
                                   
                                        <div class="form-group">

                                            <label>Christian Name</label>
                                            <input class="form-control" type="text" id="full_name" name ="full_name">
                                        </div>

                                        <div class="form-group">
                                            <label>Father Name</label>
                                            <input class="form-control" type="text" id="father_name" name ="father_name">
                                        </div>

                                        <div class="form-group">
                                            <label>Mother Name</label>
                                            <input class="form-control" type="text" id="mother_name" name ="mother_name">
                                        </div>


 										<label>Date of Birth</label>
                                               <span class="asteriskField">
                                                *
                                               </span>
                                        <div class="form-group">
							                <div class='input-group date' id='datetimepicker1'>
							                    <input type='text' class="form-control" id="dob" name ="dob" placeholder="YYYY/MM/DD"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
							            </div>   


                                	</div>
                                	<!-- /.col-lg-6 (nested) -->
                                	<div class="col-lg-6">
                                    
                                   
                                        <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Born At</label>
                                            <input type="text" class="form-control"id="born_at" name ="born_at">
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="inputWarning">Address</label>
                                            <input type="text" class="form-control" id="address" name ="address">
                                        </div>
                                        <div class="form-group has-error">
                                            <label class="control-label" for="inputError">District Of Residence</label>
                                            <input type="text" class="form-control" id="recident_district" name ="recident_district">
                                        </div>
                                    
                                        <div class="form-group has-error">
                                            <label class="control-label" for="inputError">Tribe</label>
                                            <input type="text" class="form-control" id="clan" name ="clan">
                                        </div>           
                                	</div>

                       
                            	
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>


			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        	Baptism Details
                           
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                	<div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Date Of Baptism</label>

                            
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' class="form-control" id="baptism_date" name ="baptism_date" placeholder="YYYY/MM/DD"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>                                            
                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Godfather</label>
                                            <input class="form-control" type = "text" id = "murugamiriri" name= "murugamiriri">
                                        </div>

                                        <div class="form-group has-warning">
                                            <label class="control-label" for="inputWarning">Godmother</label>
                                            <input type="text" class="form-control" id="godmother" name="godmother">
                                        </div>



                                	</div>
                                	<!-- /.col-lg-6 (nested) -->
                                	<div class="col-lg-6">
                                    
                                   
                                        <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Baptism No</label>
                                            <input type="text" class="form-control" id="baptism_reg_no" name="baptism_reg_no">
                                        </div>

                                         <div class="form-group has-warning">
                                            <label class="control-label" for="inputWarning">Place/At</label>
                                            <input type="text" class="form-control" id="baptism_parish" name="baptism_parish">
                                        </div>   

                                        <div class="form-group">
                                            <label>Administering Priest</label>
                                            <input class="form-control" type = "text" id = "priest_baptism" name= "priest_baptism">
                                        </div>                
                                    
                                	</div>
                            	
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

 			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                        	First Communion Details
                           
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                	<div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Date Of First Communion *</label>
                                            
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker1'>
                                                    <input type='text' class="form-control" id="first_communion_date" name ="first_communion_date" placeholder="YYYY/MM/DD"/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Communion At</label>
                                            <input class="form-control" type = "text" id = "communion_parish" name= "communion_parish">
                                        </div>

                                	</div>

                            	
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>     


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Confirmation Details
                           
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                    <div class="col-lg-6">
                                   
                                  
                                         <label>Confirmation Date</label>
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker1'>
                                                    <input type='text' class="form-control" id="confirmation_date" name ="confirmation_date" placeholder="YYYY/MM/DD"/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Confirmation Place</label>
                                            <input class="form-control" type = "text" id = "confirmation_parish" name= "confirmation_parish">
                                        </div>


                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                    <div class="col-lg-6">
                                    
                                   
                                        <div class="form-group">
                                            <label>Confirmation Priest</label>
                                            <input class="form-control" type = "text" id = "confirmation_priest" name= "confirmation_priest">
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="inputWarning">Confirmation No</label>
                                            <input type="text" class="form-control" id="confirmation_no" name="confirmation_no">
                                        </div>
              
                                    
                                    </div>
                                
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                        Marriage Details
                           
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                    <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Marriage Date</label>
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' class="form-control" id="marriage_date" name ="marriage_date" placeholder="YYYY/MM/DD"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            
                                        </div>

                                        <div class="form-group">
                                            <label> Parish of marriage</label>
                                            <input class="form-control" type = "text" id = "parish_of_marriage" name= "parish_of_marriage">
                                        </div>
                                        <div class="form-group">
                                            <label> Presiding Priest</label>
                                            <input class="form-control" type = "text" id = "presiding_priest" name= "presiding_priest">
                                        </div>

                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                    <div class="col-lg-6">
                                         <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Spouse</label>
                                            <input type="text" class="form-control" id="spouse" name="spouse">
                                        </div>
                                   
                                        <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Marriage Certificate Number</label>
                                            <input type="text" class="form-control" id="marriage_certificate_no" name="marriage_certificate_no">
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="inputWarning">Register No</label>
                                            <input type="text" class="form-control" id="register_no" name="register_no">
                                        </div>
              
                                    
                                    </div>
                                
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                        Religious Profession
                           
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                    <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Date</label>
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' class="form-control" id="date_" name ="date_" placeholder="YYYY/MM/DD"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            
                                        </div>

                                        <div class="form-group">
                                            <label> Place/in</label>
                                            <input class="form-control" type = "text" id = "place_" name= "place_">
                                        </div>

                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                        Death Details
                           
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                    <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Date</label>
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' class="form-control" id="death_date" name ="death_date" placeholder="YYYY/MM/DD"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            
                                        </div>

                                        <div class="form-group">
                                            <label> Death Place</label>
                                            <input class="form-control" type = "text" id = "death_pace" name= "death_pace">
                                        </div>

                                    </div>
                                    <!-- /.col-lg-6 (nested) -->

                                    <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Burried At</label>
                                             <input class="form-control" type = "text" id = "burried_at" name= "burried_at">
                                            
                                        </div>


                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>



	        <div class="row">
	        	<div class="col-lg-12">
	        		<button type="submit" class="btn btn-primary">Save Member</button>
	        		<br><br>
	        	</div>
	        </div>
            <!-- /.row -->
        </div>

		</form>

		 <script  type="text/javascript">

		 	var frmvalidator = new Validator("members");
			frmvalidator.addValidation("full_name","req","Please enter your Full Name");
			frmvalidator.addValidation("full_name","maxlen=20",  "Max length for FirstName is 50");

			frmvalidator.addValidation("mother_name","req","Please enter Mothers Name");
			frmvalidator.addValidation("mother_name","maxlen=20",  "Max length for FirstName is 50");


			frmvalidator.EnableMsgsTogether();
		</script>


        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <script src="../js/bootstrap-datepicker.min.js"></script>


    <script src = "../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../js/gen_validatorv4.js"></script>


    <script>
    $(document).ready(function(){
        var date_input=$('input[name="dob"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
    </script>

    <script>
    $(document).ready(function(){
        var date_input=$('input[name="baptism_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
    </script>

    
    <script>
    $(document).ready(function(){
        var date_input=$('input[name="first_communion_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
    </script>


    <script>
    $(document).ready(function(){
        var date_input=$('input[name="confirmation_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
    </script>

    
    <script>
    $(document).ready(function(){
        var date_input=$('input[name="marriage_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
    </script>

</body>

</html>
