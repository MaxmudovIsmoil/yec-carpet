$(document).ready(function() {

    $('#dataTable_staff').DataTable({
        paging: false,
        pageLength: 100,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: false,
        autoWidth: false,
        language: {
            search: "",
            searchPlaceholder: " Izlash...",
            // sLengthMenu: "Кўриш _MENU_ тадан",
            sInfo: "Ko'rish _START_ dan _END_ gacha _TOTAL_ jami",
            emptyTable: "Ma'lumot mavjud emas",
        }
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /************************************ Catalog products ****************************************/
    /** add product to Catalog by modal **/
    $('#js_modal_add_form_product').on('submit', function (e) {
        e.preventDefault();

        let url = $(this).attr('action');
        let method = $(this).attr('method');
        let formData = new FormData(this);

        $.ajax({
            type:method,
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {

                if (response.status == 1)
                    location.reload();

                $('#add-model .modal-body').css('padding-bottom','0px')

                let span = $(document).find('.valid-feedback');

                var i = 0;
                span.each(function() {
                    $(this).addClass('d-block')
                    $(this).html(response.message[i])
                    i++
                })

                $(document).find('.message').html(response.message[0]+'</span><span style="margin-left: 18%">'+response.message[1]+'</span>');

            },
            error: (response) => {
                console.log(response.message);
            }
        });
    });
    /** ./add product to Catalog by modal **/


    /** Edit product to Catalog by modal **/
    $('.js_edit_product_modal_form').on('submit', function(e) {
        e.preventDefault();

        let url = $(this).attr('action');
        let method = $(this).attr('method');
        let formData = new FormData(this);
        $.ajax({
            type:method,
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {

                if (response.status == 1)
                    location.reload();

                $('#add-model .modal-body').css('padding-bottom','0px')

                let span = $(document).find('.valid-feedback');

                var i = 0;
                span.each(function() {
                    $(this).addClass('d-block')
                    $(this).html(response.message[i])
                    i++
                })

                $(document).find('.message').html(response.message[0]+'</span><span style="margin-left: 18%">'+response.message[1]+'</span>');

            },
            error: (response) => {
                console.log(response.message);
            }
        });
        console.log(1111)
    });
    /** ./edit product to Catalog by modal **/


    /************************************ ./Catalog products ****************************************/


    /************************************ Room & Quality ****************************************/

    /** Room & quality add modal **/
    $('#js_modal_add_form').on('submit', function (e) {
        e.preventDefault();

        let url = $(this).attr('action');
        let method = $(this).attr('method');
        let formData = new FormData(this);

        $.ajax({
            type:method,
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {

                // if (response.status == 1)
                //     location.reload();

                console.log(response)
                $('#add-model .modal-body').css('padding-bottom','0px')
                $(document).find('#message').html('<span >'+response.message[0]+'</span><span style="margin-left: 18%">'+response.message[1]+'</span>');

            },
            error: (response) => {
                console.log(response);
            }
        });
    });
    /** ./Room & quality add modal **/


    /** Rooms & quality edit btn show form in dataTable **/
    $('.js_edit_btn').click(function(e){
        e.preventDefault();

        let this_tr = $(this).closest('.js_this_tr');

        let edit_btn_back = this_tr.find('.js_edit_btn_back');

        this_tr.find('.js_room_name').addClass('d-none');
        this_tr.find('.js_td_image a').addClass('d-none');
        this_tr.find('.js_td_image').css('height', '70px');

        let edit_form = this_tr.find('.js_edit_from');


        if (edit_form.hasClass('d-none')) {
            edit_form.removeClass('d-none');
            edit_form.addClass('d-flex');
        }

        if (edit_btn_back.hasClass('d-none')) {

            edit_btn_back.removeClass('d-none');
        }
        $(this).addClass('d-none');

    });
    /** ./Rooms & quality edit btn in dataTable **/


    /** Rooms & quality edit btn save in dataTable **/
    $('.js_edit_from').on('submit', function (e) {
        e.preventDefault();

        let url = $(this).attr('action');
        let method = $(this).attr('method');
        let formData = new FormData(this);

        $.ajax({
                url: url,
                type: method,
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    console.log(response)
                    location.reload();
                },
                error: (response) => {
                    console.log(response)
                }
            });
    })
    /** ./Rooms & quality edit btn save in dataTable **/


    /** Rooms & quality edit btn back hide form in dataTable **/
    $('.js_edit_btn_back').click(function (e) {
        e.preventDefault();

        let this_tr = $(this).closest('.js_this_tr');

        let edit_from = this_tr.find('.js_edit_from');

        if (edit_from.hasClass('d-flex')) {
            edit_from.removeClass('d-flex');
            edit_from.addClass('d-none');
        }

        this_tr.find('.js_td_image a').removeClass('d-none');
        let last_img = this_tr.find('.js_image_div label').data('img');
        this_tr.find('.js_image_div label').html(last_img);
        this_tr.find('.js_room_name').removeClass('d-none');

        this_tr.find('.js_edit_btn').removeClass('d-none');

        $(this).addClass('d-none');
    });
    /** ./Rooms & quality edit btn back hide form in dataTable **/

    /************************************ ./ Room & Quality ****************************************/


    /** Hodim qoshish, Modal add user **/
    $(document).on('submit', '.js_user_add_modal_form', function (e) {
        e.preventDefault();

        let url = $(this).attr('action');

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: "json",
            contentType: false,
            beforeSend: function(){
                $(document).find('span.text-danger').text('');
            },
            success: function(data) {

                if(data.status == 0){
                    $.each(data.error,function (prefix, val) {
                        $('span.'+prefix+'_error').text(val[0])
                        console.log(prefix+": "+val[0]);
                    })
                }
                else{
                    $('.js_user_ddd_modal_form')[0].reset();
                    console.log(data.msg);
                }

            },
            error: function (data) {
                // var er = data.responseJSON;
                console.log(data)
            }
        });
    });


    // $(document).find("#room_id").select2();
    //
    // $(document).find("#quality_id").select2();

});
