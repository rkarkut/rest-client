<!DOCTYPE html>
<html>
<head>
  <title>Portfolio</title>

   {{ HTML::style('css/main.css')}}
   {{ HTML::style('css/ajax_gallery.css')}}

   {{ HTML::script('scripts/jquery.min.js')}}
   {{ HTML::script('scripts/jquery.nav.js')}}
   {{ HTML::script('scripts/jquery.scrollTo.js')}}

   {{ HTML::script('scripts/main.js')}}
   {{ HTML::script('scripts/ajax_gallery.js')}}
</head>
<body>
@yield('content')
    <section id="home_content" data-speed="10" data-type="background">
        <div class="home">
            <div class="header"><p>With <span>us you</span> will <span>get</span> new <span>customers!</span></p></div>
            <ul class="menu">
                <li><a href="#home_content"><div class="button">
                    <div class="icon"><img src="/images/ico_home.png" /></div><p>Home</p>
                </div></a></li>
                <li><a href="#offer_content"><div class="button">
                    <div class="icon"><img src="/images/ico_offer.png" /></div><p>Offer</p>
                </div></a></li>
                <li><div class="computer"></div></li>
                <li><a href="#projects_content"><div class="button">
                    <div class="icon"><img src="/images/ico_folio.png" /></div><p>Portfolio</p>
                </div></a></li>
                <li><a href="#contact_content"><div class="button">
                    <div class="icon"><img src="/images/ico_phone.png" /></div><p>Contact</p>
                </div></a></li>
            </ul>
            <div class="langs">
                <div class="lang">
                    <div class="flag"><img src="/images/flag_pl.png" /></div><div class="name"><a href="">Polish</a></div>
                </div><div class="lang">
                    <div class="flag"><img src="/images/flag_gb.png" /></div><div class="name"><a href="">English</a></div>
                </div>
            </div>
            <div class="scroll"><a href="#offer_content"></a></div>
        </div>
    </div>
    <div class="page_menu">
        <div class="menu_content">
            <ul>
                <li><a class="home ascensorLink ascensorLink0" href="#home_content">Home</a></li>
                <li><a class="offer ascensorLink ascensorLink1" href="#offer_content">Offer</a></li>
                <li><a class="folio ascensorLink ascensorLink2" href="#projects_content">Portfolio</a></li>
                <li><a class="contact ascensorLink ascensorLink3" href="#contact_content">Contact</a></li>
            </ul>
        </div>
    </div>
    <div id="offer_content">
        <div class="offer">
            <div class="header"><p>our <span>offer</span> specialy <span>for you!</span></p></div>
            <div class="offers">
                <div class="head"><p>What can we do for you?</p></div>
                <ul>
                    <li><img src="/images/li.png" /><p>Website for smaller and larger companies</p></li>
                    <li><img src="/images/li.png" /><p>Graphic design of websites, business cards, flyers, log and logotypes</p></li>
                    <li><img src="/images/li.png" /><p>Programming and Web coding</p></li>
                    <li><img src="/images/li.png" /><p>SEO</p></li>
                    <li><img src="/images/li.png" /><p>Installing website on the server</p></li>
                </ul>
            </div>
        </div>
    </div>

    @include('partials/gallery')

    <div id="contact_content">
        <div class="contact">
            <div class="head"><p><span>Contact</span> with <span>US</span></p></div>
            <div class="left">
                <div class="faces">
                    <img src="" />
                </div>
                <div class="phones">
                    <div class="contact_phone"><div class="img"><img src="/images/contact_phone.png" /></div><span>+48 510 890 183 (grafik)</span></div>
                    <div class="contact_phone"><div class="img"><img src="/images/contact_phone.png" /></div><span>+48 508 409 876 (programista)</span></div>
                    <div class="contact_mail"><div class="img"><img src="/images/contact_mail.png" /></div><span>kontakt@estrony.eu</span></div>
                </div>
            </div><div class="right">
                <form id="contact_form" accept-charset="UTF-8" action="/index/contact" method="post">
                    <div style="width: 100%; height: 30px; margin-top: -30px">
                        <div class="success"></div>
                        <div class="error"></div>
                    </div>
                    <div class="input">
                        <input type="text" id="form_firstname" name="name" placeholder="Firstname" />
                    </div>
                    <div class="input">
                        <input type="text" id="form_lastname" name="name" placeholder="Lastname" />
                    </div>
                    <div class="input">
                        <input type="text" id="form_subject" name="name" placeholder="Subject" />
                    </div>
                    <div class="input">
                        <input type="text" id="form_contact" name="phone_or_email" placeholder="Phone number or e-mail address" />
                    </div>
                    <div class="textarea">
                        <textarea id="form_text" placeholder="Your message"></textarea>
                    </div>
                    <div class="button"><input class="send_message" type="button" value="Send message" /></div>
                </form>
            </div>
        </div>
    </div>
    <div id="response">
        <div class="response"><div class="head"><p><span>We are <span>responding</span> with <span>24 hours</span></p></div></div>
    </div>
</body>
</html>
