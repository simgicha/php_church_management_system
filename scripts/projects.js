$(document).ready(function () {
	
	var self = this;
	var projectsModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			p3: {type: "string", validation: { required: true } },
			project_name: {type: "string", validation: { required: true } },
			description: {type: "string", validation: { required: true } },
		}
	});	
	
    var viewModel = kendo.observable({
        projectsDataSource: new kendo.data.DataSource({
            schema: {
                model: projectsModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
                   
                        type: "GET",
                        dataType: "json",
                        url: 'data/get_projects.php',
                },

                create: {
                   
                        type: "POST",
                        url: 'data/get_projects.php',
						
						 complete: function(status) {
							 
							    var code = status.status;
								if (code === 200) {
									refreshGridData();
									alert('Project added successfully');
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
					url: "data/get_projects.php",
					complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Project updated successfully');
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
	
    $('#projectsgrid').kendoGrid({
        dataSource: viewModel.projectsDataSource,
        columns: [                      
            { field: "project_name", title:"Project Name", width: "120px"  },
            { field: "description", title:"Description", width: "120px"  },                       
	
			{ command: ["edit"], title: "&nbsp;", width: "55px" }	
		],
        toolbar: [{ name: "create", text: "Add Project" }],        
                                  
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
				display: "{0}-{1} of {2} Progress",
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
        viewModel.projectsDataSource.read();
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