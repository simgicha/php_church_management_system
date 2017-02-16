
<?php
session_start();
if(!isset($_SESSION['myusername'])){
header('location: index.php');
}
?>
<?php include("top.php"); ?>

      <?php 
        

        
     ?>

      <!-- BEGIN PAGE -->
      <div class="page-content" style="min-height:590px !important">
      
           <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>List of All tithes
                    <span> >> </span>Tithes List
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">Tithes</a></li>  
                    </ul>
                    <div class="tab-content">







    <div id="wrapper">



        <div id="page-wrapper">

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
   
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                           <th>No</th>
                                            <th>Member Name</th>
                                            <th>Scc</th>
                                            <th>Amount</th>
                                            <th>Tithe</th>
                                            <th>Date Added</th>
                                            <th>Edit</th>
                                           
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                 

                                          <?php
                                            include('connect-db.php'); // Database connection using PDO
                        
                                            $result = mysqli_query($connection,"SELECT t.id, t.member_id, m.name, t.amount, t.sync_datetime, tc.description,s.name as scc_name FROM ten_percent_contributions t, members m, ten_percent_configuration tc,small_christian_community s WHERE m.id = t.member_id AND tc.id = t.tithe_id AND m.scc = s.id order by t.id DESC") or die("No Chirstians");  

                                            while($rows=mysqli_fetch_assoc($result))
                                            { // Start looping table row
                                  
                                              //echo $rows['id']." ".$rows['full_name'];
                                                echo "<tr class='odd gradeX'>";
                                                $id = $rows['id'];
                                                echo "<td>".$rows['id']."</td>";
                                                echo "<td>".$rows['name']."</td>";
                                                echo "<td>".$rows['scc_name']."</td>";
                                                echo "<td>".$rows['amount']."</td>";
                                                echo "<td>".$rows['description']."</td>";
                                                echo "<td>".$rows['sync_datetime']."</td>";
                                               
                                                                     
                                                echo "<td align='center' bgcolor='#FFFFFF'>";echo "<a href='tithe-edit.php?id=$id'>Edit/Delete</a>"; echo "</td>";
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
            
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

       <!-- BEGIN FOOTER -->
   <div class="footer">
      <div class="footer-inner">
         Copyright(c)simgicha -. All Rights Reserved. 
      </div>
      <div class="footer-tools">
         <span class="go-top">
         <i class="icon-angle-up"></i>
         </span>
      </div>
   </div>
   <!-- END FOOTER -->
   <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
   <!-- BEGIN CORE PLUGINS -->   
   <!--[if lt IE 9]>
   <script src="assets/plugins/respond.min.js"></script>
   <script src="assets/plugins/excanvas.min.js"></script> 
   <![endif]-->   
   <script src="assets/plugins/jquery-1.10.2.min1.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>   
   <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
   <script src="assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
   <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
   <script src="assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
   <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
   <!-- END CORE PLUGINS -->
   <!-- BEGIN PAGE LEVEL PLUGINS -->
   <script src="assets/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>   
   <script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
   <script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
   <script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
   <script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>



    <!-- jQuery -->
    <script src="bower/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="bower/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>


    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true,
                "order": [[ 0, "desc" ]]
        });
    });
    </script>



   <script src="assets/plug   &lt;script src=" assets="" plugins="" flot="" jquery.flot.js"="" type="text/javascript"></script>
   <script src="assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
   <script src="assets/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
   <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>     
   <script src="assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
   <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
   <script src="assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>  
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="assets/scripts/app.js" type="text/javascript"></script>
   <script src="assets/scripts/index.js" type="text/javascript"></script>
   <script src="assets/scripts/tasks.js" type="text/javascript"></script>        
   <!-- END PAGE LEVEL SCRIPTS -->  
   <script>
      jQuery(document).ready(function() {    
         App.init(); // initlayout and core plugins
         Index.init();
         Index.initJQVMAP(); // init index page's custom scripts
         Index.initCalendar(); // init index page's custom scripts
         Index.initCharts(); // init index page's custom scripts
         Index.initChat();
         Index.initMiniCharts();
         Index.initDashboardDaterange();
         Index.initIntro();
         Tasks.initDashboardWidget();
      });
   </script>
   <!-- END JAVASCRIPTS -->

