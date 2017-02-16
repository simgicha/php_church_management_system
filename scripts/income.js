$(document).ready(function () {
	
	var self = this;
	var incomeModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			source: {type: "string", validation: { required: true } },
			amount: {type: "Double", validation: { required: true } },
			income_type: { validation: { required: true } },
			date_of_income: {type: "date", validation: { required: true } },
			receipt_number:{type: "string", validation: { required: false } }
		}
	});	
	
    var viewModel = kendo.observable({
        incomesDataSource: new kendo.data.DataSource({
            schema: {
                model: incomeModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
					type: "GET",
					dataType: "json",
					url: 'data/get_incomes.php',
                },

                create: {                
                        type: "PUT",
                        url: 'data/get_incomes.php',
						
						 complete: function(status) {
							 
							    var code = status.status;
								if (code === 200) {
									refreshGridData();
									alert('Income added successfully');
									options.success(status);
									//self.read();
									//refreshGridData();
								} else {
									alert(status.responseText);
									options.error(status);
								} 
							}	
                    
                },

				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_incomes.php",
					complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Income updated successfully');
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
                    url: "data/get_incomes.php",
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

			aggregate: [
				{ field: "amount", aggregate: "count" },
				{ field: "amount", aggregate: "sum" },
				{ field: "amount", aggregate: "max" },
				{ field: "amount", aggregate: "average" }
			]
        })

    });	
	
    $('#incomesgrid').kendoGrid({
        dataSource: viewModel.incomesDataSource,
        columns: [
                                      
            { field: "source", title:"Income Source" },
            { field: "amount", title:"Amount",  footerTemplate:"Total : #=sum# "},
            { field: "income_type", title:"Income type", editor: moneyTypesDropDownEditor },
			{field: "receipt_number",title:"Receipt No"},
            { field: "date_of_income", title:"Income Date",format: '{0:dd/MM/yyyy}' },
			{ command: ["edit", "destroy"], title: "&nbsp;" }
		],
        toolbar: [{ name: "create", text: "Add Income" }],                                 
                                  
        sortable: true,
		
		pageable: {
			input: true,
			refresh: true,
			pageSizes: [10, 20, 30, 40, 50, 100],
			buttonCount: 10,
			messages: {
				empty: "No data",
				display: "{0}-{1} of {2} Incomes",
				itemsPerPage: "per page"
			}
		},
		
		filterable: {
			extra: false
		},

        editable: {
            mode: "popup",
			confirmation: function(model) {
        		return 'Are you sure you want to delete  '+model.source+'?'
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
	viewModel.incomesDataSource.read();
	
	function refreshGridData() {
        viewModel.incomesDataSource.read();
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