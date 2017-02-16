<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                            include('connect-db.php'); // Database connection using PDO
                                                
                                            $result = mysqli_query($connection,"SELECT COUNT(*) as recs FROM baptism") 
                                        or die("No Chirstians");  

                                            while($rows=mysqli_fetch_assoc($result))
                                            { // Start looping table row
                                                echo "<div class='huge'>".$rows['recs']."</div> ";   
                                            }

                                        ?>
                                    
                                    <div>Baptised Chirstians</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        include('connect-db.php'); // Database connection using PDO
                                                
                                        $result = mysqli_query($connection,"SELECT COUNT(*) as recs FROM confirmation") 
                                        or die("No Chirstians");  

                                        while($rows=mysqli_fetch_assoc($result))
                                        { // Start looping table row
                                            echo "<div class='huge'>".$rows['recs']."</div> ";   
                                        }

                                    ?>
                                    <div>Confirmed Chistians</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        include('connect-db.php'); // Database connection using PDO
                                                
                                        $result = mysqli_query($connection,"SELECT COUNT(*) as recs FROM eucharist") 
                                        or die("No Chirstians");  

                                        while($rows=mysqli_fetch_assoc($result))
                                        { // Start looping table row
                                            echo "<div class='huge'>".$rows['recs']."</div> ";   
                                        }

                                    ?>
                                   
                                    <div>Christians given Eucharist</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        include('connect-db.php'); // Database connection using PDO
                                                
                                        $result = mysqli_query($connection,"SELECT COUNT(*) as recs FROM marriage") 
                                        or die("No Chirstians");  

                                        while($rows=mysqli_fetch_assoc($result))
                                        { // Start looping table row
                                            echo "<div class='huge'>".$rows['recs']."</div> ";   
                                        }

                                    ?>
                                   
                                    <div>Marriage Sacraments!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

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

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>