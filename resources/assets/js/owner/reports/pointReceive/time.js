window.Vue = require('vue');
import Chart from 'chart.js';
var randomColor = require('randomcolor'); // import the script 

var myChart;
// var data  = [12, 19, 3, 5, 2, 3];
window.onload = function(){
    const report = new Vue({
        el: "#pointReceive-time",
        data: {

        },
        methods: {
            onCheckPromotion: function(id){
                
                if($("#template-select-" + id).is(":checked")){
                    console.log("checked");
                    let data = datasets[id];
                    // let bcolor = randomColor({
                    //     format: "rgba",
                    //     alpha: 1,
                    //     luminosity: "light"
                    // });
                    // let color = bcolor.substring(0, bcolor.lastIndexOf("1")) + "0.4)";
                    let bcolor, color;
                    ({bcolor,color} = randomChartColor());
                    let dataset =   {
                                        id: id,
                                        label: data["template_name"],
                                        data: data["data"],
                                        backgroundColor: color,
                                        borderColor: bcolor,
                                        borderWidth: 1
                                    };
                    myChart.data.datasets.push(dataset);
                    let index = myChart.data.datasets.length-1;
                    
                }else{
                    console.log("unchecked")
                    for (var i = 0; i < myChart.data.datasets.length; i++) {
                        const data = myChart.data.datasets[i];
                        if(data.id == id)
                            break;
                    }
                    myChart.data.datasets.splice(i, 1);
                }
                myChart.update();
            }
        }
    });

    initExchangeChart();
}

function randomChartColor(){
    let bcolor = randomColor({
        format: "rgba",
        alpha: 1,
        luminosity: "light"
    });
    let color = bcolor.substring(0, bcolor.lastIndexOf("1")) + "0.4)";
    
    return {
        bcolor: bcolor,
        color: color
    };
}

function shortenLabel(label, n){
    let labels = [];
    for (let i = 0; i < label.length; i++) {
        if(label[i].length > n){
            let l = label[i].substring(0, n-1) + "...";
            labels.push(l);
        }
    }
    return labels;
}

function initExchangeChart(){
    
    let ds = [];
    $.each(datasets, function(id, e) {
        let bcolor, color;
        ({bcolor, color} = randomChartColor());
        let d = {
            id: id,
            label: e.template_name,
            data: e.data,
            backgroundColor: color,
            borderColor: bcolor,
            borderWidth:1
        };
        ds.push(d);
    });  

    var ctx = $("#pointReceiveChart");
    myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: label,
            datasets: ds
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    })
} 
