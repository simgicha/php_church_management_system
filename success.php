<?php
session_start();
if(!isset($_SESSION['myusername'])){
header('location: index.php');
}
?>
<?php include("top.php"); ?>
      <!-- BEGIN PAGE -->
      <div class="page-content" style="min-height:590px !important">
      
           <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>BUDGET
                    <span> >> </span> BUDGET TRANSFER
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
 				Amount Transfered Successfully<br> FROM TO
               
                <hr>

            </div>
        </div>      

      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>