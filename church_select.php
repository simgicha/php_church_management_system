
<?php include("top.php"); ?>
      <!-- BEGIN PAGE -->
      <div class="page-content" style="min-height:590px !important">
  
          <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i>Christians
                    <span>>> </span>Adding New Christians
                </div>
                <div class="tools">
                </div>
            </div>
            
            

            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <div class="tab-content">
                        Select The Christians Local Church
                        
<?php
	include('connect-db.php');

         $result = mysqli_query($connection,"SELECT id, name, Location FROM local_church ORDER BY name ASC") 
                or die("No tithes open");
        // display data in table
		
        echo"<table width=\"100%\" height='30' border=3 align=center cellpadding=1 cellspacing=1 bgcolor=\"#CCCCCC\">";
        echo "	<tr height=30px>
		<td width=\10%\ align=center bgcolor=\"#E6E6E6\"><strong>Id</strong></td>
		<td bgcolor=\"#E6E6E6\"><strong>Local Church Name</strong></td>	
		<td align=center bgcolor=\"#E6E6E6\"><strong>Location</strong></td>

		<td align=center bgcolor=\"#E6E6E6\"><strong>Select</strong></td>
	</tr>";	
        while($rows=mysqli_fetch_assoc($result))
	{ // Start looping table row
	echo "<tr>";
		$id = $rows['id'];
		echo "<td align='center' height='30px' bgcolor='#FFFFFF'>";echo ($rows['id']); echo "</td>";
		echo "<td align='center' bgcolor='#F3F3F3'>";echo $rows['name']; echo "</td>";
		echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['Location']; echo "</td>";
	
		echo "<td align='center' bgcolor='#FFFFFF'>";echo "<a href='members-profiles.php?id=$id'>View Details</a>"; echo "</td>";
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