<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                font-size:13px;
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
        </style>
    </head>
    <body>
        <div >
            <table width ="100%">
                <tr>
                    <td class = 'Margin '>
                        <table width ='100%'>
                            <tr>
                                <td style = 'text-align:right;vertical-align: middle;'>
                                    <img src ='image/tel.png' class = 'ImgMini'/>
                                    <span class = 'TextTel'>(57) 724 0280</span>
                                    <img src ='image/tel.png' class = 'ImgMini'/>
                                    <span class = 'TextTel'>302 423 6250</span>
                                </td>
                            </tr>
                        </table>
                        <table width ='100%'>
                            <tr>
                                <td style = 'text-align:left;vertical-align: middle;'>
                                    <img src ='image/logo.png' />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            
            <table width ="100%" class = 'BarraMenu'>
                <tr>
                    <td class = 'Margin '>
                        <table width = '100%' class = 'Menus'>
                            <tr>
                                <td >
                                    <a href = '#Inicio' class = 'IconMenu'>
                                        INICIO
                                    </a>
                                </td>
                                <td >
                                    <a href = '#Qs' class = 'IconMenu'>
                                        QUÉ ES Y POR QUÉ PARTICIPAR
                                    </a>
                                </td>
                                <td >
                                    <a href = '#' class = 'IconMenu'>
                                        TARIFAS
                                    </a>
                                </td>
                                <td >
                                    <a href = '#' class = 'IconMenu'>
                                        AGENDA
                                    </a>
                                </td>
                                <td >
                                    <a href = '#' class = 'IconMenu'>
                                        PATROCINIO
                                    </a>
                                </td>
                                <td >
                                    <a href = '#' class = 'IconMenu'>
                                        SPONSORS
                                    </a>
                                </td>
                                <td style = 'text-align:center;'>
                                    <a href = '#' class = 'IconMenu'>
                                        COMPRAR TICKETS
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <table width ="100%" id = 'Inicio'>
                <tr>
                    <td class = 'Margin '>
                        <table width = '100%' class = 'Menus'>
                            <tr>
                                <td >
                                    <img src ='image/banner_evento.png' class = 'BannerEvents'/>
                                </td>
                                
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br><br>
            <table width ="100%" class = 'Invitados'>
                <tr>
                    <td class = 'Margin '>
                        <table width = '100%' class = 'Menus'>
                            <tr>
                                <td nowrap style = 'text-align:center;'>
                                    <div class = 'Circular'></div>
                                </td>
                                <td nowrap style = 'text-align:center;'>
                                    <div class = 'Circular'></div>
                                </td>
                                <td nowrap style = 'text-align:center;'>
                                    <div class = 'Circular'></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br><br>
            <table width ="100%" id = 'Qs'>
                <tr>
                    <td class = 'Margin'>
                        <span class = 'Qs flex-center'>¿Qué es y por qué participar?</span>
                        <table width = '100%' class = 'Menus'>
                            <tr>
                                <td nowrap style = 'text-align:center;'>
                                    <img src ='image/qs.png' class = 'BannerEvents'/>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style = 'text-align:center;'>
                        <img src ='image/info.png' />
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
