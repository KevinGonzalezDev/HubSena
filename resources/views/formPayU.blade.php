@extends('layout.general')

@section('content')
        <style>
            body{
                background-image:none;
            }
        </style>
        

         <form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
            <input name="merchantId"    type="hidden"  value="508029"   >
            <input name="accountId"     type="hidden"  value="512321" >
            <input name="description"   type="hidden"  value="pRUEBAS"  >
			<?php 
			$D = "DAM002";
            ECHO '<input name="referenceCode" type="hidden"  value="'.$D.'" >';
			?>
            <input name="amount"        type="hidden"  value="20000"   >
            <input name="tax"           type="hidden"  value="3193"  >
            <input name="taxReturnBase" type="hidden"  value="16806" >
            <input name="currency"      type="hidden"  value="COP" >
			<?php 
			$MD =md5("4Vj8eK4rloUd272L48hsrarnUA~508029~".$D."~20000~COP");
			echo $MD;
            ECHO '<input name="signature" type="hidden"  value="'.$MD.'" >';
			?>
            <input name="test"          type="hidden"  value="1" >
            <input name="buyerEmail"    type="hidden"  value="test@test.com" >
            <input name="responseUrl"    type="hidden"  value="http://process.grupotesta.com.co:8989/BropPayU/public/prueba.php" >
            <input name="confirmationUrl"    type="hidden"  value="http://process.grupotesta.com.co:8989/BropPayU/public/prueba.php" >
            <input name="Submit"        type="submit"  value="Enviar" >
          </form>
        <script>
            $(document).ready(function () {
                //nextPaso(0)
            })
        </script>
@endsection
