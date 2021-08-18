<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <kkiapay-widget amount="2000"
        key="24d1d480da4211ebb78cf3a40dbc99e1"
        url="{{asset('welcome/images/logo.png')}}"
        position="center"
        sandbox="true"
        data=""
        callback={{route('postCreateOrder')}}>
    </kkiapay-widget>

        {{-- <kkiapay-widget amount="2000" 
            key="24d1d480da4211ebb78cf3a40dbc99e1"
            url="{{asset('welcome/images/logo.png')}}"
            position="center"
            sandbox="true"
            data="1"
            callback="http://localhost:8000/paymentGateway">
        </kkiapay-widget> --}}

        {{-- <script amount="2000" 
            name="CHEDE CEDRIC"
            callback="http://localhost:8000/paymentGateway"
            data="1"
            url="{{asset('welcome/images/logo.png')}}"
            position="right" 
            theme="#0095ff"
            sandbox="true"
            key="24d1d480da4211ebb78cf3a40dbc99e1"
            src="https://cdn.kkiapay.me/k.js">

            addSuccessListener(response => {
                console.log('response',response);
            });

            openKkiapayWidget({amount:"2000",position:"right",callback:"http://localhost:8000/paymentGateway",
            data:"1"
            theme:"green",
            key:"24d1d480da4211ebb78cf3a40dbc99e1"})

        </script>    --}}
        <script src="https://cdn.kkiapay.me/k.js"></script>
</body>
</html>