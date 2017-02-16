$(document).ready(function () {
	
	var self = this;
	var tithesModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			Year: {type: "date", validation: { required: true } },
			
			description: {type: "string", validation: { required: true } },
			target: {type: "double", validation: { required: true } },		
			status: {type: "boolean"}						
		}
	});	
	
    var viewModel = kendo.observable({
        TithesDataSource: new kendo.data.DataSource({
            schema: {
                model: tithesModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
					type: "GET",
					dataType: "json",
					url: 'data/get_tithes_set_up.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_tithes_set_up.php",
					complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Tithe updated successfully');
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
					url: "data/get_tithes_set_up.php",
					complete: function(status) {
						 
						var code = status.status;
						if (code === 200) {
							refreshGridData();
							alert('Tithe added successfully');
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
                    url: "data/get_tithes_set_up.php",
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
	
    $('#tithesSetUpgrid').kendoGrid({
        dataSource: viewModel.TithesDataSource,
        columns: [  
			{ field: "description", title:"Tithe Description"}, 
            { field: 'target', title: 'Target'},	
			{ field: 'Year', title:'Tithe Year',  format: '{0:dd/MM/yyyy}'},
			
			{ field: "status", title:"Status"}, 		                  
			{ command: ["edit", "destroy"], title: "&nbsp;" }
		],
        toolbar: [{ name: "create", text: "Add A new Tithe" }],  
                                  
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
				display: "{0}-{1} of {2} Tithes",
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
        		return 'Are you sure you want to delete  '+model.description+'?'
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
                e.container.kendoWindow("title", "Add New Record");
            }
            else {
                $("a.k-grid-update")[0].innerHTML = "<span class='k-icon k-update'></span>Update";
                e.container.kendoWindow("title", "Edit Tithe Record");
            }
        }
    }); 
	viewModel.TithesDataSource.read();
	
	function refreshGridData() {
        viewModel.TithesDataSource.read();
    }	
	
})