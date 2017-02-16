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
                    <span> >> </span>Church Member Profiles
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">Church Members Profile</a></li>  
                    </ul>
                    <div class="tab-content">
<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& form &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->
                                     <style>
                                       
                                        table.alert-table tr td{
                                            padding:3px 3px;
                                            font-size: 14px;
                                          
                                            
                                        }
                                    </style>
                                   Select on a member to view profile
                                    
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

                          
                           <td align="left" valign="top"> 
                                    <table cellspacing="0" cellpadding="2" border="0" size=40>
                                        <tr>
			                                 <td>Search By Id No</td>
		                                     <td><input class="form-control" type="text" name="name" value="" placeholder="Enter Id No" size=40/>
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
									
									 $result = mysqli_query($connection,"SELECT id, employee_name,kra_pin, nssf, nhif, active, id_no, phone_no from employees WHERE id = '".$employee_id."'  ORDER BY id DESC") 
											or die(mysqli_error($connection));  
									
									echo"<table width=\"100%\" height='30' border=1 align=center cellpadding=1 cellspacing=1 bgcolor=\"#CCCCCC\">";
									echo "	<tr>
										<td width=\"8%\" height=30 align=center bgcolor=\"#E6E6E6\"><strong>EMPLOYEE NAME</strong></td>
										<td width=\"10%\" align=center bgcolor=\"#E6E6E6\"><strong>KRA PIN</strong></td>
										<td width=\"13%\" align=center bgcolor=\"#E6E6E6\"><strong>ID NO</strong></td>
										<td width=\"13%\" align=center bgcolor=\"#E6E6E6\"><strong>NSSF NO</strong></td>
										<td width=\"13%\" align=center bgcolor=\"#E6E6E6\"><strong>NHIF NO</strong></td>
										<td width=\"13%\" align=center bgcolor=\"#E6E6E6\"><strong>ACTIVE</strong></td>
										<td width=\"13%\" align=center bgcolor=\"#E6E6E6\"><strong>PHONE NO</strong></td>

									</tr>";							
									while($rows=mysqli_fetch_assoc($result))
									{ // Start looping table row
									?>
                                        <tr>
                                            <td align="center" height="22px" bgcolor="#FFFFFF"><?php {echo ($rows["employee_name"]); }?></td>
                                            <td align="center" bgcolor="#FFFFFF"><?php {echo $rows['kra_pin']; }?></td>
                                            <td align="center" bgcolor="#FFFFFF"><?php {echo $rows['id_no']; }?></td>
                                            <td align="center" bgcolor="#FFFFFF"><?php {echo $rows['nssf']; }?></td>
                                            <td align="center" bgcolor="#FFFFFF"><?php {echo $rows['nhif']; }?></td>
                                            <td align="center" bgcolor="#FFFFFF"><?php {echo $rows['active']; }?></td>
                                            <td align="center" bgcolor="#FFFFFF"><?php {echo $rows['phone_no']; }?></td>
                                        </tr>
                                     <?php 
									}
									echo "</table>";
									mysqli_close($connection);
									echo "<br><br>";
									
									//------------------------------------------- next table stages----------------
									echo "<table width='100%' border=1px>";
									echo "<tr>";
									echo "<td width='80%' style='padding:4px'>";
										echo "Salary Configurations/Category";
										echo "<br>";
										?>
                                        
                                        
                                         <div id="CategoryAssignGrid" style="font-size:12px !important"></div>
