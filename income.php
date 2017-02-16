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
                <div class="caption"><i class="icon-reorder"></i>FINANCE
                    <span> >> </span> ALL INCOMES
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">All Incomes</a></li>
                         
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                            <div id="incomesgrid" style="font-size:12px !important"></div>
                            <script src="scripts/income.js"></script>
						</div>  
                        <div class="tab-pane" id="tab_5_2">
                            <div id="workerCategoriesGrid1"></div>
                            <script src="/BUILDCAPTURE/Views/UIFiles/js/ViewModels/Models/Workers/worker_categories.js"></script>
                        </div>    
                               
                    </div>

                </div>
            </div>
        </div>      

      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>