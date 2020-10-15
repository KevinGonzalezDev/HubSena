@extends('layout.general2')

@section('content')
        <style>
            body{
                background-image:url('../image/MASTER_BK.png');
                background-repeat: repeat-y;
                background-size: cover;
            }
        </style>

        <div class = ' Ubication'>
            <table width ='100%'>
			@if( count($datos['master']) > 0 )
				<tr>
                    <td style = 'padding-left:5%;'>
                        <p>Para poder inscribirte a nuestros talleres debes ver los videos de nuestras Máster Class.</p>
                    </td>
                </tr>
				<tr>
                    <td>
                        <ul>
							@foreach( $datos['master'] as $d)
								<li style = 'text-align:center;'>
                                <table width = '100%'>
									<tr>
										<td>
											<a href = "{{ route('Videos',['id'=>$d->id]) }}" target = '_blank'>
												<img src ='../image/{{$d->imagen}}' class = 'IconosNormal'/>
												<img src ='../image/play.png' class = 'Play'/>
											</a>
										</td>
									</tr>
									<tr>
										<td>
											<span>{{$d->nombre}}</span>
										</td>
									</tr>
								</table>
                            </li>
							@endforeach
						</ul>
                    </td>
                </tr>
			@endif
            </table>
            <br>
			<table width ='100%'>
                <tr>
                    <td style = 'padding-left:5%;'>
                        <p style = 'font-weight: bold;color:#33333382;'>Cronograma /</p>
                        <span class = 'Titulos'>{{$datos['info'][0]->subtitulo}}</span>
                    </td>
                </tr>
                <tr>
                    <td style = 'padding-left:5%;'>
                        <p style = 'width:600px;'>{{$datos['info'][0]->descripcion}}</p>
                    </td>
                </tr>
                <tr>
                    <td style = 'padding-left:5%;'>
                        @if( $datos['info'][0]->certificado == 1 )
                        <div class = 'DivCerti'>
                            <table width ='100%'>
                                <tr>
                                    <td width = '15%'>
                                        <img src ='../image/certificate.png' heigth = '30px'/>
                                    </td>
                                    <td style = 'text-align:Center;color:#2ABDC4;'>Certificado</td>
                                </tr>
                            </table>

                        </div>
                        @endif
                        <br><br>
                    </td>
                </tr>
                <tr>
                    <td style = 'padding-left:5%;'>
                        <Div class ='Talleres'>
                            <ul>
                                @foreach( $datos['info2'] as $d )
                                <li style = 'width:300px;'>
                                    <div >
                                        <table width ='100%'>
                                            <tr>
                                                <td colspan = '2'style = 'color:white;'>
                                                    {{$d->nombre}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = 'color:#FCB51A;font-size:11px;'>
                                                    Fecha:
                                                </td>
                                                <td style = 'color:white;font-size:11px;'>
                                                    {{$d->fechas}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = 'color:#FCB51A;font-size:11px;'>
                                                    Hora:
                                                </td>
                                                <td style = 'color:white;font-size:11px;'>
                                                    {{$d->horario}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan = '2'style = 'color:#2ABDC4;font-size:11px;'>
                                                    <a href = '{{$d->link}}' style = 'color:#2ABDC4;font-size:11px;' target = '_blank'>Participa en este evento haciendo clic acá</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </li>
                                @endforeach
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class = 'flex-center Ubication2'>

        </div>

    <script>
        $(document).ready(function () {

        })
    </script>
@endsection
