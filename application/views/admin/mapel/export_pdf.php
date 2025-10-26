<!DOCTYPE html>
<html>
<head>
    <title>Data Mata Pelajaran</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
    <h1>Data Mata Pelajaran</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mata Pelajaran</th>
                <th>Deskripsi</th>
                <th>Guru Pengampu</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($mapel_data as $mapel) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $mapel->nama_mapel; ?></td>
                    <td><?= $mapel->deskripsi; ?></td>
                    <td><?= $mapel->guru; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>