$(document).ready(function () {
	
	var self = this;
	var employeeCategoryModel = kendo.data.Model.define({
		id: "id",
		fields: { 				
			category_name: {type: "string", validation: { required: false } },
			monthly_pay: {type: "string", validation: { required: false } },
		}
	});	
	
    var viewModel = kendo.observable({
        employeesCategoryDataSource: new kendo.data.DataSource({
            schema: {
                model: employeeCategoryModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
                        type: "GET",
                        dataType: "json",
                        url: 'data/get_employee_categories.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_employee_categories.php",
					complete: function(status) {
						 
						var code = status.status;
						if (code === 200) {
							refreshGridData();
							alert('Category updated successfully');
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
                        url: 'data/get_employee_categories.php',
						dataType: "json",
						 complete: function(status) {
							 
							    var code = status.status;
								if (code === 200) {
									refreshGridData();
									alert('Category added successfully');
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
						url: "data/get_employee_categories.php",
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
            pageSize: 10,


        })

    });	
	
    $('#employeesCategoryGrid').kendoGrid({
        dataSource: viewModel.employeesCategoryDataSource,
        columns: [
                             
            { field: "category_name", title:"Category Name" },
            { field: "monthly_pay", title:"Monthly Pay"},		
			{ command: ["edit", "destroy"], title: "&nbsp;" }
		],
        toolbar: [{ name: "create", text: "Add New Category" }],        
                                  
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
        viewModel.employeesCategoryDataSource.read();
    }	

})