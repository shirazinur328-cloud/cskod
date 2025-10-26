<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=data_guru.doc");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Guru</title>
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
    <h1>Data Guru</h1>
    <table>
        <thead>
            <tr>
                <th>ID Guru</th>
                <th>Nama Guru</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($guru_data)) : ?>
                <?php foreach ($guru_data as $guru) : ?>
                    <tr>
                        <td><?= $guru->id_guru; ?></td>
                        <td><?= $guru->nama_guru; ?></td>
                        <td><?= $guru->email; ?></td>
                        <td><?= $guru->no_telp; ?></td>
                        <td><?= $guru->username; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">Tidak ada data guru.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>