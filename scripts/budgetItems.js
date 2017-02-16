$(document).ready(function () {
	var budgetModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			ref_no: {type: "string", validation: { required: true } },
			description: {type: "string", validation: { required: true } },
			date_created: {type: "date", validation: { required: true } }
		}
	});	
	
    var viewModel = kendo.observable({
        budgetDataSource: new kendo.data.DataSource({
            schema: {
                model: budgetModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
            transport: {
                read: {            
                        type: "GET",
                        dataType: "json",
                        url: 'data/get_budgets.php',
                },
            },
            type: "JSON",
            pageSize: 10,
        })

    });	
	
    $('#budgetItemsGrid').kendoGrid({
        dataSource: viewModel.budgetDataSource,
        columns: [                            
            { field: "ref_no", title:"Budget No", width: "120px"  },
            { field: "description", title:"Description", width: "120px" },
            { field: "date_created", title:"Date Created", width: "120px"},
            
		],
              
        filterable: { extra: false },
        columnMenu: true,
        sortable: true,
        resizable: true,
        reorderable: true,
        selectable: 'row',
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
		detailInit: initDetailTemplate,
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
        viewModel.budgetDataSource.read();
    }	

	function initDetailTemplate(e) {
		var budgetItemsModel = kendo.data.Model.define({
			id: "id",
			fields: { 
				item_id: { validation: { required: true } },
				quantity: { validation: { required: true } },
				unit_price: { validation: { required: true } },
				total: { validation: { required: true } },
				budget_ref_id: { validation: { required: true } }
			}
		});	
		

		var viewModel = kendo.observable({
			budgetItemsDataSource: new kendo.data.DataSource({
				schema: {
					model: budgetItemsModel,
					data: 'data',
					total: function(data) {
						return data.data.length;
					},
				},
				transport: {
					read: {
						type: "GET",
						dataType: "json",
						url: 'data/get_budget_Items.php',
					},
					create: {
						  type: "PUT",
						  url: 'data/get_budget_Items.php?budget_ref_id='+e.data.id,
						  data: {'budget_ref_id': e.data.id},
						   complete: function(status) {
							  var code = status.status;
							  if (code === 200) {
								  
								  alert('Item added successfully');
								  refreshBudgetItemsGridData();
								  options.success(status);
							  } 
							  else {
								  alert(status.responseText);
								  options.error(status);
							  } 
						  }	
					},
					update: {
						type: "POST",
						dataType: "json",
						url: "data/get_budget_Items.php",
						complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshBudgetItemsGridData();
								alert('Item updated successfully');
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
						url: "data/get_budget_Items.php",
						complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshBudgetItemsGridData();
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
				
				filter: [{ field: "budget_ref_id", operator: "eq", value: e.data.id }]	
			})
	
		});	

		
		$("<div/>").appendTo(e.detailCell).kendoGrid({
			dataSource: viewModel.budgetItemsDataSource,
            columns: [
				
                 { field: "item_id", title:"Items name",editor: itemsDropDownEditor },
                 { field: "quantity", title:"Quantity" },
                 { field: "unit_price",title:"Unit Price" },
                 { field: "total"},
				 
                 { command: ["edit", "destroy"], title: "&nbsp;", width: "200px" }
            ],
            toolbar: [{ name: "create", text: "Add Budget Item" }],
            filterable: { extra: false },
            columnMenu: true,
            sortable: true,
            resizable: true,
            reorderable: true,
            selectable: 'row',
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
            scrollable: {
                virtual: true
            },
            editable: {
                mode: "popup",
				confirmation: function(model) {
					return 'Are you sure you want to delete  '+model.item_name+'?'
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
			
            edit: function(e1) {
                if (e1.model.isNew()) {
                    $("a.k-grid-update")[0].innerHTML = "<span class='k-icon k-update'></span>Save";
                    e1.container.kendoWindow("title", "Add New Item");
                } else {
                    $("a.k-grid-update")[0].innerHTML = "<span class='k-icon k-update'></span>Update";
                    e1.container.kendoWindow("title", "Edit Item Details");
                }
            }	
			
					 
			 
		})
		
		function refreshBudgetItemsGridData() {
			viewModel.budgetItemsDataSource.read();
		}
		
	}
	
	function projectsDropDownEditor(container, options) {
		$('<input required data-text-field="project_name" data-value-field="id" data-bind="value:' + options.field + '"/>')
			.appendTo(container)
			.kendoDropDownList({
				autoBind: false,
				dataTextField: "project_name",
				dataValueField: "id",
				optionLabel: {
					project_name: "Select",
					id: ""
				},
				dataSource:{
					schema: {
						data: "data"
					},
					transport: {
						read: {
							url:"data/get_projects.php",
							type: "GET"
						}
					}
				}
			});
	}
	
	function itemsDropDownEditor(container, options) {
		$('<input required data-text-field="item_name" data-value-field="id" data-bind="value:' + options.field + '"/>')
			.appendTo(container)
			.kendoDropDownList({
				autoBind: false,
				dataTextField: "item_name",
				dataValueField: "id",
				optionLabel: {
					item_name: "Select Item",
					id: ""
				},
				dataSource:{
					schema: {
						data: "data"
					},
					transport: {
						read: {
							url:"data/get_item_details.php",
							type: "GET"
						}
					}
				}
			});
	}

})
