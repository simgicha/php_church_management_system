$(document).ready(function () {
	
	var self = this;
	var ownerstModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			owner_name: {type: "string", validation: { required: true } },
			description: {type: "string", validation: { required: true } },
			phone_no: {type: "string", validation: { required: true } },
			id_no: {type: "string", validation: { required: true } }						
		}
	});	
	
    var viewModel = kendo.observable({
        owneresDataSource: new kendo.data.DataSource({
            schema: {
                model: ownerstModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},
            },
			
            transport: {
                read: {
					type: "GET",
					dataType: "json",
					url: 'data/get_owners.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_owners.php",
					complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Asset owner updated successfully');
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
					url: "data/get_owners.php",
					dataType: "json",
					complete: function(status) {
						 
						var code = status.status;
						if (code === 200) {
							refreshGridData();
							alert('Asset owner Contribution added successfully');
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
                    url: "data/get_owners.php",
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
	
    $('#asset_owners_grid').kendoGrid({
        dataSource: viewModel.owneresDataSource,
        columns: [
			{ field: "owner_name", title:"Asset Owner name"},  

			{ field: "description", title:"Description"},			 
			{ field: "phone_no", title:"Phone number"},  

			{ field: "id_no", title:"Id Number"},		                 
			{ command: ["edit", "destroy"], title: "&nbsp;" }
		],
        toolbar: [{ name: "create", text: "Add Asset owner" }],  
                                  
        columnResizeHandleWidth: 6,
        columnMenu: true,
		resizable: true,                               
        sortable: true,
		selectable: 'row',
        serverFiltering: true,
		
		pageable: {
			input: true,
			refresh: true,
			pageSizes: [10, 20, 30, 40, 50, 100],
			buttonCount: 10,
			messages: {
				empty: "No data",
				display: "{0}-{1} of {2} owners",
				itemsPerPage: "per page"
			}
		},

        
        filterable: {
            extra: false
        },
        editable: {
            mode: "popup",
			//confirmation: "Are you sure you want to delete this record?", // the confirmation message for destroy command
            confirmation: function(model) {
        		return 'Are you sure you want to delete  '+model.owner_name+'?'
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
	
	viewModel.owneresDataSource.read(); // "read()" will fire the "change" event of the dataSource and the widget will be bound
	
	function refreshGridData() {
        viewModel.owneresDataSource.read();
    }	
	

})