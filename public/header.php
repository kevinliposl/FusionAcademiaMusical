<!DOCTYPE html>
<html dir="ltr" lang="es-ES">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Stylesheets
        ============================================= -->
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />

        <link type="image/x-icon" href="public/images/favicon.ico" rel="icon"/>
        <link type="image/x-icon" href="public/images/favicon.ico" rel="shortcut icon"/>

        <link rel="stylesheet" href="public/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="public/style.css" type="text/css" />
        <link rel="stylesheet" href="public/css/swiper.css" type="text/css" />
        <link rel="stylesheet" href="public/css/dark.css" type="text/css" />
        <link rel="stylesheet" href="public/css/font-icons.css" type="text/css" />
        <link rel="stylesheet" href="public/css/animate.css" type="text/css" />
        <link rel="stylesheet" href="public/css/magnific-popup.css" type="text/css" />
        <link rel="stylesheet" href="public/css/components/bs-select.css" type="text/css" />
        <link rel="stylesheet" href="public/css/select2.css" type="text/css" />
        <link rel="stylesheet" href="public/css/components/bs-editable.css" type="text/css" />
        <link rel="stylesheet" href="public/css/typeahead.js-bootstrap.css" type="text/css"/>
        <link rel="stylesheet" href="public/css/responsive.css" type="text/css" />

        <script src="public/js/jquery-1.10.2.js"></script>
        <script src="public/js/Chart.bundle.js"></script>
        <script src="public/js/utils.js"></script>

        <!-- Document Title
        ============================================= -->
        <title>Fusi&oacute;n Academia de M&uacute;sica</title>

    </head>
    <body class="stretched">

        <!-- Document Wrapper
        ============================================= -->
        <div id="wrapper" class="clearfix">

            <!-- Header
            ============================================= -->
            <header id="header" class="transparent-header full-header" data-sticky-class="not-dark">

                <div id="header-wrap">

                    <div class="container clearfix">

                        <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                        <!-- Logo
                        ============================================= -->
                        <div id="logo">
                            <a href="?" class="standard-logo" data-dark-logo="public/images/fusion-dark.png"><img src="public/images/fusion.png" alt="Canvas Logo"></a>
                            <a href="?" class="retina-logo" data-dark-logo="public/images/fusion-dark@2x.png"><img src="public/images/fusion@2x.png" alt="Canvas Logo"></a>
                        </div><!-- #logo end -->

                        <!-- Primary Navigation
                        ============================================= -->
                        <nav id="primary-menu">
                            <ul>
                                <li><a href="?"><div>Home</div></a>
                                <li><a href="?action=val"><div>Prueba Validacion</div></a>
                                <li><a href="?action=report"><div>Reporte</div></a>
                                <li><a href="#"><div>CRUDS</div></a>
                                    <ul>

                                </li>
                                <li><a href="#"><div>CRUD CURSO</div></a>
                                    <ul>
                                        <li><a href="?controller=Course&action=defaultInsertCourse"><div>Insertar Curso</div></a></li> 
                                        <li><a href="?controller=Course&action=defaultDeleteCourse"><div>Eliminar Curso</div></a></li> 
                                        <li><a href="?controller=Course&action=defaultUpdateCourse"><div>Actualizar Curso</div></a></li> 
                                    </ul>
                                </li>
                                <li><a href="#"><div>CRUD Profesor</div></a>
                                    <ul>
                                        <li><a href="?controller=Professor&action=updateProfessor"><div>Actualizar Profesor</div></a></li> 
                                        <li><a href="?controller=Professor&action=insertProfessor"><div>Insertar Profesor</div></a></li> 
                                        <li><a href="?controller=Professor&action=deleteProfessor"><div>Eliminar Profesor</div></a></li>
                                    </ul>
                                </li>
                                <li><a href="#"><div>CRUD Estudiante</div></a>
                                    <ul>
                                        <li><a href="?controller=Student&action=insertStudent"><div>Insertar Estudiante</div></a></li> 
                                        <li><a href="?controller=Student&action=deleteStudent"><div>Borrar Estudiante</div></a></li> 
                                        <li><a href="?controller=Student&action=updateStudent"><div>Actualizar Estudiante</div></a></li> 
                                    </ul>
                                </li>
                                <li><a href="#"><div>CRUD Administrador</div></a>
                                    <ul>
                                        <li><a href="?controller=Admin&action=insert"><div>Insertar Administrador</div></a></li>
                                        <li><a href="?controller=Admin&action=delete"><div>Eliminar Administrador</div></a></li> 
                                    </ul>
                                </li> 
                            </ul>
                            </li>
                            <li><a href="?controller=User&action=loginUser"><div>Iniciar Sesi&oacute;n</div></a></li>
                            <li><a href="#"><div>De Pablo</div></a>
                                <ul>
                                    <li><a href="?action=ejemploProfesor"><div>EJEMPLO PERFIL PROFESOR</div></a>
                                    <li><a href="?action=instruments"><div>Cursos</div></a>
                                    <li><a href="?action=galery"><div>Galer&iacute;a</div></a>
                                    <li><a href="?action=aboutus"><div>Sobre Nosotros</div></a>
                                    <li><a href="?action=contact"><div>Contacto</div></a>
                                </ul>
                            </li>
                            </ul>

                        </nav><!-- #primary-menu end -->

                    </div>

                </div>

            </header><!-- #header end -->
