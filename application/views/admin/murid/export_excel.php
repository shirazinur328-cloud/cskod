<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_murid.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Murid</title>
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
    <h1>Data Murid</h1>
    <table>
        <thead>
            <tr>
                <th>ID Murid</th>
                <th>Nama Murid</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>Username</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($murid_data)) : ?>
                <?php foreach ($murid_data as $murid) : ?>
                    <tr>
                        <td><?= $murid->id_murid; ?></td>
                        <td><?= $murid->nama_murid; ?></td>
                        <td><?= $murid->email; ?></td>
                        <td><?= $murid->no_telp; ?></td>
                        <td><?= $murid->username; ?></td>
                        <td><?= $murid->nama_kelas; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">Tidak ada data murid.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>