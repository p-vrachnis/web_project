new Chart(document.getElementById("user_activity_chart"), {
    type: 'pie',
    data: {
      labels: user,
      datasets: [
        {
          label: "Records Per User %",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f", "#ffffff", "ff0000", "#ffa500", "#bdb76b", "#556b2f", "#008b8b", 
                            "#191970", "#ff00ff", "#696969", "#f8f8ff", "#7fff00", "#bdb76b", "#808080", "#bc8f8f", "#d2b48c"],
          data: regcount
        }
      ]
    },
    options: {
        responsive: true,
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
            text: 'Records Per User %'
        }
    }
});