<!-- END BODY -->
<div class="jqvmap-label"></div><div class="jqvmap-label"></div><div class="jqvmap-label"></div><div class="jqvmap-label"></div><div class="jqvmap-label"></div><div class="daterangepicker dropdown-menu opensleft"><div class="calendar left"><div class="calendar-date"><table class="table-condensed"><thead><tr><th></th><th class="prev available"><i class="icon-arrow-left icon-angle-left"></i></th><th colspan="5" style="width: auto">September 2014</th><th class="next available"><i class="icon-arrow-right icon-angle-right"></i></th></tr><tr><th class="week">W</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th><th>Su</th></tr></thead><tbody><tr><td class="week">35</td><td class="available off" data-title="r0c0">25</td><td class="available off" data-title="r0c1">26</td><td class="available off" data-title="r0c2">27</td><td class="available off" data-title="r0c3">28</td><td class="available off" data-title="r0c4">29</td><td class="available off" data-title="r0c5">30</td><td class="available off" data-title="r0c6">31</td></tr><tr><td class="week">36</td><td class="available" data-title="r1c0">1</td><td class="available" data-title="r1c1">2</td><td class="available active start-date" data-title="r1c2">3</td><td class="available in-range" data-title="r1c3">4</td><td class="available in-range" data-title="r1c4">5</td><td class="available in-range" data-title="r1c5">6</td><td class="available in-range" data-title="r1c6">7</td></tr><tr><td class="week">37</td><td class="available in-range" data-title="r2c0">8</td><td class="available in-range" data-title="r2c1">9</td><td class="available in-range" data-title="r2c2">10</td><td class="available in-range" data-title="r2c3">11</td><td class="available in-range" data-title="r2c4">12</td><td class="available in-range" data-title="r2c5">13</td><td class="available in-range" data-title="r2c6">14</td></tr><tr><td class="week">38</td><td class="available in-range" data-title="r3c0">15</td><td class="available in-range" data-title="r3c1">16</td><td class="available in-range" data-title="r3c2">17</td><td class="available in-range" data-title="r3c3">18</td><td class="available in-range" data-title="r3c4">19</td><td class="available in-range" data-title="r3c5">20</td><td class="available in-range" data-title="r3c6">21</td></tr><tr><td class="week">39</td><td class="available in-range" data-title="r4c0">22</td><td class="available in-range" data-title="r4c1">23</td><td class="available in-range" data-title="r4c2">24</td><td class="available in-range" data-title="r4c3">25</td><td class="available in-range" data-title="r4c4">26</td><td class="available in-range" data-title="r4c5">27</td><td class="available in-range" data-title="r4c6">28</td></tr><tr><td class="week">40</td><td class="available in-range" data-title="r5c0">29</td><td class="available in-range" data-title="r5c1">30</td><td class="available off in-range" data-title="r5c2">1</td><td class="available off in-range end-date" data-title="r5c3">2</td><td class="available off" data-title="r5c4">3</td><td class="available off" data-title="r5c5">4</td><td class="available off" data-title="r5c6">5</td></tr></tbody></table></div></div><div class="calendar right"><div class="calendar-date"><table class="table-condensed"><thead><tr><th></th><th class="prev available"><i class="icon-arrow-left icon-angle-left"></i></th><th colspan="5" style="width: auto">October 2014</th><th class="next available"><i class="icon-arrow-right icon-angle-right"></i></th></tr><tr><th class="week">W</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th><th>Su</th></tr></thead><tbody><tr><td class="week">40</td><td class="available off in-range" data-title="r0c0">29</td><td class="available off in-range" data-title="r0c1">30</td><td class="available in-range" data-title="r0c2">1</td><td class="available active end-date" data-title="r0c3">2</td><td class="available" data-title="r0c4">3</td><td class="available" data-title="r0c5">4</td><td class="available" data-title="r0c6">5</td></tr><tr><td class="week">41</td><td class="available" data-title="r1c0">6</td><td class="available" data-title="r1c1">7</td><td class="available" data-title="r1c2">8</td><td class="available" data-title="r1c3">9</td><td class="available" data-title="r1c4">10</td><td class="available" data-title="r1c5">11</td><td class="available" data-title="r1c6">12</td></tr><tr><td class="week">42</td><td class="available" data-title="r2c0">13</td><td class="available" data-title="r2c1">14</td><td class="available" data-title="r2c2">15</td><td class="available" data-title="r2c3">16</td><td class="available" data-title="r2c4">17</td><td class="available" data-title="r2c5">18</td><td class="available" data-title="r2c6">19</td></tr><tr><td class="week">43</td><td class="available" data-title="r3c0">20</td><td class="available" data-title="r3c1">21</td><td class="available" data-title="r3c2">22</td><td class="available" data-title="r3c3">23</td><td class="available" data-title="r3c4">24</td><td class="available" data-title="r3c5">25</td><td class="available" data-title="r3c6">26</td></tr><tr><td class="week">44</td><td class="available" data-title="r4c0">27</td><td class="available" data-title="r4c1">28</td><td class="available" data-title="r4c2">29</td><td class="available" data-title="r4c3">30</td><td class="available" data-title="r4c4">31</td><td class="available off" data-title="r4c5">1</td><td class="available off" data-title="r4c6">2</td></tr><tr><td class="week">45</td><td class="available off" data-title="r5c0">3</td><td class="available off" data-title="r5c1">4</td><td class="available off" data-title="r5c2">5</td><td class="available off" data-title="r5c3">6</td><td class="available off" data-title="r5c4">7</td><td class="available off" data-title="r5c5">8</td><td class="available off" data-title="r5c6">9</td></tr></tbody></table></div></div><div class="ranges"><ul><li>Today</li><li>Yesterday</li><li>Last 7 Days</li><li class="active">Last 30 Days</li><li>This Month</li><li>Last Month</li><li>Custom Range</li></ul><div class="range_inputs"><div class="daterangepicker_start_input" style="float: left"><label for="daterangepicker_start">From</label><input class="input-mini" type="text" name="daterangepicker_start" value="" disabled="disabled"></div><div class="daterangepicker_end_input" style="float: left; padding-left: 11px"><label for="daterangepicker_end">To</label><input class="input-mini" type="text" name="daterangepicker_end" value="" disabled="disabled"></div><button class="blue applyBtn btn">Apply</button>&nbsp;<button class="default cancelBtn btn">Cancel</button></div></div></div><script src="assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>  
<div class="jqvmap-label"></div><div class="jqvmap-label"></div><div class="jqvmap-label"></div><div class="jqvmap-label"></div></body></html>




