$(document).ready(function()
{

    // Initialize the E-Sign Canvas 
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
                x: mouseEvent.clientX - rect.left,
                y: mouseEvent.clientY - rect.top
            };
        }

        function getTouchPos(canvasDom, touchEvent) {
            var rect = canvasDom.getBoundingClientRect();
            return {
                x: touchEvent.touches[0].clientX - rect.left,
                y: touchEvent.touches[0].clientY - rect.top
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
 

    var canvas = document.getElementById("sig-canvas");
    if (canvas)
    {
        var ctx = canvas.getContext("2d");
        initializeCanvas(canvas, ctx);

        function clearCanvas() {
            canvas.width = canvas.width;
            $("#e_sign").val("");
        }

        // Clear the Sign Button
        var clearBtn = document.getElementById("clearsignatureBtn");
        if (clearBtn) {
            clearBtn.addEventListener("click", function(e) {
                clearCanvas();
                // sigText.innerHTML = "Data URL for your signature will go here!";
                // sigImage.setAttribute("src", "");
            }, false);
        }

        // Add a submit event listener to capture the signature data
        var form = document.getElementById("online-application-form-with-steps");
        if (form) {
            form.addEventListener('submit', function(e) {
                if (canvas) {
                    var dataUrl = canvas.toDataURL();
                    $("#e_sign").val(dataUrl);
                }
            });
        }
    }
  
    
  

$('#online-application-form-with-steps').on('submit', function(e) {
    e.preventDefault();

    // Clear previous errors
    $('.field_error').text('');
    $('.input-error').removeClass('input-error');
    $('#form_res').hide().empty();

    // Get form action URL
    let formActionUrl = $(this).attr('action');

    // Gather form data
    let formData = new FormData(this);

    // Check for canvas and add its data URL if available
    var canvas = document.getElementById("sig-canvas");
    if (canvas) {
        var dataUrl = canvas.toDataURL();
        formData.append("e_sign", dataUrl);
    }

    // Change button text to include spinner
    let submitButton = $(this).find('button[type="submit"]').get(0);
    RRButtonLoading.start(submitButton, 'Processing…');

    // Add a 2-second delay before making the AJAX call
    setTimeout(function() {
        $.ajax({
            type: 'POST',
            url: formActionUrl, // Use the form action URL
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response
                window.location.href = response.redirect_url; // Redirect on success
            },
            error: function(response) {
                if (response.status === 422) {
                    // Validation error response
                    let errors = response.responseJSON.errors;
                    let errorMessages = '<ul>';
                    $.each(errors, function(key, value) {
                        $('#' + key + '_error').text(value[0]); // Display validation error
                        $('#' + key).addClass('input-error'); // Add error class to the field
                        errorMessages += '<li>' + value[0] + '</li>';
                    });
                    errorMessages += '</ul>';
                    // $('#form_res').html(errorMessages).show(); // Show error messages in the container

                    $("#form_res").css("display", "block");
                    $("#form_res").html('<div class="alert alert-danger blink" style="margin-bottom:1.2rem" role="alert"><p class="response_title" style="color:red;"><i class="fas fa-times"></i> Error(s) Found!</p>\
                    <b>please correct errors below and Continue!</b></div>');

                    // Ensure the DOM is updated before scrolling
                    setTimeout(function() {
                        $('html, body').animate({
                            scrollTop: $("#form_res").offset().top
                        }, 500);
                    }, 100); // Short delay to ensure DOM update
                } else {
                    // Handle other errors
                    alert('An error occurred. Please try again.');
                }
            },
            complete: function() {
                // Reset button text and re-enable it
                RRButtonLoading.stop(submitButton);
            }
        });
    }, 2000); // 2000 milliseconds = 2 seconds
});

    
    


    // Input change handler
    $(document).on('input change', '.input-error', function() {
        $(this).removeClass('input-error');
        $('#' + $(this).attr('id') + '_error').text(''); // Clear the associated error message
    });



});
