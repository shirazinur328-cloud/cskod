<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=data_mapel.doc");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mata Pelajaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
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
    <h1>Data Mata Pelajaran</h1>
    <table>
        <thead>
            <tr>
                <th>ID Mata Pelajaran</th>
                <th>Nama Mata Pelajaran</th>
                <th>Deskripsi</th>
                <th>Guru Pengampu</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($mapel_data)) : ?>
                <?php foreach ($mapel_data as $mapel) : ?>
                    <tr>
                        <td><?= $mapel->id_mapel; ?></td>
                        <td><?= $mapel->nama_mapel; ?></td>
                        <td><?= $mapel->deskripsi; ?></td>
                        <td><?= $mapel->guru; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">Tidak ada data mata pelajaran.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>