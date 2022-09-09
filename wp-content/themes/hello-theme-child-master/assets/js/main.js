(function($) {

    $(document).ready(function() {
         /**========================
         * Ajax register
         * ========================
        */
          $(document).on('submit', '#devRegis-form',function(e){
            console.log("object");
            var ajax_url = $("input[name='url_ajax']").val();
            e.preventDefault();
            last_name = $('input[name="last_name"]').val();
            first_name = $('input[name="first_name"]').val();
            email = $('input[name="email"]').val();
            username = $('input[name="username"]').val();
            pass = $('input[name="pwd1"]').val();
            confirm_pass = $('input[name="pwd2"]').val();
            var kol_user_select = $("#kol_role option:selected").val();
           
            // get percent for coupon
            var percentCoupon = $("input[name='percent_coupon']").val();
            percentCoupon = JSON.parse(percentCoupon);
            percent = parseInt(percentCoupon[kol_user_select])
            $.ajax({
                type: "post",
                dataType: "json",
                async: true,
                url: ajax_url,
                data: {
                    action:'regisForm',
                    last_name: last_name,
                    first_name: first_name,
                    email : email,
                    username: username,
                    pass: pass,
                    confirm_pass: confirm_pass,
                    kol_user_select:kol_user_select,
                    securityregis: $('form#devRegis-form #securityregis').val(),
                    percent : percent
                },
                beforeSend: function () {
                },
                success: function (response) {
                    console.log(response);
                    if( response.success == false ){
                        $('.devRegis-alert').html(`* ${response.data.showdata}`);
                    } else if(response.success == true ){
                        var base_url = window.location.origin;
                        window.location.href = base_url + '/tai-khoan';
                        // console.log(object);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //Làm gì đó khi có lỗi xảy ra
                    console.log('The following error occured: ' + textStatus, errorThrown);
                }
            });
            
        })
         /* ********************************
            Show hide register password
        *********************************/ 
        const password = $("#pwd1");
        function showpass(pass){
            if(pass.prop('type') == 'password'){
                $(pass).parent().find('.show-password-icon').html(`<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" id="Hide" d="m79.891 65.078 7.27-7.27c.529 1.979.839 4.048.839 6.192 0 13.234-10.766 24-24 24-2.144 0-4.213-.31-6.192-.839l7.27-7.27c7.949-.542 14.271-6.864 14.813-14.813zm47.605-3.021c-.492-.885-7.47-13.112-21.11-23.474l-5.821 5.821c9.946 7.313 16.248 15.842 18.729 19.602-4.741 7.219-23.339 31.994-55.294 31.994-4.792 0-9.248-.613-13.441-1.591l-6.573 6.573c6.043 1.853 12.685 3.018 20.014 3.018 41.873 0 62.633-36.504 63.496-38.057.672-1.209.672-2.677 0-3.886zm-16.668-39.229-88 88c-.781.781-1.805 1.172-2.828 1.172s-2.047-.391-2.828-1.172c-1.563-1.563-1.563-4.094 0-5.656l11.196-11.196c-18.1-10.927-27.297-27.012-27.864-28.033-.672-1.209-.672-2.678 0-3.887.863-1.552 21.623-38.056 63.496-38.056 10.827 0 20.205 2.47 28.222 6.122l12.95-12.95c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656zm-76.495 65.183 10.127-10.127c-2.797-3.924-4.46-8.709-4.46-13.884 0-13.234 10.766-24 24-24 5.175 0 9.96 1.663 13.884 4.459l8.189-8.189c-6.47-2.591-13.822-4.27-22.073-4.27-31.955 0-50.553 24.775-55.293 31.994 3.01 4.562 11.662 16.11 25.626 24.017zm15.934-15.935 21.809-21.809c-2.379-1.405-5.118-2.267-8.076-2.267-8.822 0-16 7.178-16 16 0 2.958.862 5.697 2.267 8.076z" fill="#000000" data-original="#000000"></path></g></svg>`);
                pass.attr('type','text')
            }
            else {
                $(pass).parent().find('.show-password-icon').html(`<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class="hovered-paths"><g><path xmlns="http://www.w3.org/2000/svg" id="Show" d="m64 104c-41.873 0-62.633-36.504-63.496-38.057-.672-1.209-.672-2.678 0-3.887.863-1.552 21.623-38.056 63.496-38.056s62.633 36.504 63.496 38.057c.672 1.209.672 2.678 0 3.887-.863 1.552-21.623 38.056-63.496 38.056zm-55.293-40.006c4.758 7.211 23.439 32.006 55.293 32.006 31.955 0 50.553-24.775 55.293-31.994-4.758-7.211-23.439-32.006-55.293-32.006-31.955 0-50.553 24.775-55.293 31.994zm55.293 24.006c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" fill="#000000" data-original="#000000" class="hovered-path"></path></g></svg>
                `);
                pass.attr('type','password');
            }
        }
        $("#show-password-icon").click(function(){
            showpass(password);
        })
        const password2 = $("#pwd2");
        $("#show-password-icon2").click(function(){
            showpass(password2);
        })
        $("#show-password-icon3").click(function(){
            showpass($('#login_pass'));
        })

        $(document).on('submit', '#formChangeProfile',function(e){
            console.log("kol_select");
            var ajax_url = $("input[name='url_ajax']").val();
            e.preventDefault();
            var kol_select = $("#kol_select option:selected").val();
            console.log(kol_select);
            $.ajax({
                type: "post",
                dataType: "json",
                async: true,
                url: ajax_url,
                data: {
                    action:'kol_select',
                    kol_select: kol_select,
                },
                beforeSend: function () {
                },
                success: function (response) {
                    console.log(response);
                    // if( response.success == false ){
                    //     $('.devRegis-alert').html(`* ${response.data.showdata}`);
                    // } else if(response.success == true ){
                    //     var base_url = window.location.origin;
                    //     window.location.href = base_url + '/tai-khoan';
                    //     // console.log(object);
                    // }
                    if( response.success == true ){
                        $('.kol_alert').show();
                        $('.kol_alert').addClass(response.data.class);
                        $('.kol_alert').html(response.data.showdata);
                    }
                    setTimeout(() => {
                        $('.kol_alert').removeClass(response.data.class);
                        $('.kol_alert').hide();
                    }, 2000);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //Làm gì đó khi có lỗi xảy ra
                    console.log('The following error occured: ' + textStatus, errorThrown);
                }
            });
          
        })
        // function imageIsLoaded(e) {
        //     $('#avtChange').attr('src', e.target.result);
        //     $('.box-photo .icon-text').css('display', 'none');
        // }
        // $(document).on('change','#FileAttachment',function () {
        //     if (this.files && this.files[0]) {
        //         var reader = new FileReader();
        //         reader.onload = imageIsLoaded;
        //         reader.readAsDataURL(this.files[0]);
        //     }
        //     var ajax_url = $("input[name='url_ajax']").val();
        //     const fileImg = this.files[0];
        //     console.log(fileImg);
        //     // const formData = new FormData();
		// 	// formData.append( 'misha_file', fileImg );
        //     // console.log(formData);
        //     $.ajax({
        //         type: "post",
        //         dataType: "html",
        //         async: true,
        //         url: ajax_url,
        //         data: {
        //             action:'avatar_custom',
        //             misha_file: fileImg,
        //         },
        //         beforeSend: function () {
        //         },
        //         success: function (response) {
        //             console.log(response);
        //         },
        //         error: function (jqXHR, textStatus, errorThrown) {
        //             //Làm gì đó khi có lỗi xảy ra
        //             console.log('The following error occured: ' + textStatus, errorThrown);
        //         }
        //     });
          
        // });
       
        $('#admin_kol_select').on('change',function () {
            // console.log("on change");
            var ajax_url = $("input[name='url_ajax']").val();
            var choose_kol = $("#admin_kol_select option:selected").val();
            console.log(choose_kol);
            $.ajax({
                type: "post",
                dataType: "json",
                async: true,
                url: ajax_url,
                data: {
                    action:'admin_kol_dashboard',
                    choose_kol:choose_kol,
                },
                beforeSend: function () {
                    // $('.tailor-loading').show();
                },
                success: function (response) {
                   console.log(response);
                   $('.kol-tab-content').html(response.data);
                //    $('.show').html(`${response.data}`);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //Làm gì đó khi có lỗi xảy ra
                    console.log('The following error occured: ' + textStatus, errorThrown);
                }
            });
        });

        //Phần tab chính sách phát đại lí, cá nhân
        // function activeTab(obj) {
        //     $(".kol-tab .common-tab").removeClass("active-tab");
        //     let id = $(obj).data("tab");
        //     $(obj).addClass("active-tab");
        //     $(".kol-tab-content").hide();
        //     // console.log(id);
        //     $('.'+id).show();
        // }
        // $('.kol-tab .common-tab').click(function (e) {
        //     // console.log(e.target)
        //     e.preventDefault();
        //     activeTab(this);

        // })
        // activeTab('.kol-tab .common-tab:first-child');


        
    })
    
})(jQuery);