<script>                                         
$(document).ready(function () {
	
	var self = this;
	var categAssingModel = kendo.data.Model.define({
		id: "id",
		fields: { 				
			employee_id: {type: "string", validation: { required: true } },
			category_id: {type: "string", validation: { required: true } },
			start_date: {type: "date", validation: { required: false } },
			is_active: {type: "boolean", validation: { required: false } },	
			employee_name: {type: "string", validation: { required: true } },	
			category_name: {type: "string", validation: { required: true } },	
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
                        url: 'data/get_category_assign.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_category_assign.php",
					complete: function(status) {
						 
						var code = status.status;
						if (code === 200) {
							refreshGridData();
							alert('Worker Category updated successfully');
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
                        url: 'data/get_category_assign.php',
						dataType: "json",
						 complete: function(status) {
							 
							    var code = status.status;
								if (code === 200) {
									refreshGridData();
									alert('Worker Category added successfully');
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
						url: "data/get_category_assign.php",
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
			filter: [{ field: "budget_id", operator: "eq", value: <?php echo $employee_id; ?> }]


        })

    });	
	
    $('#CategoryAssignGrid').kendoGrid({
        dataSource: viewModel.CateGoriesAssignDataSource,
        columns: [
                     
            { field: "employee_id", title:"Employee Name",  editor: employeesDropDownEditor,template: "#= employee_name #" },
            { field: "category_id", title:"Category", editor: categoriesDropDownEditor,template: "#= category_name #" },	
			{ field: "start_date", title:"Start Date", format: '{0:dd/MM/yyyy}'},		
			{ field: "is_active", title:"Is Active"},	
			{ command: ["edit", "destroy"], title: "&nbsp;" }
		],
        toolbar: [{ name: "create", text: "Add New Worker Category" }],        
                                  
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
				display: "{0}-{1} of {2} categories",
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
				return 'Are you sure you want to delete  '+model.category_name+'?'
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

	function categoriesDropDownEditor(container, options) {
		$('<input required data-text-field="category_name" data-value-field="id" data-bind="value:' + options.field + '"/>')
			.appendTo(container)
			.kendoDropDownList({
				autoBind: false,
				dataTextField: "category_name",
				dataValueField: "id",
				optionLabel: {
					category_name: "Select",
					id: ""
				},
				dataSource:{
					schema: {
						data: "data"
					},
					transport: {
						read: {
							url:"data/get_employee_categories.php",
							type: "GET",
							dataType: "json",
						}
					}
				}
			});
	}

})
</script>
                                        
                                        
                                        
                                        <?php
															
									echo "</td>";		
										
									echo "</tr>";	
									echo "<tr>";						
									echo "<td width='80%' style='padding:4px'>";
									echo "<br>";
									echo "<br>";
										echo "Salary Deductions";
										echo "<br>";
										?>

                                        
<div id="deductionsGrid" style="font-size:12px !important"></div>
<script>                                         
$(document).ready(function () {
	
	var self = this;
	var categAssingModel = kendo.data.Model.define({
		id: "id",
		fields: { 				
			employee_id: {type: "string", validation: { required: true } },
			salary_deduction_id: {type: "string", validation: { required: true } },	
			employee_name: {type: "string", validation: { required: false } },	
			deduction_description: {type: "string", validation: { required: false } },
			amount_deducted: {type: "string", validation: { required: false } },
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
                        url: 'data/get_salary_deductions_assign.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_salary_deductions_assign.php",
					complete: function(status) {
						 
						var code = status.status;
						if (code === 200) {
							refreshGridData();
							alert('Deduction updated successfully');
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
                        url: 'data/get_salary_deductions_assign.php',
						dataType: "json",
						 complete: function(status) {
							 
							    var code = status.status;
								if (code === 200) {
									refreshGridData();
									alert('Deduction added successfully');
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
						url: "data/get_salary_deductions_assign.php",
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
			filter: [{ field: "budget_id", operator: "eq", value: <?php echo $employee_id; ?> }]


        })

    });	
	
    $('#deductionsGrid').kendoGrid({
        dataSource: viewModel.CateGoriesAssignDataSource,
        columns: [
                     
            { field: "employee_id", title:"Employee Name",  editor: employeesDropDownEditor,template: "#= employee_name #" },
            { field: "salary_deduction_id", title:"Salary Deduction",editor: deductionsDropDownEditor,template: "#= deduction_description #" },	
			{ field: "amount_deducted", title:"Deduction Amount" },	
			
			{ command: ["edit", "destroy"], title: "&nbsp;" }
		],
        toolbar: [{ name: "create", text: "Add New deduction" }],        
                                  
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
				display: "{0}-{1} of {2} categories",
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

	function deductionsDropDownEditor(container, options) {
		$('<input required data-text-field="deduction_description" data-value-field="id" data-bind="value:' + options.field + '"/>')
			.appendTo(container)
			.kendoDropDownList({
				autoBind: false,
				dataTextField: "deduction_description",
				dataValueField: "id",
				optionLabel: {
					deduction_description: "Select",
					id: ""
				},
				dataSource:{
					schema: {
						data: "data"
					},
					transport: {
						read: {
							url:"data/get_deductions.php",
							type: "GET",
							dataType: "json",
						}
					}
				}
			});
	}

})
</script>


										<?php
									echo "</td>";	
									echo "</tr>";
									echo "</table>";	
									//----------------------------------end ---------------------------------------
								
									
								}
														
							 ?>

 
 
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