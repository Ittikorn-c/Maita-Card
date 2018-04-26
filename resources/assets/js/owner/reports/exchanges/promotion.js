window.Vue = require('vue');
import Chart from 'chart.js';
var randomColor = require('randomcolor'); // import the script 

var displayIndex = [];
var displayData = [];
var displayLabel = [];
var shortLabel = [];
var myChart;
// var data  = [12, 19, 3, 5, 2, 3];
window.onload = function(){
    const report = new Vue({
        el: "#exchange-promotion",
        data: {

        },
        methods: {
            onCheckPromotion: function(index){
                console.log(index);
                let i = displayIndex.indexOf(index);
                if(i != -1){
                    displayIndex.splice(i, 1);
                    myChart.data.labels.splice(i, 1);
                    myChart.data.datasets[0].data.splice(i, 1);
                }else{
                    displayIndex.push(index);
                    myChart.data.labels.push(shortLabel[index]);
                    myChart.data.datasets[0].data.push(bundle.data[index]);
                }
                myChart.update();
                console.log(displayLabel, displayIndex);
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
    shortLabel = shortenLabel(bundle.label, 8);
    let bcolors = randomColor({
        count: bundle.label.length,
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

    for (let i = 0; i < bundle.label.length; i++) {
        if(bundle.available[i] == 1){
            displayLabel.push(shortLabel[i]);
            displayData.push(bundle.data[i]);
            displayIndex.push(i);
            
        }
    }

    var ctx = $("#exchangeChart");
    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: displayLabel,
            datasets: [{
                label: 'exchage rate',
                data: displayData,
                backgroundColor: colors,
                borderColor: bcolors,
                borderWidth: 1
            }]
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
