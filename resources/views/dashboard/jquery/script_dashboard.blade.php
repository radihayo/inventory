<script>
$(document).ready(function() {
    'use strict'

  let ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  let mode = 'index'
  let intersect = true

  let $salesChart = $('#sales-chart')
  // eslint-disable-next-line no-unused-vars
  let all_month = ["Januari","Februari","Maret","April","Mei","Juni",
  "Juli","Agustus","September","Oktober","November","Desember"];
  let month = new Date();
  let get_month = all_month[month.getMonth()-1];
//   console.log(get_month);

  let labels_value = [];
  for (let backward = 0; backward <= 5; backward++) {
    let get_month = all_month[month.getMonth()-backward];
    labels_value.push(get_month);
  }
  labels_value.reverse();

  let barang_masuk_bulan = "{{$barang_masuk_bulan}}";
  let barang_keluar_bulan = "{{$barang_keluar_bulan}}";

  let high_data_masuk = "{{$high_data_masuk}}";
  let high_data_keluar = "{{$high_data_keluar}}";

  let max_value = "";
  if (high_data_masuk>high_data_keluar) {
    max_value = high_data_masuk;
  } else {
    max_value = high_data_keluar;
  }

  let salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: labels_value,
      datasets: [
        {
          backgroundColor: '#28a745',
          borderColor: '#28a745',
          data: barang_masuk_bulan
        },
        {
          backgroundColor: '#dc3545',
          borderColor: '#dc3545',
          data: barang_keluar_bulan
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {

              if (value >= 1000) {
                value /= 1000
              }
              return value
              
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
});    
</script>        