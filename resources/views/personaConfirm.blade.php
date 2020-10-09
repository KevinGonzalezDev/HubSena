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
                        <span class = 'ValorBoleta'>Compra Éxitosa</span> 
                    </th>
                </tr>
                <tr>
                    <td style = 'text-align: center;'>
                        <p>Ahora serás parte del evento más esperado del año. Descarga tus tikets de compra y accede al evento.</p>
                        <p>Revisa tu correo y termina el proceso de inscripción de asistentes al evento. Termina de llenar los datos y obtén tu escarpela virtual.</p>
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
        <script>
            $(document).ready(function () {
                //nextPaso(0)
            })
        </script>
@endsection
