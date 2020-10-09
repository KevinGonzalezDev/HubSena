<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>BPRO</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap4-toggle.min.css" rel="stylesheet">
        <link href="css/fontawesome.css" rel="stylesheet">
        <?php echo '<script type="text/javascript" src = "js/datatables.min.js?v='.date("Y-m-d H:i:s").'"></script>';?>

        <?php echo '<script type="text/javascript" src = "js/bootstrap4-toggle.min.js?v='.date("Y-m-d H:i:s").'"></script>';?>

        <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
        <?php echo '<script type="text/javascript" src = "js/dataTables.bootstrap4.min.js?v='.date("Y-m-d H:i:s").'"></script>';?>
        <?php echo '<script type="text/javascript" src = "js/dataTables.js?v='.date("Y-m-d H:i:s").'"></script>';?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        <?php echo '<script type="text/javascript" src = "js/jquery-ui.min.js?v='.date("Y-m-d H:i:s").'"></script>';?>
        <?php echo '<script type="text/javascript" src = "js/config.js?v='.date("Y-m-d H:i:s").'"></script>';?>

        <?php echo '<script type="text/javascript" src = "js/popper.min.js?v='.date("Y-m-d H:i:s").'"></script>';?>
        <?php echo '<script type="text/javascript" src = "js/bootstrap.min.js?v='.date("Y-m-d H:i:s").'"></script>';?>


        <?php echo '<script type="text/javascript" src = "js/jquery-ui.min.js?v='.date("Y-m-d H:i:s").'"></script>';?>
        <?php echo '<script type="text/javascript" src = "js/bootstrap-datepicker.js?v='.date("Y-m-d H:i:s").'"></script>';?>
        
        <style>
            html, body {
                background-color: #fff;
                color: black;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .TextTel{
                color:#B2B2B2;
                font-weight:bold;
            }
            .ImgMini{
                height: 20px;
            }
            .BarraMenu{
                background-color:#F2F2F2;
            }
            .Menus td{
                text-align: center;
                text-decoration: none;
            }
            a.IconMenu {
                text-decoration: blink;
                color:black;
                font-weight: bold;
            }
            .Margin{
                padding-left:20%;
                padding-right: 20%;
            }
            .BannerEvents{
                -webkit-box-shadow: 10px 10px 5px -6px rgba(166,163,166,1);
                -moz-box-shadow: 10px 10px 5px -6px rgba(166,163,166,1);
                box-shadow: 10px 10px 5px -6px rgba(166,163,166,1);
            }
            
            .Invitados{
                background-color:#563CA1;
            }
            .Circular{
                width: 200px;
                height: 200px;
                background: black;
                -moz-border-radius: 100px;
                -webkit-border-radius: 100px;
                border-radius: 100px;
            }
            .Qs{
                color:#E46972;
                font-weight: bold;
                font-size:25px;
                text-align:center;
            }
            .TituloParam{
                width:90%;
            }
            .ImagenBoleta{
                border-radius:0.5em;
                width:100%;
                opacity: 1;
            }
            .ImagenBoleta .NombreBoleta{
                text-align:center;
                color:white;
                font-weight: bold;
                font-size:20px;
                position: relative;
                top: -20%;
            }
            .ValorBoleta{
                color:#6420E1;
                font-weight: bold;
            }
            .Incluye textarea{
                border: 0px;
                width:100%;
                overflow: hidden;
            }
            .Incluye p, .Incluye textarea{
                color:#333333;
            }
            .Incluye p{
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        {{ csrf_field() }}
        <div >
            <table width ='100%'>
                <tr>
                    <td class = 'Margin'>
                        <table width = '100%'>
                            <tr>
                                <td class = 'TituloParam'>Logo de Inicio</td>
                                <td>
                                    <i class="fas fa-plus-circle"></i>
                                </td>
                                <td>
                                    <i class="fas fa-eye"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class = 'TituloParam'>Boletas</td>
                                <td>
                                    <i class="fas fa-plus-circle Cursor" data-toggle="modal" data-target="#ModalEdit" onclick = 'CrearBoleta()'></i>
                                </td>
                                <td>
                                    <i class="fas fa-eye" data-toggle="modal" data-target="#ModalEdit" onclick = 'ConsultarBoleta()'></i>
                                </td>
                            </tr>
                            <tr>
                                <td class = 'TituloParam'>Logo Tickets</td>
                                <td>
                                    <i class="fas fa-plus-circle"></i>
                                </td>
                                <td>
                                    <i class="fas fa-eye"></i>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="modal fade" id="ModalEdit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ModalEdit" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" id = "ModalContentForm" >
                <div class="content_modal modal-content">

                </div>
            </div>
        </div>
    </body>
</html>
