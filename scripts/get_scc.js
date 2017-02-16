$(document).ready(function () {
	
	var self = this;
	var sccModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			name: {type: "string", validation: { required: true } },
			local_church_id: {type: "string", validation: { required: true } },
			local_church_name: {type: "string", validation: { required: false } },
		}
	});	
	
    var viewModel = kendo.observable({
        sccDataSource: new kendo.data.DataSource({
            schema: {
                model: sccModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
					type: "GET",
					dataType: "json",
					url: 'data/get_scc.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_scc.php",
					complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Scc updated successfully');
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
                        url: "data/get_scc.php",
						complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Scc added successfully');
								options.success(status);
								//self.read();
								//refreshGridData();
							} else {
								alert(status.responseText);
								options.error(status);
							} 
						}	
                    
                },
                destroy: function (options) {
                    if (!confirm("Are you sure you want to delete this record?"))
                        return;

                    var url = 'data/get_scc.php' + options.data.id;
                    $.ajax({
                        type: "DELETE",
                        dataType: "json",
                        url: url
                    }).complete(function (jqXHR) {
                        var code = jqXHR.status;
                        if (code === 204) {
                            refreshGridData();
                            alert('Record deleted');
                            options.success(jqXHR);
                        } else {
                            alert(jqXHR.responseText);
                            options.error(jqXHR);
                        }
                    });
                },
				
            },
            pageSize: 10,
        })

    });	
	
    $('#sccgrid').kendoGrid({
        dataSource: viewModel.sccDataSource,
        columns: [
			{ field: "name", title:"Small Christian Community", width: "120px"  },  
			{ field: "local_church_id", title:"Church name", width: "120px",editor: churchDropDownEditor,template: "#= local_church_name #"  }, 
                   
			{ command: ["edit", "destroy"], title: "&nbsp;", width: "150px" }
		],
        toolbar: [{ name: "create", text: "Add Scc" }],  
                                  
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
        viewModel.sccDataSource.read();
    }	
	
	function churchDropDownEditor(container, options) {
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
							type: "GET"
						}
					}
				}
			});
	}
})