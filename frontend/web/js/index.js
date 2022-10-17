function set_status(id) {
    $.ajax({
        url: '/comments/status',
        type: 'POST',
        data: {
            id: id
        },
        success: function (res) {
            if (res) {
                let result = JSON.parse(res);
                let id = result.id;
                if (result.status) {
                    $('.comment-id-' + id + ' .comment-status').text('Опубликован');
                    $('.comment-id-' + id + ' .comment-status-ico').html('<i class="fa-solid fa-square-check"></i>');
                } else {
                    $('.comment-id-' + id + ' .comment-status').text('Не опубликован');
                    $('.comment-id-' + id + ' .comment-status-ico').html('<i class="fa-regular fa-square-check"></i>');
                }
                $('.comment-id-' + id + ' .comment-updated').text(result.updated_at);
            }
        },
        error: function () {
            alert('Error!');
        }
    });
}

function delete_item(id) {
    $.ajax({
        url: '/comments/delete',
        type: 'POST',
        data: {
            id: id
        },
        success: function (res) {
            if (res) {
                let id = JSON.parse(res).id;
                $('.comment-' + id).html('<td colspan="6" class="text-center">А всё, а нету больше</td>');
            } else {
                alert('Видимо, не сегодня...');
            }
        },
        error: function () {
            alert('Error!');
        }
    });
}