const csrf_token = $(`meta[name="csrf_token"]`).attr('content');
const base_url = $(`meta[name="base_url"]`).attr("content");
const basic_info_url = base_url + "/instructor/courses/create";
const update_url = base_url + "/instructor/courses/update";


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
$(document).on('change', '.storage', function () {
    let value = $(this).val();
    console.log("working");

    if (value === 'upload') {
        $('.upload_source').removeClass('d-none');
        $('.external_source').addClass('d-none');

        $('input[name="file"]').prop('disabled', false).val('');
        $('input[name="url"]').prop('disabled', true).val('');
    } else {
        $('.upload_source').addClass('d-none');
        $('.external_source').removeClass('d-none');

        $('input[name="file"]').prop('disabled', true).val('');
        $('input[name="url"]').prop('disabled', false).val('');
    }
});

// Trigger sekali saat halaman load agar kondisi disabled & tampilannya sesuai nilai awal select
$(document).ready(function () {
    $('.storage').trigger('change');
});


// course contents
$(".dynamic-modal-btn").on("click", function (e) {
    e.preventDefault();
    $("#dynamic-modal").modal("show");

    let course_id = $(this).data('id');

    $.ajax({
        method: "GET",
        url: base_url + '/instructor/course-content/:id/create-chapter'.replace(':id', course_id),
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
        url: base_url + '/instructor/course-content/:id/edit-chapter'.replace(':id', chapter_id),
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
        url: base_url + '/instructor/course-content/create-lesson',
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
        url: base_url + '/instructor/course-content/edit-lesson',
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
                url: base_url + `/instructor/course-chapter/${chapterId}/sort-lesson`,
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
        url: base_url + `/instructor/course-content/${courseId}/sort-chapter`,
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
