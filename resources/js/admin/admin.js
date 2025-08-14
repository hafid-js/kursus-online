
console.log('admin.js loaded');
import { data } from "autoprefixer";
import $ from "jquery";

window.$ = window.jQuery = $;
/** Notyf init */
var notyf = new Notyf({
    duration: 8000,
    dismissible: true,
});

const csrf_token = $('meta[name="csrf-token"]').attr('content');
const base_url = $('meta[name="base_url"]').attr('content') || '';

document.addEventListener("DOMContentLoaded", function () {
    var el;
    window.TomSelect &&
        new TomSelect((el = document.getElementById("select-users")), {
            copyClassesToDropdown: false,
            dropdownParent: "body",
            controlInput: "<input>",
            render: {
                item: function (data, escape) {
                    if (data.customProperties) {
                        return (
                            '<div><span class="dropdown-item-indicator">' +
                            data.customProperties +
                            "</span>" +
                            escape(data.text) +
                            "</div>"
                        );
                    }
                    return "<div>" + escape(data.text) + "</div>";
                },
                option: function (data, escape) {
                    if (data.customProperties) {
                        return (
                            '<div><span class="dropdown-item-indicator">' +
                            data.customProperties +
                            "</span>" +
                            escape(data.text) +
                            "</div>"
                        );
                    }
                    return "<div>" + escape(data.text) + "</div>";
                },
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

var delete_url = null;

$(function () {
    $(".select2").select2();
});

/** Delete Item with confirmation */

$(document).on("click", ".delete-item", function (e) {
    e.preventDefault();

    let url = $(this).attr("href");
    delete_url = url;

    $("#modal-danger").modal("show");
});

$(".delete-confirm").on("click", function (e) {
    e.preventDefault();

    $.ajax({
        method: "DELETE",
        url: delete_url,
        data: {
            _token: csrf_token,
        },
        beforeSend: function () {
            $(".delete-confirm").text("Deleting...");
        },
        success: function (data) {
            window.location.reload();
        },
        error: function (xhr, status, error) {
            let errorMessage = xhr.responseJSON;
            notyf.error(errorMessage.message);
        },
        complete: function () {
            $(".delete-confirm").text("Delete");
        },
    });
});

/** Database Clear with confirmation */

$(".db-clear").on("click", function (e) {
    e.preventDefault();

    let url = $(this).attr("href");
    delete_url = url;

    $("#modal-database-clear").modal("show");
});

$(".db-clear-submit").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
        method: "DELETE",
        url: base_url + "/admin/database-clear",
        data: {
            _token: csrf_token,
        },
        beforeSend: function () {
            $(".db-clear-btn").text("Wiping...");
        },
        success: function (data) {
            window.location.reload();
        },
        error: function (xhr, status, error) {
            let errorMessage = xhr.responseJSON;
            notyf.error(errorMessage.message);
        },
        complete: function () {
            $(".db-clear-btn").text("Delete");
        },
    });
});

// tinymce
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

/** Certificate js */

$(function () {
    $(".draggable-element").draggable({
        containment: ".certificate-body",
        stop: function (event, ui) {
            var elementId = $(this).attr("id");
            var xPosition = ui.position.left;
            var yPosition = ui.position.top;

            $.ajax({
                method: "POST",
                url: `${base_url}/admin/certificate-item`,
                data: {
                    _token: csrf_token,
                    element_id: elementId,
                    x_position: xPosition,
                    y_position: yPosition,
                },
                success: function (data) {},
                error: function (xhr, status, error) {},
            });
        },
    });
});

$(function () {
    $(".select_instructor").on("change", function () {
        let id = $(this).val();

        $.ajax({
            method: "get",
            url: `${base_url}/admin/get-instructor-courses/${id}`,
            beforeSend: function () {
                $(".instructor_courses").empty();
            },
            success: function (data) {
                $.each(data.courses, function (key, value) {
                    let option = `<option value="${value.id}">${value.title}</option>`;
                    $(".instructor_courses").append(option);
                });
            },
            error: function (xhr, status, error) {
                notyf.error(data.error);
            },
        });
    });
});

function updateApproveStatus(id, status) {
    $.ajax({
        method: "PUT",
        url: base_url + `/admin/instructor-requests/${id}/update-approval`,
        data: {
            _token: csrf_token,
            status: status,
        },
        success: function (data) {
            window.location.reload();
        },
        error: function (xhr, status, error) {},
    });
}

$(function () {
    // change course approval status
    $(".update-approval-status").on("change", function () {
        let id = $(this).data("id");
        let status = $(this).val();

        updateApproveStatus(id, status);
    });
});

// upload profil photo and live show
const profilePhoto = document.getElementById("profile_photo");
if(profilePhoto) {
    profilePhoto.addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById("profilePreview").src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    });
}

