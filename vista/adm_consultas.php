<?php
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==2){
    include_once 'layouts/header.php';
?>

<title>ADMIN || Más consultas</title>
<!-- Tell the browser to be responsive to screen width -->

<?php
    include_once 'layouts/nav.php';
?>
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Más consultas</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                <li class="breadcrumb-item active">Más consultas</li>
            </ol>
            </div>
        </div>
    </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Consultas generales</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="cold-md-12">
                            <h2>Ventas por mes del año actual</h2>
                            <div class="chart-responsive">
                                <canvas id="grafico1" style="min-height: 250px; height: 250px; max-height: 250px; max-width:100%;"></canvas>
                            </div>
                        </div>
                        <div class="cold-md-12">
                            <h2>Comparativa año actual - año anterior</h2>
                            <div class="chart-responsive">
                                <canvas id="grafico3" style="min-height: 250px; height: 250px; max-height: 250px; max-width:100%;"></canvas>
                            </div>
                        </div>
                        <div class="cold-md-12">
                            <h2>Top 3 vendedor del mes</h2>
                            <div class="chart-responsive">
                                <canvas id="grafico2" style="min-height: 250px; height: 250px; max-height: 250px; max-width:100%;"></canvas>
                            </div>
                        </div>
                        <div class="cold-md-12">
                            <h2>Productos más vendidos del mes</h2>
                            <div class="chart-responsive">
                                <canvas id="grafico4" style="min-height: 250px; height: 250px; max-height: 250px; max-width:100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </section>
    </div>
    
<!-- /.content-wrapper -->
<?php
include_once 'layouts/footer.php';
}
else{
    header('location: ../index.php');
}
?>
<script src="../js/Chart.min.js"></script>
<script src="../js/mas_consultas.js"></script>
