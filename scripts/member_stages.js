$(document).ready(function () {
	
	var self = this;
	var MemberStagesModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			member_id: {type: "string", validation: { required: true } },
			stage_id: {type: "string", validation: { required: true } },
			date_created: {type: "date", validation: { required: true } },	
			name: {type: "string", validation: { required: false } },	
			stage_name: {type: "string", validation: { required: false } },
			parish_received: {type: "string", validation: { required: true } },
			is_active: {type: "boolean"}			
		}
	});	
	
    var viewModel = kendo.observable({
        MemberStagesDataSource: new kendo.data.DataSource({
            schema: {
                model: MemberStagesModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
					type: "GET",
					dataType: "json",
					url: 'data/get_MemberStages.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_MemberStages.php",
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
					dataType: "json",
					url: "data/get_MemberStages.php",
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
                    url: "data/get_MemberStages.php",
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

			type: "JSON",
			pageSize: 10,
			serverPaging: true,
			serverSorting: true,
			serverFiltering: true,
        })

    });	
	
    $('#memberstagesgrid').kendoGrid({
        dataSource: viewModel.MemberStagesDataSource,
        columns: [
			{ field: "member_id", title:"Member Name", width: "120px",editor: MembersChurchDropDownEditor, template: "#= name #"},  
			{ field: "stage_id", title:"Sacraments", width: "120px",editor: MemberStagesChurchDropDownEditor, template: "#= stage_name #" }, 
            {
                field: 'date_created', title: 'Date Joined', width: 100, format: '{0:dd/MM/yyyy}'
            },	
			{ field: "parish_received", title:"Parish Received", width: "100px" }, 		    		
			{ field: "is_active", title:"Is Active", width: "100px" }, 		                  
			{ command: ["edit", "destroy"], title: "&nbsp;", width: "150px" }
		],
        toolbar: [{ name: "create", text: "Add Sacrament To Member" }],  
                                  
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
				display: "{0}-{1} of {2} Member sacraments",
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
	viewModel.MemberStagesDataSource.read();
	
	function refreshGridData() {
        viewModel.MemberStagesDataSource.read();
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
							type: "GET",
							dataType: "json",
						}
					}
				}
			});
	}
	
	function MemberStagesChurchDropDownEditor(container, options) {
		$('<input required data-text-field="stage_name" data-value-field="id" data-bind="value:' + options.field + '"/>')
			.appendTo(container)
			.kendoDropDownList({
				autoBind: false,
				dataTextField: "stage_name",
				dataValueField: "id",
				optionLabel: {
					stage_name: "Select",
					id: ""
				},
				dataSource:{
					schema: {
						data: "data"
					},
					transport: {
						read: {
							url:"data/get_stages.php",
							type: "GET",
							dataType: "json",
						}
					}
				}
			});
	}	
})