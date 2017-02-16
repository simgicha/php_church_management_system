$(document).ready(function () {
	
	var self = this;
	var harvestModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			member_id: {type: "string", validation: { required: true } },
			payment_mode: {type: "string", validation: { required: true } },
			date_paid: {type: "date", validation: { required: true } },		
			amount: {type: "string", validation: { required: true } },
			tithe_id: {type: "string", validation: { required: true } },
			name: {type: "string", validation: { required: false } },
			income_type: {type: "string", validation: { required: false } },
			description1: {type: "string", validation: { required: false } }
		}
	});	
	
    var viewModel = kendo.observable({
        harvestsDataSource: new kendo.data.DataSource({
            schema: {
                model: harvestModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},
            },
			
            transport: {
                read: {
					type: "GET",
					dataType: "json",
					url: 'data/get_harvests.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_harvests.php",
					complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Harvest Contribution updated successfully');
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
					url: "data/get_harvests.php",
					dataType: "json",
					complete: function(status) {
						 
						var code = status.status;
						if (code === 200) {
							refreshGridData();
							alert('Harvest Contribution added successfully');
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
                    url: "data/get_harvests.php",
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
	
    $('#harvestsgrid').kendoGrid({
        dataSource: viewModel.harvestsDataSource,
        columns: [
			{ field: "member_id", title:"Member Name", editor: MembersChurchDropDownEditor,template: "#= name #"},  
			{ field: "tithe_id", title:"Harvest Name",editor: tithesDropDownEditor,template: "#= description1 #" }, 
            { field: 'date_paid', title: 'Payment Date',  format: '{0:dd/MM/yyyy}'},			
            { field: "payment_mode", title:"Payment Mode", editor: moneyTypesDropDownEditor,template: "#= income_type #" },	
			{ field: "amount", title:"Amount"},			                  
			{ command: ["edit", "destroy"], title: "&nbsp;" }
		],
        toolbar: [{ name: "create", text: "Add Harvest" }],  
                                  
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
				display: "{0}-{1} of {2} Harvest Contribution",
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
	
	viewModel.harvestsDataSource.read(); // "read()" will fire the "change" event of the dataSource and the widget will be bound
	
	function refreshGridData() {
        viewModel.harvestsDataSource.read();
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
	
	function tithesDropDownEditor(container, options) {
		$('<input required data-text-field="description" data-value-field="id" data-bind="value:' + options.field + '"/>')
			.appendTo(container)
			.kendoDropDownList({
				autoBind: false,
				dataTextField: "description",
				dataValueField: "id",
				optionLabel: {
					description: "Select",
					id: ""
				},
				dataSource:{
					schema: {
						data: "data"
					},
					transport: {
						read: {
							type: "GET",
							dataType: "json",
							url: 'data/get_tithes_set_up.php',
						}
					}
				}
			});
	}	
	
	function moneyTypesDropDownEditor(container, options) {
			$('<input required data-text-field="income_type" data-value-field="id" data-bind="value:' + options.field + '"/>')
				.appendTo(container)
				.kendoDropDownList({
					autoBind: false,
					dataTextField: "income_type",
					dataValueField: "id",
					optionLabel: {
						income_type: "Select",
						id: ""
					},
					dataSource:{
						schema: {
							data: "data"
						},
						transport: {
							read: {
								url:"data/get_money_types.php",
								type: "GET",
								dataType: "json",
							}
						}
					}
				});
		}
})