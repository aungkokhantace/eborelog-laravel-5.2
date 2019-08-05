/*
    redirect to list page of corresponding module when cancel button is clicked
*/
$("#cancel_button").click(function (event) {
    event.preventDefault(); //prevent default click function
    // a hidden field named 'module' must be included in the form
    // var module = document.getElementById("module").value;
    var module = $("#module").val();
    window.location.replace("/" + module);
});

/*
    cancel button for WO page (with project_id)
    redirect to list page of corresponding module when cancel button is clicked
*/
$("#cancel_button_with_project_id").click(function (event) {
    event.preventDefault(); //prevent default click function
    // a hidden field named 'module' must be included in the form
    // var module = document.getElementById("module").value;
    var module = $("#module").val();
    var project_id = $("#project_id").val();
    window.location.replace("/" + module + "/" + project_id );
});

/* 
    ask for confirmation when delete button is clicked on setup list views
 */
$('.delete_form').on('submit', function (e) {
    var form = this;
    e.preventDefault();
    swal({
        title: "Are you sure?",
        text: "Please confirm you would like to delete this record!",
        icon: "warning",
        buttons: [true, "Confirm"],
        closeModal: true,
    }).then(
        function (isConfirm) {
            if (isConfirm) {
                $('.swal-button--confirm').prop("disabled", true);
                form.submit();
            } else {
                return;
            }
        });
});
