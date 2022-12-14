<?php

class Basic {

    //poner el head
    public static function getHead( $page = ''){ ?>

              <!DOCTYPE html>
                <html lang='es'>
                    <head>
                        <meta charset='UTF-8'>
                        <title>Portada - <?= (APP_TITLE) ?> </title>
                        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
                        <!-- <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
                        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM' crossorigin='anonymous'></script> -->
                        <!-- Latest compiled and minified CSS -->
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
                        <!-- Latest compiled JavaScript -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
                        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
                        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                        <!-- <link rel='stylesheet' type='text/css' href='css/estilo.css'> -->
                    </head>
                    <body>
    <?php 
    }

    //poner el header
    public static function getHeader(){?>
        <nav class='navbar navbar-expand-lg navbar-light bg-light'>
                <div class='container-fluid'>
                      <a class='navbar-brand' href='/'>LA BIBLIO</a>
                      <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                          <span class='navbar-toggler-icon'></span>
                      </button>
                      <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                          <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                          <li class='nav-item'>
                              <a class='nav-link' aria-current='page' href='/libro/list'>LIBROS</a>
                          </li>
                          
                          <li class='nav-item dropdown'>
                              <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                              TEMAS
                              </a>
                              <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                              <?php
                              $temas = Tema::get();
                              foreach ($temas as $tema){
                                 $count = count($tema->manyToMany('libro'));
                                 echo "<li><a class='dropdown-item' href='/libro/tema/$tema->id'>$tema->tema ($count)</a></li>
                                       <li><hr class='dropdown-divider'></li>";
                              }
                              ?>
                              </ul>
                          </li>
                          <?php if(Login::isAdmin() || Login::hasPrivilege(300)){?>
                          <li class='nav-item'>
                              <a class='nav-link' href='/socio/list'>SOCIOS</a>
                          </li>
                          <?php }?>
                          <?php if(Login::isAdmin()){?>
                          <li class='nav-item'>
                              <a class='nav-link' href='/usuario/list'>USUARIOS</a>
                          </li>
                          <?php }?>
                          

                          <!-- <li class='nav-item'>
                              <a class='nav-link disabled' href='#' tabindex='-1' aria-disabled='true'>Disabled</a>
                          </li> -->
                          </ul>
                          <!-- <form class='d-flex' method='post' action='/libro/search'>
                            <div class='mb-3'>
                              <label for='campo' class='form-label'>Campo</label>
                              <select class='form-select' aria-label='Default select example' name="campo">
                                  <option value='titulo' <?= !empty($campo) && $campo == 'titulo' ? 'selected' : '' ?>>T??tulo</option>
                                  <option value='isbn' <?= !empty($campo) && $campo == 'isbn' ? 'selected' : '' ?>>ISBN</option>
                                  <option value='editorial' <?= !empty($campo) && $campo == 'editorial' ? 'selected' : '' ?>>Editorial</option>
                                  <option value='autor' <?= !empty($campo) && $campo == 'autor' ? 'selected' : '' ?>>Autor</option>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label for="valor" class="form-label">Valor</label>
                              <input type="text" class="form-control" id="valor" name="valor" aria-describedby="valorHelp">                        
                              <div id="valorHelp" class="form-text">Escribe tu b??squeda.</div>
                            </div>
                            <div class='mb-3'>
                              <label for='orden' class='form-label'>Orden</label>
                              <select class='form-select' aria-label='Default select example' name="orden">
                                  <option value='titulo' <?= !empty($orden) && $orden == 'titulo' ? 'selected' : '' ?>>T??tulo</option>
                                  <option value='isbn' <?= !empty($orden) && $orden == 'isbn' ? 'selected' : '' ?>>ISBN</option>
                                  <option value='editorial' <?= !empty($orden) && $orden == 'editorial' ? 'selected' : '' ?>>Editorial</option>
                                  <option value='autor' <?= !empty($orden) && $orden == 'autor' ? 'selected' : '' ?>>Autor</option>
                              </select>
                            </div>
                            <div class='mb-3'>
                                <label class="form-check-label" for="sentido">
                                  ASC
                                </label>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="sentido" value="ASC" id="sentidoAsc" checked> 
                                </div>
                                <div class="form-check">
                                  <label class="form-check-label" for="sentido">
                                    DESC
                                  </label>
                                  <input class="form-check-input" type="radio" name="sentido" value="DESC" id="sentidoDesc">
                                </div>
                            </div>
                            <div class='mb-3'>
                              <div class="form-check">
                                <button class='btn btn-outline-success' type='submit' name='search' value="search">SEARCH</button>
                              </div>
                            </div>
                          </form> -->
                          <!-- <div class='mb-3'>
                            <a href='/libro/list'><button class='btn btn-outline-success' type='button' >LIMPIAR</button></a>
                          </div> -->
                          
                    </div>
                    
              </div>
              
            </nav>
            <nav class='navbar navbar-expand-lg navbar-light bg-light'>
                <div class='container-fluid'>
                  <?php self::login() ?>
                </div>
            </nav>
            
    <?php }

