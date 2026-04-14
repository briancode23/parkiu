<!DOCTYPE html>
<html>
<head>
    <title>Struk Masuk</title>
    <style>
        body {
            font-family: monospace;
            width: 80mm;
            margin: auto;
        }

        .struk {
            border: 1px dashed #000;
            padding: 10px;
        }

        .center { text-align: center; }
        .right { text-align: right; }

        button {
            margin-top: 10px;
            padding: 5px 10px;
        }

        @media print {
            button {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="struk">
    <div class="center">
        <b>PARKIFY</b><br>
        STRUK PARKIR MASUK
    </div>

    <hr>

    No Parkir : <?= $data['id_parkir'] ?><br>
    Plat      : <?= $data['plat_nomor'] ?><br>
    Jenis     : <?= $data['jenis_kendaraan'] ?><br>
    Area      : <?= $data['nama_area'] ?><br>

    <hr>

    Masuk     : <?= $data['waktu_masuk'] ?><br>
    Petugas   : <?= $data['nama_lengkap'] ?><br>

    <hr>

    <div class="center">Simpan struk ini</div>
</div>

<div class="center">
    <button onclick="window.print()">Print</button>
    <button onclick="window.location='parkir/index'">Kembali</button>
</div>

</body>
</html>