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
                    <span> >> </span> BUDGETS INCOMES/EXPENSES
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">Budget Incomes</a></li>
                        <li ><a href="#tab_5_2" data-toggle="tab">Budget Expenditure</a></li>
                         
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                        	Add income for a specific item in the budget
                            <div id="budgetIncomesGrid" style="font-size:12px !important"></div>
                            <script src="scripts/budgetIncomes.js"></script>
						</div>  
                        <div class="tab-pane" id="tab_5_2">
                        	Add an expense/amount spent on a certain budget item
                            <div id="budgetExpensesGrid"></div>
                            <script src="scripts/budgetExpenses.js"></script>
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