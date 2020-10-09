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
        <div class = 'Margin' >
            <table width ='100%' class = ' DetallePrecios'>
                <tr>
                    <td  ></td>
                    <td style ='text-align:center;font-size:20px;' class ='ValorBoleta' >Cantidad</td>
                    <td style ='text-align:center;font-size:20px;' class ='ValorBoleta' >Valor</td>
                    <!--<td style ='text-align:center;font-size:20px;' class ='ValorBoleta' colspan = '2'>Incluye</td>-->
                </tr>
                @foreach( $datos['info']  as $t)
                <tr>
                    <td style = 'text-align:center;'>
                        <img src ='{{asset('../storage/app/Boletas/'.$t->photo2)}}' class = 'ImagenBoletas2'/>
                    </td>
                    <td style = 'text-align: center;'>{{$t->Cantidad}}</td>
                    <td style = 'text-align: center;'>{{$t->valor}}</td>
                    <!--<td style = 'text-align: center;'>
                        <textarea readonly class = 'TextDetalle' style = 'min-height:80px;color:#333333;'>{{$t->include_principal}}</textarea></td>
                    <td style = 'text-align: center;'>
                        <textarea readonly class = 'TextDetalle' style = 'min-height:100px;text-align:justify;'>{{$t->include_normal}}</textarea></td>
                    -->
                </tr>
                @endforeach
            </table>
            <br>
            <br>
            <p>Datos de los participantes:</p>
            <?php $i = 1;?>
            @foreach( $datos['info2']  as $t)
                    @foreach($t->detalle as $x)
                    <form class = 'form-signin' action = '{{route('ParticipanteUpdate')}}' method='post' >
                    {{ csrf_field() }}
                    <input type ='hidden' name = 'idregistro' value = '{{$x->id}}'>
                    <input type ='hidden' name = 'idP' value = '{{$x->idfacturacion}}'>
                    <table width ='100%'>
                        <tr>
                            <td class = 'ValorBoleta' style = 'font-size:16px;'>Asistente {{$i}} {{$t->name}}</td>
                        </tr>
                        <tr>
                            <td>
                                <p>Nombre<span class = 'indicador'>*</span></p>
                                <input type ='text' class ='Inputs' name ='nombre' required autocomplete="off" value ='{{$x->nombre}}' />
                            </td>
                            <td>
                                <p>Apellido<span class = 'indicador'>*</span></p>
                                <input type ='text' class ='Inputs' name ='apellido' required autocomplete="off"value ='{{$x->apellido}}'/>
                            </td>
                            <td>
                                <p>Género<span class = 'indicador'>*</span></p>
                                <select class ='Inputs' name ='genero' required>
                                    <option value = 'Masculino'>Masculino</option>
                                    <option value = 'Femenino'>Femenino</option>
                                </select>
                            </td>
                        </tr>
                        <tr><td><p></p></td></tr>
                        <tr>
                            <td>
                                <p>No. Identificación<span class = 'indicador'>*</span></p>
                                <input type ='text' class ='Inputs' name ='identificacion' required autocomplete="off" value ='{{$x->noidentificacion}}'/>
                            </td>
                            <td>
                                <p>Correo Electrónico<span class = 'indicador'>*</span></p>
                                <input type ='email' class ='Inputs' name ='correo' onkeyup = '' required autocomplete="off" value ='{{$x->correo}}'/>
                            </td>
                            <td>
                                <p>Confirmar Correo<span class = 'indicador'>*</span></p>
                                <input type ='email' class ='Inputs' name ='correo' required autocomplete="off" value ='{{$x->correo}}'/>
                            </td>
                        </tr>
                        <tr><td><p></p></td></tr>
                        <tr>
                            <td>
                                <p>Celular<span class = 'indicador'>*</span></p>
                                <input type ='text' class ='Inputs' name ='celular' required autocomplete="off" value ='{{$x->celular}}'/>
                            </td>
                            <td>
                                <p>Pais<span class = 'indicador'>*</span></p>
                                <select class ='Inputs' name ='pais' id = 'pais' required onchange = 'Indicativopais()'>
                                    @foreach($datos['pais'] as $h)
                                    <option value = '{{$h->nombre}}'>{{$h->nombre}}</option>
                                    @endforeach
                                </select>
                                
                            </td>
                            <td>
                                <p>Indicativo País<span class = 'indicador'>*</span></p>
                                <input type ='text' class ='Inputs' name ='indicativo' id = 'indicativo'required autocomplete="off" value ='{{$x->indicativo}}'/>
                            </td>
                        </tr>
                        <tr><td><p></p></td></tr>
                        <tr>
                            <td>
                                <p>Ciudad<span class = 'indicador'>*</span></p>
                                <input type ='text' class ='Inputs' name ='ciudad' required autocomplete="off" value ='{{$x->ciudad}}'/>
                            </td>
                            <td>
                                <p>Dirección<span class = 'indicador'>*</span></p>
                                <input type ='text' class ='Inputs' name ='direccion' required autocomplete="off" value ='{{$x->direccion}}'/>
                            </td>
                            <td>
                                <p>Empresa<span class = 'indicador'>*</span></p>
                                <input type ='text' class ='Inputs' name ='empresa' required autocomplete="off" value ='{{$x->direccion}}'/>
                            </td>
                        </tr>
                        <tr><td><p></p></td></tr>
                        <tr>
                            <td>
                                <p>Cargo<span class = 'indicador'>*</span></p>
                                <input type ='text' class ='Inputs' name ='cargo' required autocomplete="off" value ='{{$x->ciudad}}'/>
                            </td>
                        </tr>
                        <tr><td><p></p></td></tr>
                        <tr>
                            <td colspan = '3'>
                                @if(count($t->talleres) > 0 )
                                <p>Seleccione uno de los talleres:</p>
                                <table width = '100%'>
                                    <?php $x = 1;?>
                                @foreach( $t->talleres as $y )
                                <tr>
                                    <td width = '50px;'>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' type='checkbox' name = 'taller[]' id='taller{{$y->id}}' value='{{$y->id}}'  >
                                            <label class='form-check-label' for='taller{{$y->id}}' style = 'font-weight:500;'></label>
                                        </div>
                                    </td>
                                    <td width = '100px;'>
                                        Taller {{$x}}
                                    </td>
                                    <td>{{$y->nombre}}</td>
                                </tr>
                                <?php $x++;?>
                                @endforeach
                                </table>
                                @endif
                            </td>
                        </tr>
                        <tr><td><p></p></td></tr>
                        <tr>
                            <td colspan = '3' style = 'text-align:center;'>
                                <button  type = 'Submit' class = 'Bttn'>GUARDAR</button>
                            </td>
                        </tr>
                        </table>
                    </form>
                    <?php $i++;?>
                    <br><br>
                    @endforeach
            
            
            @endforeach
            
            
        </div>
        
        <script>
            $(document).ready(function () {
                //nextPaso(0)
            })
        </script>
@endsection
