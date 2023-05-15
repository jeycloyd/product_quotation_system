$(document).ready(function(){

    //confirm approval script
    $('#approveModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget); // Button that triggered the modal
        var customer_id = button.data('id'); // Extract info from data-* attributes
        // Update the modal's content. (JQuery method)
        var modal = $(this);
        modal.find('.modal-body input').val(customer_id);
    })

    //confirm delete script
    $('#deleteModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget); // Button that triggered the modal
        var customer_id = button.data('id'); // Extract info from data-* attributes
        // Update the modal's content. (JQuery method)
        var modal = $(this);
        modal.find('.modal-body input').val(customer_id);
    })

    //confirm approve billing script
    $('#billingApprovalModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget); // Button that triggered the modal
        var quotation_id = button.data('billing'); // Extract info from data-* attributes
        var customer_id = button.data('customer_id'); //Extract info 
        // Update the modal's content. (JQuery method)
        var modal = $(this);
        modal.find('#input_for_image_receipt').val(quotation_id);
        modal.find('#input_customer_id').val(customer_id);
       
        //call ajax
        $.ajax({
            type: "GET",
            url: "/view/total/" + quotation_id,
            dataType: "json",
            success: function (response) { 
                //get the total from the object 
                $total = parseFloat(response.total);
                //put this to the input value
                $('#input_total').val($total);
            }
        });
    }) 
    
    //mark as paid script
    $('#markAsPaidModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget); // Button that triggered the modal
        var billing_id = button.data('id'); // Extract info from data-* attributes
        // Update the modal's content. (JQuery method)
        var modal = $(this);
        modal.find('#input_billing_id').val(billing_id);
    })

    //view receipt script
    $('#viewReceiptModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget); // Button that triggered the modal
        var billing_image = button.data('image'); // Extract info from data-* attributes
        // Update the modal's content. (JQuery method)
        var modal = $(this);
        $('#image_receipt').attr('src', billing_image);
    })
})



