<!DOCTYPE html>
<html>
<head>
    <title>Data Kelas</title>
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
    <h1>Data Kelas</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
                <th>Tahun Ajaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($kelas_data as $kelas) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $kelas->nama_kelas; ?></td>
                    <td><?= $kelas->tahun_ajaran; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>