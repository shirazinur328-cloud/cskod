<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tugas & Penilaian</h1>
        <div class="d-none d-sm-inline-block">
            <a href="<?= base_url('guru/penilaian/export_excel'); ?>" class="btn btn-success btn-icon-split btn-sm mr-2">
                <span class="icon text-white-50"><i class="fas fa-file-excel"></i></span>
                <span class="text">Ekspor ke Excel</span>
            </a>
            <a href="<?= base_url('guru/penilaian/export_pdf'); ?>" class="btn btn-danger btn-icon-split btn-sm">
                <span class="icon text-white-50"><i class="fas fa-file-pdf"></i></span>
                <span class="text">Ekspor ke PDF</span>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Semua Tugas</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Tugas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Rata-rata Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($daftar_tugas)): ?>
                                    <?php $no = 1; foreach ($daftar_tugas as $tugas): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($tugas->judul_tugas); ?></td>
                                            <td><?= htmlspecialchars($tugas->nama_mapel); ?></td>
                                            <td><?= htmlspecialchars($tugas->nama_kelas); ?></td>
                                            <td><?= $tugas->rata_rata_nilai ?? 'Belum ada nilai'; ?></td>
                                            <td>
                                                <a href="<?= base_url('guru/penilaian/jawaban/' . $tugas->id_tugas); ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Lihat Jawaban
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada tugas yang Anda buat.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Performance Chart -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Performa Siswa</h6>
                    <div class="float-right">
                        <button class="btn btn-sm btn-outline-primary" id="toggleChartType">Ganti Tipe Grafik</button>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (!empty($student_performance_data)): ?>
                        <div class="chart-bar">
                            <canvas id="studentPerformanceChart"></canvas>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info text-center">
                            Tidak ada data performa siswa untuk ditampilkan. Pastikan ada tugas yang sudah dinilai.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php $this->load->view('templates/guru/footer'); ?>

<script>
$(document).ready(function() {
    // Chart.js for Student Performance
    var studentPerformanceData = <?= json_encode($student_performance_data); ?>;
    var myChart; // Variabel untuk menyimpan instance chart

    console.log("studentPerformanceData:", studentPerformanceData); // Debug log

    if (studentPerformanceData.length > 0) {
        var labels = studentPerformanceData.map(function(item) {
            return item.nama_murid;
        });
        var data = studentPerformanceData.map(function(item) {
            return parseFloat(item.average_nilai_siswa).toFixed(2);
        });

        console.log("Chart Labels:", labels); // Debug log
        console.log("Chart Data:", data);     // Debug log

        var ctx = document.getElementById("studentPerformanceChart");
        console.log("Canvas Element:", ctx); // Debug log

        if (ctx) { // Pastikan elemen canvas ditemukan
            ctx = ctx.getContext('2d');
            console.log("Canvas Context:", ctx); // Debug log
            
            function createChart(type) {
                if (myChart) {
                    myChart.destroy(); // Hancurkan chart yang ada sebelum membuat yang baru
                }
                myChart = new Chart(ctx, {
                    type: type,
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Rata-rata Nilai",
                            backgroundColor: "#4e73df",
                            hoverBackgroundColor: "#2e59d9",
                            borderColor: "#4e73df",
                            data: data,
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
                                    maxTicksLimit: 10
                                },
                                maxBarThickness: 35,
                            }],
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    max: 100,
                                    maxTicksLimit: 5,
                                    padding: 10,
                                    callback: function(value, index, values) {
                                        return value + '';
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
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ': ' + tooltipItem.yLabel;
                                }
                            }
                        },
                    }
                });
            }

            // Inisialisasi chart pertama kali sebagai 'bar'
            createChart('bar');

            // Event listener untuk tombol ganti tipe grafik
            $('#toggleChartType').on('click', function() {
                var currentType = myChart.config.type;
                var newType = (currentType === 'bar') ? 'line' : 'bar';
                createChart(newType);
            });
        } else {
            console.error("Canvas element with ID 'studentPerformanceChart' not found.");
        }
    } else {
        console.log("No student performance data available to render chart.");
    }
});
</script>
