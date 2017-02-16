$(document).ready(function () {
	
	var self = this;
	var membersModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			name: {type: "string", validation: { required: true } },
			local_church: {type: "string", validation: { required: true } },
			scc: {type: "string", validation: { required: true } },
			marital_status: {type: "string", validation: { required: true } },	
			marrital_status: {type: "string", validation: { required: false } },	
			registration_date: {type: "date", validation: { required: true } },
			local_church_name: {type: "string", validation: { required: true } },
			scc_name: {type: "string", validation: { required: true } },
			phone_number: {type: "string", validation: { required: false } }
		}
	});	
	
    var viewModel = kendo.observable({
        membersDataSource: new kendo.data.DataSource({
            schema: {
                model: membersModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
					type: "GET",
					dataType: "json",
					url: 'data/get_members.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_members.php",
					complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Member updated successfully');
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
					url: "data/get_members.php",
					dataType: "json",
					complete: function(status) {
						 
						var code = status.status;
						if (code === 200) {
							refreshGridData();
							alert('Member added successfully');
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
                    url: "data/get_members.php",
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
	
    $('#membersgrid').kendoGrid({
        dataSource: viewModel.membersDataSource,
        columns: [
			{ field: "name", title:"Member Name"  },
			{ field: "local_church", title:"Local church",editor: localChurchDropDownEditor,template: "#= local_church_name #" }, 
 			{ field: "scc", title:"SCC",editor: sccDropDownEditor,template: "#= scc_name #" },
			{ field: "marrital_status", title:"marrital status",  editor: maritalStatusDropDownEditor,template: "#= marital_status #" },
			{ field: "registration_date", title:"Registration Date",  format: '{0:dd/MM/yyyy}' },  
			{ field: "phone_number", title:"Phone No" },        
			
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
			//confirmation: "Are you sure you want to delete this record?", // the confirmation message for destroy command
            confirmation: function(model) {
        		return 'Are you sure you want to delete  '+model.name+'?'
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
        viewModel.membersDataSource.read();
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
	
	function sccDropDownEditor(container, options) {
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
							url:"data/get_scc.php",
							type: "GET",
							dataType: "json",
						}
					}
				}
			});
	}	
	

	function maritalStatusDropDownEditor(container, options) {
		$('<input required data-text-field="marital_status" data-value-field="id" data-bind="value:' + options.field + '"/>')
			.appendTo(container)
			.kendoDropDownList({
				autoBind: false,
				dataTextField: "marital_status",
				dataValueField: "id",
				optionLabel: {
					marital_status: "Select",
					id: ""
				},
				dataSource:{
					schema: {
						data: "data"
					},
					transport: {
						read: {
							url:"data/get_marital_status.php",
							type: "GET",
							dataType: "json",
						}
					}
				}
			});
	}




})