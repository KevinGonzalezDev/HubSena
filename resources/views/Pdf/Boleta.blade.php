<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Boleta</title>
        <style>
            .page-break {
                page-break-after: always;
            }
            
            body{
                font-family: "Century Gothic", CenturyGothic, AppleGothic, sans-serif;
            }
            .CenterText{
                text-align:center;
            }
            .Negrilla{
                font-weight: bold;
            }
            footer table{
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 25px;
                color: #848788;
                font-size:10px;
                text-align: center;
            }
            header table td{
                font-size:10xp;
                margin:0px;
            }
            header { position: fixed; left: 0px; top: -20px; right: 0px; bottom: 20px;}
            
            footer { position: fixed; left: 0px; top: -40px; right: 0px; height: 25px; font-weight: lighter; }
            
            .Page{
                position:absolute;top:100px;
            }
            .pagenum:after {
                content: counter(page);
                color:black;
                font-weight: bold;
            }
            .TotalPage:after{ 
                content:counter(footer); 
                color:black;
            }
            Border{
                border:1px solid black;
            }
            hr{
                border:0.001em solid black;
            }
            body {
                margin-top: 2.5cm;
                margin-bottom: 1cm;
            }
            .DetallePrecios td{
                border:1px solid #707070;
            }
            .DetallePrecios{
                background-color:white;
            }
            table{
                border-collapse: collapse;
            }
            .ValorBoleta{
    color:#6420E1;
    font-weight: bold;
    font-size: 25px;
}
.BannerGeneral > .ValorBoleta{
    font-weight: bold;
    font-size:30px;
    position: relative;
    /* top: -20%; */
    bottom: 200px;
}
.BoletasSize{
    height:100px;
    width:100%;
    border-radius:1em;
}
.BoletasSize span{
    color:white;
    font-size:20px;
    position:relative;
    top:35%;
}

.ImagenBoleta .NombreBoleta{
    text-align:center;
    color:white;
    font-weight: bold;
    font-size:14px;
    position: relative;
    top: -40%;
}
.flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}

        </style>
    </head>
    
    <body style = ''>
        <table width ='100%' class = ' DetallePrecios'>
            <tr>
                <td  ></td>
                <td style ='text-align:center;font-size:20px;' class ='ValorBoleta' >DATOS DEL PARTICIPANTE</td>
            </tr>
            @foreach( session("s2")  as $t)
                @foreach($t->detalle as $x)
                    <tr>
                        <td style = 'text-align:Center;'>
                            <img src = 'C:\xampp\htdocs\BropPayU\/storage/app/Boletas/{{$t->photo}}' class = 'ImagenBoletas2'/>
                            
                        </td>
                        <td nowrap>
                            <p class = 'ValorBoleta' style = 'font-size:14px;font-weight: bold;text-align:Center;'>{{$x->nombre}} {{$x->apellido}}</p>
                            <p style = 'font-size:14px;font-weight: bold;text-align:Center;'>{{$x->noidentificacion}}</p>
                        </td>
                    </tr>
                    @endforeach
            @endforeach
        </table>
        <br>
        <br>
        
            
        
    </body>
</html>