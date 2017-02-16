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
                <div class="caption"><i class="icon-reorder"></i>Employee Centre
                    <span> >> </span>Manage Leave days
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">Employees leave days</a></li>  
                    </ul>
                    <div class="tab-content">
                    <h4><span style="color:#F00"><marquee behavior="alternate">Leave Days Award! read below first</marquee></span></h4>
                   Only use this section to add(award) leave days to an employee upon completion of a specified period. usually its 21 days in an year. This section cannot be edited and you can only issue a compensating transaction in case of an error in entry.  <br><br>
<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& form &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->
                                     <style>
                                       
                                        table.alert-table tr td{
                                            padding:3px 3px;
                                            font-size: 14px;
                                          
                                            
                                        }
                                    </style>
                                   Select on a member to award leave days
                                    
                            <form id="member" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >        
 			                <table  class="alert-table" cellspacing="0" cellpadding="4" width="100%" border="0" id="my-editor" >
                                 
                           <tr>
                           <td align="left" valign="top">
                                <table>
 
                                          <tr>
                                            <td>Search By name</td>   
                                            <td>
                                            <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT employee_name,id FROM employees order by employee_name ASC") 
										or die("No employees");  

												echo "<select name=employee_name value='' class='form-control combobox_ui' onchange='this.form.submit()';>Employee</option>"; // list box select command
												echo "<option value=''>-- Select Employee name --</option>";
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[employee_name]</option>";
												/* Option values are added by looping through the array */
												}
												echo "</select>";// Closing of list box
												
											?>
                                             

		                                    </td>
                                        </tr>                                   


                                </table>
                            </td>

                         
                           </tr>
                           
                           </table>
							</form>
                            <?php		
								if(!isset($_POST['employee_name'])){
									echo "No employee selected";
								}	
								else{
									echo "Member Profile ";
									$employee_id = $_POST['employee_name'];
									include('connect-db.php');
									
									 $result = mysqli_query($connection,"SELECT l.id, e.employee_name, COALESCE(SUM(l.no_of_days),0) as no_of_days from employee_leave_days l, employees e WHERE e.id = l.employee_id AND l.employee_id = '".$employee_id."' AND l.type = 2 ORDER BY l.id DESC") 
											or die(mysqli_error($connection));  
									
									echo"<table width=\"100%\" height='30' border=1 align=center cellpadding=1 cellspacing=1 bgcolor=\"#CCCCCC\">";
									echo "	<tr>
										<td width=\"8%\" height=30 align=center bgcolor=\"#E6E6E6\"><strong>EMPLOYEE NAME</strong></td>
										<td width=\"10%\" align=center bgcolor=\"#E6E6E6\"><strong>Total days Awarded</strong></td>
									

									</tr>";							
									while($rows=mysqli_fetch_assoc($result))
									{ // Start looping table row
									?>
                                        <tr>
                                            <td align="center" height="22px" bgcolor="#FFFFFF"><?php {echo ($rows["employee_name"]); }?></td>
                                            <td align="center" bgcolor="#FFFFFF"><?php {echo $rows['no_of_days']; }?></td>

                                        </tr>
                                     <?php 
									}
									echo "</table>";
									mysqli_close($connection);
									echo "<br><br>";
									

										?>
                                        
                                        
                                         <div id="leave_days_grid" style="font-size:12px !important"></div>
<script>                                         
$(document).ready(function () {
	
	var self = this;
	var categAssingModel = kendo.data.Model.define({
		id: "id",
		fields: { 				
			employee_id: {type: "string", validation: { required: true } },
			start_date: {type: "date", validation: { required: true } },
			leave_days_awarded: {type: "string", validation: { required: true } },
			reason: {type: "string", validation: { required: false } },	
			employee_name: {type: "string", validation: { required: true } },	
			
		}
	});	
	
    var viewModel = kendo.observable({
        CateGoriesAssignDataSource: new kendo.data.DataSource({
            schema: {
                model: categAssingModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
                        type: "GET",
                        dataType: "json",
                        url: 'data/get_leave_days_add.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_leave_days_add.php",
					complete: function(status) {
						 
						var code = status.status;
						if (code === 200) {
							refreshGridData();
							alert('Leave days updated successfully');
							options.success(status);
							//self.read();
							//refreshGridData();
						} else {
							alert(status.responseText);
							options.error(status);
						} 
					}
				},
                create: {
                   
                        type: "PUT",
                        url: 'data/get_leave_days_add.php',
						dataType: "json",
						 complete: function(status) {
							 
							    var code = status.status;
								if (code === 200) {
									refreshGridData();
									alert('Leave days added successfully');
									options.success(status);
									//self.read();
									//refreshGridData();
								} else {
									alert(status.responseText);
									options.error(status);
								} 
							}	
                    
                },



					destroy: {
						type: "DELETE",
						dataType: "json",
						url: "data/get_leave_days_add.php",
						complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Record deleted successfully');
								options.success(status);
								//self.read();
								//refreshGridData();
							} else {
								alert(status.responseText);
								options.error(status);
							} 
						}
               		},
				
            },
			type: "JSON",
			pageSize: 10,
			serverPaging: true,
			serverSorting: true,
			serverFiltering: true,
			filter: [{ field: "employee_id", operator: "eq", value: <?php echo $employee_id; ?> }]


        })

    });	
	
    $('#leave_days_grid').kendoGrid({
        dataSource: viewModel.CateGoriesAssignDataSource,
        columns: [
                     
            { field: "employee_id", title:"Employee Name",  editor: employeesDropDownEditor,template: "#= employee_name #" },
           	
			{ field: "start_date", title:"Start Date", format: '{0:dd/MM/yyyy}'},		
			{ field: "leave_days_awarded", title:"No of days to Award"},
			{ field: "reason", title:"Reason for days award"},	
			
		],
        toolbar: [{ name: "create", text: "Add New Leave days" }],        
                                  
        columnResizeHandleWidth: 6,
        columnMenu: true,
		resizable: true,                               
        sortable: true,
		pageable: {
			input: true,
			refresh: true,
			pageSizes: [10, 20, 30, 40, 50, 100],
			buttonCount: 10,
			messages: {
				empty: "No data",
				display: "{0}-{1} of {2} records",
				itemsPerPage: "per page"
			}
		},

        pageSize: 10,
        filterable: {
            extra: false
        },
        editable: {
            mode: "popup",
			confirmation: function(model) {
				return 'Are you sure you want to delete  '+model.employee_id+'?'
			},
            window: {
                animation: {
                    close: {
                        effects: "fadeOut zoom:out",
                        duration: 600
                    },
                    open: {
                        effects: "fadeIn zoom:in",
                        duration: 300
                    }
                }
            }

        },
		
        edit: function (e) {
            if (e.model.isNew()) {
                $("a.k-grid-update")[0].innerHTML = "<span class='k-icon k-update'></span>Save";
                e.container.kendoWindow("title", "Add Record");
            }
            else {
                $("a.k-grid-update")[0].innerHTML = "<span class='k-icon k-update'></span>Update";
                e.container.kendoWindow("title", "Edit Record");
            }
        }
    }); 
	function refreshGridData() {
        viewModel.CateGoriesAssignDataSource.read();
    }	
	
	
	function employeesDropDownEditor(container, options) {
		$('<input required data-text-field="employee_name" data-value-field="id" data-bind="value:' + options.field + '"/>')
			.appendTo(container)
			.kendoDropDownList({
				autoBind: false,
				dataTextField: "employee_name",
				dataValueField: "id",
				optionLabel: {
					employee_name: "Select",
					id: ""
				},
				dataSource:{
					schema: {
						data: "data"
					},
					transport: {
						read: {
							url:"data/get_employees.php",
							type: "GET",
							dataType: "json",
						}
					}
				}
			});
	}



})
</script>
                                        
                                        


                                        
<?php } ?>

 
 
 <!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& end form &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->                              
                    </div>

                </div>
            </div>
        </div>      

      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>