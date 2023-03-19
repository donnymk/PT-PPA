<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Claim Warranty</title>
        <!--<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />-->
        <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet" />
        <link href="<?= base_url('fontawesome-free-6.1.0-web/css/fontawesome.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('fontawesome-free-6.1.0-web/css/brands.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('fontawesome-free-6.1.0-web/css/solid.min.css') ?>" rel="stylesheet" type="text/css"/>
        
        <!-- DataTables -->
        <link href="<?= base_url('DataTables-1.13.4/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- Export library for DataTables -->
        <!--<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />-->
        <!--<link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" rel="stylesheet" />-->
        <link href="<?= base_url('DataTables-1.13.4/css/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('Buttons-2.3.6/css/buttons.bootstrap5.min.css') ?>" rel="stylesheet" type="text/css"/>
        <style>
            #inputRekomFollowUp {
                display: none
            }
            .wajib-diisi {
                color:#ff0000;
                font-weight: bold
            }            
        </style>        
    </head>
    <body class="sb-nav-fixed">
        <!-- Include Isi Halaman dinamis -->
        <?= $this->renderSection('isiHalaman') ?>

        <!-- jQuery -->
        <script src="<?= base_url('js/jquery.1.11.1.js') ?>" type="text/javascript"></script>

        <!-- Bootstrap Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <!-- DataTables library -->
        <!--<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>-->
        <script src="<?= base_url('DataTables-1.13.4/js/jquery.dataTables.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('DataTables-1.13.4/js/dataTables.bootstrap5.min.js') ?>" type="text/javascript"></script>
        
        <!-- Export Library -->
        <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('Buttons-2.3.6/js/buttons.html5.min.js') ?>" crossorigin="anonymous"></script>
        <script src="<?= base_url('Buttons-2.3.6/js/buttons.bootstrap5.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('Buttons-2.3.6/js/buttons.print.min.js') ?>" type="text/javascript"></script>
        

        <!-- Sidebar Navigasi -->
        <script src="<?= base_url('js/scripts.js') ?>"></script>

        <!-- Chart Demo -->

        <!-- Script used to some pages -->
        <script src="<?= base_url('js/cwp-script.js') ?>"></script>

    </body>
</html>
