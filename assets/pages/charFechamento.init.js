/**
Template Name: Ubold Dashboard
Author: CoderThemes
Email: coderthemes@gmail.com
File: Chartjs
*/

function carregarChart(){

!function($) {
    "use strict";
    var ChartJs = function() {};

    ChartJs.prototype.respChart = function respChart(selector,type,data, options) {
        // get selector by context
        var ctx = selector.get(0).getContext("2d");
        // pointing parent container to make chart js inherit its width
        var container = $(selector).parent();

        // enable resizing matter
        $(window).resize( generateChart );

        // this function produce the responsive Chart JS
        function generateChart(){
            // make chart width fit with its container
            var ww = selector.attr('width', $(container).width() );
            new Chart(ctx).Bar(data, options);

        };
        // run function - render chart at first load
        generateChart();
    },
    //init
    ChartJs.prototype.init = function() {
        //creating lineChart
        
        var labelChart = document.getElementById('labelChart').value;
        alert(labelChart);
        
        
        var LineChart = {
            //labels : ["01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"],
            labels : [labelChart],
            datasets : [
                {
                    fillColor : "rgba(93, 156, 236, 0.5)",
                    strokeColor : "rgba(93, 156, 236, 1)",
                    pointColor : "rgba(93, 156, 236, 1)",
                    pointStrokeColor : "#fff",
                    data : [13,48,29,42,40,23,36,11,27,33,45,47,31,28,16,22,43,12,10,8,28,]
                    /*data : [dadosChart]*/
                }
                
            ]
        };
        
        this.respChart($("#lineChart"),'Line',LineChart);

    },
    $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.ChartJs.init()
}(window.jQuery);

}