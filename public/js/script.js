$(function () {
    $('.change-price').on('change', function () {
        const id = $(this).attr('data-id');
        const price = $(this).val();
        $.post(`/api/change-price/${id}`, {price})
            .done(response => {
                alert('Цена успешно изменена');
            })
            .catch(e => {
                console.log(e);
            })
    })
})
