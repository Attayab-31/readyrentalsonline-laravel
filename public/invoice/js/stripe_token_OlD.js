$(document).ready(function()
{
 
	$("#payment_form").submit(function()
	{
        var original_sub_btm_markup = $("#payment-sub-btn").data("original_markup");

        $('#payment-sub-btn').addClass("disabled");
        $('#payment-sub-btn').prop("disabled" , true);
        
        $(".payment-errors").html("");
        $(".payment-errors").css("display", "none");

        $("#payment-sub-btn").html('<i class="fa fa-lock"></i> <span class="spinner-border spinner-border-sm align-middle ms-2"></span> Processing... Please Wait!');

        var card_number =$('#card_number').val();
        var cvc =$('#cvc').val();
        var expiry_month =$('#expiry_month').val();
        var expiry_year =$('#expiry_year').val();
        var card_holder_name =$('#card_holder_name').val();
        var amount =$('#amount').val();

 
        if(card_holder_name =="" || card_holder_name.length == 0 )
        {
	        // re-enable the submit button
	        $('#payment-sub-btn').prop("disabled" , false);
            $('#payment-sub-btn').removeClass("disabled");
	  				
	        // show the errors on the form
	        $(".payment-errors").html('<b>Error</b>:<br>  The card holder name is required and can\'t be empty');
	        $(".payment-errors").css("display", "block");
        	
        	$("#payment-sub-btn").html(original_sub_btm_markup);
	    			
	        return false;
        }

       	var card_number_isnum = /^\d+$/.test(card_number);
        if(card_number =="" || card_number.length == 0 || card_number_isnum == false )
        {
	        // re-enable the submit button
	        $('#payment-sub-btn').prop("disabled" , false);
            $('#payment-sub-btn').removeClass("disabled");
	  				
	        // show the errors on the form
	        $(".payment-errors").html('<b>Error</b>:<br>  The credit card number is required and can\'t be empty and can contain digits only ');
	        $(".payment-errors").css("display", "block");

	        $("#payment-sub-btn").html(original_sub_btm_markup);

	        return false;
        }
        else if(card_number.length < 13)
        {
	        // re-enable the submit button
	        $('#payment-sub-btn').prop("disabled" , false);
            $('#payment-sub-btn').removeClass("disabled");
	  				
	        // show the errors on the form
	        $(".payment-errors").html('<b>Error</b>:<br>  The credit card number must contain minimum 13 digits ');
	        $(".payment-errors").css("display", "block");
	        
	        $("#payment-sub-btn").html(original_sub_btm_markup);

	        return false;
        }



       	var expiry_month_isnum = /^\d+$/.test(expiry_month);
        if(expiry_month =="" || expiry_month.length == 0 || expiry_month_isnum == false || expiry_month < 1 || expiry_month > 12 )
        {
	        // re-enable the submit button
	        $('#payment-sub-btn').prop("disabled" , false);
            $('#payment-sub-btn').removeClass("disabled");
	  				
	        // show the errors on the form
	        $(".payment-errors").html('<b>Error</b>:<br>  The expiration month is required and can only contain valid month number');
	        $(".payment-errors").css("display", "block");
	        
	        $("#payment-sub-btn").html(original_sub_btm_markup);

	        return false;
        }



       	var expiry_year_isnum = /^\d+$/.test(expiry_year);
        if(expiry_year =="" || expiry_year.length == 0 || expiry_year_isnum == false )
        {
	        // re-enable the submit button
	        $('#payment-sub-btn').prop("disabled" , false);
            $('#payment-sub-btn').removeClass("disabled");
	  				
	        // show the errors on the form
	        $(".payment-errors").html('<b>Error</b>:<br>  The expiration year is required and can only contain valid year number');
	        $(".payment-errors").css("display", "block");
	        
	        $("#payment-sub-btn").html(original_sub_btm_markup);

	        return false;
        }


        if(cvc =="" )
        {
	        // re-enable the submit button
	        $('#payment-sub-btn').prop("disabled" , false);
            $('#payment-sub-btn').removeClass("disabled");
	  				
	        // show the errors on the form
	        $(".payment-errors").html('<b>Error</b>:<br>  The cvv is required and can\'t be empty');
	        $(".payment-errors").css("display", "block");
	        
	        $("#payment-sub-btn").html(original_sub_btm_markup);

	        return false;
        }


       	var amount_isnum = /^\d+$/.test(amount);
        if(amount =="")
        {
	        // re-enable the submit button
	        $('#payment-sub-btn').prop("disabled" , false);
            $('#payment-sub-btn').removeClass("disabled");
	  				
	        // show the errors on the form
	        $(".payment-errors").html('<b>Error</b>:<br> Please enter the amount you want to donate');
	        $(".payment-errors").css("display", "block");

	        $("#payment-sub-btn").html(original_sub_btm_markup);

	        return false;
        }

        if(amount < 1 )
        {
	        // re-enable the submit button
	        $('#payment-sub-btn').prop("disabled" , false);
            $('#payment-sub-btn').removeClass("disabled");
	  				
	        // show the errors on the form
	        $(".payment-errors").html('<b>Error</b>:<br>  The amount can not be less than 1 ');
	        $(".payment-errors").css("display", "block");

	        $("#payment-sub-btn").html(original_sub_btm_markup);

	        return false;
        }












        Stripe.card.createToken(
        {
            number: card_number,
            cvc: cvc,
            exp_month: expiry_month,
            exp_year: expiry_year,
  			name: card_holder_name
        },
        stripeResponseHandler);
        return false; // submit from callback
	});

});



// this identifies your website in the createToken call below
Stripe.setPublishableKey(window.STRIPE_PUBLISHABLE_KEY);

function stripeResponseHandler(status, response)
{
    if (response.error)
    {
  				
        // show the errors on the form
        $(".payment-errors").html('<b>Error</b>:<br>'+response.error.message);
        $(".payment-errors").css("display", "block");


        // re-enable the submit button
        $('#payment-sub-btn').prop("disabled" , false);
        $('#payment-sub-btn').removeClass("disabled");
 
        var original_sub_btm_markup = $("#payment-sub-btn").data("original_markup");
        $("#payment-sub-btn").html(original_sub_btm_markup);

    }
    else
    {
        var token = response['id'];
        var form$ = $("#payment_form");
        form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
        form$.get(0).submit();
    }
}







