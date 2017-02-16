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
                    
                    



 
   Employee Payment details<br>
<input type="button" value="Print" onclick="PrintElem('#print_content')" /><img src="assets/img/print_edit.gif">
  <div id="print_content"> 
  Payslip<br>                      
<?php
	include('connect-db.php');
		$id = $_GET['id']; 
		$b_id = $_GET['id'];
		$month = $_GET['month_paying'];
		echo "Month ".$month;
		echo "<hr>";
         $result = mysqli_query($connection,"SELECT e.id, e.employee_name, e.kra_pin, e.id_no, eca.id, ec.monthly_pay FROM employees e, employee_categories ec, employee_category_assign eca WHERE e.id = $b_id AND eca.employee_id = e.id AND eca.category_id = ec.id ORDER BY e.id DESC") 
                or die("No such employee");  
        // display data in table

        while($rows=mysqli_fetch_assoc($result))
	{ // Start looping table row
	
		echo "Name :  ".$rows['employee_name']."<br>";
		echo "P.I.N : ".$rows['kra_pin']."<br>";
		echo "ID No ; ".$rows['id_no']."<br><hr>";
		echo "Basic Pay : ".$rows['monthly_pay']."<br>";
		$basic_pay = $rows['monthly_pay'];

	}
	
	include('connect-db.php');
	echo "<br>"."Deductions"."<br>";
	$result = mysqli_query($connection,"SELECT s.id, s.amount_deducted, s.salary_deduction_id, sd.deduction_description FROM salary_deductions_assign s, salary_deductions sd WHERE s.salary_deduction_id = sd.id AND s.employee_id =  ".$b_id) 
                or die("Error calculating total"); 
	while($rows=mysqli_fetch_assoc($result))
	{

		echo $rows['deduction_description']." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$rows['amount_deducted']."<br>";
		
	}
	echo "<br>";
	$result = mysqli_query($connection,"SELECT COALESCE(SUM(s.amount_deducted),0) as total_deductions FROM salary_deductions_assign s, salary_deductions sd WHERE s.salary_deduction_id = sd.id AND s.employee_id =  ".$b_id) 
                or die("Error calculating total"); 
	while($rows=mysqli_fetch_assoc($result))
	{
		$total_deductions = $rows['total_deductions'];
		echo "Total Deductions  ".$total_deductions;
	}
	
	
	
	echo "</br>";
	
 ?>	
 <hr>	
Net Pay : 	
<?php
	echo $basic_pay - $total_deductions
	
 ?>

<br>

<br>

 </div> <!--end print content -->
 <?php 
 		$result2 = mysqli_query($connection,"SELECT id, month_id, employee_id, year, COALESCE(SUM(amount),0) as amount, SUM(total_deductions), actual_amount_to_be_paid FROM monthly_salaries 	WHERE month_id = '".$month."' AND employee_id = '".$b_id."'") or die("No pending payments");
		while($rows2=mysqli_fetch_assoc($result2))
		{ // Start looping table row	
			$already_paid = 1;
			$amount_paid = $rows2['amount'];
			$actual_amount_to_be_paid = $rows2['actual_amount_to_be_paid'];
			echo "<b>Amount Already paid: ".$amount_paid."</b>";
		}
		
 ?>
 
                             <form id="member" action="post-salary.php" method="post" >        
 			                <table  class="alert-table" cellspacing="0" cellpadding="4" width="100%" border="0" id="my-editor" >
                                 
                           <tr>         
                           <td align="left" valign="top"> 
                                    <table cellspacing="0" cellpadding="2" border="0" size=40>
                                        <tr>
                                        <input class="form-control" type="hidden" name="employee_id" value="<?php echo $b_id; ?>" size=40/>
                                        <input class="form-control" type="hidden" name="month_id" value="<?php echo $month; ?>" size=40/>
                                        <input class="form-control" type="hidden" name="total_deductions" value="<?php echo $total_deductions; ?>" size=40/>
                                        <input class="form-control" type="hidden" name="basic_pay" value="<?php echo $basic_pay; ?>" size=40/>
			                                 <td>Now enter the amount paying</td>
		                                     <td><input class="form-control" type="text" name="amount" value="" placeholder="Amount paid" size=40/>
		                                     </td>
                                             <td>
                                              <span class="input-group-btn">
                                             <input type="submit" class="btn green" value="Save"  >
                                             </span>
                                             </td>
		                                </tr>

                                    </table>
                           
                           </td>
                           </tr>
                           
                           </table>
							</form>
                    </div>
                </div>
            </div>
        </div>


      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>