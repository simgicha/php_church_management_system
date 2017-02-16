<?php
session_start();
if(!isset($_SESSION['myusername'])){
header('location: index.php');
}
?>
<?php include("top.php"); ?>
      <!-- BEGIN PAGE -->
  <script>
function printPage(id)
{
   var html="<html>";
   html+= document.getElementById(id).innerHTML;

   html+="</html>";

   var printWin = window.open('','','left=0,top=0,width=1,height=1,toolbar=0,scrollbars=0,status  =0');
   printWin.document.write(html);
   printWin.document.close();
   printWin.focus();
   printWin.print();
   printWin.close();
}
</script>    
                          <script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=650, height=600, left=100, top=25"; 
  var content_vlue = document.getElementById("page-content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>Inel Power System</title>'); 
   docprint.document.write('</head><body onLoad="self.print()"><center>');          
   docprint.document.write(content_vlue);          
   docprint.document.write('</center></body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
      <div class="page-content" style="min-height:590px !important">
  
          <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i>BUDGET
                    <span>>> </span>Budget Balances
                </div>
                <div class="tools">
                </div>
            </div>
            
            

            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <div class="tab-content">
                    
                    <h4>Budget Expenditure Details</h4>

<br>
<input type="button" value="Print" onclick="PrintElem('#print_content')" /><img src="assets/img/print_edit.gif">
  <div id="print_content"> 
                     
<?php
	include('connect-db.php');
		$id = $_GET['id']; 
		$b_id = $_GET['id'];
		
	$result = mysqli_query($connection,"SELECT ref_no FROM budget_ref WHERE id = $b_id") 
                or die("Error calculating total"); 
	while($rows=mysqli_fetch_assoc($result))
	{
		$budget_name = $rows['ref_no'];
		echo "<h4>BUDGET: $budget_name </h4>";
	}
		
         $result = mysqli_query($connection,"SELECT b.id, b.source, b.amount,b.income_type,b.date_of_income, b.type, b.budget_transfer FROM budget_incomes_expenses b WHERE b.budget_id = '$b_id' ORDER BY b.id DESC") 
                or die("No transactions on that budget");  
        // display data in table

        echo"<table width=\"100%\" height='30' style='border: 2px solid #E6E6E6;' align=center cellpadding=1 cellspacing=1 bgcolor=\"#CCCCCC\">";
        echo "	<tr height=35px style='border: 1px solid #E6E6E6;'>
		<td width=\10%\ align=left bgcolor=\"#E6E6E6\"><strong>Source</strong></td>
		<td bgcolor=\"#E6E6E6\"><strong>Debit(Income)</strong></td>	
		<td bgcolor=\"#E6E6E6\"><strong>Credit(Expense)</strong></td>	
		<td align=center bgcolor=\"#E6E6E6\"><strong>Date</strong></td> 

	</tr>";	
    while($rows=mysqli_fetch_assoc($result))
	{ // Start looping table row
	echo "<tr style='border: 1px solid #E6E6E6;'>";
		$id = $rows['id'];
		$budget_transfer_id = $rows['budget_transfer'];
		$budget_transfer = "";
		
		$result2 = mysqli_query($connection,"SELECT ref_no FROM budget_ref WHERE id = '$budget_transfer_id'") 
					or die("Error calculating total");
		while($rowss=mysqli_fetch_assoc($result2))
		{
			$budget_transfer = $rowss['ref_no'];
		}		
		
		echo "<td align='left' height='25px' bgcolor='#FFFFFF'>";echo ($rows['source']." ".$budget_transfer); echo "</td>";
		$type = $rows['type'];
		if($type == 1){
			echo "<td align='left' bgcolor='#FAFAFA'>";echo $rows['amount']; echo "</td>";
			echo "<td align='left' bgcolor='#FAFAFA'>";echo "-"; echo "</td>";			
		}
		else{
			echo "<td align='left' bgcolor='#FAFAFA'>";echo "-"; echo "</td>";
			echo "<td align='left' bgcolor='#FAFAFA'>";echo $rows['amount']; echo "</td>";				
		}
		echo "<td align='left' bgcolor='#FFFFFF'>";echo $rows['date_of_income']; echo "</td>";
		echo "</tr>	";
	}	
	include('connect-db.php');
	$debit = 0;
	$credit = 0;
	echo "<tr height=30px style='border: 1px solid #E6E6E6;'>";	
	echo "<td align='left' bgcolor='#bd6f2f'>";echo 'Totals'; echo "</td>";
	
	$result = mysqli_query($connection,"SELECT COALESCE(SUM(amount),0) as debit FROM budget_incomes_expenses WHERE type = 1 AND budget_id = '".$b_id."'") 
                or die("Error calculating total"); 
	while($rows=mysqli_fetch_assoc($result))
	{
		$debit = $rows['debit'];
		
	}
	
	$result = mysqli_query($connection,"SELECT COALESCE(SUM(amount),0) as credit FROM budget_incomes_expenses WHERE budget_id = '$b_id' AND type = 2") 
                or die("Error calculating total");
	while($rows=mysqli_fetch_assoc($result))
	{
		$credit = $rows['credit'];
	}
	
	echo "<td align='left' bgcolor='#bd6f2f'>";echo $debit; echo "</td>";
	echo "<td align='left' bgcolor='#bd6f2f'>";echo $credit; echo "</td>";
	echo "<td align='left' bgcolor='#bd6f2f'>";echo ''; echo "</td>";
	echo "</tr>	";
		
	echo "</table>";	
	
	echo "</br>";
	echo "<b>Net Balance: ";
	echo "".$debit-$credit;
	echo " Ksh</b>";
	
	
 ?>		


<br><br>
 </div> <!--end print content -->
                    </div>
                </div>
            </div>
        </div>


      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>