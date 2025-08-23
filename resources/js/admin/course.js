/** const variables */
import $ from 'jquery';
window.$ = window.jQuery = $;

const csrf_token = $('meta[name="csrf-token"]').attr('content');
const base_url = $('meta[name="base_url"]').attr('content') || '';
const basic_info_url = base_url + "/admin/courses/create";
const update_url = base_url + "/admin/courses/update";

// notyf init
var notyf = new Notyf({
    duration: 8000,
    dismissible: true
});

var loader = `
<div class="modal-content text-center text-primary p-2" style="display:inline">
   <div class="spinner-border" role="status">
  <span class="sr-only"></span>
</div>
  </div>

`;

// course tab navigation
$(".course-tab").on("click", function (e) {
    e.preventDefault();
    let step = $(this).data("step");
    $(".course-form").find("input[name=next_step]").val(step);
    $(".course-form").trigger("submit");
});

$(".basic_info_form").on("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        method: "POST",
        url: basic_info_url,
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {},
        success: function (data) {
            if (data.status == "success") {
                window.location.href = data.redirect;
            }
        },
        error: function (xhr, status, error) {
            let errors = xhr.responseJSON.errors;
            $.each(errors, function (key, value) {
                notyf.error(value[0]);
            });
        },
        complete: function () {},
    });
});

$(".basic_info_update_form").on("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        method: "POST",
        url: update_url,
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {},
        success: function (data) {
            if (data.status == "success") {
                window.location.href = data.redirect;
            }
        },
        error: function (xhr, status, error) {
            let errors = xhr.responseJSON.errors;
            $.each(errors, function (key, value) {
                notyf.error(value[0]);
            });
        },
        complete: function () {},
    });
});

$(".more_info_form").on("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    $.ajax({
        method: "POST",
        url: update_url,
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {},
        success: function (data) {
            if (data.status == "success") {
                window.location.href = data.redirect;
            }
        },
        error: function (xhr, status, error) {
            let errors = xhr.responseJSON.errors;
            $.each(errors, function (key, value) {
                notyf.error(value[0]);
            });
        },
        complete: function () {},
    });
});

// show hide path input depending on source

$(document).ready(function () {
    $('.storage').trigger('change'); // buat set awal tampilan
});

$(document).on('change', '.storage', function () {
    let value = $(this).val();

    if (value === 'upload') {
        $('.upload_source').removeClass('d-none');
        $('.external_source').addClass('d-none');

        $('input[name="file"]').prop('disabled', false);
        $('input[name="url"]').prop('disabled', true).val('');
    } else {
        $('.upload_source').addClass('d-none');
        $('.external_source').removeClass('d-none');

        $('input[name="url"]').prop('disabled', false);
        $('input[name="file"]').prop('disabled', true).val('');
    }
});
// course contents
$(".dynamic-modal-btn").on("click", function (e) {
    e.preventDefault();
    $("#dynamic-modal").modal("show");

    let course_id = $(this).data('id');

    $.ajax({
        method: "GET",
        url: base_url + '/admin/course-content/:id/create-chapter'.replace(':id', course_id),
        data: {},
        beforeSend: function () {
            $('.dynamic-modal-content').html(loader);
        },
        success: function (data) {
            $('.dynamic-modal-content').html(data);
        },
        error: function () {

        },
    });
});

$(".edit_chapter").on("click", function (e) {
    e.preventDefault();
    $("#dynamic-modal").modal("show");

    let chapter_id = $(this).data('chapter-id');-
    $.ajax({
        method: "GET",
        url: base_url + '/admin/course-content/:id/edit-chapter'.replace(':id', chapter_id),
        data: {},
        beforeSend: function () {
            $('.dynamic-modal-content').html(loader);
        },
        success: function (data) {
            $('.dynamic-modal-content').html(data);
        },
        error: function () {

        },
    });
});

