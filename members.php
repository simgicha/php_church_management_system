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
                <div class="caption"><i class="icon-reorder"></i>Church Members
                    <span> >> </span> All Christians
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">Church Members</a></li>  
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                        <a href="church_select.php"><button type="button" class="btn btn-primary">+ Add New Member</button></a><br><br>
                            <div id="membersgrid" style="font-size:12px !important"></div>
                            <script src="scripts/members.js"></script>



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