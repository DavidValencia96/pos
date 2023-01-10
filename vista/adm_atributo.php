<?php
session_start();
if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 2) {
    include_once 'layouts/header.php';
?>

    <title>ADMIN || Atributos</title>
    <!-- Tell the browser to be responsive to screen width -->

    <?php
    include_once 'layouts/nav.php';
    ?>
    <div class="modal fade" id="cambiarlogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar logo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="logoactual" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
                    </div>
                    <div class="text-center">
                        <b id="nombre_logo"> </b>
                    </div>
                    <div class="alert alert-success text-center" id="edit" style="display:none">
                        <span><i class="fas fa-check mr-1"></i>Logo cambiado.</span>
                    </div>
                    <div class="alert alert-danger text-center" id="noedit" style="display:none">
                        <span><i class="fas fa-times mr-1"></i>Formato no soportado, solo se permite (.jpg, .png, o gif).</span>
                    </div>
                    <form id="form-logo" ectype="multipart/form-data">
                        <div class="input-group mb-3 ml-5 mt-2">
                            <input type="file" name="photo" class="input-group">
                            <input type="hidden" name="funcion" id="funcion">
                            <input type="hidden" name="id_logo_lab" id="id_logo_lab">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn bg-gradient-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="crearlaboratorio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Laboratorio</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add-laboratorio" style="display:none">
                            <span><i class="fas fa-check mr-1"></i>Registro exítoso.</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd-laboratorio" style="display:none">
                            <span><i class="fas fa-times mr-1"></i>Laboratorio ya existe, verifique e intente de nuevo.</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit-lab" style="display:none">
                            <span><i class="fas fa-check mr-1"></i>Se edito correctamente.</span>
                        </div>
                        <form id="form-crear-laboratorio">
                            <div class="form-group">
                                <label for="nombre-laboratorio">Nombre</label>
                                <input id="nombre-laboratorio" type="text" class="form-control" placeholder="Ingrese nombre" required>
                                <input id="id_editar_lab" type="hidden">
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar cambio</button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="creartipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Tipo</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add-tipo" style="display:none">
                            <span><i class="fas fa-check mr-1"></i>Registro exítoso.</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd-tipo" style="display:none">
                            <span><i class="fas fa-times mr-1"></i>Tipo ya existe, verifique e intente de nuevo.</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit-tipo" style="display:none">
                            <span><i class="fas fa-check mr-1"></i>Se edito correctamente.</span>
                        </div>
                        <form id="form-crear-tipo">
                            <div class="form-group">
                                <label for="nombre-tipo">Nombre</label>
                                <input id="nombre-tipo" type="text" class="form-control" placeholder="Ingrese nombre" required>
                                <input id="id_editar_tip" type="hidden">
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1">Crear</button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="crearpresentacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Presentación</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add-pre" style="display:none">
                            <span><i class="fas fa-check mr-1"></i>Registro exítoso.</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd-pre" style="display:none">
                            <span><i class="fas fa-times mr-1"></i>La presentacion ya existe, verifique e intente de nuevo.</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit-pre" style="display:none">
                            <span><i class="fas fa-check mr-1"></i>Se edito correctamente.</span>
                        </div>
                        <form id="form-crear-presentacion">
                            <div class="form-group">
                                <label for="nombre-presentacion">Nombre</label>
                                <input id="nombre-presentacion" type="text" class="form-control" placeholder="Ingrese nombre" required>
                                <input id="id_editar_pre" type="hidden">
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestión atributos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestión atributos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a href="#laboratorio" class="nav-link active" data-toggle="tab">Laboratorio</a></li>
                                    <li class="nav-item"><a href="#tipo" class="nav-link" data-toggle="tab">Tipo</a></li>
                                    <li class="nav-item"><a href="#presentacion" class="nav-link" data-toggle="tab">Presentación</a></li>
                                </ul>
                            </div>
                            <div class="card-body p-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id='laboratorio'>
                                        <div class="card-success">
                                            <div class="card-header">
                                                <div class="card-title">buscar laboratorio <button type="button" data-toggle="modal" data-target="#crearlaboratorio" class="btn bg-gradient-primary btn-sm m-2">Crear laboratorio</button></div>
                                                <div class="input-group">
                                                    <input id="buscar-laboratorio" type="text" class="form-control float-left" placeholder="Buscar">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body p-0 table-responsive">
                                                <table class="table table-hover text-nowrap">
                                                    <thead class="table-success">
                                                        <tr>
                                                            <th>Acción</th>
                                                            <th>Logo</th>
                                                            <th>Laboratorio</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-active" id="laboratorios">

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id='tipo'>
                                        <div class="card-success">
                                            <div class="card-header">
                                                <div class="card-title">Buscar tipo<button type="button" data-toggle="modal" data-target="#creartipo" class="btn bg-gradient-primary btn-sm m-2">Crear tipo</button></div>
                                                <div class="input-group">
                                                    <input id="buscar-tipo" type="text" class="form-control float-left" placeholder="Buscar">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body p-0 table-responsive">
                                                <table class="table table-hover text-nowrap">
                                                    <thead class="table-success">
                                                        <tr>
                                                            <th>Acción</th>
                                                            <th>Tipos</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-active" id="tipos">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id='presentacion'>
                                        <div class="card-success">
                                            <div class="card-header">
                                                <div class="card-title">Buscar presentación <button type="button" data-toggle="modal" data-target="#crearpresentacion" class="btn bg-gradient-primary btn-sm m-2">Crear presentacion</button></div>
                                                <div class="input-group">
                                                    <input id="buscar-presentacion" type="text" class="form-control float-left" placeholder="Buscar">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body p-0 table-responsive">
                                                <table class="table table-hover text-nowrap">
                                                    <thead class="table-success">
                                                        <tr>
                                                            <th>Acción</th>
                                                            <th>Presentacion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-active" id="presentaciones">
                                                    </tbody>    
                                                </table>
                                            </div>
                                            <div class="card-footer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php
    include_once 'layouts/footer.php';
} else {
    header('location: ../index.php');
}
?>
<script src="../js/Laboratorio.js"></script>
<script src="../js/Tipo.js"></script>
<script src="../js/Presentacion.js"></script>