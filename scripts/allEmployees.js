$(document).ready(function () {
	
	var self = this;
	var employeeModel = kendo.data.Model.define({
		id: "id",
		fields: { 			
			id: {type: "string", editable: false  },
			kra_pin: {type: "string", validation: { required: false } },
			nssf: {type: "string", validation: { required: false } },
			nhif: {type: "string", validation: { required: false } },
			date_of_employment: {type: "date", validation: { required: true } },
			active: {type: "boolean", validation: { required: false } },
			employee_name: {type: "string", validation: { required: true } }
		}
	});	
	
    var viewModel = kendo.observable({
        employeesDataSource: new kendo.data.DataSource({
            schema: {
                model: employeeModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
                        type: "GET",
                        dataType: "json",
                        url: 'data/get_employees.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_employees.php",
					complete: function(status) {
						 
						var code = status.status;
						if (code === 200) {
							refreshGridData();
							alert('Employee updated successfully');
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
                        url: 'data/get_employees.php',
						dataType: "json",
						 complete: function(status) {
							 
							    var code = status.status;
								if (code === 200) {
									refreshGridData();
									alert('Employee added successfully');
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
						url: "data/get_employees.php",
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
	
    $('#employeesGrid').kendoGrid({
        dataSource: viewModel.employeesDataSource,
        columns: [
                             
            { field: "id", title:"Employee No" },
            { field: "employee_name", title:"Name" },
            { field: "kra_pin", title:"KRA PIN"},
            { field: "nssf", title:"NSSF No"},
            { field: "nhif", title:"NHIF NO" },
            { field: "active", title:"IS ACTIVE"},
            { field: "date_of_employment", title:"Date of Employment",format: '{0:dd/MM/yyyy}'},			
			{ command: ["edit", "destroy"], title: "&nbsp;" }
		],
        toolbar: [{ name: "create", text: "Add New Employee" }],        
                                  
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
				display: "{0}-{1} of {2} employees",
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
				return 'Are you sure you want to delete  '+model.employee_name+'?'
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
        viewModel.employeesDataSource.read();
    }	

})