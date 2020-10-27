@extends('layout.general')

@section('content')
        <style>
            .footerPage{
                display:none;
            }

        </style>



        <div class="events-main-container">
        
        <img class = 'logo' src ='image/logo.png' />
        
            <div class="eventos-buttons-container">

                    <h2 id="main-title">ESTAS SON LAS ACTIVIDADES QUE TENEMOS PARA TI</h2>

                        <div class = 'flex-center UbicationCe'>
                                @foreach( $datos['info'] as $d )
                                    <div class = 'contentopcion'>

                                        <img src ='image/{{$d->icono}}' class = 'IconosMins'/>
                                        <a href = '{{route('InformacionTipo',['id'=>$d->id])}}' data-toggle="tooltip" title="{{$d->descripcion}}" >{{$d->nombre}}</a>

                                    </div>
                                @endforeach
                        </div>
            </div>
        
        </div>

        


@endsection
