import "./cart.js";

const csrf_token = $(`meta[name="csrf_token"]`).attr("content");
const base_url = $(`meta[name="base_url"]`).attr("content");

// notyf init
var notyf = new Notyf({
    duration: 5000,
    dismissible: true,
});

// Ez Share init
document.addEventListener("DOMContentLoaded", function () {
    ezShare.execute();
});

$(function () {
    // dynamic delete popup
    $(".delete-item").on("click", function (e) {
        e.preventDefault();
        let url = $(this).attr("href");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#356DF1",
            cancelButtonColor: "#dc3741",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "DELETE",
                    url: url,
                    data: {
                        _token: csrf_token,
                    },
                    success: function (data) {
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        notyf.error(error);
                    },
                });
            }
        });
    });
});

// subscribe to newsletter
$(".newsletter").on("submit", function (e) {
    e.preventDefault();

    let formData = $(this).serialize();
    $.ajax({
        method: "POST",
        url: `${base_url}/newsletter-subscribe`,
        data: formData,
        beforeSend: function () {
            $(".newsletter-btn").text("Subscribing...");
            //disable button
            $(".newsletter-btn").prop("disabled", true);
        },
        success: function (data) {
            notyf.success(data.message);
            $(".newsletter").trigger("reset");
            $(".newsletter-btn").text("Subscribe");
            $(".newsletter-btn").prop("disabled", false);
        },
        error: function (xhr, status, error) {
            notyf.error(xhr.responseJSON.message);
            $(".newsletter").trigger("reset");
            $(".newsletter-btn").text("Subscribe");
            $(".newsletter-btn").prop("disabled", false);
        },
    });
});

document.addEventListener("DOMContentLoaded", function () {
    tinymce.init({
        selector: ".editor",
        height: 500,
        menubar: false,
        plugins: [
            "advlist",
            "autolink",
            "lists",
            "link",
            "charmap",
            "anchor",
            "searchreplace",
            "visualblocks",
            "fullscreen",
            "insertdatetime",
            "media",
            "table",
            "help",
            "wordcount",
        ],
        toolbar:
            "undo redo | blocks | " +
            "bold italic backcolor | alignleft aligncenter " +
            "alignright alignjustify | bullist numlist outdent indent | " +
            "removeformat | help",
        content_style:
            "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",
    });
});
