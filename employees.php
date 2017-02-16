
<?php include("top.php"); ?>
      <!-- BEGIN PAGE -->
      <div class="page-content" style="min-height:590px !important">
      
           <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>EMPLOYEE CENTRE
                    <span> >> </span> ALL EMPLOYEES
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">All Employees</a></li>
                        <li ><a href="#tab_5_2" data-toggle="tab">Employee Categories</a></li>

                         
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                        	List Of All employees
                            <div id="employeesGrid" style="font-size:12px !important"></div>
                            <script src="scripts/allEmployees.js"></script>
						</div>  
                        <div class="tab-pane" id="tab_5_2">
                        	Employee Categories
                            <div id="employeesCategoryGrid" style="font-size:12px !important"></div>
                            <script src="scripts/EmployeesCategory.js"></script>
                        </div>    
                        <div class="tab-pane" id="tab_5_3">
                        	This part of the system is used to configure employees salary(Set employees salaries and categories
                            <div id="CategoryAssignGrid" style="font-size:12px !important"></div>
                            <script src="scripts/CategoryAssign.js"></script>
                                                       
                        </div>    
                        <div class="tab-pane" id="tab_5_4">
                        	Here record all salary deductions per employee such as NHIF, NSSF etc
                            
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