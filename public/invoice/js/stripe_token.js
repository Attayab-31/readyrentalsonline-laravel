$(document).ready(function() {
    // Initialize Stripe with your publishable key
    const stripe = Stripe(window.STRIPE_PUBLISHABLE_KEY);
    // const stripe = Stripe(window.STRIPE_PUBLISHABLE_KEY);
   
    // Create Stripe Elements
    const elements = stripe.elements();
    const cardElement = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#32325d',
            }
        }
    });
    
    // Mount the card element to the DOM (you'll need a div with id 'card-element')
    cardElement.mount('#card-element');
    
    // Handle form submission
    $("#payment_form").submit(async function(e) {
        e.preventDefault();
        
        var original_sub_btm_markup = $("#payment-sub-btn").data("original_markup");
        $('#payment-sub-btn').addClass("disabled");
        $('#payment-sub-btn').prop("disabled", true);
        $(".payment-errors").html("").css("display", "none");
        $("#payment-sub-btn").html('<i class="fa fa-lock"></i> <span class="spinner-border spinner-border-sm align-middle ms-2"></span> Processing... Please Wait!');
        
        // Client-side validation (similar to your existing code)
        var card_holder_name = $('#card_holder_name').val();
        var amount = $('#amount').val();
        
        // if (!card_holder_name) {
        //     showError('The card holder name is required and can\'t be empty');
        //     return false;
        // }
        
        // if (!amount || amount < 1) {
        //     showError('Please enter a valid amount (minimum 1)');
        //     return false;
        // }
        
        try {
            // 1. First create a PaymentIntent on your server
            const response = await fetch('/create-payment-intent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({
                    amount: amount * 100, // Convert to cents
                    invoice_number: $('#invoice_number').val() // Add any other needed data
                })
            });
            
            const { clientSecret, error: serverError } = await response.json();
            
            if (serverError) {
                throw new Error(serverError);
            }
            
            // 2. Confirm the payment with Stripe.js
            const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: card_holder_name
                    }
                }
            });
            
            if (error) {
                throw new Error(error.message);
            }
            
            if (paymentIntent.status === 'succeeded') {
                // 3. Send the paymentIntent ID to your server to complete the process
                const completeResponse = await fetch('/complete-payment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        payment_intent_id: paymentIntent.id,
                        invoice_number: $('#invoice_number').val()
                    })
                });
                
                const result = await completeResponse.json();
                
                if (result.success) {
                    // Redirect to success page or show success message
                    window.location.href = '/invoices/pay/' + $('#invoice_number').val();
                } else {
                    throw new Error(result.error || 'Payment failed');
                }
            }
        } catch (err) {
            showError(err.message);
        }
        
        function showError(message) {
            $(".payment-errors").html('<b>Error</b>:<br>' + message);
            $(".payment-errors").css("display", "block");
            $('#payment-sub-btn').prop("disabled", false).removeClass("disabled");
            $("#payment-sub-btn").html(original_sub_btm_markup);
        }
    });
});