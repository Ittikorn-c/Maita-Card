window.Vue = require('vue');
import Chart from 'chart.js';
var randomColor = require('randomcolor'); // import the script 

var myChart;
// var data  = [12, 19, 3, 5, 2, 3];
window.onload = function(){
    const report = new Vue({
        el: "#exchange-age",
        data: {

        },
        methods: {
            onCheckPromotion: function(id){
                
                if($("#promotion-select-" + id).is(":checked")){
                    let data = datasets[id];
                    let bcolor = randomColor({
                        format: "rgba",
                        alpha: 1,
                        luminosity: "light"
                    });
                    let color = bcolor.substring(0, bcolor.lastIndexOf("1")) + "0.4)";

                    let dataset =   {
                                        id: id,
                                        label: data["label"],
                                        data: data["data"],
                                        backgroundColor: color,
                                        borderColor: bcolor,
                                        borderWidth: 1
                                    };
                    myChart.data.datasets.push(dataset);
                    let index = myChart.data.datasets.length-1;
                    
                }else{
                    
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
    let bcolors = randomColor({
        format: "rgba",
        alpha: 1,
        luminosity: "light"
    });
    let colors = [];
    for (let i = 0; i < bcolors.length; i++) {
        let l = bcolors[i].length;
        colors.push(bcolors[i].substring(0, bcolors[i].lastIndexOf("1")) + "0.4)");
    }
    console.log(bcolors, colors);


    var ctx = $("#exchangeChart");
    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: label,
            datasets: [
                // {
                //     label: 'exchage rate',
                //     data: displayData,
                //     backgroundColor: colors,
                //     borderColor: bcolors,
                //     borderWidth: 1
                // }
            ]
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
