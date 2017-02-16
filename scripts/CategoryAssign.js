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
			filter: [{ field: "budget_id", operator: "eq", value: 1 }]


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