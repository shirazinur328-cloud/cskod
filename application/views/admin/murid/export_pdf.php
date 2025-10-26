<!DOCTYPE html>
<html>
<head>
    <title>Data Murid</title>
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
    <h1>Data Murid</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Murid</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>Username</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($murid_data as $murid) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $murid->nama_murid; ?></td>
                    <td><?= $murid->email; ?></td>
                    <td><?= $murid->no_telp; ?></td>
                    <td><?= $murid->username; ?></td>
                    <td><?= $murid->nama_kelas; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>