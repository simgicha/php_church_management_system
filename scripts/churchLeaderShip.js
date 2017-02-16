$(document).ready(function () {
	var leadersModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			name: {type: "string", validation: { required: true } },
			Location: {type: "string", validation: { required: true } },
			Address: {type: "string", validation: { required: true } }
		}
	});	
	
    var viewModel = kendo.observable({
        churchesDataSource: new kendo.data.DataSource({
            schema: {
                model: leadersModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
            transport: {
                read: {            
					type: "GET",
					dataType: "json",
					url: 'data/get_church.php',
                },
            },
            type: "JSON",
            pageSize: 10,
        })

    });	
	
    $('#churchLeadershipGrid').kendoGrid({
        dataSource: viewModel.churchesDataSource,
        columns: [                            
            { field: "id", title:"id", width: "120px"  },
            { field: "name", title:"name", width: "120px" },
            { field: "Location", title:"Location", width: "120px"},
            { field: "Address", title:"Address", width: "120px"},
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
        viewModel.churchesDataSource.read();
    }	

	function initDetailTemplate(e) {
		var leadershipModel = kendo.data.Model.define({
			id: "id",
			fields: { 
				member_id: { validation: { required: true } },
				position_id: { validation: { required: true } },
				start_date: {type: "date", validation: { required: true } },
				is_active: {type: "boolean"},		
				name: {type: "string" },
				position: {type: "string", validation: { required: true } },			
			}
		});	
		

		var viewModel = kendo.observable({
			LeadershipDataSource: new kendo.data.DataSource({
				schema: {
					model: leadershipModel,
					data: 'data',
					total: function(data) {
						return data.data.length;
					},
				},
				transport: {
					read: {
						type: "GET",
						dataType: "json",
						url: 'data/get_church_leaders.php',
					},
					create: {
						  type: "PUT",
						  dataType: "json",
						  url: 'data/get_church_leaders.php?local_church_id='+e.data.id,
						  data: {'local_church_id': e.data.id},
						   complete: function(status) {
							  var code = status.status;
							  if (code === 200) {
								  
								  alert('Item added successfully');
								  refreshLeaderGridData();
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
						url: "data/get_church_leaders.php",
						complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshLeaderGridData();
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
						url: "data/get_church_leaders.php",
						complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshLeaderGridData();
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
				
				filter: [{ field: "local_church_id", operator: "eq", value: e.data.id }]	
			})
	
		});	

		
		$("<div/>").appendTo(e.detailCell).kendoGrid({
			dataSource: viewModel.LeadershipDataSource,
            columns: [
				
                 { field: "member_id", title:"Member Name" , editor: membersDropDownEditor, template: "#= name #"},
                 { field: "position_id", title:"Position", editor: positionDownEditor, template: "#= position #" },
                 { field: "start_date",title:"Start Date", format: '{0:dd/MM/yyyy}' },
                 { field: "is_active",title:"Acting"},
				 
                 { command: ["edit", "destroy"], title: "&nbsp;", width: "200px" }
            ],
            toolbar: [{ name: "create", text: "Add New Member" }],
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
		
		function refreshLeaderGridData() {
			viewModel.LeadershipDataSource.read();
		}
		
	}
	
	function membersDropDownEditor(container, options) {
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
							type: "GET",
							dataType: "json",
						}
					}
				}
			});
	}
	
	function positionDownEditor(container, options) {
		$('<input required data-text-field="position" data-value-field="id" data-bind="value:' + options.field + '"/>')
			.appendTo(container)
			.kendoDropDownList({
				autoBind: false,
				dataTextField: "position",
				dataValueField: "id",
				optionLabel: {
					position: "Select Item",
					id: ""
				},
				dataSource:{
					schema: {
						data: "data"
					},
					transport: {
						read: {
							url:"data/get_leadership_positions.php",
							type: "GET"
						}
					}
				}
			});
	}

})
// JavaScript Document