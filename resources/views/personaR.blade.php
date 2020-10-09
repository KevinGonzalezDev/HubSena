@extends('layout.general')

@section('content')
        <style>
            body{
                background-image:none;
            }
        </style>
        <span style = 'display:none;' class = 'fecha_limit'>{{$datos['fecha']}}</span>
        <span style = 'display:none;' class = 'fecha_actual'>{{$datos['fechaA']}}</span>
        
        <span style = 'display:none;' class = 'valorboleta_'></span>
        <span style = 'display:none;' class = 'impuesto_'></span>
        <span style = 'display:none;' class = 'descuento_'></span>
        <span style = 'display:none;' class = 'promo_'></span>
        
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
        <div class = 'SeleccionTipoComprador Step P0' style = 'display:none;'>
            <table width ='width:100%' class = 'Margin'>
                <tr>
                    <td  style = 'padding-left:20%;padding-right:20%;'>
                        <table width ='100%'>
                            <tr>
                                <td style = 'text-align:Center;margin:0px auto;'>
                                    <img src ='image/LOGO_BL.png' height = '75px'/>
                                </td>
                                <td style = 'width:30px;'></td>
                                <td rowspan = '3' style = 'vertical-align: top;' class = 'FormularioG'>
                                    <br><br><div class = 'FormRegistro'>
                                        <div >
                                            <table width ='100%' class = 'Form'>
                                                <tr>
                                                    <td colspan = '3' style = 'text-align:center;'>
                                                        <span class = 'ValorBoleta'>Regístrate</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style = 'padding-left:30px;'>
                                                        <p>Usuario(Email)<span class = 'indicador'>*</span></p>
                                                        <input required autocomplete="off" type ='email' class = 'Inputs' name ='' id ='Correo' />
                                                    </td>
                                                    <td></td>
                                                    <td style = 'padding-left:30px;'>
                                                        <p>Contraseña<span class = 'indicador'>*</span></p>
                                                        <input required autocomplete="off" type ='password' class = 'Inputs' name ='' id = 'pwd'/>
                                                    </td>
                                                </tr>
                                                <tr><td><p></p></td></tr>
                                                <tr>
                                                    <td style = 'padding-left:30px;'>
                                                        <p>Nombre<span class = 'indicador'>*</span></p>
                                                        <input required autocomplete="off" type ='text' class = 'Inputs' name ='' id = 'name'/>
                                                    </td>
                                                    <td></td>
                                                    <td style = 'padding-left:30px;'>
                                                        <p>Apellido<span class = 'indicador'>*</span></p>
                                                        <input required autocomplete="off" type ='text' class = 'Inputs' name ='' id ='apellido' />
                                                    </td>
                                                </tr>
                                                <tr><td><p></p></td></tr>
                                                <tr>
                                                    <td style = 'padding-left:30px;'>
                                                        <p>Celular<span class = 'indicador'>*</span></p>
                                                        <input required autocomplete="off" type ='text' class = 'Inputs' name ='' id = 'celular'/>
                                                    </td>
                                                    <td></td>
                                                    <td style = 'padding-left:30px;'>
                                                        <p>Empresa</p>
                                                        <input  autocomplete="off"type ='text' class = 'Inputs' name ='' id = 'empresa'/>
                                                    </td>
                                                </tr>
                                                <tr><td><p></p><p><br></p></td></tr>
                                                <tr>
                                                    <td style = 'text-align:center;' colspan = '3'>
                                                        <a href="#" class = 'Politica' style ='font-size:12px;' data-toggle="modal" data-target="#ModalEdit" onclick = 'TerminosCondiciones()'>*Términos y Condiciones</a>
                                                    </td>
                                                </tr>
                                                <tr><td><p></p><p><br></p></td></tr>
                                                <tr>
                                                    <td style = 'text-align:center;' colspan = '3'>
                                                        <p><span onclick ='nextPasoVal(1)' class = 'Bttn'>CONTINUAR</span></p>
                                                        <a href = '#'>Recurperar Contraseña</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style = 'text-align:Center;margin:0px auto;'>
                                    <img src ='image/01KV-BPro-050220.png' height = '200px'/>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div class = 'ComprarBoleta Step P1' style = 'display:none;'>
            <div >

                <table width ="100%" >
                    <tr>
                        <td  style = 'text-align: center;' class = 'BannerGeneral'>
                            <img src ='image/banner_compra_boletas.png' height="250px;" width = '100%'/>
                            <p class = 'flex-center ValorBoleta TitulosP'>¡Sé parte de uno de los eventos más esperados del año!</p>
                            <p class = 'flex-center textRecord TitulosS'>Adquiere ya tus tickets o regístrate para crear una orden de compra y realizar el pago en el momento que desees.</p>
                        </td>
                    </tr>
                </table>

                <table width ="100%">
                    <tr>
                        <td class = 'Margin CenterText'>
                            <span class = 'flex-center ValorBoleta' style = 'font-size:20px;'>¡Adquiere tu ticket!</span>
                            <p class = 'flex-center textRecord TitulosS' style = 'font-size:18px;'>Sé parte de uno de los eventos más esperados del año.</p>
                        </td>
                    </tr>
                </table>
                <table width ="100%" class = 'Margin'>
                    <tr>
                        <td style = 'width:10%;background-image:url(image/fondo.png);'></td>
                        <td style = 'text-align:center;'>
                            <ul>
                            @foreach( $datos['info'] as $d )
                            <li>
                                <table >
                                    <tr>
                                        <td style = 'text-align:Center;'>
                                            <img src ='{{asset('../storage/app/Boletas/'.$d->photo)}}' class = 'ImagenBoletas'/>
                                            <!--<div style = 'border-radius:0.5em;' class = 'ContenedorBoleta'>
                                                <div class = 'BoletasSize' style = 'background-color:#{{$d->photo}};' >
                                                    <span class = 'NombreBoleta NombreBoletaB flex-center TitulosS'>{{$d->name }}</span>
                                                    <span class = 'NombreBoletaMin flex-center TitulosS' style = 'font-size:12px;'>{{$d->comprados }} Pases Disponibles</span>
                                                    <span class = 'NombreBoletaMin flex-center TitulosS' style = 'font-size:12px;'>{{$d->TipoComprador }}</span>
                                                </div>
                                            </div>-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class = 'flex-center Valores TitulosP' style = 'font-size:20px;'>$ {{$d->valor}} + IVA</span>
                                            <span class = 'ValorBoleta flex-center ' style = 'color:#333333;font-size:12px'>Valor en pesos colombianos.</span>
                                            <span class = 'flex-center Valores TitulosP' style = 'font-size:20px;'>{{$d->dolar}} USD</span>
                                            <span class = 'ValorBoleta flex-center ' style = 'color:#333333;font-size:12px'>Valor aprox. en Dólares.</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <table width = '100%'>
                                                <tr>
                                                    <td class = 'CenterText'><i class="fas fa-minus Cursor Circulo" onclick = "ActualizarCantidad({{$d->id}},0,{{$d->comprados }})"></i></td>
                                                    <td>
                                                        <span class = 'Contador contador{{$d->id}}'>0</span>
                                                        <span style = 'display:none;'>{{$d->id}}</span>
                                                        <span style = 'display:none;'>{{$d->valors}}</span>
                                                        <span style = 'display:none;'>{{$d->photo}}</span>
                                                        <span style = 'display:none;'>{{$d->include_principal}}</span>
                                                        <span style = 'display:none;'>{{$d->include_normal}}</span>
                                                        <span style = 'display:none;'>{{$d->name}}</span>
                                                        <span style = 'display:none;'>{{$d->photo2}}</span>
                                                    </td>
                                                    <td><i class="fas fa-plus Cursor Circulo" onclick = "ActualizarCantidad({{$d->id}},1,{{$d->comprados }})"></i></td>
                                                </tr>
                                            </table>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style = 'text-align:left;'>
                                            
                                        </td>
                                    </tr>
                                </table>
                            </li>
                            @endforeach
                            </ul>
                        </td>
                        <td style = 'width:10%;background-image:url(image/fondo.png);'></td>
                    </tr>
                </table>
            </div>
            <br>
            <table width ='100%'>
                <tr>
                    <td style = 'text-align:center;'>
                        <a href="#" class = 'Politica'>*Política de Cancelación</a>
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <table width ='100%'>
                <tr>
                    <td style = 'text-align:center;'>
                        <span onclick ='nextPasoVal(2)' class = 'Bttn'>CONTINUAR COMPRA</span>
                    </td>
                </tr>
            </table>
        </div>
        
        
        <div class = 'ComprarBoleta Step P2' style = 'display:none;'>
            <div >
                <table width ='100%'>
                    <tr>
                        <td style = 'text-align:center;'>
                            <span class = 'ValorBoleta'>Datos Adicionales</span>
                        </td>
                    </tr>
                </table>
                <br>
                <div style = 'background-color:white;'>
                    <div class = 'DetalleTicket' style = 'padding-left:10%;padding-right: 10%;'>

                    </div>
                    <br>
                    <br>
                    <div style = 'padding-left:10%;padding-right: 10%;'>
                        <table width ='100%' class = 'Form ' style = 'background-color:white;'>
                            <tr>
                                <td colspan = '3' >
                                    <span class = 'ValorBoleta'>Datos de Facturación</span>
                                </td>
                            </tr>
                            <tr><td><p></p></td></tr>
                            <tr>
                                <td style = 'padding-left:30px;'>
                                    <p>Nombre Completo<span class = 'indicador'>*</span></p>
                                    <input required autocomplete="off" type ='text' class = 'Inputs' name ='' id ='F_name' />
                                </td>
                                <td></td>
                                <td style = 'padding-left:30px;'>
                                    <p>Cédula de Ciudadanía<span class = 'indicador'>*</span></p>
                                    <input required autocomplete="off" type ='text' class = 'Inputs' name ='' id = 'F_cedula'/>
                                </td>
                            </tr>
                            <tr><td><p></p></td></tr>
                            <tr>
                                <td style = 'padding-left:30px;'>
                                    <p>Dirección<span class = 'indicador'>*</span></p>
                                    <input required autocomplete="off" type ='text' class = 'Inputs' name ='' id = 'F_direccion'/>
                                </td>
                                <td></td>
                                <td style = 'padding-left:30px;'>
                                    <p>Ciudad<span class = 'indicador'>*</span></p>
                                    <input required autocomplete="off" type ='text' class = 'Inputs' name ='' id ='F_ciudad' />
                                </td>
                                <td></td>
                                <td style = 'padding-left:30px;'>
                                    <p>País<span class = 'indicador'>*</span></p>
                                    <input required autocomplete="off" type ='text' class = 'Inputs' name ='' id ='F_pais' />
                                </td>
                            </tr>
                            <tr><td><p></p></td></tr>
                            <tr>
                                <td style = 'padding-left:30px;'>
                                    <p>Teléfono<span class = 'indicador'>*</span></p>
                                    <input required autocomplete="off" type ='text' class = 'Inputs' name ='' id = 'F_telefono'/>
                                </td>
                                <td></td>
                                <td style = 'padding-left:30px;'>
                                    <p>Celular<span class = 'indicador'>*</span></p>
                                    <input required autocomplete="off" type ='text' class = 'Inputs' name ='' id ='F_celular' />
                                </td>
                                <td></td>
                                <td style = 'padding-left:30px;'>
                                    <p>Email<span class = 'indicador'>*</span></p>
                                    <input required autocomplete="off" type ='email' class = 'Inputs' name ='' id ='F_mail' />
                                </td>
                            </tr>
                            <tr><td><p><br></p><p><br></p></td></tr>
                        </table>
                        <br>
                        <table width ='100%' class = 'Form ' style = 'background-color:white;'>
                            <tr>
                                <td colspan = '3' >
                                    <span class = 'ValorBoleta'>Forma de Pago</span>
                                </td>
                            </tr>
                            <tr><td><p></p></td></tr>
                            <tr>
                                <td style = 'padding-left:10px;' >
                                    <table class = 'CodigoDescuentoDiv'>
                                        <tr>
                                            <td>Ingrese su código de descuento:</td>
                                            <td style = 'padding-left:20px;'>
                                                <input type ='text' class = 'Inputs' id = 'codigodescuento' />
                                            </td>
                                            <td style = 'padding-left:20px;'>
                                                <span onclick ='validarCodigo()' class = 'Bttn'>VALIDAR</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td><p></p></td></tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <br>
            <br>
            <br>
            <table width ='100%' >
                <tr>
                    <td style = 'text-align:center;'>
                        <table width = '100%' style = 'padding-left:35%;padding-right:35%;'>
                            <tr>
                                <td style = 'margin:0px auto;'>
                                    <span onclick ='nextPasoVal(1)' class = 'Bttn2'>ANTERIOR</span>
                                </td>
                                <td style = 'margin:0px auto;'>
                                    <span onclick ='nextPasoVal(0)' class = 'Bttn3'>CANCELAR COMPRA</span>
                                </td>
                                <td style = 'margin:0px auto;'>
                                    <span onclick ='nextPasoVal(3)' class = 'Bttn'>CONTINUAR COMPRA</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class = 'ComprarBoleta Step P3' style = 'height:450px;display:none;background-image:url(image/001.png);'>
            <table width ='100%' class ='Margin'>
                <tr>
                    <th style = 'text-align:Center;'>
                        <span class = 'ValorBoleta'>Datos de la Tarjeta de Crédito</span> 
                    </th>
                </tr>
            </table>
            <br> 
            <br>
            <table width ='100%' class ='Margin' style = 'padding-left:30%;'>
                <tr>
                    <td >
                        <table width ='100%' class ='Margin' style = 'padding-left:30%;'>
                            <tr>
                                <td  colspan = '5' style = 'margin:0px auto;'>
                                    <div class ='ResumenFactura flex-center'></div>
                                </td>
                            </tr>
                            <tr>
                                <td class = 'flex-center'>
                                    <br><br>
                                    <table width = '60%'>
                                        <tr>
                                            <td >
                                                <label>Número de Tarjeta</label>
                                                <p></p>
                                                <input type="text" class = 'Inputs' placeholder="1234 5678 9012 3456" id="card_number" onkeyup = 'cardFormValidate()'>
                                            </td>
                                            <td></td>
                                            <td>
                                                <label>Mes Expiración</label>
                                                <p></p>
                                                <input type="text" class = 'Inputs' placeholder="MM" maxlength="5" id="expiry_month" onkeyup = 'cardFormValidate()'>
                                            </td>
                                            <td></td>
                                            <td>
                                                <label>Año Expiración</label>
                                                <p></p>
                                                <input type="text"class = 'Inputs'  placeholder="YYYY" maxlength="5" id="expiry_year" onkeyup = 'cardFormValidate()'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><br></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>CVV</label>
                                                <p></p>
                                                <input type="text" class = 'Inputs' placeholder="123" maxlength="3" id="cvv" onkeyup = 'cardFormValidate()'>
                                            </td>
                                            <td></td>
                                            <td>
                                                <label>Nombre de la Tarjeta</label>
                                                <p></p>
                                                <input type="text" class = 'Inputs' placeholder="Codex World" id="name_on_card" onkeyup = 'cardFormValidate()'>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
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
                                    <span onclick ='nextPasoVal(2)' class = 'Bttn2'>ANTERIOR</span>
                                </td>
                                <td style = 'margin:0px auto;'>
                                    <span onclick ='nextPasoVal(0)' class = 'Bttn3'>CANCELAR COMPRA</span>
                                </td>
                                <td style = 'margin:0px auto;'>
                                    <span onclick ='nextPasoVal(4)' class = 'Bttn'>CONTINUAR COMPRA</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
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
