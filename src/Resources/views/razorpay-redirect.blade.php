<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Razorpay Gateway</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
            justify-content: flex-start;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            /* Adjust margin-top as needed */
            animation: slideIn 1s ease-out forwards;
            /* Animation */
        }

        @keyframes slideIn {
            0% {
                transform: translateY(-50px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <form name='razorpayform' action="razorpaycheck" method="POST">
        <div class="message">
            <strong>Note: Don't close this window or refresh it. After processing the payment, wait for
                redirection...</strong>
        </div>
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    </form>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        // Checkout details as a json
var options = <?php echo $json?>;

/**
 * The entire list of Checkout fields is available at
 * https://docs.razorpay.com/docs/checkout-form#checkout-fields
 */
options.handler = function (response){
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.razorpayform.submit();
};

// Boolean whether to show image inside a white frame. (default: true)
options.theme.image_padding = false;

options.modal = {
    ondismiss: function() {
        window.location.href="checkout/cart";
       
    },
    // Boolean indicating whether pressing escape key 
    // should close the checkout form. (default: true)
    escape: false,
    // Boolean indicating whether clicking translucent blank
    // space outside checkout form should close the form. (default: false)
    backdropclose: false
};

var rzp = new Razorpay(options);

window.onload = (event) => {
    rzp.open();
    event.preventDefault();
}

    </script>
</body>

</html>