<!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
            <title>Signature Test</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
            <link href="css/jquery.signature.css" rel="stylesheet">
            <style>
                .kbw-signature { width: 468px; height: 250px; }
            </style>
            <!--[if IE]>
            <script src="excanvas.js"></script>
            <![endif]-->
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            <script src="js/jquery.signature.js"></script>
            <script>
                $(function() {
                    //create an instance of signature
                    var sig = $('#sig').signature();
                    //clear signature board when pressed
                    $('#clear').click(function() {
                        sig.signature('clear');
                        $('#input_base64img').val("");
                    });
                    //when there are changes within the signature form
                    $('#sig').signature({ 
                        change: function(event, ui) { 
                            //convert the signature to base64
                            let img = sig.signature('toDataURL');
                            //store signature in a hidden input inside the modal
                            $('#input_base64').val(img);
                            //disable/enable save button when the signature form is empty
                            $('#btn-save-signature').prop('disabled', false)
                            if ($('#sig').signature('isEmpty')) {
                                $('#btn-save-signature').prop('disabled', true)
                            }
                        } 
                    }); 
                    //show modal on page load
                    // $("#signatureModal").modal('show');
                    // $('#signatureModal').on('show.bs.modal', function (e) {
                    //     let img = sig.signature('toDataURL');
                    //     $('#input_base64').val(img);
                    // }) 
                    // $('#sig').signature({ 
                    //     change: function(event, ui) { 
                    //         $('#btn-save-signature').prop('disabled', false)
                    //         if ($('#sig').signature('isEmpty')) {
                    //             $('#btn-save-signature').prop('disabled', true)
                    //         }
                    //     } 
                    // }); 
                });
            </script>
        </head>
        <body>
            {{-- <div id="sig"></div>
            <form action="{{route('store.image')}}" method="POST">
                @csrf   
            </form>
            <p style="clear: both;">
                <button id="clear" class="btn btn-secondary" >Clear</button> 
            </p> --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signatureModal">
                Affix Signature
            </button>   
        </body>

        <!-------------------------------------- SIGNATURE CONFIRMATION MODAL ----------------------------------------------->
        <div class="modal fade" id="signatureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Affix Signature</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('store.image')}}" method="POST">
                    <div class="modal-body">
                            @csrf
                            <div id="sig"></div>
                            <input type="text" value="" name="base64string" id="input_base64" hidden>
                    </div>
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                        <p style="clear: both;">
                            <button type="button" id="clear" class="btn btn-secondary" >Clear</button> 
                        </p> 
                        <button type="submit" class="btn btn-primary" target="_blank" id="btn-save-signature">Save</button>
                    </div>
                </form> 
            </div>
            </div>
        </div>
</html>
