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
                <div class="caption"><i class="icon-reorder"></i>Church Configuration
                    <span> >> </span> Local Churches
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">Local Churches</a></li>
                         <li ><a href="#tab_5_2" data-toggle="tab">Churches Leadership</a></li>
                         
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                        	
                            <div id="churchesgrid" style="font-size:12px !important"></div>
                            <script src="scripts/local_churches.js"></script>
						</div>  
                          <div class="tab-pane" id="tab_5_2">
                          Expand on a local church ti view the church leadership by clicking the > at the beginning of every church
                            <div id="churchLeadershipGrid"></div>
                            <script src="scripts/churchLeaderShip.js"></script>
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