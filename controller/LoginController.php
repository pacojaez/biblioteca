<?php

    class LoginController{

        // pone el formulario de login
        public function index(){
            include '../views/login.php';
        }

        // método que gestiona la identificación
        public function login(){
            // comprobar que llegan los datos
            if(empty($_POST['identificar']))
                throw new Exception('No se recibió el formulario');

            // recuperar usuario (o email) y clave
            $u = DB::escape($_POST['usuario']);
            $c = md5($_POST['clave']); // la clave va en MD5

            $identificado = Usuario::identificar($u, $c); // recuperar el usuario

            if(!$identificado)
                throw new Exception('Los datos de identificación no son correctos.');

            Login::set($identificado); // vincula el usuario a la sesión

            // nos lleva a la página con sus datos
            //(new UsuarioController())->show($identificado->id);
            // $entradas = Blog::get();
            // $usuario = Login::get();
            // $categories = Category::get();
            // $countcategories = Category::count();
            $libros = Libro::get();
            include '../views/libro/listar.php';

        }


        // método que gestiona la salida del usuario de la aplicación
        public function logout(){

            // eliminar los datos de sesión y desvincular el usuario
            Login::clear();

            // redirige a la portada de la biblioteca
            $controlador = DEFAULT_CONTROLLER;
            $metodo = DEFAULT_METHOD;
            (new $controlador())->$metodo();
            // include '../views/login.php';
        }

        public function dashboard(){
          //pasamos las entradas a la vista
        //   $entradas = Blog::getDesc();
        //   $categories=Category::get();
        //   $usuario=Login::get();
          //me lleva a la pagina de inicio de dashboard
        //   include 'views/admin/dashboard.php';
        }
    }
