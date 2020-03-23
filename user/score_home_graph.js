const ctx2 = document.getElementById('score_chart').getContext('2d');
const activity_chart2 = new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    datasets: [{
      label: '% of transports',
      data: [4, 5, 1, 28, 11, 7, 15, 20, 4, 1, 5, 8],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(235, 19, 44, 0.2)',
        'rgba(205, 109, 64, 0.2)',
        'rgba(55, 159, 4, 0.2)',
        'rgba(25, 159, 164, 0.2)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(235, 19, 44, 1)',
        'rgba(205, 109, 64, 1)',
        'rgba(55, 159, 4, 1)',
        'rgba(25, 159, 164, 1)'
      ], 
      borderWidth: 2
    }]
  },
  options: {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});
