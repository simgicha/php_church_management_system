<?php
session_start();
if(!isset($_SESSION['myusername'])){
header('location: index.php');
}
?>
<?php include("top.php"); ?>
    <script>

        function createChart() {
            $("#churchmemberschart").kendoChart({
                theme: "silver",
                title: {
                    text: "Christians Per Church"
                },
                legend: {
                    position: "top"
                },
                dataSource: {
					schema: {
						data: 'data',
						dataType: "jsonp",		
					},
                    transport: {

                        read: function (options) {
                            $.ajax({
                                type: "GET",
                                dataType: "json",
                                url: 'data/get_church_members_count.php',
                                contentType: "application/json; charset=UTF-8",
                                data: JSON.stringify(options.data),
                            }).done(function (data) {
                                options.success(data);
                            }).fail(function (jqXHR) {
                                options.error(jqXHR);
                            });

                        },
                    },

                    group: {
                        field: "local_church"
                    }
                },
                transitions: true,

                categoryAxis: [{
                    
                    labels: {
                      rotation: 90,
                      align: "center"
                    },
                    
                    
                }],

                series: [{
                    type: "column",
                    field: "num",
                    categoryField:"local_church",
                }],

                seriesDefaults: {
                    type: "column",
                    labels: 
                    {    
                        visible: true,
                        color: "green"
                    },
                    gap: 0, 
                    spacing: 0,
                    width:200,
                     visible: true,
                    font: "11px Segoe UI, Arial ",
                    margin: { top: 0, left: 0 },
                    padding: 3,
                    border: { color: "black", width: 0 }
                },                
               
				tooltip: {
                    visible: true,
                    template: "#= series.name #: #= value #"
                }
                //categoryAxis: {
                //    field: "projects"
                //}
            });
        }

        $(document).ready(createChart);
        $(document).bind("kendo:skinChange", createChart);
    </script>

    <script>

        function createChartTithes() {
            $("#titheschart").kendoChart({
                theme: "silver",
                title: {
                    text: "Tithes Per Church"
                },
                legend: {
                    position: "top"
                },
                dataSource: {
					schema: {
						data: 'data',
						dataType: "jsonp",		
					},
                    transport: {

                        read: function (options) {
                            $.ajax({
                                type: "GET",
                                dataType: "json",
                                url: 'data/get_church_tithes_count.php',
                                contentType: "application/json; charset=UTF-8",
                                data: JSON.stringify(options.data),
                            }).done(function (data) {
                                options.success(data);
                            }).fail(function (jqXHR) {
                                options.error(jqXHR);
                            });

                        },
                    },

                    group: {
                        field: "local_church"
                    }
                },
                transitions: true,
                series: [{
                    type: "column",
                    field: "num"
                }],
				tooltip: {
                    visible: true,
                    template: "#= series.name #: #= value #"
                }
                //categoryAxis: {
                //    field: "projects"
                //}
            });
        }

        $(document).ready(createChartTithes);
        $(document).bind("kendo:skinChange", createChartTithes);
    </script>

    <script type="text/javascript">

        $(function gettopinfo() {
            //GET NO OF Churches
            $.ajax({
                type: "GET",
                dataType: "json",
                url: 'data/get_local_churches_count.php',
                contentType: "application/json; charset=UTF-8",

            }).done(function (data) {
                var projectcount = data.data;
				for (var i = 0; i < projectcount.length; i++) {
		    		var object = projectcount[i];
					$('#totalnumberofchurches').append(projectcount[i]['num']);
				}
            }).fail(function (jqXHR) {
                options.error(jqXHR);
            });
            //END GET NO OF Churches

            //GET NO OF Christians
            $.ajax({
                type: "GET",
                dataType: "json",
                url: 'data/get_christians_count.php',
                contentType: "application/json; charset=UTF-8",

            }).done(function (data) {
                var memberscount = data.data;
				
				for (var i = 0; i < memberscount.length; i++) {
		    		var object = memberscount[i];
					$('#totalnumberofmembers').append(memberscount[i]['christians']);
				}				     

            }).fail(function (jqXHR) {
                options.error(jqXHR);
            });
            //END GET NO OF christians
 
});


    </script>



      <!-- BEGIN PAGE -->
      <div class="page-content" style="min-height:590px !important">
      

      
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="width:33%">
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="icon-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number" id="totalnumberofchurches">
                          
                        </div>
                        <div class="desc">
                            Open Churches
                        </div>
                    </div>
                    <a class="more" href="#">TOTAL No OF Local Churches
                               <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
         

             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="width:33%">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="icon-sitemap"></i>
                    </div>
                    <div class="details">
                        <div class="number" id="totalnumberofmembers">
                            
                        </div>
                        <div class="desc">ALL CHRISTIANS</div>
                    </div>
                    <a class="more" href="#">TOTAL No OF Christians <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="width:33%">
                <div class="dashboard-stat purple">
                    <div class="visual">
                        <i class="icon-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number" id="totalnumberofworkers">
                            
                        </div>
                        <div class="desc">TOTAL NO OF SCC</div>
                    </div>
                    <a class="more" href="#">TOTAL No OF small Christian communities <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>            
  
  
            <!-- <div class="col-md-6 col-sm-6"> -->
                <!-- BEGIN PORTLET-->
                <div class="portlet solid light-grey bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bullhorn"></i>
                            Christians Per Church
        
                        </div>
                        <div class="tools">
                            <div class="btn-group pull-right" data-toggle="buttons">
                               
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="churchmemberschart" style="width: 100%; height: 600px; margin: 0 auto;">
                           
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
        
            
  

            

      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>