const base_url = $('meta[name="base_url"]').attr("content");
const csrf_token = $('meta[name="csrf_token"]').attr('content');

// notyf init (kalau pakai notyf untuk notifikasi)
var notyf = new Notyf({
    duration: 5000,
    dismissible: true
});

function updateCartCount() {
    $.ajax({
        url: base_url + '/cart-count',
        method: 'GET',
        success: function(res) {
            $('.cart_count').text(res.count);
        },
        error: function() {
            console.log('Failed to fetch cart count');
        }
    });
}

function addToCart(courseId) {
    $.ajax({
        method: "POST",
        url: base_url + "/add-to-cart/" + courseId,
        data: {
            _token: csrf_token
        },
        beforeSend: function() {
            $('.add_to_cart').text('Adding...');
        },
        success: function(data) {
            notyf.success(data.message);
            $('.add_to_cart').text('Add To Cart');
            updateCartCount(); // update count setelah berhasil add
        },
        error: function(xhr) {
            let errorsMessage = xhr.responseJSON?.message || 'Something went wrong';
            notyf.error(errorsMessage);
            $('.add_to_cart').text('Add To Cart');
        }
    })
}

$(function() {
    updateCartCount(); // update count saat halaman load

    // event handler tombol add to cart
    $('.add_to_cart').on('click', function(e) {
        e.preventDefault();
        let courseId = $(this).data('course-id');
        addToCart(courseId);
    });
});
