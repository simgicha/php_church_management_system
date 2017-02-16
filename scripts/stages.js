$(document).ready(function () {
	
	var self = this;
	var stagesModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			stage_name: {type: "string", validation: { required: true } },
			Description: {type: "string", validation: { required: true } }
		}
	});	
	
    var viewModel = kendo.observable({
        stagesDataSource: new kendo.data.DataSource({
            schema: {
                model: stagesModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
					type: "GET",
					dataType: "json",
					url: 'data/get_stages.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_stages.php",
					complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Sacrament updated successfully');
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
                        url: "data/get_stages.php",
						complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Sacrament added successfully');
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
                    url: "data/get_stages.php",
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
	
    $('#stagesgrid').kendoGrid({
        dataSource: viewModel.stagesDataSource,
        columns: [
			{ field: "stage_name", title:"Sacrament Name", width: "120px"  },  
			{ field: "Description", title:"Description", width: "120px" }, 
                   
			{ command: ["edit", "destroy"], title: "&nbsp;", width: "150px" }
		],
        toolbar: [{ name: "create", text: "Add Sacrament" }],  
                                  
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
				display: "{0}-{1} of {2} sacraments",
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
        		return 'Are you sure you want to delete  '+model.stage_name+'?'
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
        viewModel.stagesDataSource.read();
    }	
	

})