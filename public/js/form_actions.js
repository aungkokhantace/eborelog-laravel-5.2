/* 
    redirect to list page of corresponding module when cancel button is clicked 
*/

// check if the cancel button exists in the form (will not exist for list pages)
// var cancel_button = document.getElementById("cancel_button");
// if (cancel_button) {
//     cancel_button.onclick = function (event) {
//         event.preventDefault(); //prevent default click function
//         // a hidden field named 'module' must be included in the form
//         var module = document.getElementById("module").value;
//         window.location.replace("/" + module);
//     };
// }


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


// check if the delete button exists in the list view form(will not exist for entry and edit pages)
// var delete_button = document.getElementByClassName("delete_button");

// $(".delete_button").click(function () {
//     event.preventDefault(); //prevent default click function
//     // a hidden field named 'module' must be included in the form
//     var module = $("#module").val();
//     console.log(module);
//     // window.location.replace("/" + module);
// });


// if (delete_button) {
//     delete_button.onclick = function (event) {
//         event.preventDefault(); //prevent default click function
//         // a hidden field named 'module' must be included in the form
//         var module = document.getElementById("module").value;
//         window.location.replace("/" + module);
//     };
// }
// function delete_confirmation(module) {
//     swal({
//         title: "Are you sure?",
//         text: "You will not be able to recover!",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#DD6B55 ",
//         confirmButtonText: "Confirm",
//         cancelButtonText: "Cancel",
//         closeOnConfirm: false,
//         closeOnCancel: true
//     },
//         function (isConfirm) {
//             if (isConfirm) {
//                 $("#delete_form_" + module).submit();
//             } else {
//                 return;
//             }
//         });
// }


// $(".delete_form").on("submit", function () {
//     // return confirm("Are you sure?");
// });

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
                // $("#delete_form_" + module).submit();
                form.submit();
            } else {
                return;
            }
        });
});
