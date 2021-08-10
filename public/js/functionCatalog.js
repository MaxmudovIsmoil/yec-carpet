$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /************************************ Catalog products ****************************************/

    /**
     * ADD PRODUCT
     *  **/
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
                if (response.status == 0) {

                    let span = $(document).find('.valid-feedback');
                    var i = 0;
                    span.each(function() {
                        $(this).addClass('d-block')
                        $(this).html(response.error[i])
                        i++

                    })
                    console.log(response)
                    $(document).find('.message').html(response.error[0]+'</span><span style="margin-left: 18%">'+response.error[1]+'</span>');

                }
                // if (response.warn){
                //     let check = $(document).find('.room_checkbox_error')
                //     check.html(response.warn);
                // }

            },
            error: (response) => {

                console.log(response);
            }
        });
    });
    /** ./add product to Catalog by modal **/


    /**
     * EDIT PRODUCT INDEX and ROOM
     *  **/
    $(document).on('submit', '.js_edit_product_modal_form_index_room', function(e) {

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

        let see_again_room_id = $(document).find('.ajax_see_again').data('sub_category_id')

        $.ajax({
            type:method,
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {

                // console.log(response)
                if (response.error) {
                    var i = 0;
                    span.each(function () {
                        $(this).addClass('d-block')
                        $(this).html(response.error[i])
                        i++
                    })
                    $(document).find('.message').html(response.error[0] + '</span><span style="margin-left: 18%">' + response.error[1] + '</span>');
                }

                /** Agar quality_id o'zgargan bo'lsa bu sifatlar ichidan olib tashlash kerak */


                if (response.warn){
                    let check = $(document).find('.js_checkbox_error_room_id')
                    check.text(response.warn);
                    check.removeClass('d-none');
                }

                this_product.each(function(index, product) {

                    if ($(product).data('id') == response.id) {
                        console.log(response)
                        let room_image = ''
                        if (response.data.room_image) {
                            room_image = response.data.room_image;
                        }
                        else {
                            room_image = 'no-image.png';
                        }
                        let room_img_src = 'http://yec.almirab.uz/public/uploaded/product/'+room_image;
                        $(product).find('.room_image').attr('href', room_img_src)
                        $(product).find('.room_image').css('background-image', "url('"+room_img_src+"')")


                        $(product).find('tbody tr').first().find('td').last().html(response.data.articul)
                        $(product).find('tbody tr').eq(1).find('td').last().html(response.data.code)
                        $(product).find('tbody tr').last().find('td').last().html(response.data.price)

                        /** Agar room_id o'zgargan bo'lsa bu Xonabi ichidan olib tashlash kerak */
                        let room_ids = response.data.room_id.split(';');

                        let room = false
                        $.each(room_ids, function( index, value ) {

                            if(parseInt(value) == parseInt(see_again_room_id)){
                                room = true
                                return false;
                            }
                        })
                        if (!room){
                            product.remove()
                        }
                    }

                })
                $(this).closest('.modal').modal('hide')

            },
            error: (response) => {
                console.log(response);
            }
        });

    });
    /** ./edit product to Catalog by modal **/

    /**
     * ADD PRODUCT2 QUALITY
     *  **/
    $('#js_modal_add_form_product2_quality').on('submit', function (e) {
        e.preventDefault();

        let url = $(this).attr('action');
        let method = $(this).attr('method');
        let formData = new FormData(this);


        $.ajax({
            type: method,
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {

                if (response.status == 1)
                    location.reload();

                $('#add-model .modal-body').css('padding-bottom','0px')
                if (response.status == 0) {
                    let span = $(document).find('.valid-feedback');
                    var i = 0;
                    span.each(function() {
                        $(this).addClass('d-block')
                        $(this).html(response.error[i])
                        i++
                    })
                    console.log(response)
                    $(document).find('.message').html(response.error[0]+'</span><span style="margin-left: 18%">'+response.error[1]+'</span>');
                }
            },
            error: (response) => {
                console.log(response);
            }
        });
    });
    /** ./add product2 quality **/


    /**
     * EDIT PRODUCT2 QUALITY
     *  **/
    $(document).on('submit', '.js_edit_product2_modal_form_quality', function(e) {

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

        let see_again_quality_id = $(document).find('.ajax_see_again').data('sub_category_id')

        console.log(see_again_quality_id)

        $.ajax({
            type:method,
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {

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

                this_product.each(function(index, product) {

                    if ($(product).data('id') == response.id) {
                        console.log(response.data)

                        let img_src = 'http://yec.almirab.uz/public/uploaded/product2/'+response.data.image;
                        $(product).find('.room_image').attr('href', img_src)
                        $(product).find('.room_image').css('background-image', "url('"+img_src+"')")

                        $(product).find('tbody tr').first().find('td').last().html(response.data.articul)
                        $(product).find('tbody tr').eq(1).find('td').last().html(response.data.code)
                        $(product).find('tbody tr').last().find('td').last().html(response.data.price)

                        console.log(typeof (response.data.quality_id))
                        console.log(typeof (see_again_quality_id))
                        /** Agar quality_id o'zgargan bo'lsa bu Sifatni ichidan olib tashlash kerak */
                        if (parseInt(response.data.quality_id) !== parseInt(see_again_quality_id)) {
                            // console.log('terng')
                            $(product).remove()
                        }
                    }
                })
                $(this).closest('.modal').modal('hide')
            },
            error: (response) => {
                console.log(response);
            }
        });

    });
    /** ./edit product to Catalog by modal **/


    /***
     * SEE AGAIN BTN INDEX , ROOM , QUALITY
     * **/
    // let see_again_btn = $(document).find('.ajax_see_again')
    // see_again_btn.on('click', function (e) {
    //     e.preventDefault();
    //
    //     let all_products = $(document).find('.js_all_products')
    //
    //     let url = $(this).attr('href');
    //     let one_product = $(document).find('.js_one_product')
    //     let product_id = one_product.last().data('id')
    //     let product_count = one_product.length
    //     let sub_category_id = $(this).data('sub_category_id')
    //
    //     let warn_model = $(document).find('#warn_model')
    //
    //     // console.log(product_count)
    //     if (product_count) {
    //         $.ajax({
    //             type: 'POST',
    //             url: url,
    //             data: {
    //                 'product_id': product_id,
    //                 'sub_category_id': sub_category_id,
    //                 'product_count': product_count
    //             },
    //             // contentType: false,
    //             // processData: false,
    //             success: (response) => {
    //
    //                 // console.log(response)
    //                 if (response.product == '') {
    //                     warn_model.modal('show')
    //                     setTimeout(function () {
    //                         warn_model.modal('hide');
    //                     }, 2000);
    //                 } else {
    //                     all_products.append(response.product)
    //                 }
    //                 // console.log(response)
    //             },
    //             error: (response) => {
    //                 console.log(response)
    //             }
    //         });
    //     }
    //     else {
    //         warn_model.modal('show')
    //         setTimeout(function () {
    //             warn_model.modal('hide');
    //         }, 2000);
    //     }
    // })
    /** ------------------------- see again btn index room quality --------------------------- **/





    /************************************ ./Catalog products ****************************************/

});