    //poner el footer
    public static function getFooter( ){

        echo '<!-- Footer -->
        <footer class="text-center text-lg-start bg-light text-muted">
          <!-- Section: Social media -->
          <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
              <span>AQU?? IR??AN ENLACES A REDES SOCIALES:</span>
            </div>
            <!-- Left -->
        
            <!-- Right -->
            <div>
              <a href="" class="me-4 text-reset">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="" class="me-4 text-reset">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="" class="me-4 text-reset">
                <i class="fab fa-google"></i>
              </a>
              <a href="" class="me-4 text-reset">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="" class="me-4 text-reset">
                <i class="fab fa-linkedin"></i>
              </a>
              <a href="" class="me-4 text-reset">
                <i class="fab fa-github"></i>
              </a>
            </div>
            <!-- Right -->
          </section>
          <!-- Section: Social media -->
        
          <!-- Section: Links  -->
          <section class="">
            <div class="container text-center text-md-start mt-5">
              <!-- Grid row -->
              <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                  <!-- Content -->
                  <h6 class="text-uppercase fw-bold mb-4">
                    <i class="fas fa-gem me-3"></i>LA BIBLIO
                  </h6>
                  <p>
                   ESPACIO PARA ORGANIZAR EL FOOTER
                  </p>
                </div>
                <!-- Grid column -->
        
                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                  <!-- Links -->
                  <h6 class="text-uppercase fw-bold mb-4">
                    ??LTIMO TEMAS A??ADIDOS
                  </h6>';

                  $temas = Tema::getFourLastAdded();
                  foreach ($temas as $tema){
                    echo "<p>
                            <a href='/libro/tema/$tema->id' class='text-reset'>$tema->tema</a>
                          </p>";
                  }


                  echo '
                </div>
                <!-- Grid column -->
        
                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                  <!-- Links -->
                  <h6 class="text-uppercase fw-bold mb-4">
                    ??LTIMOS LIBROS A??ADIDOS
                  </h6>'
                  ;

                  $libros = Libro::getFourLastAdded();
                  foreach ($libros as $libro){
                    echo "<p>
                            <a href='/libro/show/$libro->id' class='text-reset'>$libro->titulo</a>
                          </p>";
                  }


                  echo '


                </div>
                <!-- Grid column -->
        
                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                  <!-- Links -->
                  <h6 class="text-uppercase fw-bold mb-4">Contacto</h6>
                  <p><i class="fas fa-home me-3"></i> CIFO Sabadell</p>
                  <p>
                    <i class="fas fa-envelope me-3"></i>
                    info@cifo.com
                  </p>
                  <p><i class="fas fa-phone me-3"></i> + 34 606 566 566</p>
                  <p><i class="fas fa-print me-3"></i> + 34 606 234 567</p>
                </div>
                <!-- Grid column -->
              </div>
              <!-- Grid row -->
            </div>
          </section>
          <!-- Section: Links  -->
        
          <!-- Copyright -->
          <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            ?? 2022 Copyright:
            <a class="text-reset fw-bold" href="https://packagist.org/packages/robertsallent/fastlight">Realizado sobre el framework FastLight desarrollado por Robert Sallent</a>
          </div>
          <!-- Copyright -->
        </footer>
        <!-- Footer -->
        </body>
        </html>
        ';

    }


    public static function login(){

      $identificado = Login::get();
      echo "<div class='collapse navbar-collapse' id='navbarSupportedContent'>
              <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                <li class='nav-item'>";

                echo $identificado ? 
                  "Hola <a href='/usuario/show/$identificado->id'> $identificado->usuario</a>, <a href='/login/logout'> SALIR </a>" :
                  "<a href='/login'><button class='btn btn-secondary'> Identificate </button></a>";
                
                echo "</li>
              </ul>
            </div>";
      // echo $identificado ? 
      //             "Hola <a href='/usuario/show/$identificado->id'> $identificado->usuario</a>, <a href='/login/logout'><button class='btn btn-light ms-3'>Logout</button></a>" :
      //             "<a href='/login'><button >Identificate</button> </a>";
    }

}