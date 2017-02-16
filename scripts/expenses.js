$(document).ready(function () {
	
	var self = this;
	var expensesModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			expense_type_id: {type: "string", validation: { required: true } },
			paid_to: {type: "string", validation: { required: true } },
			date_paid: {type: "date", validation: { required: true } },
			amount_paid: {type: "Double", validation: { required: true } },
			reason: {type: "string", validation: { required: true } },
			sync_datetime: {type: "date", validation: { required: true } },
			user_id: {validation: { required: true } },
			payment_type: { validation: { required: true } }
		}
	});	
	
    var viewModel = kendo.observable({
        expensesDataSource: new kendo.data.DataSource({
            schema: {
                model: expensesModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
                   
                        type: "GET",
                        dataType: "json",
                        url: 'data/get_expenses.php',
                        q: function() {
                            viewModel.expensesDataSource.read();
                        }
                },

                create: {
                   
                        type: "POST",
                        url: 'data/get_expenses.php',
						
						 complete: function(status) {
							 
							    var code = status.status;
								if (code === 200) {
									refreshGridData();
									alert('Expenses added successfully');
									options.success(status);
									//self.read();
									//refreshGridData();
								} else {
									alert(status.responseText);
									options.error(status);
								} 
							}	
                    
                },



                destroy: function (options) {
                    if (!confirm("Are you sure you want to delete this record?"))
                        return;

                    var url = 'data/get_buildings.php' + options.data.metric_id;
                    $.ajax({
                        type: "DELETE",
                        dataType: "json",
                        url: url
                    }).complete(function (jqXHR) {
                        var code = jqXHR.status;
                        if (code === 204) {
                            refreshGridData();
                            alert('Record deleted');
                            options.success(jqXHR);
                        } else {
                            alert(jqXHR.responseText);
                            options.error(jqXHR);
                        }
                    });
                },
				
            },
            pageSize: 10,


        })

    });	
	
    $('#incomesgrid').kendoGrid({
        dataSource: viewModel.expensesDataSource,
        columns: [
                                      
            { field: "expense_type_id", title:"Expense type",  editor: expenseTypesDropDownEditor  },
            { field: "paid_to", title:"Paid To" },
            { field: "date_paid", title:"Date paid", format: '{0:dd/MM/yyyy}'},
            { field: "reason", title:"Explanation" },
			{ field: "amount_paid", title:"Amount" },
			{ field: "payment_type", title:"Payment Type", editor: moneyTypesDropDownEditor },
			
		],
        toolbar: [{ name: "create", text: "Add Income" }],        
                                  
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
				display: "{0}-{1} of {2} Rooms",
				itemsPerPage: "per page"
			}
		},

        pageSize: 10,
        filterable: {
            extra: false
        },
        editable: {
            mode: "popup",
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
        viewModel.expensesDataSource.read();
    }	
	
	
	function expenseTypesDropDownEditor(container, options) {
		$('<input required data-text-field="expense_name" data-value-field="id" data-bind="value:' + options.field + '"/>')
			.appendTo(container)
			.kendoDropDownList({
				autoBind: false,
				dataTextField: "expense_name",
				dataValueField: "id",
				optionLabel: {
					expense_name: "Select",
					id: ""
				},
				dataSource:{
					schema: {
						data: "data"
					},
					transport: {
						read: {
							url:"data/get_expenses_types.php",
							type: "GET"
						}
					}
				}
			});
	}
	function moneyTypesDropDownEditor(container, options) {
		$('<input required data-text-field="income_type" data-value-field="id" data-bind="value:' + options.field + '"/>')
			.appendTo(container)
			.kendoDropDownList({
				autoBind: false,
				dataTextField: "income_type",
				dataValueField: "id",
				optionLabel: {
					income_type: "Select",
					id: ""
				},
				dataSource:{
					schema: {
						data: "data"
					},
					transport: {
						read: {
							url:"data/get_money_types.php",
							type: "GET"
						}
					}
				}
			});
	}	
})