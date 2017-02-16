$(document).ready(function () {
	
	var self = this;
	var assetsModel = kendo.data.Model.define({
		id: "id",
		fields: { 			
			item_name: {type: "string", validation: { required: true } },
			local_church_id: {type: "string", validation: { required: true } },
			purchase_date: {type: "date", validation: { required: true } },
			initial_value: {type: "string", validation: { required: true } },	
			item_tag: {type: "string", validation: { required: false } },	
			disposal_date: {type: "date", validation: { required: false } },
			disposal_amount: {type: "string", validation: { required: false } },
			status: {type: "string", validation: { required: true } },
			name: {type: "string", validation: { required: false } },
			quantity:{type: "string", validation: { required: true } },
			owner_id:{type: "string", validation: { required: true } },
			qty_disposed:{type: "string", validation: { required: false } },
		}
	});	
	
    var viewModel = kendo.observable({
        assetsDataSource: new kendo.data.DataSource({
            schema: {
                model: assetsModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
					type: "GET",
					dataType: "json",
					url: 'data/get_disposals.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_disposals.php",
					complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Assets updated successfully');
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
					dataType: "json",
					url: "data/get_disposals.php",
					complete: function(status) {
						 
						var code = status.status;
						if (code === 200) {
							refreshGridData();
							alert('Asset added successfully');
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
                    url: "data/get_disposals.php",
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
	
    $('#disposalgrid').kendoGrid({
        dataSource: viewModel.assetsDataSource,
        columns: [
			{ field: "item_name", title:"Item Name", width: "120px"  },
			{ field: "local_church_id", title:"Local church", width: "120px",editor: localChurchDropDownEditor,template: "#= name #" }, 
			{ field: "purchase_date", title:"Acquisition Date", width: "120px", format: '{0:dd/MM/yyyy}' },  
			{ field: "initial_value", title:"Initial Value", width: "120px"  },    
			{ field: "item_tag", title:"Item Tag", width: "120px"  }, 
			{ field: "quantity", title:"Quantity", width: "120px"  },  
			{ field: "qty_disposed", title:"Quantity disposed", width: "120px"  }, 
			{ field: "disposal_amount", title:"Disposal Amount", width: "120px"  },  
			
			{ field: "owner_id", title:"Owned By", width: "120px",editor: ownerDropDownEditor,template: "#= owner_name #"  },     
			{ command: ["edit", "destroy"], title: "&nbsp;", width: "150px" }
		],

                                  
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
				display: "{0}-{1} of {2} assets",
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
	function refreshGridData() {
        viewModel.assetsDataSource.read();
    }	
	
	function localChurchDropDownEditor(container, options) {
		$('<input required data-text-field="name" data-value-field="id" data-bind="value:' + options.field + '"/>')
			.appendTo(container)
			.kendoDropDownList({
				autoBind: false,
				dataTextField: "name",
				dataValueField: "id",
				optionLabel: {
					name: "Select",
					id: ""
				},
				dataSource:{
					schema: {
						data: "data"
					},
					transport: {
						read: {
							url:"data/get_church.php",
							type: "GET",
							dataType: "json",
						}
					}
				}
			});
	}
	

	function ownerDropDownEditor(container, options) {
		$('<input required data-text-field="owner_name" data-value-field="id" data-bind="value:' + options.field + '"/>')
			.appendTo(container)
			.kendoDropDownList({
				autoBind: false,
				dataTextField: "owner_name",
				dataValueField: "id",
				optionLabel: {
					owner_name: "Select",
					id: ""
				},
				dataSource:{
					schema: {
						data: "data"
					},
					transport: {
						read: {
							url:"data/get_owners.php",
							type: "GET",
							dataType: "json",
						}
					}
				}
			});
	}

})