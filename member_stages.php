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
                <div class="caption"><i class="icon-reorder"></i>Christian Stages
                    <span> >> </span>  Members Stages
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">Members Stages</a></li>  
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                            Search Member <input class="form-control" value="" type="text" id="mname" name ="mname"><br><br>
						                <button type="submit" class="btn btn-primary">Search Member</button>
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