$(document).ready(function () {
    // Handle edit button click
    $(".edit_blog_category").on("click", function () {
        const categoryId = $(this).data("category-id");
        $("#dynamic-modal").modal("show");
        $(".dynamic-modal-content").html(
            '<div class="p-5 text-center">Loading...</div>'
        );

        $.ajax({
            url: `${base_url}/admin/blog-categories/${categoryId}/edit`,
            method: "GET",
            success: function (html) {
                $(".dynamic-modal-content").html(html);
            },
            error: function (xhr) {
                $(".dynamic-modal-content").html(
                    '<div class="p-5 text-danger">Error loading form</div>'
                );
            },
        });
    });

    // Handle update form submission
    $(document).on("submit", "#updateCategoryForm", function (e) {
        e.preventDefault();
        const form = $(this);
        const actionUrl = form.attr("action");
        const formData = new FormData(this);

        $.ajax({
            url: actionUrl,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $("#dynamic-modal").modal("hide");
                location.reload();
            },
            error: function (xhr) {
                $("#error-name").text("");
                $("#error-status").text("");
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.name) {
                        $("#error-name").text(errors.name[0]);
                    }
                    if (errors.status) {
                        $("#error-status").text(errors.status[0]);
                    }
                }
            },
        });
    });
});

$(document).ready(function () {
    console.log("Document ready, script running...");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#createCategoryForm").on("submit", function (e) {
        e.preventDefault();
        console.log("Form intercepted, submitting via AJAX...");

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('admin.blog-categories.store') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log("Success response:", response);

                // Bootstrap 5 modal hide
                var modal = bootstrap.Modal.getOrCreateInstance(
                    document.getElementById("addBlogCatModal")
                );
                modal.hide();

                window.location.href = response.redirect;
            },
            error: function (xhr) {
                console.log("Validation error:", xhr);
                $("#error-name").text("");
                $("#error-status").text("");

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.name) {
                        $("#error-name").text(errors.name[0]);
                    }
                    if (errors.status) {
                        $("#error-status").text(errors.status[0]);
                    }
                }
            },
        });
    });
});

// ajax search
window.initLiveSearch = function({
    inputSelector,
    resultSelector,
    url,
    delay = 300,
    additionalData = {}
}) {
    let timer = null;

    $(document).on('keyup', inputSelector, function () {
        clearTimeout(timer);

        timer = setTimeout(() => {
            const query = $(this).val();
            $.ajax({
                url: url,
                type: "GET",
                data: { search: query, ...additionalData },
                success: function (data) {
                    $(resultSelector).html(data);
                },
                error: function () {
                    $(resultSelector).html(`
                        <tr>
                            <td colspan="4" class="text-center text-danger">
                                Error fetching results
                            </td>
                        </tr>`);
                }
            });
        }, delay);
    });
};



// yajra datatable custom usable
window.initTable = function(tableSelector) {
    let table = $(tableSelector).DataTable();

    table.on('draw', function() {
        updateTableInfo();
        renderPagination(table.page.info().page + 1, table.page.info().pages);
    });

    // Manual pagination click handler
    $(document).off('click.customPagination').on('click.customPagination', '.page-link', function(e) {
        e.preventDefault();
        const page = $(this).data('page');
        if (page && page >= 1 && page <= table.page.info().pages) {
            table.page(page - 1).draw(false);
        }
    });

    // Search manual input
    $('#custom-search').off('keyup.customSearch').on('keyup.customSearch', function() {
        table.search(this.value).draw();
    });

    // Custom Length Input
    $('#custom-length').off('change.customLength').on('change.customLength', function() {
        let val = parseInt(this.value, 10);
        if (!isNaN(val) && val > 0) {
            table.page.len(val).draw();
        }
    });

    // Sinkronisasi input length dengan DataTables awal
    $('#custom-length').val(table.page.len());

    function updateTableInfo() {
        const info = table.page.info();
        $('#table-info').html(
            `Showing <strong>${info.start + 1} to ${info.end}</strong> of <strong>${info.recordsTotal} entries</strong>`
        );
    }

    function renderPagination(currentPage, totalPages) {
        const $pagination = $('.pagination');
        $pagination.empty();

        // Prev button
        const prevDisabled = currentPage === 1 ? 'disabled' : '';
        $pagination.append(`
            <li class="page-item ${prevDisabled}">
                <a class="page-link" href="#" data-page="${currentPage - 1}" aria-label="Previous">
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
            const active = i === currentPage ? 'active' : '';
            $pagination.append(`
                <li class="page-item ${active}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>
            `);
        }

        // Next button
        const nextDisabled = currentPage === totalPages ? 'disabled' : '';
        $pagination.append(`
            <li class="page-item ${nextDisabled}">
                <a class="page-link" href="#" data-page="${currentPage + 1}" aria-label="Next">
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

    return table; // optional kalau mau simpan instance
}
