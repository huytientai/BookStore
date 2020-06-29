@extends('exam1.default')

@section('title', 'request')

@section('content')
    <form action="https://test-payment.momo.vn" method="post">
        <input type="text" name="partnerCode" value="MOMO">
        <input type="text" name="accessKey" value="F8BBA842ECF85">
        <input type="text" name="requestId" value="MM1540456472575">
        <input type="text" name="amount" value="150000">
        <input type="text" name="orderId" value="MM1540456472575">
        <input type="text" name="orderInfo" value="SDK team.">
        <input type="text" name="returnUrl" value="https://momo.vn">
        <input type="text" name="notifyUrl" value="https://momo.vn">
        <input type="text" name="requestType" value="captureMoMoWallet">
        <input type="text" name="signature" value="996ed81d68a1b05c99516835e404b2d0146d9b12fbcecbf80c7e51df51cac85e">
        <input type="text" name="extraData" value="email=abc@gmail.com">

        <button type="submit">Submit</button>

    </form>
@endsection
