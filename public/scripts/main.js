
var Page = {

    init: function() {

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

    addBundle: function() {

        var nameInput = $('#add_bundle_input');

        $.ajax({
            type: 'GET',
            dataType: 'json',
            data: {'name': nameInput.val()},
            url: "/bundles/create",

        }).success(function(result) {

            $('#add_bundle').find('.alert').hide();
                        
            if(result.status == 'ok') {

                $('#add_bundle').find('.alert-success').html(result.message).fadeIn();
            }
            else if(result.status == 'error') {

                $('#add_bundle').find('.alert-danger').html(result.message).fadeIn();   
            }

            nameInput.val('');
        });

        return false;

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