$('.add_lesson').on('click', function() {
    $("#dynamic-modal").modal("show");

    let courseId = $(this).data('course-id');
    let chapterId = $(this).data('chapter-id');
    $.ajax({
        method: 'GET',
        url: base_url + '/admin/course-content/create-lesson',
        data: {
            'course_id': courseId,
            'chapter_id': chapterId
        },
        beforeSend: function () {
            $('.dynamic-modal-content').html(loader);
        },
        success: function (data) {
            $('.dynamic-modal-content').html(data);
        },
        error: function (xhr, status, error) {
            let errors = xhr.responseJSON.errors;
            $.each(errors, function (key, value) {
                notyf.error(value[0]);
            });
        },
    });
})

$('.edit_lesson').on('click', function() {
    $("#dynamic-modal").modal("show");

    let courseId = $(this).data('course-id');
    let chapterId = $(this).data('chapter-id');
    let lessonId = $(this).data('lesson-id');
    $.ajax({
        method: 'GET',
        url: base_url + '/admin/course-content/edit-lesson',
        data: {
            'course_id': courseId,
            'chapter_id': chapterId,
            'lesson_id': lessonId
        },
        beforeSend: function () {
            $('.dynamic-modal-content').html(loader);
        },
        success: function (data) {
            $('.dynamic-modal-content').html(data);
        },
        error: function (xhr, status, error) {
            let errors = xhr.responseJSON.errors;
            $.each(errors, function (key, value) {
                notyf.error(value[0]);
            });
        },
    });
});


$(document).ready(function () {
if($('.sortable_list li').length) {
    $('.sortable_list').sortable({
        items: "li",
        containment: "parent",
        cursor: "move",
        handle: ".dragger",
        update: function(event, ui) {
            let orderIds = $(this).sortable("toArray", {
                attribute: "data-lesson-id"
            });

            let chapterId = ui.item.data("chapter-id");

            $.ajax({
                method: 'POST',
                url: base_url + `/admin/course-chapter/${chapterId}/sort-lesson`,
                data: {
                    _token: csrf_token,
                    order_ids: orderIds
                },
                success: function(data) {
                    notyf.success(data.message);
                }, error: function(xhr, status, error, data) {
                    notyf.error(data.error);
                }
            })

        }
    })
}
})

$('.sort_chapter_btn').on('click', function() {
    $('#dynamic-modal').modal("show");
    let courseId = $(this).data('id');
    $.ajax({
        method: 'GET',
        url: base_url + `/admin/course-content/${courseId}/sort-chapter`,
        data: {
        },
        beforeSend: function () {
            $('.dynamic-modal-content').html(loader);
        },
        success: function (data) {
            $('.dynamic-modal-content').html(data);
        },
        error: function (xhr, status, error) {
            notyf.error(error);
        }
    })
});

    // change course approval status
$(document).on('change', '.update-approval-status', function() {
        let id = $(this).data('id');
        let status = $(this).val();

        updateApproveStatus(id, status);
    })

function updateApproveStatus(id, status) {
    $.ajax({
        method: 'PUT',
        url: base_url + `/admin/courses/${id}/update-approval`,
        data: {
            _token: csrf_token,
            status: status
        },
        success: function(data) {
            window.location.reload()
        },
        error: function(xhr, status, error) {

        }
    })
}

// modal edit course language

// document.addEventListener('DOMContentLoaded', function () {
//     const modal = document.getElementById('edit-language-modal');

//     modal.addEventListener('show.bs.modal', function (event) {
//         const button = event.relatedTarget;

//         const id = button.getAttribute('data-id');
//         const name = button.getAttribute('data-name');
//         const action = button.getAttribute('data-action');

//         // Set action URL and input values
//         const form = modal.querySelector('form');
//         form.action = action;

//         modal.querySelector('#edit-language-id').value = id;
//         modal.querySelector('#edit-language-name').value = name;
//     });
// });

$('.edit_category').on('click', function() {
    $("#dynamic-modal").modal("show");

    let categoryId = $(this).data('category-id');
    $.ajax({
        method: 'GET',
        url: base_url + '/admin/course-content/edit-category',
        data: {
            'category_id': categoryId
        },
        beforeSend: function () {
            $('.dynamic-modal-content').html(loader);
        },
        success: function (data) {
            $('.dynamic-modal-content').html(data);
        },
        error: function (xhr, status, error) {
            let errors = xhr.responseJSON.errors;
            $.each(errors, function (key, value) {
                notyf.error(value[0]);
            });
        },
    });
});

