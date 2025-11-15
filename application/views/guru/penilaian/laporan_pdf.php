<!DOCTYPE html>
<html>
<head>
    <title><?= $title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2><?= $title; ?></h2>
        <p>Tanggal Cetak: <?= date('d F Y H:i:s'); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Tugas</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Rata-rata Nilai</th>
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
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada tugas yang Anda buat.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
