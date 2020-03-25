new Chart(document.getElementById("month_activity_chart"), {
    type: 'pie',
    data: {
      labels: ["January", "February", "March", "April", "May", "June", "July", "August", 
                 "September", "October", "November", "December"],
      datasets: [
        {
          label: "Recodrs Per Month",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: regmonths 
        }
      ]
    },
    options: {
        responsive: false,
        legend:{
            display: false
        },
        tooltips: {
            callbacks: {
              // this callback is used to create the tooltip label
              label: function(tooltipItem, data) {
                // get the data label and data value to display
                // convert the data value to local string so it uses a comma seperated number
                var dataLabel = data.labels[tooltipItem.index];
                var value = ': ' + data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].toLocaleString();
      
                // make this isn't a multi-line label (e.g. [["label 1 - line 1, "line 2, ], [etc...]])
                if (Chart.helpers.isArray(dataLabel)) {
                  // show value on first line of multiline label
                  // need to clone because we are changing the value
                  dataLabel = dataLabel.slice();
                  dataLabel[0] += value;
                } else {
                  dataLabel += value;
                }
      
                // return the text to display on the tooltip
                return dataLabel;
              }
            }
          },
        title: {
            display: true,
            text: 'Records Per Month'
        }
    }
});