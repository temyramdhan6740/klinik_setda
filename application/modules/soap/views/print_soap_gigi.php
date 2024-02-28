<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        media="print,all">
    <style>
    @page {
        size: A5;
        margin: 20px;

    }

    @media print {
        @page {
            size: A5;
            margin: 20px;
        }

    }

    @font-face {
        font-family: poppins;
        src: url(<?= base_url('assets/fonts/Poppins-Regular.ttf');
        ?>);

    }

    .container {
        /* font-family: poppins !important; */
        font-size: small;
    }

    hr {
        margin: 1rem 0;
        color: black;
        border: 1;
    }

    .gambar {
        max-width: 25% !important;
        height: auto !important;
    }

    .ttd {
        height: 40px;
        width: auto;
        /*maintain aspect ratio*/
        max-width: 70px;
    }
    </style>
</head>

<body>
    <div class="container" style="border: 1px solid black;">
        <div class="row align-items-start">
            <div class="col-md-12 text-center">
                <h6>REKAM MEDIS RAWAT JALAN</h6>
            </div>
        </div>
        <div class="row row-cols-4 align-items-top border-top border-dark border-1">
            <div class="col">
                Nama pasien
            </div>
            <div class="col">
                : <?= isset($data->nama_pasien) ? $data->nama_pasien : ''  ?>
            </div>
            <div class="col">
                Tgl. Pemeriksan
            </div>
            <div class="col">
                : <?= isset($data->tran_date) ? $data->tran_date : ''  ?>
            </div>
            <div class="col">
                No. RM
            </div>
            <div class="col">
                : <?= isset($data->no_rm) ? $data->no_rm : ''  ?>
            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>
            <div class="col">
                Tgl Lahir
            </div>
            <div class="col">
                : <?= isset($data->tanggal_lahir) ? $data->tanggal_lahir : ''  ?>
            </div>
            <div class="col">
                Dokter
            </div>
            <div class="col">
                : <?= isset($data->tanggal_lahir) ? $data->nama_dokter : ''  ?>
            </div>
            <div class="col">
                Jenis Kelamin
            </div>
            <div class="col">
                : <?= isset($data->jenis_kelamin) ? $data->jenis_kelamin : ''  ?>
            </div>

        </div>

        <div class="row align-items-end border-top border-dark border-1">
            <span class="card-text fw-bold">Anamensa (S)</span>
            <p class="card-text"><?= isset($data->anamnesa) ? $data->anamnesa : ''  ?></p>
        </div>
        <div class="row align-items-end border-top border-dark border-1">
            <span class="card-text fw-bold">Pemeriksaan Fisik (O)</span>
            <p class="card-text fw-bold">Tanda Vital :</p>
            <div class="row">
                <div class="col-1">
                    TD
                </div>
                <div class="col-3">
                    : <?= isset($data->td) ? $data->td . 'mmHg' : ''  ?>
                </div>
                <div class="col-1">
                    N
                </div>
                <div class="col-3">
                    : <?= isset($data->n) ? $data->n . 'x/menit' : ''  ?>
                </div>
                <div class="col-1">
                    R
                </div>
                <div class="col-3">
                    : <?= isset($data->r) ? $data->r . 'x/menit' : ''  ?>
                </div>
                <div class="col-1">
                    S
                </div>
                <div class="col-3">
                    : <?= isset($data->s) ? $data->s . 'C' : ''  ?>
                </div>
            </div>
            <div class="row mt-2">
                <span class="card-text fw-bold">Pemeriksan Penunjang</span>
                <p class="card-text"><?= isset($data->pemeriksaan_penunjang) ? $data->pemeriksaan_penunjang : ''  ?></p>
            </div>
        </div>
        <div class="row align-items-end border-top border-dark border-1">
            <span class="card-text fw-bold">Diagnosa (A)</span>
            <p class="card-text"><?= isset($data->diagnosa) ? $data->diagnosa : ''  ?></p>
        </div>
        <div class="row align-items-end border-top border-dark border-1">
            <span class="card-text fw-bold">Rencana layanan Klinis (P)</span>
            <p class="card-text"><?= isset($data->layanan_klinis) ? $data->layanan_klinis : ''  ?></p>
        </div>
        <div class="row align-items-end border-top border-dark border-1">
            <span class="card-text fw-bold">Edukasi</span>
            <p class="card-text">
                <?php
                $edukasi = json_decode($data->edukasi, true);
                if ($edukasi) {
                    foreach ($edukasi as $edu) {
                        if ($edu == 'lain') {
                            echo $data->lain_lain;
                        } else {
                            echo $edu . '<br>';
                        }
                    }
                }

                ?>

            </p>
        </div>
        <div class="row align-items-end border-top border-dark border-1">
            <span class="card-text fw-bold">Pelaksanaan Layanan (E)</span>
            <p class="card-text"><?= isset($data->pelaksanaan_layanan) ? $data->pelaksanaan_layanan : ''  ?></p>
        </div>

        <div class="row align-items-end border-top border-dark border-1">
            <span class="card-text fw-bold">Pemeriksaan GIGI</span>

            <div class="col-md-12 row">
                <div class="col-6"> Elemen Gigi: <br>
                    <?php
                    $elemen_gigi = json_decode($data->elemen_gigi, true);
                    if ($elemen_gigi) {
                        foreach ($elemen_gigi as $ele) {
                            echo $ele . '<br>';
                        }
                    }
                    ?>
                </div>
                <div class="col-6"> <img src="<?= base_url(); ?>assets/img/odontogram_gigi.png" class="gambar" alt=""
                        style="min-width:100%">
                </div>
            </div>

            <?php
            // $edukasi = json_decode($data->edukasi, true);

            // foreach ($edukasi as $edu) {
            //     if ($edu == 'lain') {
            //         echo $data->lain_lain;
            //     } else {
            //         echo $edu . '<br>';
            //     }
            // }
            // 
            ?>
        </div>

        <p class="fw-bold">Paraf Dokter</p>
        <?php if (file_exists('assets/soap_ttd/' . $data->no_struck . '.png')) { ?>
        <img src="<?= base_url(); ?>assets/soap_ttd/<?= $data->no_struck ?>.png" class="ttd" alt=""
            style="max-width:100%" />
        <?php } else { ?>
        <div width="50%"></div>
        <?php } ?>

        <p class="fw-bold"><?= isset($data->nama_dokter) ? $data->nama_dokter : ''  ?></p>
</body>

</html>