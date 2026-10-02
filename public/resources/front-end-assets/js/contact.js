/* Contact Form Dynamic */


        $( document ).ready(function() { 
 
                    //   window.requestAnimFrame = (function(callback) {
                    //     return window.requestAnimationFrame ||
                    //       window.webkitRequestAnimationFrame ||
                    //       window.mozRequestAnimationFrame ||
                    //       window.oRequestAnimationFrame ||
                    //       window.msRequestAnimaitonFrame ||
                    //       function(callback) {
                    //         window.setTimeout(callback, 1000 / 60);
                    //       };
                    //   })();

                    //   var canvas = document.getElementById("sig-canvas");
                    //   var ctx = canvas.getContext("2d");
                    //   ctx.strokeStyle = "#222222";
                    //   ctx.lineWidth = 4;

                    //   var drawing = false;
                    //   var mousePos = {
                    //     x: 0,
                    //     y: 0
                    //   };
                    //   var lastPos = mousePos;

                    //   canvas.addEventListener("mousedown", function(e) {
                    //     drawing = true;
                    //     lastPos = getMousePos(canvas, e);
                    //   }, false);

                    //   canvas.addEventListener("mouseup", function(e) {
                    //     drawing = false;
                    //   }, false);

                    //   canvas.addEventListener("mousemove", function(e) {
                    //     mousePos = getMousePos(canvas, e);
                    //   }, false);

                    //   // Add touch event support for mobile
                    //   canvas.addEventListener("touchstart", function(e) {

                    //   }, false);

                    //   canvas.addEventListener("touchmove", function(e) {
                    //     var touch = e.touches[0];
                    //     var me = new MouseEvent("mousemove", {
                    //       clientX: touch.clientX,
                    //       clientY: touch.clientY
                    //     });
                    //     canvas.dispatchEvent(me);
                    //   }, false);

                    //   canvas.addEventListener("touchstart", function(e) {
                    //     mousePos = getTouchPos(canvas, e);
                    //     var touch = e.touches[0];
                    //     var me = new MouseEvent("mousedown", {
                    //       clientX: touch.clientX,
                    //       clientY: touch.clientY
                    //     });
                    //     canvas.dispatchEvent(me);
                    //   }, false);

                    //   canvas.addEventListener("touchend", function(e) {
                    //     var me = new MouseEvent("mouseup", {});
                    //     canvas.dispatchEvent(me);
                    //   }, false);

                    //   function getMousePos(canvasDom, mouseEvent) {
                    //     var rect = canvasDom.getBoundingClientRect();
                    //     return {
                    //       x: mouseEvent.clientX - rect.left,
                    //       y: mouseEvent.clientY - rect.top
                    //     }
                    //   }

                    //   function getTouchPos(canvasDom, touchEvent) {
                    //     var rect = canvasDom.getBoundingClientRect();
                    //     return {
                    //       x: touchEvent.touches[0].clientX - rect.left,
                    //       y: touchEvent.touches[0].clientY - rect.top
                    //     }
                    //   }

                    //   function renderCanvas() {
                    //     if (drawing) {
                    //       ctx.moveTo(lastPos.x, lastPos.y);
                    //       ctx.lineTo(mousePos.x, mousePos.y);
                    //       ctx.stroke();
                    //       lastPos = mousePos;
                    //     }
                    //   }

                    //   // Prevent scrolling when touching the canvas
                    //   document.body.addEventListener("touchstart", function(e) {
                    //     if (e.target == canvas) {
                    //       e.preventDefault();
                    //     }
                    //   }, false);
                    //   document.body.addEventListener("touchend", function(e) {
                    //     if (e.target == canvas) {
                    //       e.preventDefault();
                    //     }
                    //   }, false);
                    //   document.body.addEventListener("touchmove", function(e) {
                    //     if (e.target == canvas) {
                    //       e.preventDefault();
                    //     }
                    //   }, false);

                    //   (function drawLoop() {
                    //     requestAnimFrame(drawLoop);
                    //     renderCanvas();
                    //   })();

                    //   function clearCanvas() {
                    //     canvas.width = canvas.width;
                    //   	 $("#e_sign").val("");
                    //   }


                    //   // Set up the UI 
                    //   var sigValue = document.getElementById("e_sign");
                    //   var clearBtn = document.getElementById("clearsignatureBtn");
                    //   clearBtn.addEventListener("click", function(e) {
                    //     clearCanvas();
                    //     sigText.innerHTML = "Data URL for your signature will go here!";
                    //     sigImage.setAttribute("src", "");
                    //   }, false);





// Code for initializing the first canvas
window.requestAnimFrame = (function(callback) {
    return window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimationFrame ||
        function(callback) {
            window.setTimeout(callback, 1000 / 60);
        };
})();

function initializeCanvas(canvas, ctx) {
    ctx.strokeStyle = "#222222";
    ctx.lineWidth = 4;

    var drawing = false;
    var mousePos = {
        x: 0,
        y: 0
    };
    var lastPos = mousePos;

    canvas.addEventListener("mousedown", function(e) {
        drawing = true;
        lastPos = getMousePos(canvas, e);
    }, false);

    canvas.addEventListener("mouseup", function(e) {
        drawing = false;
    }, false);

    canvas.addEventListener("mousemove", function(e) {
        mousePos = getMousePos(canvas, e);
    }, false);

    canvas.addEventListener("touchstart", function(e) {
        if (e.target == canvas) {
            drawing = true;
            lastPos = getTouchPos(canvas, e);
        }
    }, false);

    canvas.addEventListener("touchend", function(e) {
        drawing = false;
    }, false);

    canvas.addEventListener("touchmove", function(e) {
        if (e.target == canvas) {
            var touch = e.touches[0];
            var me = new MouseEvent("mousemove", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(me);
        }
    }, false);

    function getMousePos(canvasDom, mouseEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: (mouseEvent.clientX - rect.left) * canvasDom.width / rect.width,
            y: (mouseEvent.clientY - rect.top) * canvasDom.height / rect.height
        };
    }

    function getTouchPos(canvasDom, touchEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: (touchEvent.touches[0].clientX - rect.left) * canvasDom.width / rect.width,
            y: (touchEvent.touches[0].clientY - rect.top) * canvasDom.height / rect.height
        };
    }

    function renderCanvas() {
        if (drawing) {
            ctx.beginPath();
            ctx.moveTo(lastPos.x, lastPos.y);
            ctx.lineTo(mousePos.x, mousePos.y);
            ctx.stroke();
            lastPos = {
                x: mousePos.x,
                y: mousePos.y
            };
        }
    }

    canvas.addEventListener("touchstart", function(e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);

    canvas.addEventListener("touchend", function(e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);

    canvas.addEventListener("touchmove", function(e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);

    (function drawLoop() {
        requestAnimFrame(drawLoop);
        renderCanvas();
    })();
}

// Initialize canvas 1
var canvas = document.getElementById("sig-canvas");
var ctx = canvas ? canvas.getContext("2d") : null;
if (canvas && ctx) {
    initializeCanvas(canvas, ctx);
}

// Initialize canvas 2
var canvas2 = document.getElementById("sig-canvas2");
var ctx2 = canvas2 ? canvas2.getContext("2d") : null;
if (canvas2 && ctx2) {
    initializeCanvas(canvas2, ctx2);
}

  
  
  
  
  
  function clearCanvas() {
    canvas.width = canvas.width;
    $("#e_sign").val("");
  }
  

  function clearCanvas2() {
    canvas2.width = canvas2.width;
    $("#e_sign2").val("");
  }



  var sigValue = document.getElementById("e_sign");
  var clearBtn = document.getElementById("clearsignatureBtn");
  if (clearBtn) {
      clearBtn.addEventListener("click", function(e) {
        clearCanvas();
        if (typeof sigText !== 'undefined') sigText.innerHTML = "Data URL for your signature will go here!";
        if (typeof sigImage !== 'undefined') sigImage.setAttribute("src", "");
      }, false);
  }

 

  var sigValue2 = document.getElementById("e_sign2");
  var clearBtn2 = document.getElementById("clearsignatureBtn2");
  if (clearBtn2) {
      clearBtn2.addEventListener("click", function(e) {
        clearCanvas2();
      }, false);
  }




























 

    function post_e_Sign_to_field(argument) 
    {
    	
      var dataUrl = canvas.toDataURL();
      // alert(dataUrl);
      // sigText.innerHTML = dataUrl;
      // sigValue.val = dataUrl;
      // sigImage.setAttribute("src", dataUrl);
      
      $("#e_sign").val(dataUrl);

    }

                    	
 

      $("#contact-form").submit(function(e)
      {
      	e.preventDefault();
      	$('#form-sbm-btn').prop('disabled', true);
      	$('#form-sbm-btn').text('Processing... Please Wait!');

      	$("#form_res").css("display", "none");
      	$("#form_res").html();

		$('.form-text').text('');
		var formData = new FormData($(this)[0]);

		$.ajax({
		  url:$(this).attr('action'),
		  type: "POST",
		  dataType: 'JSON',
		  headers: {
		           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		           },
		  data: formData,
		  cache:false,
		  contentType: false,
		  processData: false,
		  success: function(data)
		  {

		    var res_code = data.res_code;
		    var res_msg_markup = data.res_msg_markup;

		    if(res_code == "200")
		    {
			      $("#form_res").css("display", "block");
			      $("#form_res").html(res_msg_markup);
			      $('#contact-form').hide();

			      $('html, body').animate({
					scrollTop: $("#form_container").offset().top
	    			}, 500);

		    }
		    else if(res_code == "100")
		    {
			     	$("#form_res").css("display", "block");
			      $("#form_res").html(res_msg_markup);

			      $('html, body').animate({
					scrollTop: $("#form_container").offset().top
	    			}, 500);
		    }		    
		    else
		    {
			      $("#form_res").css("display", "block");
			      $("#form_res").html(res_msg_markup);

			      $('html, body').animate({
					scrollTop: $("#form_container").offset().top
	    			}, 500);
		    }

      	   	   $('#form-sbm-btn').prop('disabled', false);
      	    	   $('#form-sbm-btn').text('Submit');

		  },
		  error: function (err)
		  {
		    if(err.status == 422) 
		    {
		       // when status code is 422, it's a validation issue
		        console.log(err.responseJSON);
		        $('#success_message').fadeIn().html(err.responseJSON.message);
		        
		        // you can loop through the errors object and show it to the user
		        console.warn(err.responseJSON.errors);
		        // display errors on each form field
		        $.each(err.responseJSON.errors, function (i, error)
		        {
		            var el = $(document).find('[name="'+i+'"]');
		            // el.after($('<span style="color: red;">'+error[0]+'</span>'));
		            $('#'+i+'_error').text(error[0]);
		            console.log(error[0]);
		        
		        });

	        	$("#form_res").css("display", "block");
	        	$("#form_res").html('<div class="alert alert-danger" role="alert"><b><i class="fas fa-times"></i> Error Found!</b><br>\
                                                Please fix the errors below and submit again!</div>');

		      $('html, body').animate({
				scrollTop: $("#form_container").offset().top
    			}, 500);  
		    }
		    else
		    {
		      console.log('All Good');
		    }

      	    $('#form-sbm-btn').prop('disabled', false);
      	    $('#form-sbm-btn').text('Submit');

		  }

		});

        return false;
      
      });
 

      $("#prop_inqury_form").submit(function(e)
      {
      	e.preventDefault();
      	$('#form-sbm-btn').prop('disabled', true);
      	$('#form-sbm-btn').text('Processing... Please Wait!');

      	$("#form_res").css("display", "none");
      	$("#form_res").html();

		$('.form-text').text('');
		var formData = new FormData($(this)[0]);

		$.ajax({
		  url:$(this).attr('action'),
		  type: "POST",
		  dataType: 'JSON',
		  headers: {
		           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		           },
		  data: formData,
		  cache:false,
		  contentType: false,
		  processData: false,
		  success: function(data)
		  {

		    var res_code = data.res_code;
		    var res_msg_markup = data.res_msg_markup;

		    if(res_code == "200")
		    {
			      $("#form_res").css("display", "block");
			      $("#form_res").html(res_msg_markup);

			      $('html, body').animate({
					scrollTop: $("#form_container").offset().top
	    			}, 500);

                    $('#prop_inqury_form')[0].reset();
		    		
		    }
		    else if(res_code == "100")
		    {
			     	$("#form_res").css("display", "block");
			      $("#form_res").html(res_msg_markup);

			      $('html, body').animate({
					scrollTop: $("#form_container").offset().top
	    			}, 500);
		    }		    
		    else
		    {
			      $("#form_res").css("display", "block");
			      $("#form_res").html(res_msg_markup);

			      $('html, body').animate({
					scrollTop: $("#form_container").offset().top
	    			}, 500);
		    }

	      	$('#form-sbm-btn').prop('disabled', false);
	      	$('#form-sbm-btn').text('Send Messege');

		  },
		  error: function (err)
		  {
		    if(err.status == 422) 
		    {
		       // when status code is 422, it's a validation issue
		        console.log(err.responseJSON);
		        $('#success_message').fadeIn().html(err.responseJSON.message);
		        
		        // you can loop through the errors object and show it to the user
		        console.warn(err.responseJSON.errors);
		        // display errors on each form field
		        $.each(err.responseJSON.errors, function (i, error)
		        {
		            var el = $(document).find('[name="'+i+'"]');
		            // el.after($('<span style="color: red;">'+error[0]+'</span>'));
		            $('#'+i+'_error').text(error[0]);
		            console.log(error[0]);
		        
		        });

				$("#form_res").css("display", "block");
				$("#form_res").html('<div class="alert alert-danger" role="alert"><b><i class="fas fa-times"></i> Error Found!</b><br>\
				                        Please fix the errors below and submit again!</div>');
				$('html, body').animate({
					scrollTop: $("#form_container").offset().top
				}, 500);  
		    }
		    else
		    {
		      console.log('All Good');
		    }

      	    $('#form-sbm-btn').prop('disabled', false);
      	    $('#form-sbm-btn').text('Send Messege');

		  }

		});

        return false;
      
      });      





	$("#online-application-form").submit(function(e)
      {
      	e.preventDefault();
      	$('#form-sbm-btn').prop('disabled', true);
      	$('#form-sbm-btn').text('Processing... Please Wait!');

      	$("#form_res").css("display", "none");
      	$("#form_res").html();
		
	      var dataUrl = canvas.toDataURL();
      	 $("#e_sign").val(dataUrl);


	      var dataUrl2 = canvas2.toDataURL();
      	  $("#e_sign2").val(dataUrl2);

 



		$('.form-text').text('');
		var formData = new FormData($(this)[0]);
		$('.input_field').removeClass("input_field_error");

		$.ajax({
		  url:$(this).attr('action'),
		  type: "POST",
		  dataType: 'JSON',
		  headers: {
		           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		           },
		  data: formData,
		  cache:false,
		  contentType: false,
		  processData: false,
		  success: function(data)
		  {

		    var res_code = data.res_code;
		    var res_msg_markup = data.res_msg_markup;

		    if(res_code == "200")
		    {	
			     clearCanvas();
		       $("#form_res").css("display", "block");
		       $("#form_res").html(res_msg_markup);

			$('html, body').animate({
			     scrollTop: $("#form_container").offset().top
    			}, 500);

	    		$('#online-application-form')[0].reset();
		    }
		    else if(res_code == "100")
		    {
			$("#form_res").css("display", "block");
			$("#form_res").html(res_msg_markup);

			$('html, body').animate({
				scrollTop: $("#form_container").offset().top
			}, 500);
		    }		    
		    else
		    {
		      $("#form_res").css("display", "block");
		      $("#form_res").html(res_msg_markup);

		      $('html, body').animate({
				scrollTop: $("#form_container").offset().top
    			}, 500);
		    }

      	   	   $('#form-sbm-btn').prop('disabled', false);
      	    	   $('#form-sbm-btn').text('Submit Application');

		  },
		  error: function (err)
		  {
		    if(err.status == 422) 
		    {
		       // when status code is 422, it's a validation issue
		        console.log(err.responseJSON);
		        $('#success_message').fadeIn().html(err.responseJSON.message);
		        
		        // you can loop through the errors object and show it to the user
		        console.warn(err.responseJSON.errors);
		        // display errors on each form field
		        $.each(err.responseJSON.errors, function (i, error)
		        {
		            var el = $(document).find('[name="'+i+'"]');
		            // el.after($('<span style="color: red;">'+error[0]+'</span>'));
		            $('#'+i+'_error').text(error[0]);
				$('#'+i+'').addClass("input_field_error");

		             

		            console.log(error[0]);
		        
		        });

	        	$("#form_res").css("display", "block");
                $("#form_res").html('<div class="alert alert-danger blink" style="margin-bottom:5rem" role="alert"><h3 style="color:red;"><i class="fas fa-times"></i> Error Found!</h3>\
                <b>Please correct boxes in Red and Continue!</b></div>');


		      $('html, body').animate({
				scrollTop: $("#form_container").offset().top
    			}, 500);  
		    }
		    else
		    {
		      console.log('All Good');
		    }

	      	    $('#form-sbm-btn').prop('disabled', false);
	      	    $('#form-sbm-btn').text('Submit Application');

		  }

		});

        return false;
      
      });




	$("#offline-application-form").submit(function(e)
      {	


      	// post_e_Sign_to_field();



      	e.preventDefault();
	      $('#form-sbm-btn').prop('disabled', true);
      	$('#form-sbm-btn').text('Processing... Please Wait!');

      	$("#form_res").css("display", "none");
      	$("#form_res").html();

				$('.form-text').text('');
		
	      var dataUrl = canvas.toDataURL();
      	$("#e_sign").val(dataUrl);


		var formData = new FormData($(this)[0]);


	    // var pa_application_document_attached = $("#pa_application_document_attached").val();

	    // if(fileName) { // returns true if the string is not empty
	    //     alert(fileName + " was selected");
	    // } else { // no file was selected
	    //     alert("no file selected");
	    // }

	    // return false;



		$.ajax({
		  url:$(this).attr('action'),
		  type: "POST",
		  dataType: 'JSON',
		  headers: {
		           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		           },
		  data: formData,
		  cache:false,
		  contentType: false,
		  processData: false,
		  success: function(data)
		  {

		    var res_code = data.res_code;
		    var res_msg_markup = data.res_msg_markup;

		    if(res_code == "200")
		    {
		       $("#form_res").css("display", "block");
		       $("#form_res").html(res_msg_markup);

			$('html, body').animate({
			     scrollTop: $("#form_container").offset().top
    			}, 500);
					clearCanvas();
	    		$('#offline-application-form')[0].reset();
		    }
		    else if(res_code == "100")
		    {
			$("#form_res").css("display", "block");
			$("#form_res").html(res_msg_markup);

			$('html, body').animate({
				scrollTop: $("#form_container").offset().top
			}, 500);
		    }		    
		    else
		    {
		      $("#form_res").css("display", "block");
		      $("#form_res").html(res_msg_markup);

		      $('html, body').animate({
				scrollTop: $("#form_container").offset().top
    			}, 500);
		    }

      	   	   $('#form-sbm-btn').prop('disabled', false);
      	    	   $('#form-sbm-btn').text('Submit Application');

		  },
		  error: function (err)
		  {
		    if(err.status == 422) 
		    {
		       // when status code is 422, it's a validation issue
		        console.log(err.responseJSON);
		        $('#success_message').fadeIn().html(err.responseJSON.message);
		        
		        // you can loop through the errors object and show it to the user
		        console.warn(err.responseJSON.errors);
		        // display errors on each form field
		        $.each(err.responseJSON.errors, function (i, error)
		        {
		            var el = $(document).find('[name="'+i+'"]');
		            // el.after($('<span style="color: red;">'+error[0]+'</span>'));
		            $('#'+i+'_error').text(error[0]);
		            console.log(error[0]);
		        
		        });

	        	$("#form_res").css("display", "block");
	        	$("#form_res").html('<div class="alert alert-danger" role="alert"><b><i class="fas fa-times"></i> Error Found!</b><br>\
                                                Please fix the form errors below and submit again!</div>');

		      $('html, body').animate({
				scrollTop: $("#form_container").offset().top
    			}, 500);  
		    }
		    else
		    {
		      console.log('All Good');
		    }

	      	    $('#form-sbm-btn').prop('disabled', false);
	      	    $('#form-sbm-btn').text('Submit Application');

		  }

		});

        return false;
      
      });





});
