$(document).ready(function () {
	
	var self = this;
	var offeringsModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			local_church_id: {type: "string", validation: { required: true } },
			amount: {type: "string", validation: { required: true } },	
			contribution_date: {type: "date", validation: { required: true } },
			local_church_name: {type: "string", validation: { required: true } },
		}
	});	
	
    var viewModel = kendo.observable({
        membersDataSource: new kendo.data.DataSource({
            schema: {
                model: offeringsModel,
                data: 'data',
				total: function(data) {
					return data.data.length;
				},				
            },
			
            transport: {
                read: {
					type: "GET",
					dataType: "json",
					url: 'data/get_offerings.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_offerings.php",
					complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Offerings updated successfully');
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
					url: "data/get_offerings.php",
					complete: function(status) {
						 
						var code = status.status;
						if (code === 200) {
							refreshGridData();
							alert('Offerings added successfully');
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
                    url: "data/get_offerings.php",
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
	
    $('#offeringsgrid').kendoGrid({
        dataSource: viewModel.membersDataSource,
        columns: [
			{ field: "local_church_id", title:"Local Church" ,editor: localChurchDropDownEditor,template: "#= local_church_name #"},
			{ field: "amount", title:"Amount" }, 
 			{ field: "contribution_date", title:"Contribution Date", format: '{0:dd/MM/yyyy}' },       
			{ command: ["edit", "destroy"], title: "&nbsp;" }
		],
        toolbar: [{ name: "create", text: "Add New Offering" }], 
                                  
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
				display: "{0}-{1} of {2} offering",
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
        		return 'Are you sure you want to delete  '
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


 $("#btnExport").click(function(e) {
	 viewModel.exportCsv('churchesgrid', 'churches.csv');
     
/* var dataSource =  $("#membersgrid").data("kendoGrid").dataSource; 
     var filteredDataSource = new kendo.data.DataSource( { 
         data: dataSource.data(), 
         filter: dataSource.filter() 
     }); 
     
     filteredDataSource.read();
     var data = filteredDataSource.view();
     
     var result = "data:application/vnd.ms-excel,";
     
     result += "<table><tr><th>Member Name</th><th>Local Church</th><th>SCC</th><th>Marrital Status</th></tr>";
     
     for (var i = 0; i < data.length; i++) {
         result += "<tr>";
         
         result += "<td>";
         result += data[i].name;
         result += "</td>";
         
         result += "<td>";
         result += data[i].local_church;
         result += "</td>";
         
/*         result += "<td>";
         result += kendo.format("{0:MM/dd/yyyy}", data[i].OrderDate);
         result += "</td>";*/
         
/*         result += "<td>";
         result += data[i].scc;
         result += "</td>";

         result += "<td>";
         result += data[i].marrital_status;
         result += "</td>";
         
         result += "</tr>";
     }
     
     result += "</table>";
     if (window.navigator.msSaveBlob) {
            window.navigator.msSaveBlob(new Blob([result]), 'export.csv');
        } else {
            window.open(result);
        }
   
     
     e.preventDefault();*/
});


		function exportCsv (gridId, fileName) {
             var grid = $("#" + gridId).data("kendoGrid");
                var originalPageSize = grid.dataSource.pageSize();
                var csv = '';
                fileName = fileName || 'download.csv';

                // Increase page size to cover all the data and get a reference to that data
                grid.dataSource.pageSize(grid.dataSource.view().length);
                var data = grid.dataSource.view();

                //add the header row
                for (var i = 0; i < grid.columns.length; i++) {
                    var field = grid.columns[i].field;
                    var title = grid.columns[i].title || field;

                    //NO DATA
                    if (!field) continue;

                    title = title.replace(/"/g, '""');
                    csv += '"' + title + '"';
                    if (i < grid.columns.length - 1) {
                        csv += ',';
                    }
                }
                csv += '\n';

                //add each row of data
                for (var row in data) {
                    for (var i = 0; i < grid.columns.length; i++) {
                        var fieldName = grid.columns[i].field;
                        var template = grid.columns[i].template;
                        var exportFormat = grid.columns[i].exportFormat;

                        //VALIDATE COLUMN
                        if (!fieldName) continue;
                        var value = '';
                        if (fieldName.indexOf('.') >= 0)
                        {
                        var properties = fieldName.split('.');
                        var value = data[row] || '';
                        for (var j = 0; j < properties.length; j++) {
                            var prop = properties[j];
                            value = value[prop] || '';
                        }
                        }
                        else{
                            
                       value = data[row][fieldName] || '';
                        }
                        if (value && template && exportFormat !== false) {
                            value = _.isFunction(template)
                                ? template(data[row])
                                : kendo.template(template)(data[row]);
                        }

                        value = value.toString().replace(/"/g, '""');
                        csv += '"' + value + '"';
                        if (i < grid.columns.length - 1) {
                            csv += ',';
                        }
                    }
                    csv += '\n';
                }

                // Reset datasource
                grid.dataSource.pageSize(originalPageSize);

                //EXPORT TO BROWSER
                var blob = new Blob([csv], { type: 'text/csv;charset=utf-8' }); //Blob.js
                saveAs(blob, fileName); //FileSaver.js
        }

})