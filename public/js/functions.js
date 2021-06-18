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

        console.log(1111)

        $.ajax({
            type:method,
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {

                if (response.status == 1)
                    location.reload();

                // $('#add-model .modal-body').css('padding-bottom','0px')
                if (response.status == 0) {

                    let span = $(document).find('.valid-feedback');
                    var i = 0;
                    span.each(function() {
                        $(this).addClass('d-block')
                        $(this).html(response.message[i])
                        i++
                    })
                    $(document).find('.message').html(response.message[0]+'</span><span style="margin-left: 18%">'+response.message[1]+'</span>');

                }
                if (response.warn){
                    let check = $(document).find('.js_checkbox_error_room_id')
                    check.text(response.warn);
                    check.removeClass('d-none');
                }

            },
            error: (response) => {
                console.log(response);
            }
        });
    });
    /** ./add product to Catalog by modal **/


    /** Edit product to Catalog by modal **/
    let edit_product_modal_form = $(document).find('.js_edit_product_modal_form')
    edit_product_modal_form.on('submit', function(e) {
        e.preventDefault();

        let this_product = $(document).find('.js_one_product')

        let url = $(this).attr('action');
        let method = $(this).attr('method');
        let formData = new FormData(this);

        let inputs = $(this).find('input');
        inputs.each(function () {

            let val = $(this).val()
            if (!val)
                $(this).css('border', '1px solid red')
        })
        inputs.focusout(function () {
            let val = $(this).val();
            if (val)
                $(this).css('border', '1px solid #0c900c')
            else
                $(this).css('border', '1px solid red')
        })
        let selects = $(this).find('select');

        selects.each(function () {
            let val = $(this).val()
            if (!val)
                $(this).css('border', '1px solid red')
        })
        selects.focusout(function () {
            let val = $(this).val();
            if (val)
                $(this).css('border', '1px solid #0c900c')
            else
                $(this).css('border', '1px solid red')
        })

        let input_checkbox = $(this).find('input[type="checkbox"]');


        $.ajax({
            type:method,
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {

                // if (response.success)
                //     location.reload();
                console.log(response)

                if (response.error) {
                    var i = 0;
                    span.each(function () {
                        $(this).addClass('d-block')
                        $(this).html(response.error[i])
                        i++
                    })
                    $(document).find('.message').html(response.error[0] + '</span><span style="margin-left: 18%">' + response.error[1] + '</span>');
                }

                if (response.warn){
                    let check = $(document).find('.js_checkbox_error_room_id')
                    check.text(response.warn);
                    check.removeClass('d-none');
                }

                this_product.each(function(index, val) {
                    if ($(val).data('id') == response.id) {
                        $(val).find('')
                        console.log('teng ura')
                    }
                })

            },
            error: (response) => {
                console.log(response);
            }
        });

    });
    /** ./edit product to Catalog by modal **/


    /** ------------------------- see again btn --------------------------- **/
    let see_again_btn = $(document).find('.js_see_again_btn')
    see_again_btn.on('click', function (e) {
        e.preventDefault();

        let all_products = $(document).find('.js_all_products')

        let url = $(this).attr('href');
        let one_product = $(document).find('.js_one_product')
        let product_id = one_product.last().data('id')
        let product_count = one_product.length
        let segment = $(this).data('segment')
        let sub_category_id = $(this).data('sub_category_id')

        let warn_model = $(document).find('#warn_model')
        console.log(product_count)
        console.log(product_id)
        if (product_count) {
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    'product_id': product_id,
                    'segment': segment,
                    'sub_category_id': sub_category_id,
                    'product_count': product_count
                },
                // contentType: false,
                // processData: false,
                success: (response) => {
                    if (response.product == '') {
                        warn_model.modal('show')
                        setTimeout(function () {
                            warn_model.modal('hide');
                        }, 2000);
                    } else {
                        all_products.append(response.product)
                    }
                    console.log(response)
                },
                error: (response) => {
                    console.log(response)
                }
            });
        }
        else {
            warn_model.modal('show')
            setTimeout(function () {
                warn_model.modal('hide');
            }, 2000);
        }
    })
    /** ------------------------- see again btn --------------------------- **/


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

                if (response.status == 1) location.reload()

                if (response.status == 0) {
                    $('#add-model .modal-body').css('padding-bottom','0px')
                    $(document).find('#message').html('<span >'+response.message[0]+'</span><span style="margin-left: 18%">'+response.message[1]+'</span>');
                }
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

        let edit_form = this_tr.find('.js_edit_from');

        if (edit_form.hasClass('d-flex')) {
            edit_form.removeClass('d-flex');
            edit_form.addClass('d-none');
        }

        this_tr.find('.js_td_image a').removeClass('d-none');
        let last_img = this_tr.find('.js_image_div label').data('img');
        this_tr.find('.js_image_div label').html(last_img);
        this_tr.find('.js_room_name').removeClass('d-none');

        this_tr.find('.js_edit_btn').removeClass('d-none');

        $(this).addClass('d-none');

        let name = this_tr.find('.js_room_name');
        edit_form.find('input[name="name"]').val(name.text())
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



    /**=================================== Muddatli to'lov =======================================**/

    $(document).on('click', '.js_term_edit_btn', function(e) {
        e.preventDefault()

        let this_tr = $(this).closest('.term_tr')

        let form = this_tr.find('.js_term_edit_from')
        let percent = this_tr.find('.js_term_payment_percent')
        let back = this_tr.find('.js_term_edit_btn_back')


        percent.addClass('d-none')
        form.addClass('d-flex')
        $(this).addClass('d-none')
        back.addClass('d-block')
    })

    $(document).on('click', '.js_term_edit_btn_back', function(e) {
        e.preventDefault()
        let this_tr = $(this).closest('.term_tr')

        let form = this_tr.find('.js_term_edit_from')
        let percent = this_tr.find('.js_term_payment_percent')
        let edit_btn = this_tr.find('.js_term_edit_btn')

        percent.removeClass('d-none')
        form.removeClass('d-flex')
        edit_btn.removeClass('d-none')
        $(this).removeClass('d-block')

        form.find('input[type="text"]').val(percent.text())
    });

    $(document).on('submit', '.js_term_edit_from', function(e) {
        e.preventDefault()

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: "json",
            contentType: false,
            success: function(data) {
                if (data.message)
                    location.reload()
            },
            error: function (data) {
                console.log(data)
            }
        });

    })



    /**---------------------------------- due_dated active update -----------------------------------**/
    let active = $(document).find('.js_term_check_td').data('active')
    let n = active

    $(document).on('click', '.js_term_check_td span', function() {
        let id = $(this).closest('.js_term_check_td').data('id')

        let ok = '<svg class="c-icon c-icon-xl term_payment_check_ok js_term_check_icon">' +
                    '<use xlink:href="http://yec.almirab.uz/public/icons/sprites/free.svg#cil-check-alt"></use>' +
                '</svg>'

        let no = '<svg class="c-icon c-icon-xl term_payment_check_no js_term_check_icon">' +
                    '<use xlink:href="http://yec.almirab.uz/public/icons/sprites/free.svg#cil-x"></use>' +
                '</svg>'

        if (n){
            $(this).html(no)
            n = 0
        }
        else {
            $(this).html(ok)
            n = 1
        }

        let data = {
            'id' : id,
            'active' : n
        }

        $.ajax({
            url: 'http://yec.almirab.uz/termPayment/term_payment_active',
            type: 'GET',
            data: data,
            dataType: "json",
            success: function(data) {
                console.log(data)
            },
            error: function (data) {
                console.log(data)
            }
        });

    });

    /**=================================== Muddatli to'lov =======================================**/



});

