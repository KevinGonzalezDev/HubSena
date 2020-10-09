@extends('layout.general2')

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
                                    <img src ='../image/logo.png' />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <hr>
        <br>
        <div class = 'Margin P0' >
            <p>DATOS DE LOS PARTICIPANTES</p>
            <table width ='100%' class = ' DetallePrecios'>
                <tr>
                    <td  ></td>
                    <td style ='text-align:center;font-size:20px;' class ='ValorBoleta' colspan = '2'>DATOS DEL PARTICIPANTE</td>
                </tr>
                @foreach( $datos['info2']  as $t)
                <span class = 'fact' style = 'display:none;'>{{$t->idfacturacion}}</span>
                    @foreach($t->detalle as $x)
                <tr>
                    <td style = 'text-align:center;'>
                        <img src ='{{asset('../storage/app/Boletas/'.$t->photo2)}}' class = 'ImagenBoletas2'/>
                    </td>
                    <!--<td style = 'text-align: center;'>
                        <textarea readonly class = 'TextDetalle' style = 'min-height:80px;color:#333333;'>{{$t->include_principal}}</textarea></td>
                    <td style = 'text-align: center;'>
                        <textarea readonly class = 'TextDetalle' style = 'min-height:100px;text-align:justify;'>{{$t->include_normal}}</textarea>
                    </td>-->
                    <td>
                        <table width ='100%'>
                            <tr>
                                <td style = 'border:0px;text-align:center;'>
                                    <p class = 'ValorBoleta' style = 'font-size:14px;font-weight: bold;'>{{$x->nombre}} {{$x->apellido}}</p>
                                    {{$x->noidentificacion}}
                                </td>
                            </tr>
                            <tr>
                                <td style = 'border:0px;'>
                                   <div class='form-check form-check-inline'>
                                        <input class='ValorBoleta form-check-input' type='radio' name = 'pase[]' id='estadoA' value='1' onclick ='descargarpase({{$x->id}})' >
                                        <label class='ValorBoleta form-check-label' for='estadoA' style = 'font-weight:bold;font-size:14px;'>DESCARGAR PASE</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style = 'border:0px;'>
                                   <div class='form-check form-check-inline'>
                                        <input class='ValorBoleta form-check-input' type='radio' name = 'pase[]' id='estadoA' value='2' >
                                        <label class='ValorBoleta form-check-label' for='estadoA' style = 'font-weight:bold;font-size:14px;'>ENVIAR AL CORREO ASOCIADO</label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @endforeach
                @endforeach
            </table>
            <br>
            <br>
            <table width ='100%'>
                <tr>
                    <td style = 'text-align:center;'>
                        <span  >Revisa tu correo y descarga tu escarapela virtual.</span>
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <br>
            <table width ='100%'>
                <tr>
                    <td style = 'text-align:center;'>
                        <span onclick ='finalizarcompraboletas()' class = 'Bttn' >FINALIZAR</span>
                    </td>
                </tr>
            </table>
            <br>
            <br>
        </div>
        
        <div class = 'ComprarBoleta Step P5' style = 'display:none;'>
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
                                    <span onclick ='nextPasoValEmpresa(0)' class = 'Bttn'>REGRESAR</span>
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
