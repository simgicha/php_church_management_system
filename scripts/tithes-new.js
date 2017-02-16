$(document).ready(function () {
	
	var self = this;
	var sccModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			name: {type: "string", validation: { required: true } },
			local_church_id: {type: "string", validation: { required: true } },
			local_church_name: {type: "string", validation: { required: false } },
			member_name:{type: "string", validation: { required: false } },
		}
	});	
	
    var viewModel = kendo.observable({
        sccDataSource: new kendo.data.DataSource({
			batch: true,
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
					url: 'data/get_member_tithes.php',
                },
				update: {
					type: "PUT",
					dataType: "json",
					url: "data/get_member_tithes.php",
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
                        url: "data/get_member_tithes.php",
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

                    var url = 'data/get_member_tithes.php' + options.data.id;
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
            pageSize: 10000,
        })

    });	
	
    $('#new-tithes-grid').kendoGrid({
        dataSource: viewModel.sccDataSource,
		navigatable: true,
        columns: [
			
			{ field: "local_church_id", title:"Church name", width: "120px",editor: churchDropDownEditor,template: "#= member_name #"  }, 
            { field: "name", title:"Small Christian Community", width: "120px"  },
			{ field: "amount", title:"Tithe Amount", width: "120px"  },         
			
		],
		editable: true,
       
        toolbar: ["save", "cancel"],                          
        columnResizeHandleWidth: 6,
        columnMenu: true,
		resizable: true,                               
        sortable: true,
		pageable: {
			input: true,
			refresh: true,
			pageSizes: [10000, 20000, 30000, 40000, 50000, 100000],
			buttonCount: 10000,
			messages: {
				empty: "No data",
				display: "{0}-{1} of {2} Progress",
				itemsPerPage: "per page"
			}
		},

        pageSize: 10000,
        filterable: {
            extra: false
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