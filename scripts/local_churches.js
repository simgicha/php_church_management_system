$(document).ready(function () {
	
    var log = (function (el) {
        return function (text) {
            el.html(el.html() + '<br/>' + text);
        };
    })($('#log'));
	
		
	var self = this;
	var churchModel = kendo.data.Model.define({
		id: "id",
		fields: { 
			name: {type: "string", validation: { required: true } },
			Location: {type: "string", validation: { required: true } },
			Address: {type: "string", validation: { required: true } }
				
		}
	});	

				
    var viewModel = kendo.observable({
		saveGridCsv: function () {
        	viewModel.exportCsv('churchesgrid', 'churches.csv');
        },
        churchDataSource: new kendo.data.DataSource({
            schema: {
                model: churchModel,
                data: 'data',
				dataType: "jsonp",
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
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_church.php",
					complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Church updated successfully');
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
                        url: "data/get_church.php",
						complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshGridData();
								alert('Church added successfully');
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
                    url: "data/get_church.php",
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


        }),

        exportCsv: function (gridId, fileName) {
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
    });	
	
    $('#churchesgrid').kendoGrid({
        dataSource: viewModel.churchDataSource,
        columns: [ 
			{ field: "name", title:"Church Name", width: "120px"  },  
			{ field: "Location", title:"Location", width: "120px"  }, 
			{ field: "Address", title:"Address", width: "120px"  },                   
			{ command: ["edit", "destroy"], title: "&nbsp;", width: "150px" }	
		],
        toolbar: [{ name: "create", text: "Add Church" }],        
                                  
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
	viewModel.churchDataSource.read();
	function refreshGridData() {
        viewModel.churchDataSource.read();
    }	

})