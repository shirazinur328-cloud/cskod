<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_kelas.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kelas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data Kelas</h1>
    <table>
        <thead>
            <tr>
                <th>ID Kelas</th>
                <th>Nama Kelas</th>
                <th>Tahun Ajaran</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($kelas_data)) : ?>
                <?php foreach ($kelas_data as $kelas) : ?>
                    <tr>
                        <td><?= $kelas->id_kelas; ?></td>
                        <td><?= $kelas->nama_kelas; ?></td>
                        <td><?= $kelas->tahun_ajaran; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3">Tidak ada data kelas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>