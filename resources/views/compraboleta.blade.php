@extends('layout.general2')

@section('content')
        <style>
            body{
                background-image:url('../image/MASTER_BK.png');
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>

        <div class = ' Ubication'>

            <div class="regresar">
                <a onclick="regresar()">< Volver</a>
            </div>

<!--   CRONOGRAMA ---------------------------------  -->

        <div class="cronograma-container">

            <div class="title-cronograma">
                    <p>Cronograma /</p>
                    <span class = 'Titulos'>{{$datos['info'][0]->subtitulo}}</span>
                    <p>{{$datos['info'][0]->descripcion}}</p>
            </div>


            <div class="certificado-container">

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
            </div>
        </div>


<!--   TALLERES ---------------------------------  -->

            <div class = "info-taller-container">
                @if( count($datos['master']) > 0 )

                    @if($datos['id'] == 1)
                    <div class = "info-taller"">
						
							<p class = 'SizeText''>Es un taller de co-creación en el que por medio de una metodología interactiva teórico práctica,
                             se transmite conocimiento a los asistentes con el fin de brindar las herramientas necesarias para validar ideas de negocio y/o 
                             soluciones de mercado con usuarios y clientes reales.<br>Todo el proceso se realiza paso a paso, inicia con un tablero de ideación y  termina con el 
                             conocimiento necesario para crear un producto digital 100% interactivo, navegable, real y sin necesidad de inversión económica dando como resultado la posibilidad de 
                             iniciar un modelo de negocio.<br>Desde el inicio del taller se brindan diferentes herramientas totalmente prácticas las cuales fueron diseñadas para este taller, en el que 
                             los participantes tienen acceso a ellas de manera ilimitada, contando al final con el conocimiento  necesario para ser utilizadas y aplicarlas durante y 
                             después de la jornada de ocho horas.<br>Al final de la jornada se entrega adicionalmente en un pdf que le permite repasar el cómo y cuándo deben utilizarse con 
                             otra idea u otro proceso en el que las quiera implementar.</p>
						
                    </div>
                    @endif

                    @if($datos['id'] == 2)
                    <div class="info-taller">
                    
							<p class = 'SizeText'>Es un campo de entrenamiento virtual orientado a emprendedores o personas que quieran serlo, 
                            diseñado para acoplar soluciones de los emprendedores y asistentes con las necesidades de un sector específico o eje temático del Bootcamp previamente 
                            establecido.<br>Son dos días de inmersión de co-creación, divididos en dos jornadas acompañadas de cuatro horas cada una, más un trabajo extra del mismo tiempo,
                            durante este proceso se va avanzado desde la inspiración del equipo de trabajo hasta lograr enunciado de un modelo de negocio validad con un producto 
                            digital al aire de manera gratuita.<br>Las herramientas empleadas durante las jornadas, son adaptadas para este campo de entrenamiento para que los 
                            asistentes tengan acceso a ellas sean utilizadas y descargarlas en el momento que requieran, con eso se garantiza que un emprendedor logre generar 
                            soluciones a un sector específico totalmente interactivas y con un segmento de clientes real y validado.<br>Al final de la jornada se entrega adicionalmente
                            en un pdf que le permite repasar el cómo y cuándo deben utilizarse con otra idea u otro proceso en el que las quiera implementar.</p>
						
                    </div>
					@endif

					<p>Para poder inscribirte a nuestros talleres debes ver los videos de nuestra Máster Class.</p>
            </div>

            
            <div class="videos-container">
                <ul>
					@foreach( $datos['master'] as $d)
							<li style = 'text-align:center;'>
                                <table width = '100%'>
									<tr>
										<td >
											<a href = "{{ route('Videos',['id'=>$d->id]) }}" target = '_blank' >
												<img src ='../image/{{$d->imagen}}' class = 'IconosNormal Sombra' />
												<img src ='../image/play.png' class = 'Play'/>
											</a>
										</td>
									</tr>
									<tr>
										<td>
											<br><span>{{$d->nombre}}</span>
										</td>
									</tr>
								</table>
                            </li>
				@endforeach
				</ul>
            </div>
			@endif


<!--   ACTIVIDADES ---------------------------------  -->

            <div class="actividades-container">

			    <span class = 'Titulos'>ESTAS SON LAS ACTIVIDADES QUE TENEMOS PARA TI</span>
					
                    <div class = 'Talleres'>

                    <ul>

                        @foreach( $datos['info2'] as $d )
                            <li style = 'width:300px;'>
                                        @if( $datos['id'] == 6 )
										<table width ='100%'>
                                            <tr>
                                                <td colspan = '2'style = 'color:white;'>
                                                    {{$d->nombre}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan = '2'style = 'color:#2ABDC4;font-size:11px;'>
                                                    <a href = '{{$d->link}}' style = 'color:#2ABDC4;font-size:11px;' target = '_blank'>Ingresa aquí</a>
                                                </td>
                                            </tr>
                                        </table>
										@else
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

                                            @if( $d->fecha_cierre < date("Y-m-d") )
                                            <tr>
                                                <td colspan = '2'style = 'color:#d14221;font-size:11px;'>
                                                    <a style = 'color:#d14221;font-size:11px;' target = '_blank'>Este evento ya no esta disponible</a>
                                                </td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td colspan = '2'style = 'color:#2ABDC4;font-size:11px;'>
                                                    <a href = '{{$d->link}}' style = 'color:#2ABDC4;font-size:11px;' target = '_blank'>Participa en este evento haciendo clic acá</a>
                                                </td>
                                            </tr>
                                            @endif
                                        </table>
										@endif
                            </li>
                            @endforeach

                    </ul>
                            
                    </div>
                
            </div>


        <div class = 'flex-center Ubication2'>

        </div>

    <script>
        $(document).ready(function () {

        })

        function regresar(){
            window.history.back();
        }
    </script>
@endsection
