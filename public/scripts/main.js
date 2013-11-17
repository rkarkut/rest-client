
function Page()
{
    this.init = function() 
    {
        $(window).scroll(function() {
            var offset = $('.page_menu').offset();

            if($(this).scrollTop() > 10) {
                $('.page_menu').css('top', $(this).scrollTop());
                $('.page_menu').fadeIn();
            }
            else
                $('.page_menu').hide();
        });

        $('.page_menu, .scroll, .menu').onePageNav({
            begin: function() {
                $('.page_menu').fadeOut('fast');
            },
            end: function() {
                if($(window).scrollTop() > 5) 
                    $('.page_menu').fadeIn('slow');
            }
        });
    };
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
    var page = new Page();
    page.init();

    // init contact form
    var contact_form = new ContactForm();
    contact_form.init();
});
