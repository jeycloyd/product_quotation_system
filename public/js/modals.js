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
    })

})



