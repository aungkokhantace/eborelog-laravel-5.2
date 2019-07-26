<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Signature</title>

    <style>
        #signature-pad {
            border: 1px solid;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
    </div>

    <button id="save">Save</button>
    <button id="clear">Clear</button>

</body>

</html>
<!-- jquery -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<!-- signature pad -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });
        var saveButton = document.getElementById('save');
        var cancelButton = document.getElementById('clear');


        saveButton.addEventListener('click', function(event) {
            event.preventDefault();
            if (signaturePad.isEmpty()) {
                alert("Oops...", "Please provide signature first.", "error");
            } else {

                // do ajax to post it
                $.ajax({
                    url: '/signature_save',
                    type: 'POST',
                    data: {
                        signature: signaturePad.toDataURL('image/png'),
                        // position: $('#position').val()
                    },
                    success: function(response) {
                        console.log('success : ' + response);
                        // alert("Success!", "Good stuff! Your signature is now saved", "success");
                        // setTimeout(function() {
                        //     location.reload();
                        // }, 3000);
                        //data - response from server
                    },
                    error: function(response) {
                        console.log('error : ' + response);
                        // alert("Oops...", "Sorry, something went wrong! We will investigate as soon as possible.", "error");
                        // console.log(response);
                    }
                });
            }

        });

        cancelButton.addEventListener('click', function(event) {
            event.preventDefault();
            signaturePad.clear();
        });


    });
</script>
