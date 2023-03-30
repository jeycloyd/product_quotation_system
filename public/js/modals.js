deleteModal.addEventListener('click', function (event) {
    const element = document.getElementsById('btnDelete');
    var test = element.getAttribute("data-id");
    //populate the textbox with the value from the button
    document.getElementById("customer_id_input").value = test;
    console.log(element);
});