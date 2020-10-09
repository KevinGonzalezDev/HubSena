@extends('layout.general')

@section('content')
        <style>
            body{
                background-image:none;
            }
        </style>
        <div >
            <table width ="100%">
                <tr>
                    <td class = 'Margin '>
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
        </div>
        <br>
        <div class = 'ComprarBoleta' >
            <table width ='100%' class ='Margin'>
                <tr>
                    <th style = 'text-align:Center;'>
                        <span class = 'ValorBoleta'>Compra Rechazada</span> 
                    </th>
                </tr>
                <tr>
                    <td style = 'text-align: center;'>
                        <p>No se ha podido realizar la transacción, por favor intente nuevamente.</p>
                        <p></p>
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <br>
            <table width ='100%' >
                <tr>
                    <td style = 'text-align:center;'>
                        <table width = '100%' style = 'padding-left:35%;padding-right:35%;'>
                            <tr>
                                <td style = 'margin:0px auto;'>
                                    <span onclick ='nextPasoVal(0)' class = 'Bttn'>REGRESAR</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <br>
        <br>
        <br>
        <script>
            $(document).ready(function () {
                //nextPaso(0)
            })
        </script>
@endsection
