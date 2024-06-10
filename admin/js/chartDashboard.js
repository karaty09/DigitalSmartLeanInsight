// Chart 1
function chart1(ctx, labels, data) {
  return new Chart(ctx, {
    type: "doughnut",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Impact",
          data: data,
          backgroundColor: [
            "#698396",
            "#A9C8C0",
            "#DBBC8E",
            "#AE8A8C",
            "#7C98AB",
            "#C6AC84",
            "#E2E5CC",
            "#D9C2BD",
            "#A2C4C6",
            "#82B2B7",
          ],
          borderColor: [
            "#698396",
            "#A9C8C0",
            "#DBBC8E",
            "#AE8A8C",
            "#7C98AB",
            "#C6AC84",
            "#E2E5CC",
            "#D9C2BD",
            "#A2C4C6",
            "#82B2B7",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      width: 200,
      height: 200,
      plugins: {
        legend: {
          position: "top",
        },
        title: {
          display: true,
          text: "Impact",
          position: "top",
          font: {
            size: 15,
            weight: "bold",
          },
        },
        tooltip: {
          enabled: true,
          callbacks: {
            label: function (context) {
              const total = context.dataset.data.reduce((a, b) => a + b, 0);
              const value = context.raw;
              const percentage = ((value / total) * 100).toFixed(2);
              return percentage + "%";
            },
          },
        },
        datalabels: {
          formatter: (value) => {
            return value.toString();
          },
          color: "white",
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

// Chart 2
function chart2(ctx, datasets) {
  return new Chart(ctx, {
    type: "bar",
    data: datasets,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          stacked: true, // Enable stacking on x-axis
        },
        y: {
          stacked: true, // Enable stacking on y-axis
          beginAtZero: true,
        },
      },
      plugins: {
        legend: {
          position: "top",
        },
        title: {
          display: true,
          text: "Actual Completion Date (Project)",
          position: "top",
          font: {
            size: 15,
            weight: "bold",
          },
        },
      },
    },
  });
}

// Chart 3
function chart3(ctx, labels, data) {
  return new Chart(ctx, {
    type: "bar",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Number of Votes",
          data: data,
          backgroundColor: [
            "#F2EEE5",
            "#E5C1C5",
            "#C3E2DD",
            "#6ECEDA",
            "#E9E1D4",
            "#F5DDAD",
            "#F1BCAE",
            "#C9DECF",
          ],
          borderColor: [
            "#F2EEE5",
            "#E5C1C5",
            "#C3E2DD",
            "#6ECEDA",
            "#E9E1D4",
            "#F5DDAD",
            "#F1BCAE",
            "#C9DECF",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      responsive: true, // Make the chart responsive
      maintainAspectRatio: false, // Ensure the chart maintains the aspect ratio
      plugins: {
        legend: {
          position: "top",
        },
        title: {
          display: true,
          text: "Need Digital Transformation",
          position: "top",
          font: {
            size: 15,
            weight: "bold",
          },
        },
        datalabels: {
          align: "end",
          anchor: "end",
          offset: 10,
          color: "black",
        },
      },
      scales: {
        y: {
          reverse: false,
          min: 0,
          max: 20,
        },
        x: {
          beginAtZero: true,
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

// Chart 4
function chart4(ctx, labels, data) {
  return new Chart(ctx, {
    type: "bar",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Number of Votes",
          data: data,
          backgroundColor: [
            "#C9DECF",
            "#F1BCAE",
            "#F5DDAD",
            "#E9E1D4",
            "#6ECEDA",
            "#C3E2DD",
            "#E5C1C5",
            "#F2EEE5",
          ],
          borderColor: [
            "#C9DECF",
            "#F1BCAE",
            "#F5DDAD",
            "#E9E1D4",
            "#6ECEDA",
            "#C3E2DD",
            "#E5C1C5",
            "#F2EEE5",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      responsive: true, // Make the chart responsive
      maintainAspectRatio: false, // Ensure the chart maintains the aspect ratio
      indexAxis: "y",
      plugins: {
        legend: {
          position: "top",
        },
        title: {
          display: true,
          text: "Value Top 5",
          position: "top",
          font: {
            size: 15,
            weight: "bold",
          },
        },
        datalabels: {
          align: "end",
          anchor: "end",
          offset: 10,
          color: "black",
        },
      },
      scales: {
        y: {
          reverse: false,
        },
        x: {
          beginAtZero: true,
          min: 0,
          max: 10000,
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}
