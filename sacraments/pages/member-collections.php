<?php
include('top.php');
 ?>
         <div id="page-wrapper">

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Chirstians
                        </div>
                        <!-- /.panel-heading -->
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
												
											$result = mysqli_query($connection,"SELECT m.id,m.name, m.local_church, m.scc, l.name as l_name FROM members m,local_church l WHERE l.id = m.local_church  order by m.id DESC") 
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
		                                           
		                                            echo "<td align='center' bgcolor='#FFFFFF'>";echo "<a href='member-profile.php?id=$id'>Profile</a>"; echo "</td>";
		                                        echo "</tr>";
											}

										?>


                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

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

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true,
                "order": [[ 0, "desc" ]]
        });
    });
    </script>

</body>

</html>