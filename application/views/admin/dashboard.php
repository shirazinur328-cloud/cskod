<div class="container-fluid">
    <!-- Page Heading -->
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold"><?= $title; ?></h1>
    </div>

    <!-- Statistic Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats shadow border-0 rounded-3 h-100 py-2" style="border-radius: 16px !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-3">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Guru</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $total_guru; ?></div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-gradient-primary shadow-sm">
                                <i class="fas fa-chalkboard-teacher text-white fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats shadow border-0 rounded-3 h-100 py-2" style="border-radius: 16px !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-3">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Murid</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $total_murid; ?></div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-gradient-primary shadow-sm">
                                <i class="fas fa-user-graduate text-white fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats shadow border-0 rounded-3 h-100 py-2" style="border-radius: 16px !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-3">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Kelas</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $total_kelas; ?></div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-gradient-primary shadow-sm">
                                <i class="fas fa-school text-white fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats shadow border-0 rounded-3 h-100 py-2" style="border-radius: 16px !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-3">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Mapel</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $total_mapel; ?></div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-gradient-primary shadow-sm">
                                <i class="fas fa-book text-white fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4 rounded-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white border-0 rounded-top-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas Mingguan</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="aktivitasChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Mapel -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4 rounded-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white border-0 rounded-top-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Mata Pelajaran</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="mapelChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card shadow rounded-3">
                <div class="card-header py-3 bg-white border-0 rounded-top-3">
                    <h6 class="m-0 font-weight-bold text-primary">Akses Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="<?= base_url('admin/guru'); ?>" class="text-decoration-none">
                                <div class="card bg-gradient-primary text-white shadow h-100 py-2 rounded-3">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center justify-content-center p-3">
                                            <div class="text-center">
                                                <i class="fas fa-chalkboard-teacher fa-2x mb-2"></i>
                                                <div class="h6 mb-0 font-weight-bold">Tambah Guru</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="<?= base_url('admin/murid'); ?>" class="text-decoration-none">
                                <div class="card bg-gradient-primary text-white shadow h-100 py-2 rounded-3">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center justify-content-center p-3">
                                            <div class="text-center">
                                                <i class="fas fa-user-graduate fa-2x mb-2"></i>
                                                <div class="h6 mb-0 font-weight-bold">Tambah Murid</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="<?= base_url('admin/mapel'); ?>" class="text-decoration-none">
                                <div class="card bg-gradient-primary text-white shadow h-100 py-2 rounded-3">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center justify-content-center p-3">
                                            <div class="text-center">
                                                <i class="fas fa-book fa-2x mb-2"></i>
                                                <div class="h6 mb-0 font-weight-bold">Tambah Mapel</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="<?= base_url('admin/kelas'); ?>" class="text-decoration-none">
                                <div class="card bg-gradient-primary text-white shadow h-100 py-2 rounded-3">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center justify-content-center p-3">
                                            <div class="text-center">
                                                <i class="fas fa-school fa-2x mb-2"></i>
                                                <div class="h6 mb-0 font-weight-bold">Tambah Kelas</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="<?= base_url('assets/vendor/chart.js/Chart.min.js'); ?>"></script>

<!-- Page level custom scripts -->
<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Area Chart - Aktivitas Mingguan (based on assignment submissions)
var ctx = document.getElementById("aktivitasChart");
var aktivitasChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"],
    datasets: [{
      label: "Jumlah Pengumpulan Tugas",
      lineTension: 0.3,
      backgroundColor: "rgba(37, 99, 235, 0.05)",
      borderColor: "rgba(37, 99, 235, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(37, 99, 235, 1)",
      pointBorderColor: "rgba(37, 99, 235, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(37, 99, 235, 1)",
      pointHoverBorderColor: "rgba(37, 99, 235, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [
        <?php
        for($i = 0; $i < 7; $i++) {
          echo isset($weekly_submissions[$i]) ? $weekly_submissions[$i] : 0;
          if($i < 6) echo ',';
        }
        ?>,
      ],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
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
          return datasetLabel + ': ' + tooltipItem.yLabel;
        }
      }
    }
  }
});

// Pie Chart - Statistik Mapel (based on assignment completion)
var ctx2 = document.getElementById("mapelChart");
var mapelChart = new Chart(ctx2, {
  type: 'doughnut',
  data: {
    labels: <?php echo json_encode(array_column($top_subjects_by_activity, 'nama_mapel')); ?>,
    datasets: [{
      data: <?php echo json_encode(array_column($top_subjects_by_activity, 'jumlah')); ?>,
      backgroundColor: [
        'rgba(37, 99, 235, 1)',
        'rgba(96, 165, 250, 1)',
        'rgba(147, 197, 253, 1)',
        'rgba(191, 219, 254, 1)',
        'rgba(219, 234, 254, 1)'
      ],
      hoverBackgroundColor: [
        'rgba(30, 64, 175, 1)',
        'rgba(59, 130, 246, 1)',
        'rgba(96, 165, 250, 1)',
        'rgba(147, 197, 254, 1)',
        'rgba(191, 219, 254, 1)'
      ],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: true,
      position: 'bottom'
    },
    cutoutPercentage: 80,
  },
});
</script>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #1d4ed8, #3b82f6);
    }

    .bg-gradient-primary:hover {
        background: linear-gradient(135deg, #1e40af, #2563eb);
    }

    .card-stats {
        border-radius: 16px;
    }

    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .rounded-3 {
        border-radius: 16px !important;
    }

    .rounded-top-3 {
        border-top-left-radius: 16px !important;
        border-top-right-radius: 16px !important;
    }

    .shadow-sm {
        box-shadow: 0 2px 4px rgba(0,0,0,0.05) !important;
    }
</style>
