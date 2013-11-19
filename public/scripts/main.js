
var Page = {

    init: function() {

        Page.initBundleListSlider();

        $('.bundle_list>a:first').click();

        Page.initLoadRequest();

        $('.button_add_request').bind('click', function() {

            Page.addRequest();
            return false;
        });

        $('.button_add_bundle').bind('click', function() {

            Page.addBundle();
            return false;
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

    initLoadRequest: function() {

        $('.list-group-subitems>a').bind('click', function() {
            Page.loadRequest(this);
        });
    },

    initBundleListSlider: function() {

        $('.bundle_list>a').bind('click', function() {
            $('.list-group-subitems').slideUp();
            $(this).next('div').slideDown();
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

    addRequest: function() {

        var add_request_name        = $('#add_request_name');
        var add_request_method      = $('#add_request_method');
        var add_request_link        = $('#add_request_link');
        var add_request_host        = $('#add_request_host');
        var add_request_content_type= $('#add_request_content_type');
        var add_request_content     = $('#add_request_content');
        var add_request_bundle  = $('#add_request_bundle');

        $.ajax({
            type: 'GET',
            dataType: 'json',
            data: {

                'name': add_request_name.val(),
                'method': add_request_method.val(),
                'link': add_request_link.val(),
                'host': add_request_host.val(),
                'content_type': add_request_content_type.val(),
                'content': add_request_content.val(),
                'bundle': add_request_bundle.val(),

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
                $('#request_url').val(result.request.host+result.request.link);
                $('#request_text').val(result.request.content);
            }
            else {


            }
        });

    }
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
