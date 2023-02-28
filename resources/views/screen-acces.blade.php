<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Acceso Unico</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <meta http-equiv="refresh" content="1" >
    <style>
        #relojeador{
            background-color : Black;
            color : White;
            font-family : Verdana, Arial, Helvetica;
            font-size : 15px;
            text-align : center;
            border-radius: 10px ;
        }
        .masthead{
            padding-top: 0.5rem;
            padding-bottom: 0rem;
        }
        footer{
            position: fixed;

            left: 0;
            bottom: 0;
            width: 100%;
        }
</style>
    <script language="JavaScript">
            function mueveReloj(){
                momentoActual = new Date()
                hora = momentoActual.getHours()
                minuto = momentoActual.getMinutes()
                segundo = momentoActual.getSeconds()

                str_segundo = new String (segundo)
                if (str_segundo.length == 1)
                    segundo = "0" + segundo

                str_minuto = new String (minuto)
                if (str_minuto.length == 1)
                    minuto = "0" + minuto

                str_hora = new String (hora)
                if (str_hora.length == 1)
                    hora = "0" + hora

                horaImprimible = hora + " : " + minuto + " : " + segundo

                document.form_reloj.reloj.value = horaImprimible

                setTimeout("mueveReloj()",1000)
            }
    </script>
</head>
<body id="page-top" onload="mueveReloj()">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
    <div class="container px-5">
        <a class="navbar-brand fw-bold" ><img style="width: 5rem" src="{{ asset('assets/img/logo_naabol.jpg') }}" alt=""></a>
        <form name="form_reloj">
            <input type="text" id="relojeador" name="reloj" size="10" onfocus="window.document.form_reloj.reloj.blur()">
        </form>
        <a class="navbar-brand fw-bold" style="float: left">{{ $punto->nombre_punto }}</a>

    </div>
</nav>
<!-- Mashead header-->
<header class="masthead mt-5">
    <div class="container px-5 mt-5">
        <div class="row gx-5 align-items-center mt-5" >
            <div class="col-lg-8">
                <!-- Mashead text and app badges-->
                <table class="table table-hover mt-1" style="font-size: .8rem">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">EMPRESA</th>
                        <th scope="col">ESTADO</th>
                        <th scope="col">FECHA</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lecturas as $lectura)
                        <tr>
                            <th scope="row">{{ $lectura->id }}</th>
                            <td>{{ $lectura->empleado->Nombre }}</td>
                            <td>{{ substr($lectura->empleado->empresa->NombEmpresa, 0, 15) }}.</td>
                            <td>@if($lectura->permitido == 1 ) Permitido @else No permitido @endif</td>
                            <td>{{ $lectura->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <!-- Masthead device mockup feature-->
                <div class="masthead-device-mockup">
                    <div style="width: 15rem; position: relative; border: 1px solid; border-radius: 10px; overflow: hidden ">

                        <div style="position: absolute; top: 5.5rem; left: -.1rem;">
                            <div style="width: 10rem; height: 6rem">
                                <img style="transform: rotate(90deg); width: 100%; height: 100%; object-fit: cover" src="data:image/png;base64, {{base64_encode($last_person->Fotografia)}}">
                            </div>
                        </div>
                        <div style="position: absolute; top: 4rem; left: .5rem;">
                            <span style="display: block; inline-size: 1rem; overflow-wrap: break-word; font-weight: bold; font-size: 1.3rem">{{ $last_person->AreasAut }}</span>
                        </div>
                        <div style="position: absolute; top: 14rem; left: 2.1rem;">
                            <span style="display: block; font-size: .9rem; font-weight: bolder">{{ $last_person->Nombre }}</span>
                            <span style="display: block; font-size: .9rem; font-weight: bolder">{{ $last_person->Paterno }} {{ $last_person->Materno }}</span>
                            <span style="display: block; font-size: .9rem; font-weight: bolder">{{ $last_person->Cargo }}</span>
                            <span style="display: block; font-size: .9rem; font-weight: bolder">{{ $last_person->empresa->NombEmpresa }}</span>
                        </div>
                        <div style="position: absolute; top: 6rem; right: 0rem; width: 7rem">
                            <span style=" text-align: center;  display: block; font-size: 1.1rem; font-weight: bolder; font-family: 'Nunito', sans-serif; color: #d3192d">{{ substr($last_person->Vencimiento, 0, 4) }} <br> </span>
                            <span style=" text-align: center;  display: block; font-size: 1.1rem; font-weight: bolder; font-family: 'Nunito', sans-serif; color: #d3192d">{{ $mes }} <br> </span>
                            <span style=" text-align: center;  display: block; font-size: .9rem; font-weight: bolder; ">{{ $last_person->Codigo }} - VVI <br> </span>
                        </div>
                        <div style="position: absolute; bottom: 1.8rem; left: 2rem;">
                            <span style="display: block; font-weight: 900; font-size: .8rem">{{ $last_person->CI }}</span>
                        </div>
                        <img style="width: 100%" src="{{ asset('assets/img/local/local.jpg') }}" alt="">
{{--                        <img style="width: 100%" src="{{ asset('assets/img/nacional/na.jpg') }}" alt="">--}}
{{--                        <img style="transform: rotate(90deg); width: 100%" src="data:image/png;base64, {{base64_encode($last_person->Fotografia)}}" alt="Red dot" />--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Footer-->
<footer class="bg-black text-center py-3">
    <div class="container px-3">
        <div class="text-white-50 small">
            <div class="mb-2">&copy; Naabol. All Rights Reserved.</div>
    </div>
</footer>
</body>
</html>
