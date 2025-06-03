<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    $(document).ready(function() {

      $.ajax({
        url: "functions.php",
        type: "POST",
        data: {
          "RESULT_TYPE": "DASHBOARD"
        },
        success: function(res) {
          var jobj = JSON.parse(res);
          console.log(jobj);
          carlisted.innerHTML = jobj.carcount;
          activeusers.innerHTML = jobj.usercount;
          bbookings.innerHTML = jobj.bookings;
          revenue.innerHTML = formatToLakh(jobj.revenue);
        }
      });

    });

    function formatToLakh(number) {
      if (number >= 100000) {
        return "₹ " + (number / 100000).toFixed(1) + " lakh";
      }
      return number.toString();
    }
  </script>
  <style>
    body {
      margin: 0;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
      background-color: #f8f9fa;
    }

    .boxdiv {
      width: 220px;
      height: 140px;
      background: linear-gradient(135deg, #ffffff 0%, #f8f9fe 100%);
      border-radius: 15px;
      padding: 20px;
      margin: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      cursor: pointer;
      border: 1px solid rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(5px);
      position: relative;
      overflow: hidden;
    }

    .boxdiv:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
      background: linear-gradient(135deg, #ffffff 0%, #f4f6ff 100%);
    }

    .boxdiv h3 {
      color: #6b7280;
      margin: 0 0 10px 0;
      font-size: 1.1rem;
      font-weight: 500;
    }

    .boxdiv h2 {
      color: #1f2937;
      margin: 0;
      font-size: 2.2rem;
      font-weight: 700;
    }

    .boxdiv::after {
      content: '';
      position: absolute;
      bottom: 0;
      right: 0;
      width: 60px;
      height: 60px;
      background: rgba(99, 102, 241, 0.1);
      border-radius: 50%;
      transform: translate(30%, 30%);
    }

    /* Optional: Add different accent colors */
    .boxdiv:nth-child(2)::after {
      background: rgba(16, 185, 129, 0.1);
    }

    .boxdiv:nth-child(3)::after {
      background: rgba(245, 158, 11, 0.1);
    }

    .boxdiv:nth-child(4)::after {
      background: rgba(239, 68, 68, 0.1);
    }

    .stats-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 20px;
      padding: 25px;
      max-width: 1200px;
      margin: 0 auto;
    }
  </style>

  <style>
    .chart-container {
      background: white;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.03);
      border: 1px solid rgba(241, 245, 249, 0.8);
      transition: transform 0.2s ease;
    }

    .chart-container:hover {
      transform: translateY(-2px);
    }

    .chart-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .chart-header h3 {
      margin: 0;
      color: #1e293b;
      font-size: 1.25rem;
      font-weight: 600;
    }

    .stat-change {
      font-size: 0.9rem;
      padding: 4px 10px;
      border-radius: 20px;
    }

    .stat-change.up {
      background: #dcfce7;
      color: #16a34a;
    }
  </style>

  <!-- Include Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
  <div style="display: flex;">
    <div style="width: 20%;">
      <?php include_once("layouts/sidebar.php"); ?>
    </div>
    <div style="width: 80%;">
      <div class="stats-container">
        <div class="boxdiv">
          <h3><i class="fas fa-car-side" style="margin-right: 8px; color: #6366f1;"></i>Cars Listed</h3>
          <h2 id="carlisted">0</h2>
        </div>
        <div class="boxdiv">
          <h3><i class="fas fa-users" style="margin-right: 8px; color: #10b981;"></i>Active Users</h3>
          <h2 id="activeusers">0</h2>
        </div>
        <div class="boxdiv">
          <h3><i class="fas fa-calendar-check" style="margin-right: 8px; color: #f59e0b;"></i>Bookings</h3>
          <h2 id="bbookings">0</h2>
        </div>
        <div class="boxdiv">
          <h3><i class="fas fa-wallet" style="margin-right: 8px; color: #ef4444;"></i>Revenue</h3>
          <h2 id="revenue">₹0</h2>
        </div>

      </div>
      <div class="chart-container" style="position: relative;">
        <div class="chart-header">
          <h3>Monthly Bookings</h3>
          <div class="chart-stats">
            <span class="stat-change up">+12% vs last month</span>
          </div>
        </div>
        <!-- Add wrapper div with fixed height -->
        <div style="height: 400px;">
          <canvas id="bookingsChart"></canvas>
        </div>
      </div>
    </div>
  </div>
  <script>
    const ctx = document.getElementById('bookingsChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(124, 58, 237, 0.2)');
    gradient.addColorStop(1, 'rgba(124, 58, 237, 0)');

    $.ajax({
      url: "functions.php",
      type: "POST",
      data: {
        "RESULT_TYPE": "MONTHLY_BOOKINGS"
      },
      success: function(res) {
        var jobj = JSON.parse(res);
        console.log(jobj);

        new Chart(ctx, {
          type: 'line',
          data: {
            labels: jobj.month,
            datasets: [{
              label: 'Bookings',
              data: jobj.bookings,
              borderColor: '#6366f1',
              backgroundColor: gradient,
              fill: true,
              tension: 0.4,
              borderWidth: 2,
              pointRadius: 4,
              pointBackgroundColor: '#fff',
              pointBorderWidth: 2,
              pointHoverRadius: 6,
              pointHoverBorderWidth: 2
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false
              },
              tooltip: {
                backgroundColor: '#1e293b',
                titleColor: '#f8fafc',
                bodyColor: '#f8fafc',
                borderColor: '#64748b',
                borderWidth: 1,
                padding: 12,
                boxPadding: 6,
                usePointStyle: true,
                callbacks: {
                  title: () => ''
                }
              }
            },
            scales: {
              x: {
                grid: {
                  display: false
                },
                ticks: {
                  color: '#64748b'
                }
              },
              y: {
                beginAtZero: true,
                grid: {
                  color: '#f1f5f9'
                },
                ticks: {
                  color: '#64748b',
                  stepSize: 20
                }
              }
            },
            elements: {
              line: {
                cubicInterpolationMode: 'monotone'
              }
            },
            animation: {
              duration: 1000,
              easing: 'easeOutQuart'
            }
          }
        });
      }
    });
  </script>
</body>

</html>