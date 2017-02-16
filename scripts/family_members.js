$(document).ready(function () {

	
	    $('.fancybox').fancybox({
        helpers: {
            overlay: null
        },
        padding: 1,
        maxHeight: 500
    });

	
	var self = this;
	var membersModel = kendo.data.Model.define({
		id: "family_id",
		fields: { 
			id: { editable: false, nullable: true },
			name: {type: "string", validation: { required: true } },
			local_church: {type: "string", validation: { required: true } },
			scc: {type: "string", validation: { required: true } },
			marital_status: {type: "string", validation: { required: true } },	
			marrital_status: {type: "string", validation: { required: false } },	
			local_church_name: {type: "string", validation: { required: true } },
			registration_date: {type: "date", validation: { required: true } },
			scc_name: {type: "string", validation: { required: true } },
			phone_number: {type: "string", validation: { required: false } },
			family_name: {type: "string", validation: { required: false } },
			no_of_children: {type: "int", validation: { required: false } },
			economic_activity: {type: "string", validation: { required: false } },
			member_photo: { type: "string", defaultValue: "",validation: { required: false }  }
					
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
					url: 'data/get_families.php',
                },
				update: {
					type: "POST",
					dataType: "json",
					url: "data/get_families.php",
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
					url: "data/get_families.php",
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
                    url: "data/get_families.php",
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
	
    $('#familymembersgrid').kendoGrid({
        dataSource: viewModel.membersDataSource,
        columns: [
			{ field: "family_name", title:"Family Name", width: "120px"  },
			{ field: "name", title:"Family Head", width: "120px"  },
			{ field: "local_church", title:"Local church", width: "120px",editor: localChurchDropDownEditor,template: "#= local_church_name #" }, 
 			{ field: "scc", title:"SCC", width: "120px",editor: sccDropDownEditor,template: "#= scc_name #" },
			{ field: "marital_status", title:"Marital status", width: "120px", editor: maritalStatusDropDownEditor,template: "#= marital_status #" },

			{ field: "phone_number", title:"Phone No", width: "120px"  },  
			{
                field: 'member_photo', title: 'Member Photo', width: 140,
                template: kendo.template($("#timeInPhotoTemplate").html())
            },  

			{ field: "economic_activity", title:"Economic Activty", width: "120px"  },
			{ field: "registration_date", title:"Date of Birth", width: "120px", format: '{0:dd/MM/yyyy}' },  					
			{ field: "no_of_children", title:"Children No", width: "120px"  }, 
			{ command: ["edit"], title: "&nbsp;", width: "150px" }
		],
        toolbar: [{ name: "create", text: "Click Here to add New Family." }], 
                                  
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
			template: kendo.template($("#memberEditTemplate").html()),
			

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
        save: function(e,c){
            e.model.set("image",$("#uploadedFile").val());
        },
		
        edit: function (e) {
            if (e.model.isNew()) {
                $("a.k-grid-update")[0].innerHTML = "<span class='k-icon k-update'></span>Save";
                e.container.kendoWindow("title", "Add New Member");
				var editWindow = this.editable.element.data("kendoWindow");
    			editWindow.wrapper.css({ width: 800 }); 
            }
            else {
                $("a.k-grid-update")[0].innerHTML = "<span class='k-icon k-update'></span>Update";
                e.container.kendoWindow("title", "Edit Member");
            }
        },
		detailInit: initDetailTemplateMembersFamily,
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

    $('.fancybox').fancybox({
        helpers: {
            overlay: null
        },
        padding: 1,
        maxHeight: 500
    });
	
    function fileEditor(container, options)
    {
        $('<input type="file" name="file"/>')
            .appendTo(container)
            .kendoUpload({
                multiple: false,
                async: {
                    saveUrl: "/Home/Save",
                    autoUpload: true
                },
                upload: function (e) {
                    e.data = { family_id: options.model.family_id};

                    if (options.model.imageID) {
                        e.data.imageID = options.model.imageID;
                    }
                },
                success: function (e) {
                    options.model.set("member_photo", e.response.fileName);

                    if (e.response.imageID) {
                        options.model.set("imageID", e.response.imageID);
                    }
                }
            });
    }
	
	
	
	
	
	
	function initDetailTemplateMembersFamily(e) {
		var familyDetailsModel = kendo.data.Model.define({
			id: "id",
			fields: { 
				name: {type: "string", validation: { required: true } },
				local_church: {type: "string", validation: { required: true } },
				scc: {type: "string", validation: { required: true } },
				marital_status: {type: "string", validation: { required: true } },	
				marrital_status: {type: "string", validation: { required: false } },	
				local_church_name: {type: "string", validation: { required: true } },
				registration_date: {type: "date", validation: { required: true } },
				scc_name: {type: "string", validation: { required: true } },
				phone_number: {type: "string", validation: { required: false } },
				
				
				member_photo: { type: "string", defaultValue: "",validation: { required: false }  }
			}
		});	
		

		var viewModel = kendo.observable({
			familyDetailsDataSource: new kendo.data.DataSource({
				schema: {
					model: familyDetailsModel,
					data: 'data',
					total: function(data) {
						return data.data.length;
					},
				},
				transport: {
					read: {
						type: "GET",
						dataType: "json",
						url: 'data/get_member_details.php',
					},
					create: {
						  type: "PUT",
						  dataType: "json",
						  url: 'data/get_member_details.php?family_id='+e.data.id,
						  data: {'family_id': e.data.id},
						   complete: function(status) {
							  var code = status.status;
							  if (code === 200) {
								  
								  alert('Member added successfully');
								  refreshFamilyDetailsGridData();
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
						url: "data/get_member_details.php",
						complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshFamilyDetailsGridData();
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
					destroy: {
						type: "DELETE",
						dataType: "json",
						url: "data/get_member_details.php",
						complete: function(status) {
							 
							var code = status.status;
							if (code === 200) {
								refreshFamilyDetailsGridData();
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
				
				filter: [{ field: "family_id", operator: "eq", value: e.data.id }]	
			})
	
		});	

		
		$("<div/>").appendTo(e.detailCell).kendoGrid({
			dataSource: viewModel.familyDetailsDataSource,
            columns: [
				{ field: "name", title:"Member Name", width: "120px"  },
				{ field: "local_church", title:"Local church", width: "120px",editor: localChurchDropDownEditor,template: "#= local_church_name #" }, 
				{ field: "scc", title:"SCC", width: "120px",editor: sccDropDownEditor,template: "#= scc_name #" },
				{ field: "marrital_status", title:"Marital status", width: "120px", editor: maritalStatusDropDownEditor,template: "#= marital_status #" },
				{ field: "registration_date", title:"Date of Birth", width: "120px", format: '{0:dd/MM/yyyy}' },  
				{ field: "phone_number", title:"Phone No", width: "120px"  },   
				
				{
					field: 'member_photo', title: 'Member Photo', width: 140,
					template: kendo.template($("#timeInPhotoTemplate").html())
				}, 
				{ command: ["edit", "destroy"], title: "&nbsp;", width: "150px" }
            ],
            toolbar: [{ name: "create", text: "Add New Family Member" }],
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
				template: kendo.template($("#memberDetailsEditTemplate").html()),
				confirmation: function(model) {
					return 'Are you sure you want to delete  '+model.item_name+'?'
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
                    e1.container.kendoWindow("title", "Add New Member Number");
                } else {
                    $("a.k-grid-update")[0].innerHTML = "<span class='k-icon k-update'></span>Update";
                    e1.container.kendoWindow("title", "Edit Item Details");
                }
            }	
			
					 
			 
		})
		
		function refreshFamilyDetailsGridData() {
			viewModel.familyDetailsDataSource.read();
		}
		
	}

})