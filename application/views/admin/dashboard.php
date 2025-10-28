<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <!-- Content Row: Info Cards -->
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Guru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_guru; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Murid</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_murid; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Kelas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_kelas; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-school fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Mapel</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_mapel; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row: Charts and Lists -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Progress Rata-rata per Kelas</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donut Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">3 Murid Paling Produktif</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php foreach ($murid_produktif as $murid) : ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= $murid['nama']; ?>
                                <span class="badge badge-primary badge-pill"><?= $murid['progress']; ?>%</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
             <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Absensi Guru</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Hadir <span class="float-right"><?= $statistik_absensi['hadir']; ?> (<?= $statistik_absensi_persen['hadir']; ?>%)</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $statistik_absensi_persen['hadir']; ?>%" aria-valuenow="<?= $statistik_absensi_persen['hadir']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Sakit <span class="float-right"><?= $statistik_absensi['sakit']; ?> (<?= $statistik_absensi_persen['sakit']; ?>%)</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $statistik_absensi_persen['sakit']; ?>%" aria-valuenow="<?= $statistik_absensi_persen['sakit']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Izin <span class="float-right"><?= $statistik_absensi['izin']; ?> (<?= $statistik_absensi_persen['izin']; ?>%)</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?= $statistik_absensi_persen['izin']; ?>%" aria-valuenow="<?= $statistik_absensi_persen['izin']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Alpa <span class="float-right"><?= $statistik_absensi['alpa']; ?> (<?= $statistik_absensi_persen['alpa']; ?>%)</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $statistik_absensi_persen['alpa']; ?>%" aria-valuenow="<?= $statistik_absensi_persen['alpa']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            <!-- Recent Absensi Guru -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Absensi Guru Terbaru</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($recent_absensi_guru)) : ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($recent_absensi_guru as $absensi) : ?>
                                <li class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"><?= $absensi['nama_guru']; ?></h5>
                                        <small><?= date('d M Y', strtotime($absensi['tanggal'])); ?></small>
                                    </div>
                                    <p class="mb-1">Status: <span class="badge badge-<?= strtolower($absensi['status']) == 'hadir' ? 'success' : (strtolower($absensi['status']) == 'sakit' ? 'warning' : (strtolower($absensi['status']) == 'izin' ? 'info' : 'danger')); ?>"><?= $absensi['status']; ?></span></p>
                                    <?php if (!empty($absensi['keterangan'])) : ?>
                                        <small>Keterangan: <?= $absensi['keterangan']; ?></small>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p>Tidak ada data absensi guru terbaru.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Page level plugins -->
<script src="<?= base_url('assets/vendor/chart.js/Chart.min.js'); ?>"></script>

<!-- Page level custom scripts -->
<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: <?= json_encode($chart_labels); ?>,
    datasets: [{
      label: "Progress Rata-rata",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: <?= json_encode($chart_data); ?>,
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
        time: {
          unit: 'date'
        },
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
          padding: 10,
          callback: function(value, index, values) {
            return value + '%';
          }
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
          return datasetLabel + ': ' + tooltipItem.yLabel + '%';
        }
      }
    }
  }
});
</script>
