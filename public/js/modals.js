//confirm delete script
$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var customer_id = button.data('id') // Extract info from data-* attributes
    // Update the modal's content. (JQuery method)
    var modal = $(this)
    modal.find('.modal-body input').val(customer_id)
})