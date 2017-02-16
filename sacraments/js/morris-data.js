$(function() {

    $.ajax({
        url: "../pages/get_church.php",
        type: "GET",
        dataType: "json",
        context: document.body,
        success: function(data){
          //$(this).addClass("done");
          console.log(JSON.stringify(data) );
            Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010 Q1',
             Simon: '2000',
            iphone: 2666,
            ipad: null,
            itouch: 2647
        }, {
            period: '2010 Q2',
            Simon: '2000',
            iphone: 2778,
            ipad: 2294,
            itouch: 2441
        }],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch', 'Simon'],
        labels: ['iPhone', 'iPad', 'iPod Touch', 'Simon'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

        }
    });

  
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Download Sales",
            value: 12
        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 100,
            b: 90
        }, {
            y: '2007',
            a: 75,
            b: 65
        }, {
            y: '2008',
            a: 50,
            b: 40
        }, {
            y: '2009',
            a: 75,
            b: 65
        }, {
            y: '2010',
            a: 50,
            b: 40
        }, {
            y: '2011',
            a: 75,
            b: 65
        }, {
            y: '2012',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });

});
