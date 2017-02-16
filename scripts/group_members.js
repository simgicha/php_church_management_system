$(document).ready(function () {
	
	var self = this;
	var groupMembersModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			member_id: {type: "string", validation: { required: true } },
			group_id: {type: "string", validation: { required: true } },
			date_created: {type: "date", validation: { required: true } },		
			is_active: {type: "boolean"}						
		}
	});	
	
    var viewModel = kendo.observable({
        groupMembersDataSource: new kendo.data.DataSource({
            schema: {
                model: groupMembersModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},
            },
			
            transport: {
                read: {
					type: "GET",
					dataType: "json",
					url: 'data/get_groupMembers.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_groupMembers.php",
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
					url: "data/get_groupMembers.php",
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
                    url: "data/get_groupMembers.php",
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
	
    $('#groupmembersgrid').kendoGrid({
        dataSource: viewModel.groupMembersDataSource,
        columns: [
			{ field: "member_id", title:"Member Name", width: "120px",editor: MembersChurchDropDownEditor},  
			{ field: "group_id", title:"Associations Name", width: "120px",editor: groupMembersChurchDropDownEditor }, 
            {
                field: 'date_created', title: 'To', width: 100, format: '{0:dd/MM/yyyy}'
            },			
			{ field: "is_active", title:"Is Active", width: "100px" }, 		                  
			{ command: ["edit", "destroy"], title: "&nbsp;", width: "150px" }
		],
        toolbar: [{ name: "create", text: "Add Associations Member" }],  
                                  
        columnResizeHandleWidth: 6,
        columnMenu: true,
		resizable: true,                               
        sortable: true,
		selectable: 'row',
        serverFiltering: true,
		sort: { field: "id", dir: "desc" },
		pageable: {
			input: true,
			refresh: true,
			pageSizes: [10, 20, 30, 40, 50, 100],
			buttonCount: 10,
			messages: {
				empty: "No data",
				display: "{0}-{1} of {2} Associations Members",
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
        		return 'Are you sure you want to delete  '+model.member_id+'?'
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
	
	viewModel.groupMembersDataSource.read(); // "read()" will fire the "change" event of the dataSource and the widget will be bound
	
	function refreshGridData() {
        viewModel.groupMembersDataSource.read();
    }	
	
	function MembersChurchDropDownEditor(container, options) {
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
							url:"data/get_members.php",
							type: "GET"
						}
					}
				}
			});
	}
	
	function groupMembersChurchDropDownEditor(container, options) {
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
							url:"data/get_groups.php",
							type: "GET"
						}
					}
				}
			});
	}	
})