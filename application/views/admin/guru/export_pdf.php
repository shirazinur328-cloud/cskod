<!DOCTYPE html>
<html>
<head>
    <title>Data Guru</title>
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
    <h1>Data Guru</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($guru_data as $guru) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $guru->nama_guru; ?></td>
                    <td><?= $guru->email; ?></td>
                    <td><?= $guru->no_telp; ?></td>
                    <td><?= $guru->username; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>