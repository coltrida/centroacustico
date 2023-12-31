// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}
let audiometria = JSON.parse(document.getElementById('audiom').innerHTML);

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["125", "250", "500", "1000", "1500", "2000", "3000", "4000", "8000"],
    datasets: [{
      label: "Sinistro",
      lineTension: 0.1,
        fill: false,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 4,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [audiometria._125s, audiometria._250s, audiometria._500s, audiometria._1000s, audiometria._1500s, audiometria._2000s, audiometria._3000s, audiometria._4000s, audiometria._8000s],
    },
        {
            fill: false,
            label: "Destro",
            lineTension: 0.1,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgb(241,11,11)",
            pointRadius: 4,
            pointBackgroundColor: "rgb(255,0,0)",
            pointBorderColor: "rgb(255,0,0)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgb(241,11,11)",
            pointHoverBorderColor: "rgb(241,11,11)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [audiometria._125d, audiometria._250d, audiometria._500d, audiometria._1000d, audiometria._1500d, audiometria._2000d, audiometria._3000d, audiometria._4000d, audiometria._8000d],
        }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 0,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
          gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              borderDash: [2],
              zeroLineBorderDash: [2],
          },
        ticks: {
          maxTicksLimit: 8,
        }
      }],
      yAxes: [{
        ticks: {
            max: 100,
            min:0,
          maxTicksLimit: 20,
          padding: 10,
            reverse: true
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          borderDash: [2],
          zeroLineBorderDash: [2],
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel +': '+ number_format(tooltipItem.yLabel) + ' dB';
        }
      }
    }
  }
});
