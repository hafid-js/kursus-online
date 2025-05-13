// variables
const base_url = $(`meta[name="base_url"]`).attr("content");
const csrf_token = $(`meta[name="csrf_token"]`).attr('content');

// notyf init
var notyf = new Notyf({
    duration: 5000,
    dismissible: true
});


function addToCart(courseId) {
    $.ajax({
        method: "POST",
        url: base_url + "/add-to-cart/" + courseId,
        data: {
            _token: csrf_token
        },
        beforeSend: function() {
            $('.add_to_cart').text('Adding...')
        },
        success: function(data) {
            notyf.success(data.message);

              $('.add_to_cart').text('Add To Cart')
        },
        error: function(xhr, status, error) {
            let errorsMessage = xhr.responseJSON.message;
           notyf.error(errorsMessage);

             $('.add_to_cart').text('Add To Cart')
        }
    })
}

$(function() {
    // add course into cart
    $('.add_to_cart').on('click', function(e) {
        e.preventDefault();
        let courseId = $(this).data('course-id');
        addToCart(courseId);
    })
})
