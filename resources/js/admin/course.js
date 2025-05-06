// const variables

// reusable functions

function updateApproveStatus(id, status) {
    alert(id, status);
}

$(function() {
    // change course approval status
    $('.update-approval-status').on('change', function() {
        let id = $(this).data('id');
        let status = $(this).val();

        updateApproveStatus(id, status);
    })
})
