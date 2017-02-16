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
                <div class="caption"><i class="icon-reorder"></i>Church Inventory
                    <span> >> </span> All Assets
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">Church Assets</a></li>  
                        <li ><a href="#tab_5_2" data-toggle="tab">Asset Owners</a></li>
                        <li ><a href="#tab_5_3" data-toggle="tab">Asset Categories</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                        
                            <div id="assetsgrid" style="font-size:12px !important"></div>
                            <script src="scripts/assets.js"></script>
						</div>  
  						<div class="tab-pane" id="tab_5_2">
                            <div id="asset_owners_grid"></div>
                            <script src="scripts/asset_owners.js"></script>
                        </div>    
   						<div class="tab-pane" id="tab_5_3">
                            <div id="asset_categories_grid"></div>
                            <script src="scripts/asset_categories.js"></script>
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