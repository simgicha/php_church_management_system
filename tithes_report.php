<?php
session_start();
if(!isset($_SESSION['myusername'])){
header('location: index.php');
}
?>
<?php include("top.php"); ?>
      <!-- BEGIN PAGE -->
      <?php 
	  		$b_id = $_GET['id'];
	   		$_SESSION['tithe_id']=$b_id;
	   ?>
      <div class="page-content" style="min-height:590px !important">
      
           <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Tithes
                    <span> >> </span>Tithes Report
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">

<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& form &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->
                                     <style>
                                       
                                        table.alert-table tr td{
                                            padding:3px 3px;
                                            font-size: 14px;                                        
                                        }
										fieldset{
											width:40%;
											margin:auto;
											
											background-color:#4B8DF8;
											border:solid #333;
										}
										legend{
										}
                                    </style>
   
                                    
    <script>

        function createChartTithes() {
            $("#titheschart").kendoChart({
                theme: "silver",
                title: {
                    text: "Tithes Per Church"
                },
                legend: {
                    position: "top"
                },
                dataSource: {
					schema: {
						data: 'data'		
					},
				
                    transport: {

                        read: function (options) {
                            $.ajax({
                                type: "PUT",
                                dataType: "json",
                                url: 'data/get_church_tithes_count.php',
                                contentType: "application/json; charset=UTF-8",
                               
                            }).done(function (data) {
                                options.success(data);
                            }).fail(function (jqXHR) {
                                options.error(jqXHR);
                            });

                        },
                    },
					

                    group: {
                        field: "name"
                    }
                },
                transitions: true,
                series: [{
                    type: "column",
                    field: "tithes_amount"
                }],
				tooltip: {
                    visible: true,
                    template: "#= series.name #: #= value #"
                }
            });
        }

        $(document).ready(createChartTithes);
        $(document).bind("kendo:skinChange", createChartTithes);
    </script>
    
    <input type="button" value="Print" onclick="PrintElem('#print_content')"  /><img src="assets/img/print_edit.gif"><br><br>
 
  <div id="print_content"> 
  
              <div class="col-md-6 col-sm-6">
                <!-- BEGIN PORTLET-->
                <div class="portlet solid light-grey bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bullhorn"></i>
                            Tithes Per Church
        
                        </div>
                        <div class="tools">
                            <div class="btn-group pull-right" data-toggle="buttons">
                               
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="titheschart" style="width: 100%; height: 350px; margin: 0 auto;">
                           
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
                <br>	
                
                        <?php
	include('connect-db.php');
	
			$b_id = $_GET['id'];
		
         $result = mysqli_query($connection,"SELECT  SUM(t.amount) as tithes_amount, m.local_church, l.name FROM ten_percent_contributions t, members m, local_church l WHERE m.id = t.member_id AND l.id = m.local_church AND t.tithe_id = '$b_id' GROUP BY m.local_church ORDER BY SUM(t.amount) DESC") 
                or die("No orders in the table orders");  
        // display data in table
		
        echo"<table width=\"100%\" height='30' style='border: 2px solid #E6E6E6;' align=center cellpadding=1 cellspacing=1 bgcolor=\"#CCCCCC\">";
        echo "	<tr height=30px style='border: 1px solid #E6E6E6;'>
		<td width=\10%\ align=left bgcolor=\"#E6E6E6\"><strong>Church</strong></td>
		<td bgcolor=\"#E6E6E6\"><strong>tithes amount(Ksh)</strong></td>	


	</tr>";	
        while($rows=mysqli_fetch_assoc($result))
	{ // Start looping table row
	echo "<tr style='border: 1px solid #E6E6E6;'>";
		echo "<td align='left' height='30px' bgcolor='#FFFFFF'>";echo ($rows['name']); echo "</td>";

		echo "<td align='left' bgcolor='#FAFAFA'>";echo $rows['tithes_amount']; echo "</td>";

	echo "</tr>	";
	}	
	echo "</table>";	
	

	
 ?>			
  </div> <!-- End prin_content-->
            
      <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br>      <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br><br><br><br><br> <br><br><br><br>
 
 <!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& end form &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->  

  

            </div>
        </div>      

      </div>
      <!-- END PAGE -->

   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>