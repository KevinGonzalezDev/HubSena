@extends('layout.general2')

@section('content')
        <!--<form method="post" action="https://checkout.payulatam.com/ppp-web-gateway-payu/">-->
        <form id = 'formPayU' method="post" action="{{$datos['pay'][0]->url}}">
        <!--<input name="merchantId"    type="hidden"  value="507132"   >
        <input name="accountId"     type="hidden"  value="508152" >-->
        <input name="merchantId"    type="hidden"  value="{{$datos['pay'][0]->merchanid}}"   >
        <input name="accountId"     type="hidden"  value="{{$datos['pay'][0]->accountid}}" >
        <input name="description"   type="hidden"  value="Test PAYU"  >
        <input name="referenceCode" type="hidden"  value="{{$datos['pay'][0]->reference}}" >
        <input name="amount"        type="hidden"  value="{{$datos['info'][0]->Total}}"   >
        <input name="tax"           type="hidden"  value="{{$datos['info'][0]->impuesto}}"  >
        <input name="taxReturnBase" type="hidden"  value="{{$datos['info'][0]->valorcompra}}" >
        <input name="currency"      type="hidden"  value="COP" >
        <input name="signature" type="hidden"  value="{{$datos['pay'][0]->sig}}" >
        <!--<input name="test"          type="hidden"  value="0" >-->
        <input name="test"          type="hidden"  value="1" >
        <input name="buyerEmail"    type="hidden"  value="{{$datos['info'][0]->email}}" >
        <input name="responseUrl"    type="hidden"  value="http://process.grupotesta.com.co:8989/BropPayU/public/DatosPayU/{{$datos['info'][0]->id}}" >
        <input name="confirmationUrl"    type="hidden"  value="http://process.grupotesta.com.co:8989/BropPayU/public/DatosPayU/{{$datos['info'][0]->id}}" >
        <input name="Submit"        type="submit"  value="Enviar" >
      </form>
        <script>
            $(document).ready(function () {
                //$('#formPayU').submit()
            })
        </script>
@endsection
