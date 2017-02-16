
<?php include("top.php"); ?>
      <!-- BEGIN PAGE -->
      <div class="page-content" style="min-height:590px !important">
  
          <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i>Reports
                    <span>>> </span>Tithes Report
                </div>
                <div class="tools">
                </div>
            </div>
            
            

            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <div class="tab-content">
                        Below are the different tithes opened. To view a tithes details, select on the tithe byy clicking <b>view details</b> alongside each tithe
                        
<?php
	include('connect-db.php');

         $result = mysqli_query($connection,"SELECT id, Year, description, target, status FROM ten_percent_configuration") 
                or die("No tithes open");
        // display data in table
		
        echo"<table width=\"100%\" height='30' border=3 align=center cellpadding=1 cellspacing=1 bgcolor=\"#CCCCCC\">";
        echo "	<tr height=30px>
		<td width=\10%\ align=center bgcolor=\"#E6E6E6\"><strong>id</strong></td>
		<td bgcolor=\"#E6E6E6\"><strong>Tithe Year</strong></td>	
		<td align=center bgcolor=\"#E6E6E6\"><strong>Description</strong></td>
        
		<td align=center bgcolor=\"#E6E6E6\"><strong>Target</strong></td>
		<td align=center bgcolor=\"#E6E6E6\"><strong>Details</strong></td>
	</tr>";	
        while($rows=mysqli_fetch_assoc($result))
	{ // Start looping table row
	echo "<tr>";
		$id = $rows['id'];
		echo "<td align='center' height='30px' bgcolor='#FFFFFF'>";echo ($rows['id']); echo "</td>";
		echo "<td align='center' bgcolor='#F3F3F3'>";echo $rows['Year']; echo "</td>";
		echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['description']; echo "</td>";
		echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['target']; echo "</td>";
		echo "<td align='center' bgcolor='#FFFFFF'>";echo "<a href='tithes_report.php?id=$id'>View Details</a>"; echo "</td>";
	echo "</tr>	";
	}	
	echo "</table>";	
 ?>
                    </div>
                </div>
            </div>
        </div>


      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>