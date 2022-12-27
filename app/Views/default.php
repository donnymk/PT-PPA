<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Follow Up CBM</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link href="<?= base_url('DataTables-1.13.1/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet" type="text/css"/>
        <style>
            #inputRekomFollowUp {
                display: none
            }          
        </style>        
    </head>
    <body class="sb-nav-fixed">
        <!-- Include Isi Halaman dinamis -->
        <?= $this->renderSection('isiHalaman') ?>

        <script src="<?= base_url('js/jquery.1.11.1.js') ?>" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('js/scripts.js') ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('assets/demo/chart-area-demo.js') ?>"></script>
        <script src="<?= base_url('assets/demo/chart-bar-demo.js') ?>"></script>
        <!-- DataTables ->
        <!--<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>-->
        <script src="<?= base_url('DataTables-1.13.1/js/jquery.dataTables.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('DataTables-1.13.1/js/dataTables.bootstrap5.min.js') ?>" type="text/javascript"></script>
        
        <script src="<?= base_url('js/custom-script.js') ?>"></script>
        
    </body>
</html>
