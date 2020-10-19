@extends('layout.general')

@section('content')
        <style>
            body{
                background-image:url('image/FONDO_2.png');
                background-repeat: no-repeat;
                background-size: cover;
            }
            .footerPage{
                display:none;
            }
            .logo{
                position:absolute;
                top:2%;
                left:5%;
                height: 50px;
            }
        </style>
        <img class = 'logo' src ='image/logo.png' />
        <div class = 'flex-center UbicationCe'>
            <ul>
                @foreach( $datos['info'] as $d )
                <li>
                    <div class = 'contentopcion'>
                        <table width ='100%'>
                            <tr>
                                <td width = '20%'>
                                    <img src ='image/{{$d->icono}}' class = 'IconosMins'/>
                                </td>
                                <td style = 'text-align: center;color:#3D3D3D;'>
                                    <a href = '{{route('InformacionTipo',['id'=>$d->id])}}'>{{$d->nombre}}</a>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <script>
                        alert($d['id']);
                    </script>
                </li>
                @endforeach
            </ul>
        </div>

        
@endsection
