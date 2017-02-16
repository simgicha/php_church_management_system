$(document).ready(function () {
	
	var self = this;
	var itemsModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			item_name: {type: "string", validation: { required: true } },
			item_code: {type: "string", validation: { required: true } },
			date_added: {type: "date", validation: { required: true } },							
		}
	});	
	
    var viewModel = kendo.observable({
        ItemsDataSource: new kendo.data.DataSource({
            schema: {
                model: itemsModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
					type: "GET",
					dataType: "json",
					url: 'data/get_itemDetails.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_itemDetails.php",
					complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
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
                create: {  
					type: "PUT",
					url: "data/get_itemDetails.php",
					complete: function(status) {
						 
						var code = status.status;
						if (code === 200) {
							refreshGridData();
							alert('Item added successfully');
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
                    url: "data/get_itemDetails.php",
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
	
    $('#item_details_grid').kendoGrid({
        dataSource: viewModel.ItemsDataSource,
        columns: [
			{ field: "item_name", title:"Item name"},  
			{ field: "item_code", title:"Item Code"}, 
            {
                field: 'date_added', title: 'Date Added', format: '{0:dd/MM/yyyy}'
            },				                  
			{ command: ["edit"], title: "&nbsp;"}
		],
        toolbar: [{ name: "create", text: "Add Item" }],  
                                  
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
				display: "{0}-{1} of {2} Items",
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
	viewModel.ItemsDataSource.read();
	
	function refreshGridData() {
        viewModel.ItemsDataSource.read();
    }	
	

})