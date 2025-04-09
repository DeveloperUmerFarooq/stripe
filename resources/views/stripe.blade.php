<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <center>
        <h1>Payment Page</h1>
        <form id="payment-form" method="POST" action="{{route('stripe.payment')}}">
            @csrf
            <div id="card-element" class="form-control w-25">

            </div>
            <input type="hidden" name="stripeToken" id="stripe-token">
            <input type="submit" id="submit" class="d-none" value="Submit">
            <div id="payment-message" class="hidden"></div>
        </form>
        <button class="btn btn-primary mt-3" onclick="createToken(event)">
            Pay
        </button>
    </center>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe(
            "{{env('STRIPE_KEY')}}"
            );
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');
        function createToken(e){
            e.preventDefault();
            stripe.createToken(cardElement).then(function(result) {
                console.log(result);
                if(result.token){
                        document.getElementById('stripe-token').value=result.token.id
                        document.getElementById('submit').click();
                    }
            });
        }
    </script>
</body>

</html>
