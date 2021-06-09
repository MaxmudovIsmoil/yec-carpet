

$(document).on("click", ".js_delete_btn", function () {

    let name = $(this).data('name')
    let url = $(this).data('url')

    let modal = $(document).find('#delete-model')
    let title = $(document).find('#delete-model-title')
    let modalForm = $(document).find('.js_modal_delete_form')

    title.text(name);
    modalForm.attr('action', url)

});
