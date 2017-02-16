$(document).ready(function () {
	
	var self = this;
	var expenses_typeModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			expense_name: {type: "string", validation: { required: true } },					
		}
	});	
	
    var viewModel = kendo.observable({
        ExpensesTypesDataSource: new kendo.data.DataSource({
            schema: {
                model: expenses_typeModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
					type: "GET",
					dataType: "json",
					url: 'data/get_expense_type.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_expense_type.php",
					complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Expense Type updated successfully');
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
					url: "data/get_expense_type.php",
					complete: function(status) {
						 
						var code = status.status;
						if (code === 200) {
							refreshGridData();
							alert('Expense Type added successfully');
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
                    url: "data/get_expense_type.php",
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
            serverFiltering: true,
            pageSize: 10,
        })

    });	
	
    $('#expenses_type_grid').kendoGrid({
        dataSource: viewModel.ExpensesTypesDataSource,
        columns: [
			{ field: "expense_name", title:"Expense name"},  
				                  
			{ command: ["edit", "destroy"] }
		],
        toolbar: [{ name: "create", text: "Add Expense Type" }],  
                                  
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
				display: "{0}-{1} of {2} Expense types",
				itemsPerPage: "per page"
			}
		},

        pageSize: 10,
        filterable: {
            extra: false
        },
        editable: {
            mode: "popup",
			//confirmation: "Are you sure you want to delete this record?", // the confirmation message for destroy command
            confirmation: function(model) {
        		return 'Are you sure you want to delete  '+model.expense_name+'?'
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
	viewModel.ExpensesTypesDataSource.read();
	
	function refreshGridData() {
        viewModel.ExpensesTypesDataSource.read();
    }	
	
})