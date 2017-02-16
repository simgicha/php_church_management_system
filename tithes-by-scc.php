
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
                        <b><h2>Tithes By Scc</h2></b>.

                        <br>Please select the Local Church and the tithe to view individual contribuitions
                        
   

                               
                                    
                            <form name = "members-tithes" id="members-tithes" action="tithes-by-scc-view.php" method="post">        
                      <table  class="alert-table" cellspacing="0" cellpadding="4" width="100%" border="0" id="my-editor" >
                                 
                           <tr>
                           <td align="left" valign="top">
                                <table cellspacing="0" cellpadding="2"  >
                                     <tr>
                                       <td width="140" border="0">Select Local Church</td>
                                         <td border="0">

                                             
                        <?php
                         include('connect-db.php'); // Database connection using PDO
                        
                          $result = mysqli_query($connection,"SELECT l.name as local_church, l.id as l_id FROM local_church l order by local_church") or die("No Buildings are added");  

  
                          echo "<select name=local_church_id value='' class='form-control combobox_ui';>Scc</option>";   
                          echo "<option value='000'>-- Select Local Church --</option>";                                                                  echo "<option value=''>-- Select --</option>";
                          while($rows=mysqli_fetch_assoc($result))
                          { // Start looping table row
              
                          $da = $rows[local_church];
                          //foreach ($dbo->query($sql) as $row){//Array or records stored in $row
                          echo "<option value=$rows[l_id]>$da</option>";
                          /* Option values are added by looping through the array */
                          }
                          echo "</select>";// Closing of list box
                          
                        ?>
                                          </td>
                                    </tr>
                           
                                       
                                          <tr>
                                            <td border="0">Tithe Year</td>   
                                            <td border =  "0">
                                            <?php
                         include('connect-db.php'); // Database connection using PDO
                        
                        $result = mysqli_query($connection,"SELECT description,id FROM ten_percent_configuration WHERE status ='true' order by id") 
                    or die("No Buildings are added");  

                        echo "<select name=tithe_id value='' class='form-control combobox_ui';>Tithe Year</option>"; 
                        echo "<option value='000'>-- Select tithe --</option>";
                        while($rows=mysqli_fetch_assoc($result))
                        { // Start looping table row
            
                        //foreach ($dbo->query($sql) as $row){//Array or records stored in $row
                        echo "<option value=$rows[id]>$rows[description]</option>";
                        /* Option values are added by looping through the array */
                        }
                        echo "</select>";// Closing of list box
                        
                      ?>
                                             

                                        </td>
                                        </tr>   


                                      <tr>
                                            <td border="0">Select Month</td>   
                                            <td border =  "0">
                                            <?php
                         include('connect-db.php'); // Database connection using PDO
                        
                        $result = mysqli_query($connection,"SELECT id,month FROM months") 
                    or die("No Buildings are added");  

                        echo "<select name=month value='' class='form-control combobox_ui';>Month</option>"; 
                        echo "<option value='000'>-- Select Month --</option>";
                        while($rows=mysqli_fetch_assoc($result))
                        { // Start looping table row
            
                        //foreach ($dbo->query($sql) as $row){//Array or records stored in $row
                        echo "<option value=$rows[id]>$rows[month]</option>";
                        /* Option values are added by looping through the array */
                        }
                        echo "</select>";// Closing of list box
                        
                      ?>
                                             

                                        </td>
                                        </tr>                                     
                                 
                                         <td border="0"><input class="form-control" type="hidden" name="payment_date" value="" size=40/>
                                 
                                        <tr>
                                        <td border="0"></td>
                                        <td align="right" border="0">
                                              <span class="input-group-btn"><br>
                                                    <input type="submit" class="btn green" value="View Records"  >

                                                </span>
                                        </td>
                                        </tr>

                                       
                                </table>
                            </td>

                          
                           <td align="left" valign="top"> 
                                    <table cellspacing="0" cellpadding="2" border="0" size=40>

                                    </table>
                           
                           </td>
                           </tr>
                           
                           </table>
              </form>
  <script  type="text/javascript">
 var frmvalidator = new Validator("members-tithes");
 

 frmvalidator.addValidation("tithe_id","dontselect=000");
  frmvalidator.addValidation("scc_id","dontselect=000");
    frmvalidator.addValidation("month","dontselect=000");

</script>



<br><br>

<!-- ppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppp -->
                             <form name = "members-tithes-all" id="members-tithes-all" action="tithes-all.php" method="post">        
                      <table  class="alert-table" cellspacing="0" cellpadding="4" width="100%" border="0" id="my-editor" >
                                 
                           <tr>
                           <td align="left" valign="top">
                             
                            </td>

                          
                           <td align="left" valign="top"> 
                                    <table cellspacing="0" cellpadding="2" border="0" size=40>

                                    </table>
                           
                           </td>
                           </tr>
                           
                           </table>
              </form>
  <script  type="text/javascript">
 var frmvalidator = new Validator("members-tithes-all");
 

 frmvalidator.addValidation("tithe_id","dontselect=000");

</script>
 <!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& end form &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->  


         <style>

table {
    width: 100%;
    border: thin solid black;
    border-spacing: 0 10px;
}
td {
   
    border-top: 0px;
    
}
th, tfoot td {
    border: thin solid black;
    text-align: center;
    font-weight: bold;
}
tbody td {
    font-size: 90%;
}
caption {
    font-size: 90%;
    text-align: right;
}
td, th, caption {
    padding: 5px;
}
        
        </style> 
                    </div>
                </div>
            </div>
        </div>


      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>