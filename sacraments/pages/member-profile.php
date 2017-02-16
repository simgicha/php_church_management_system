<?php
include('top.php');
 ?>

         <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Profile</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Christian Details
                        </div>
                        <div class="panel-body">
                        	<div class="dataTable_wrapper">
                                
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Full Name</th>
                                            <th>Local Church</th>
                                            <th>Scc</th>

                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php
                                            include('connect-db.php'); // Database connection using PDO
                                            $member_id = $_GET['id'];
                                            $result = mysqli_query($connection,"SELECT m.id,m.name, m.local_church, m.scc, l.name as l_name FROM members m,local_church l WHERE l.id = m.local_church AND m.id = '$member_id'  order by m.id DESC") 
                                        or die("No Chirstians");  

                                            while($rows=mysqli_fetch_assoc($result))
                                            { // Start looping table row
                        
                                                //echo $rows['id']." ".$rows['full_name'];
                                                echo "<tr class='odd gradeX'>";
                                                    $id = $rows['id'];
                                                    echo "<td>".$rows['id']."</td>";
                                                    echo "<td>".$rows['name']."</td>";
                                                    echo "<td>".$rows['l_name']."</td>";
                                                    echo "<td>".$rows['scc']."</td>";
                                                   echo "<td align='center' bgcolor='#FFFFFF'>";echo "<a href='edit.php?id=$id'>Edit</a>"; echo "</td>";
                                                   
                                                echo "</tr>";
                                            }

                                        ?>


                                    </tbody>
                                </table>
                            </div>

                        </div>
 
                    </div>
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Baptism Details
                        </div>
                        <div class="panel-body">
                        	<table width="100%">

                                        <?php
											include('connect-db.php'); // Database connection using PDO
											$member_id = $_GET['id'];
		
												
											$result = mysqli_query($connection,"SELECT m.name,b.baptism_date,b.sponser,b.priest, b.registration_no,b.baptism_parish,b.godmother FROM members m, baptism b where b.member_id = '$member_id' AND b.member_id = m.id") 
										or die("No Chirstians");  

											while($rows=mysqli_fetch_assoc($result))
											{ // Start looping table row
						
							
													echo "<tr>";
                                                    echo "<td>Name</td><td>".$rows['name']."</td>";
                                                    echo "</tr>";
                                                    echo "<tr>";
		                                            echo "<td>Baptism Date</td><td>".$rows['baptism_date']."</td>";
		                                            echo "</tr>";
                                                    echo "<tr>";
		                                            echo "<td>Baptism Parish</td><td>".$rows['baptism_parish']."</td>";
		                                            echo "</tr>";
		                                            echo "<tr>";
		                                            echo "<td>Baptism priest </td><td>".$rows['priest']."</td>";
		                                            echo "</tr>";
		                                            echo "<tr>";
		                                            echo "<td>God father</td><td>".$rows['sponser']."</td>";
		                                            echo "</tr>";
		                                         
		                                            echo "<tr>";
		                                            echo "<td>Registration No</td><td>     ".$rows['registration_no']."</td>";
		                                            echo "</tr>";
		                                       
											}
										?>
							</table>
                        </div>

                    </div>
                </div>

                                <!-- /.col-lg-4 -->
                <div class="col-lg-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            First Communion
                        </div>
                        <div class="panel-body">
                        	<table width="100%">
                                       <?php
											include('connect-db.php'); // Database connection using PDO
											$member_id = $_GET['id'];
		
												
											$result = mysqli_query($connection,"SELECT date_received, parish_received FROM eucharist where member_id = '$member_id'") 
										or die("No Chirstians");  

											while($rows=mysqli_fetch_assoc($result))
											{ // Start looping table row
						
							
													echo "<tr>";
                                                    echo "<td>Date Received</td><td>".$rows['date_received']."</td>";
                                                    echo "</tr>";
                                                    echo "<tr>";
		                                            echo "<td>Parish Received</td><td>".$rows['parish_received']."</td>";
		                                            echo "</tr>";
                                                    echo "<tr>";
		                                           
		                        
		                                       
											}
										?>
									</table>	
                        </div>

                    </div>
                </div>
               
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Confirmation Details
                        </div>
                        <div class="panel-body">
                         	<table width="100%">
                                       <?php
											include('connect-db.php'); // Database connection using PDO
											$member_id = $_GET['id'];
		
												
											$result = mysqli_query($connection,"SELECT place, priest, registration_no,confirmation_no, confirmation_date FROM confirmation where member_id = '$member_id'") 
										or die("No Chirstians");  

											while($rows=mysqli_fetch_assoc($result))
											{ // Start looping table row
						
							
													echo "<tr>";
                                                    echo "<td>Confirmation Date</td><td>".$rows['confirmation_date']."</td>";
                                                    echo "</tr>";
                                                    echo "<tr>";
		                                            echo "<td>Parish Confirmed</td><td>".$rows['place']."</td>";
		                                            echo "</tr>";
                                                    echo "<tr>";
		                                            echo "<td>Confirmation Priest</td><td>".$rows['priest']."</td>";
		                                            echo "</tr>";
                                                    echo "<tr>";
                                                    echo "<td>Register No</td><td>".$rows['registration_no']."</td>";
		                                            echo "</tr>";
                                                    echo "<tr>";
                                                    echo "<td>Confirmation No</td><td>".$rows['confirmation_no']."</td>";
		                                            echo "</tr>";
                                                    echo "<tr>";		                                           
		                        
		                                       
											}
										?>
							</table>	                           
                        </div>

                    </div>
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            Matrimony Details
                        </div>
                        <div class="panel-body">
                            <table width="100%">
                                       <?php
											include('connect-db.php'); // Database connection using PDO
											$member_id = $_GET['id'];
		
												
											$result = mysqli_query($connection,"SELECT married_to, marriage_date, marriage_parish,priest, marriage_no, register_no,marriage_certificate_no FROM marriage where member_id = '$member_id'") 
										or die("No Chirstians");  

											while($rows=mysqli_fetch_assoc($result))
											{ // Start looping table row
						
							
													echo "<tr>";
                                                    echo "<td>Marriage Date</td><td>".$rows['marriage_date']."</td>";
                                                    echo "</tr>";
                                                    echo "<tr>";
		                                            echo "<td>Married To</td><td>".$rows['married_to']."</td>";
		                                            echo "</tr>";
                                                    echo "<tr>";
		                                            echo "<td>Presiding Priest</td><td>".$rows['priest']."</td>";
		                                            echo "</tr>";
                                                    echo "<tr>";
                                                    echo "<td>Parish</td><td>".$rows['marriage_parish']."</td>";
		                                            echo "</tr>";
                                                    echo "<tr>";
                                                    echo "<td>Marriage Cerificate No</td><td>".$rows['marriage_certificate_no']."</td>";
		                                            echo "</tr>";
                                                    echo "<tr>";		
                                                    echo "<td>Register No</td><td>".$rows['register_no']."</td>";
		                                            echo "</tr>";
                                                    echo "<tr>";                                                                                               
		                        
		                                       
											}
										?>
							</table>	
                        </div>

                    </div>
                </div>
               
            </div>

              <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            Religious Profession
                        </div>
                        <div class="panel-body">
                            <table width="100%">
                                       <?php
											include('connect-db.php'); // Database connection using PDO
											$member_id = $_GET['id'];
		
												
											$result = mysqli_query($connection,"SELECT date, place FROM religious_profession where member_id = '$member_id'") 
										or die("No Chirstians");  

											while($rows=mysqli_fetch_assoc($result))
											{ // Start looping table row
						
							
													echo "<tr>";
                                                    echo "<td>Date</td><td>".$rows['date']."</td>";
                                                    echo "</tr>";
                                                    echo "<tr>";
		                                            echo "<td>Place</td><td>".$rows['place']."</td>";
		                                            echo "</tr>";
                                                    echo "<tr>";
		                                           
											}
										?>
							</table>	                           
                        </div>

                    </div>
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            Death Details
                        </div>
                        <div class="panel-body">
                           <table width="100%">
                                       <?php
											include('connect-db.php'); // Database connection using PDO
											$member_id = $_GET['id'];
		
												
											$result = mysqli_query($connection,"SELECT death_date, death_place, buried_at FROM death where member_id = '$member_id'") 
										or die("No Chirstians");  

											while($rows=mysqli_fetch_assoc($result))
											{ // Start looping table row
						
							
													echo "<tr>";
                                                    echo "<td>Death Date</td><td>".$rows['death_date']."</td>";
                                                    echo "</tr>";
                                                    echo "<tr>";
		                                            echo "<td>Place Of Death</td><td>".$rows['death_place']."</td>";
		                                            echo "</tr>";
                                                    echo "<tr>";
		                                            echo "<td>Buried At</td><td>".$rows['buried_at']."</td>";
		                                            echo "</tr>";
                                                    echo "<tr>";
                                                                                                                                        
		                        
		                                       
											}
										?>
							</table>	
                        </div>

                    </div>
                </div>
               
            </div>
            
        </div>
 
            
        </div>

        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>