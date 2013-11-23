
var Page = {

    init: function() {

        Page.initBundleListSlider();

        $('.bundle_list>a:first').click();

        $('.load-request').bind('click', function() {
            Page.loadRequest(this);
        });

        $('.button_add_request').bind('click', function() {

            Page.addRequest();
            return false;
        });

        $('.button_add_bundle').bind('click', function() {

            Page.addBundle();
            return false;
        });

        $('.button_update_bundle').bind('click', function() {

            Page.updateBundle($(this));
            return false;
        });
        
        $('.button_update_request').bind('click', function() {

            Page.updateRequest($(this));
            return false;
        });

        $('.send-request').bind('click', function() {
            Page.sendRequest();
        });

        $(window).scroll(function() {
            var offset = $('.page_menu').offset();

            if($(this).scrollTop() > 10) {
                $('.page_menu').css('top', $(this).scrollTop());
                $('.page_menu').fadeIn();
            }
            else
                $('.page_menu').hide();
        });

    },

    initBundleListSlider: function() {

        $('.bundle_list>div>a').bind('click', function() {
            $('.list-group-subitems').slideUp();
            $(this).parent().next('div').slideDown();
        });
    },

    addBundle: function() {

        var add_bundle_name = $('#add_bundle_input');

        $.ajax({
            type: 'GET',
            dataType: 'json',
            data: {'name': add_bundle_name.val()},
            url: "/bundles/create",

        }).success(function(result) {

            $('#add_bundle').find('.alert').hide();
                        
            if(result.status == 'ok') {

                $('#add_bundle').find('.alert-success').html(result.message).fadeIn();
            }
            else if(result.status == 'error') {

                $('#add_bundle').find('.alert-danger').html(result.message).fadeIn();   
            }

            add_bundle_name.val('');
        });

        return false;

    },

    updateBundle: function(obj) {
        
        var param_name = $(obj).data('input');
        var id = $(obj).data('id');

        var bundle_name = $('#'+param_name).val();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {'name': bundle_name},
            url: "/bundles/"+id+"/update",

        }).success(function(result) {

            $('#'+param_name).parent('.row').parent().find('.alert').hide();
                        
            if(result.status == 'ok') {

                $('#'+param_name).parent('.row').parent().find('.alert-success').html(result.message).fadeIn();
            }
            else if(result.status == 'error') {

                $('#'+param_name).parent('.row').parent().find('.alert-danger').html(result.message).fadeIn();   
            }
        });

        return false;

    },

    updateRequest: function(obj) {

        var id = $(obj).data('id');

        var container_name = "edit_request_"+id;

        var container = $('#'+container_name);

        var name            = $(container).find('#update_request_name');
        var method          = $(container).find('#update_request_method');
        var url             = $(container).find('#update_request_url');
        var content_type    = $(container).find('#update_request_content_type');
        var content         = $(container).find('#update_request_content');
        var bundle          = $(container).find('#update_request_bundle');


        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {

                'name':             name.val(),
                'method':           method.children(':selected').val(),
                'url':              url.val(),
                'content_type':     content_type.children(':selected').val(),
                'content':          content.val(),
                'bundle':           bundle.children(':selected').val()

            },

            url: "/requests/"+id+"/update",

        }).success(function(result) {

            $(container).find('.alert').hide();
                        
            if(result.status == 'ok') {

                $(container).find('.alert-success').html(result.message).fadeIn();
            }
            else if(result.status == 'error') {

                $(container).find('.alert-danger').html(result.message).fadeIn();   
            }
        });
    },

    addRequest: function() {

        var name            = $('#add_request_name');
        var method          = $('#add_request_method');
        var url             = $('#add_request_url');
        var content_type    = $('#add_request_content_type');
        var content         = $('#add_request_content');
        var bundle          = $('#add_request_bundle');

        $.ajax({
            type: 'GET',
            dataType: 'json',
            data: {

                'name':             name.val(),
                'method':           method.val(),
                'url':              url.val(),
                'content_type':     content_type.val(),
                'content':          content.val(),
                'bundle':           bundle.val()

            },
            url: "/requests/create",

        }).success(function(result) {

            $('#add_request').find('.alert').hide();
                        
            if(result.status == 'ok') {

                $('#add_request').find('.alert-success').html(result.message).fadeIn();
            }
            else if(result.status == 'error') {

                $('#add_request').find('.alert-danger').html(result.message).fadeIn();   
            }

            nameInput.val('');
        });

        return false;

    },

    loadRequest: function(obj) {

        var id = $(obj).data('id');

        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: "/requests/"+id,

        }).success(function(result) {

            if(result.status == 'ok') {

                $('#request_content>h3:first').text(result.request.name);                
                $('#request_method option[value="'+result.request.method+'"]').attr("selected", "selected");
                $('#request_url').val(result.request.url);
                $('#request_text').val(result.request.content);
                $('.save-request').attr('data-id', id);
            }
            else {


            }
        });
    },

    sendRequest: function() {
        $('#request_response').html("<img src='/images/ajax-loader.gif' />");
        var url = $('#request_url').val();
        var method = $('#request_method option:selected').val();
        var request = $('#request_text').val();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {'url': url, 'method': method, 'request': request},
            url: "/requests/make-request",

        }).success(function(result) {

            $('#request_response').html(result.response);
        });
    },
};

function ContactForm()
{
    this.init = function()
    {
        var form = this;

        $('.send_message').bind('click', function() { form.sendMessage(); return false; });
    }

    this.sendMessage = function() {

        var firstname = $('#form_firstname');
        var lastname = $('#form_lastname');
        var subject = $('#form_subject');
        var contact = $('#form_contact');
        var text = $('#form_text');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {'firstname': firstname.val(), 'lastname': lastname.val(), 
                    'subject': subject.val(), 'contact': contact.val(), 'text': text.val()},
            url: "/index/contact",

        }).success(function(result) {
            $('#contact_form').find('.error').hide();

            if(result.errors) {

                $('#contact_form').find('.error').html(result.errors);
                $('#contact_form').find('.error').fadeIn();
            }
            else if(result.success) {
                $('#contact_form').find('.success').html(result.success);
                $('#contact_form').find('.success').fadeIn();

                firstname.val('');
                lastname.val('');
                subject.val('');
                contact.val('');
                text.val('');
            }
        });
    };
}

// init methods
$(window).load(function(){
    // init page
    Page.init();

    // init contact form
    var contact_form = new ContactForm();
    contact_form.init();
});
