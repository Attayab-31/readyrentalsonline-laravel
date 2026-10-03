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
                x: (mouseEvent.clientX - rect.left) * (canvasDom.width / rect.width),
                y: (mouseEvent.clientY - rect.top) * (canvasDom.height / rect.height)
            };
        }

        function getTouchPos(canvasDom, touchEvent) {
            var rect = canvasDom.getBoundingClientRect();
            return {
                x: (touchEvent.touches[0].clientX - rect.left) * (canvasDom.width / rect.width),
                y: (touchEvent.touches[0].clientY - rect.top) * (canvasDom.height / rect.height)
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

    var form = this;
    var $form = $(form);
    var $response = $form.find('#form_res');
    var submitEvent = e.originalEvent;
    var submitButton = (submitEvent && submitEvent.submitter) || $form.find('button[type="submit"]').get(0);
    var action = form.getAttribute('action');

    if (!action || !submitButton || submitButton.disabled) {
        return;
    }

    $form.find('.field_error').text('');
    $form.find('.input-error').removeClass('input-error').removeAttr('aria-invalid');
    $response.hide().empty();

    var formData = new FormData(form);
    var signatureCanvas = document.getElementById('sig-canvas');
    if (signatureCanvas) {
        formData.set('e_sign', signatureCanvas.toDataURL());
    }

    RRButtonLoading.start(submitButton, 'Saving your answers…');

    $.ajax({
        type: 'POST',
        url: action,
        data: formData,
        contentType: false,
        processData: false,
        headers: { Accept: 'application/json' },
        success: function(response) {
            if (response && typeof response.redirect_url === 'string' && response.redirect_url !== '') {
                window.location.assign(response.redirect_url);
                return;
            }

            showApplicationMessage($response, 'We could not continue just now. Please try again.');
            RRButtonLoading.stop(submitButton);
        },
        error: function(xhr) {
            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                showValidationErrors($form, $response, xhr.responseJSON.errors);
                RRButtonLoading.stop(submitButton);
                return;
            }

            showApplicationMessage(
                $response,
                xhr.responseJSON && xhr.responseJSON.message
                    ? xhr.responseJSON.message
                    : 'We could not save your answers. Please try again or call 1-267-549-9625 for help.'
            );
            RRButtonLoading.stop(submitButton);
        }
    });
});

function showApplicationMessage($container, message) {
    $container
        .empty()
        .append($('<div>', {
            class: 'alert alert-danger rr-application-error',
            role: 'alert',
            tabindex: '-1',
            text: message
        }))
        .show();

    var messageElement = $container.children().get(0);
    messageElement.focus();
    messageElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function showValidationErrors($form, $response, errors) {
    var errorList = $('<ul>');
    var firstInvalidField = null;

    $.each(errors, function(key, messages) {
        var message = Array.isArray(messages) ? messages[0] : messages;
        var field = document.getElementById(key);
        var fieldError = document.getElementById(key + '_error');

        // The signature is drawn on a canvas; its submitted value is a hidden input.
        if (key === 'e_sign') {
            field = document.getElementById('sig-canvas') || field;
        }

        if (field && $form.get(0).contains(field)) {
            $(field)
                .addClass('input-error')
                .attr('aria-invalid', 'true')
                .attr('aria-describedby', key + '_error');
            firstInvalidField = firstInvalidField || field;
        }

        if (fieldError && $form.get(0).contains(fieldError)) {
            fieldError.textContent = message;
        }

        errorList.append($('<li>', { text: message }));
    });

    var summary = $('<div>', {
        class: 'alert alert-danger rr-application-error',
        role: 'alert',
        tabindex: '-1'
    }).append(
        $('<p>', { text: 'Please check the following and try again:' }),
        errorList
    );

    $response.empty().append(summary).show();
    summary.get(0).focus();
    summary.get(0).scrollIntoView({ behavior: 'smooth', block: 'center' });

    if (firstInvalidField) {
        window.setTimeout(function() {
            firstInvalidField.focus({ preventScroll: true });
        }, 300);
    }
}

$(document).on('input change', '#online-application-form-with-steps .input-error', function() {
    $(this).removeClass('input-error').removeAttr('aria-invalid');
    var fieldError = document.getElementById(this.id + '_error');
    if (fieldError) {
        fieldError.textContent = '';
        if ($(this).attr('aria-describedby') === fieldError.id) {
            $(this).removeAttr('aria-describedby');
        }
    }
});



});
