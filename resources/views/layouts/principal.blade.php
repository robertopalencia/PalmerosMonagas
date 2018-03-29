<?php use Palma\Precio;?>
@if(Auth::check())
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PALMEROS</title>


   <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
   <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet">
   <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
   <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
   
    

</head>

<body>

    <div id="wrapper">

        
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/home"><strong>Administración ACEITECA-MONAGAS</strong></a>
                
            </div>
           

            <ul class="nav navbar-top-links navbar-right">
               
                
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                           
                                    <li>
                                        <button href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn btn-block">
                                             <i class="fa fa-arrow-left"></i><strong>SALIR</strong>
                                        </button>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <lu><li align="center"><button type="submit" class="btn btn-warning btn-block" onclick="location.href='editarusuarios/{{Auth::user()->id}}'">
                        <i class="fa fa-pencil"></i>Editar
                    </button></li></lu>
                                </ul>
                   
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
              
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-bar-chart fa-fw"></i> Pesaje<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               @if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('user'))
                                <li>
                                    <a href="/pagregar"><i class='fa fa-keyboard-o fa-fw'></i> Cargar</a>
                                </li>
                                @endif
                                <li>
                                    <a href="/cupos"><i class='fa fa-bookmark fa-fw'></i> Cupos</a>
                                </li>
                                @if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('watcher'))
                                 <li>
                                    <a href="/gandolas"><i class='fa fa-book fa-fw'></i> Seguimiento</a>
                                </li>
                                @endif
                                @if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('user'))
                                <li>
                                    <a href="/control"><i class='fa fa-book fa-fw'></i> Control</a>
                                </li>
                                @endif
                            </ul>
                        </li>
                       
                        <li>
                           
                            <a href="#"><i class="fa fa-book fa-fw"></i> Productor<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('user'))
                                <li>
                                    <a href="/proagregar"><i class='fa fa-plus fa-fw'></i> Agregar</a>
                                </li>
                                 @endif
                                <li>
                                    <a href="/tablaproductores"><i class='fa fa-list-ol fa-fw'></i> Productores</a>
                                </li>
                                @if(Auth::user()->hasRole('admin'))
                                <li>
                                    <a href="/banco"><i class='fa fa-bank fa-fw'></i> Bancos</a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-truck fa-fw"></i> Vehiculo<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               
                                <li>
                                    <a href="/tablacamiones"><i class='fa fa-list-ol fa-fw'></i> Camiones</a>
                                </li>
                                <li>
                                    <a href="/tablagandolas"><i class='fa fa-list-alt fa-fw'></i> Gandolas</a>
                                </li>
                            </ul>
                        </li>
                         @if(Auth::user()->hasRole('admin'))
                        <li>
                            <a href="#"><i class="fa fa-folder fa-fw"></i> Documentos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               
                                <li>
                                    <a href="/informe"><i class='fa fa-print fa-fw'></i> Informe</a>
                                </li>
                            </ul>
                        </li>
                        
                         <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Usuario<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{route('register2')}}"><i class='fa fa-plus fa-fw'></i> Agregar</a>
                                </li>
                                <li>
                                    <a href="/users"><i class='fa fa-list-ol fa-fw'></i> Usuarios</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <li>
                            <a href="#"><i class="fa fa-usd fa-fw"></i> Precio<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <?php $precio = Precio::all();
                                         if(count($precio)>0) { ?>
                               <li> <div align="center">
                                     <strong>PRECIO DE CONTADO</strong>
                                     </div>
                                </li>
                                <li>
                                     <div align='center'><?php 
                                         $precios2=0;
                                         $preciosid=0;
                                         foreach ($precio as $precios){
                                             
                                             if($precios->id>=$preciosid) {
                                                 $preciocontado=$precios->preciocontado;
                                                 $preciocredito=$precios->preciocredito;
                                                 $preciosid=$precios->id;
                                             }
                                         } ;
                                         echo number_format($preciocontado, 2, ",",".")." BsF";
                                         ?></div>
                                </li>
                                 <li> <div align="center">
                                    <strong>PRECIO DE CREDITO</strong>
                                     </div>
                                </li>
                                <li> 
                                     <div align='center'><?php 
                                         
                                         echo number_format($preciocredito, 2, ",",".")." BsF";
                                         ?></div>
                                </li>
                                <?php } else {?>
                                 <li> 
                                     <div align='center'> 0,00 BsF</div>
                                </li>
                                <?php }?>
                                @if(Auth::user()->hasRole('admin'))
                                <li>
                                    <a href="/precio"><i class='fa fa-pencil fa-fw'></i> Cambiar Precios</a>
                                </li>
                                @endif
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>

     </nav>

        <div id="page-wrapper">
            @yield('content')
        </div>

    </div>

    
    <script src="{{('js/jquery.min.js')}}"></script>
    <script src="{{('js/bootstrap.min.js')}}"></script>
    <script src="{{('js/metisMenu.min.js')}}"></script>
    <script src="{{('js/sb-admin-2.js')}}"></script>

</body>

</html>


@endif
