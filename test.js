(function () {
    var log = (function (el) {
        return function (text) {
            el.html(el.html() + '<br/>' + text);
        };
    })($('#log'));

    var viewModel = kendo.observable({
        
    saveGridCsv: function () {
        viewModel.exportCsv('test-grid', 'testdata.csv');
    },

    // the remote datasource    
    remoteSource: new kendo.data.DataSource({
		  transport: {
			  read: {
				  dataType: "jsonp",
				  url:"http://demos.kendoui.com/service/Twitter/Search?q=kendoui",
				  data: function (response) {
					  return [response];
				  }
			  }
		  },
		  schema: { 
			  data: function(data) { 
				  return data.statuses || [];
			  },			
		  },
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
    })
    // Kendo MVVM binding    
    kendo.bind('body', viewModel);

})()