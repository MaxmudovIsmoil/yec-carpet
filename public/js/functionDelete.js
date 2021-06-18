

$(document).on("click", ".js_delete_btn", function () {

    let name = $(this).data('name')
    let url = $(this).data('url')
    let id = $(this).data('id')

    let title = $(document).find('#delete-model-title')
    let modalForm = $(document).find('#js_modal_delete_form')

    title.text(name);
    modalForm.attr('action', url)
    modalForm.find('#hidden_id').val(id)
});


let delete_form = $(document).find('#js_modal_delete_form')
delete_form.on('submit', function (e) {
    e.preventDefault()

    let url = $(this).attr('action')
    let id = $(this).find('#hidden_id').val()


    $.ajax({
        type:"POST",
        url: url,
        data: { 'id': id },
        success: (response) => {

            if (response.status == 'catalog')
            {
                let this_product = $(document).find('.js_one_product')
                this_product.each(function(index, value)
                {
                    if($(value).data('id') == response.id )
                        $(value).remove()
                })
                $(this).closest('#delete_notify').modal('hide')
            }
            else if(response.status == 'room_quality')
            {
                let this_tr = $(document).find('.js_this_tr')
                this_tr.each(function(index, value)
                {
                    if($(value).data('id') == response.id )
                        $(value).remove()
                })
                $(this).closest('#delete_notify').modal('hide')
            }
        },
        error: (response) => {
            console.log(response);
        }
    });

})
/** ================================================================================== **/
