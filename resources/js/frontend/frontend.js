import "./cart.js";

const base_url = $('meta[name="base_url"]').attr("content");
const csrf_token = $('meta[name="csrf_token"]').attr("content");
import { Notyf } from 'notyf';

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

$(document).ready(function () {
    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function () {
            const context = this,
                args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    // AJAX put courses result
    function fetchCourses() {
        let formData = $("#course-filter-form").serialize();

        const courseIndexUrl = $('meta[name="course-index-url"]').attr(
            "content"
        );

        $.ajax({
            url: courseIndexUrl,
            type: "GET",
            data: formData,
            beforeSend: function () {
                $("#course-results").html("<p>Loading...</p>");
            },
            success: function (res) {
                $("#course-results").html(res); // if work it change
            },
            error: function () {
                $("#course-results").html("<p>Something went wrong</p>");
            },
        });
    }

    // if user typing in form
    $('#course-filter-form input[name="search"]').on(
        "keyup",
        debounce(function () {
            fetchCourses(); // call ajax
        }, 500)
    );

    // add trigger if checkbox level, category dll it change
    $('#course-filter-form input[type="checkbox"]').on("change", function () {
        fetchCourses();
    });
});

// upload avatar and live show
document
    .getElementById("profile_photo")
    .addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById("profilePreview").src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    });

window.initTable = function (tableSelector) {
    let table = $(tableSelector).DataTable();

    table.on("draw", function () {
        updateTableInfo();
        renderPagination(table.page.info().page + 1, table.page.info().pages);
    });

    // Manual pagination click handler
    $(document)
        .off("click.customPagination")
        .on("click.customPagination", ".page-link", function (e) {
            e.preventDefault();
            const page = $(this).data("page");
            if (page && page >= 1 && page <= table.page.info().pages) {
                table.page(page - 1).draw(false);
            }
        });

    // Search manual input
    $("#custom-search")
        .off("keyup.customSearch")
        .on("keyup.customSearch", function () {
            table.search(this.value).draw();
        });

    $(".custom-length-input")
        .off("change.customLength")
        .on("change.customLength", function () {
            const tableId = $(this).data("table-id");
            const newLength = parseInt($(this).val());

            if (!isNaN(newLength) && newLength > 0) {
                const table = $("#" + tableId).DataTable();
                table.page.len(newLength).draw();
            }
        });

    // Sinkronisasi input length dengan DataTables awal
    $("#custom-length").val(table.page.len());

    function updateTableInfo() {
        const info = table.page.info();
        $("#table-info").html(
            `Showing <strong>${info.start + 1} to ${
                info.end
            }</strong> of <strong>${info.recordsTotal} entries</strong>`
        );
    }

    function renderPagination(currentPage, totalPages) {
        const $pagination = $(".pagination");
        $pagination.empty();

        // Prev button
        const prevDisabled = currentPage === 1 ? "disabled" : "";
        $pagination.append(`
            <li class="page-item ${prevDisabled}">
                <a class="page-link" href="#" data-page="${
                    currentPage - 1
                }" aria-label="Previous">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-1">
                        <path d="M15 6l-6 6l6 6"></path>
                    </svg>
                </a>
            </li>
        `);

        // Numbered pages
        for (let i = 1; i <= totalPages; i++) {
            const active = i === currentPage ? "active" : "";
            $pagination.append(`
                <li class="page-item ${active}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>
            `);
        }

        // Next button
        const nextDisabled = currentPage === totalPages ? "disabled" : "";
        $pagination.append(`
            <li class="page-item ${nextDisabled}">
                <a class="page-link" href="#" data-page="${
                    currentPage + 1
                }" aria-label="Next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-1">
                        <path d="M9 6l6 6l-6 6"></path>
                    </svg>
                </a>
            </li>
        `);
    }

    // Initial info and pagination render
    updateTableInfo();
    const info = table.page.info();
    renderPagination(info.page + 1, info.pages);

    return table;
};
