window.Vue = require('vue');
import Chart from 'chart.js';
var randomColor = require('randomcolor'); // import the script 

var myChart;
var mcolor = 'rgba(79, 138, 255, 0.4)'
var bmcolor = 'rgba(79, 138, 255, 1)'
var fcolor = 'rgba(255, 61, 237, 0.4)'
var bfcolor = 'rgba(255, 61, 237, 1)'
// var data  = [12, 19, 3, 5, 2, 3];
window.onload = function(){
    const report = new Vue({
        el: "#exchange-gender",
        data: {

        },
        methods: {
            onCheckPromotion: function(id){
                console.log("click ", id);
                let dataset = datasets[id];
                console.log(datasets);
                let data = [
                    dataset.data.male,
                    dataset.data.female
                ];

                myChart.data.datasets[0].data = data;
                
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
        type: 'pie',
        data: {
            labels: label,
            datasets: [
                {
                    label: 'exchage rate',
                    data: (datasets.length==0)?[0, 0]:[
                        datasets[Object.keys(datasets)[0]].data.male,
                        datasets[Object.keys(datasets)[0]].data.female
                    ],
                    backgroundColor: [ mcolor, fcolor],
                    borderColor: [ bmcolor, bfcolor ] ,
                    borderWidth: 1
                }
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

function getDataIndex(id){

    
    return idIndexHash[id];
}

function addDataIndex(id, index){

    idIndexHash[id] = index;
}
