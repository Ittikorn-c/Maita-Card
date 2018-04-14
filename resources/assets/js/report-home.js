window.Vue = require('vue');
import Chart from 'chart.js';
var randomColor = require('randomcolor'); // import the script 

// var data  = [12, 19, 3, 5, 2, 3];
window.onload = function(){
    const report = new Vue({
        el: "#report",
        data: {

        },
        methods: {
            
        }
    });
    
    initExchangeChart();
};

function shortenLabel(label, n){
    for (let i = 0; i < label.length; i++) {
        if(label[i].length > n)
            label[i] = label[i].substring(0, n-1) + "...";
    }
}

function initExchangeChart(){
    shortenLabel(exchangeData.label, 8);
    let bcolors = randomColor({
        count: exchangeData.label.length,
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
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: exchangeData.label,
            datasets: [{
                label: 'exchage rate',
                data: exchangeData.data,
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