$(document).ready(function () {
	
	var self = this;
	var budgetModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			ref_no: {type: "string", validation: { required: true } },
			description: {type: "string", validation: { required: true } },
			date_created: {type: "date", validation: { required: true } },
			project_id: {type: "string", validation: { required: true } },
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
                        q: function() {
                            viewModel.budgetDataSource.read();
                        }
                },

                create: {
                   
                        type: "POST",
                        url: 'data/get_budgets.php',
						
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

                    var url = 'data/get_budgets.php' + options.data.metric_id;
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
	
    $('#budgetbalances').kendoGrid({
        dataSource: viewModel.budgetDataSource,
        columns: [
                                      
            { field: "ref_no", title:"Budget No", width: "120px"  },
            { field: "description", title:"Description", width: "120px" },
            { field: "date_created", title:"Date Created", width: "120px"},
            { field: "project_id", title:"Project", width: "120px", editor: projectsDropDownEditor},
			
		],
        toolbar: [{ name: "create", text: "Add Budget" }],        
                                  
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
				display: "{0}-{1} of {2} Budget",
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
        viewModel.budgetDataSource.read();
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

})