<div class="container">
    <div class="footer-top">
        <div class="row">
            <div class="col-md-9">
                <div class="widget widget-newsletter">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="widget-title">Subscribe newsletter</h4>
                            <p>Get all the latest information on Events,Sales and Offers. Sign up for newsletter today</p>
                        </div><!-- End .col-lg-6 -->

                        <div class="col-lg-6">
                            <form action="javascript:void(0);" type="post">
                                @csrf
                                <input onfocus="enableSubscriber();" onfocusout="checkSubscriber();" name="subscriber_email" id="subscriber_email" type="email" class="form-control" placeholder="Email address" required>

                                <button onclick="checkSubscriber(); addSubscriber();" id="btnSubmit" type="submit" class="btn" value="Subscribe">Subscribe</button>
                            </form>
                            <span id="statusSubscriber" style="display: none; color:white; font-weight: bold;"></span>
                        </div><!-- End .col-lg-6 -->
                    </div><!-- End .row -->
                </div><!-- End .widget -->
            </div><!-- End .col-md-9 -->

            <div class="col-md-3 widget-social">
                <div class="social-icons">
                    <a href="#" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
                    <a href="#" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
                    <a href="#" class="social-icon" target="_blank"><i class="icon-linkedin"></i></a>
                </div><!-- End .social-icons -->
            </div><!-- End .col-md-3 -->
        </div><!-- End .row -->
    </div><!-- End .footer-top -->
</div><!-- End .container -->

<div class="footer-middle">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="widget">
                    <h4 class="widget-title">Contact Us</h4>
                    <ul class="contact-info">
                        <li>
                            <span class="contact-info-label">Address:</span>123 Street Name, City, England
                        </li>
                        <li>
                            <span class="contact-info-label">Phone:</span>Toll Free <a href="tel:">(123) 456-7890</a>
                        </li>
                        <li>
                            <span class="contact-info-label">Email:</span> <a href="mailto:mail@example.com">mail@example.com</a>
                        </li>
                    </ul>
                </div><!-- End .widget -->
            </div><!-- End .col-lg-3 -->

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-5">
                        <div class="widget">
                            <h4 class="widget-title">My Account</h4>

                            <div class="row">
                                <div class="col-sm-6 col-md-5">
                                    <ul class="links">
                                        <li><a href="about.html">About Us</a></li>
                                        <li><a href="{{ route('page.contact_us') }}">Contact Us</a></li>
                                        <li><a href="my-account.html">My Account</a></li>
                                    </ul>
                                </div><!-- End .col-sm-6 -->
                                <div class="col-sm-6 col-md-5">
                                    <ul class="links">
                                        <li><a href="#">Orders History</a></li>
                                        <li><a href="#">Advanced Search</a></li>
                                        <li><a href="#" class="login-link">Login</a></li>
                                    </ul>
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-md-5 -->

                    <div class="col-md-7">
                        <div class="widget">
                            <h4 class="widget-title">Main Features</h4>

                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="links">
                                        <li><a href="#">Super Fast Magento Theme</a></li>
                                        <li><a href="#">1st Fully working Ajax Theme</a></li>
                                        <li><a href="#">20 Unique Homepage Layouts</a></li>
                                    </ul>
                                </div><!-- End .col-sm-6 -->
                                <div class="col-sm-6">
                                    <ul class="links">
                                        <li><a href="#">Powerful Admin Panel</a></li>
                                        <li><a href="#">Mobile & Retina Optimized</a></li>
                                    </ul>
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-md-7 -->
                </div><!-- End .row -->

                <div class="footer-bottom">
                    <p class="footer-copyright">Porto eCommerce. &copy;  2018.  All Rights Reserved</p>

                    <ul class="contact-info">
                        <li>
                            <span class="contact-info-label">Working Days/Hours:</span>
                            Mon - Sun / 9:00AM - 8:00PM
                        </li>
                    </ul>
                    <img src="{{ asset('assets/frontend/assets/images/payments.png') }}" alt="payment methods" class="footer-payments">
                </div><!-- End .footer-bottom -->
            </div><!-- End .col-lg-9 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .footer-middle -->


<script>
    function checkSubscriber() {
        var subscriber_email = $("#subscriber_email").val();
        $.ajax({
           type:'post',
            url:'check-subscriber-email',
            data:{subscriber_email:subscriber_email},
            success:function (resp) {
                if (resp=="exists"){
                    //alert("You have already subscribed using this Email!");
                    $("#statusSubscriber").show();
                    $("#btnSubmit").hide();
                    $("#statusSubscriber").html("You have already subscribed using this Email!");
                }
            },error:function () {
                alert("error");
            }

        });

    }
    function addSubscriber() {
        var subscriber_email = $("#subscriber_email").val();
        $.ajax({
            type:'post',
            url:'add-subscriber-email',
            data:{subscriber_email:subscriber_email},
            success:function (resp) {
                if (resp=="exists"){
                    //alert("You have already subscribed using this Email!");
                    $("#statusSubscriber").show();
                    $("#btnSubmit").hide();
                    $("#statusSubscriber").html("You have already subscribed using this Email!");
                }else if (resp=="saved"){
                    $("#statusSubscriber").show();
                    $("#statusSubscriber").html("Thanks for Your Subscription!");
                }
            },error:function () {
                alert("error");
            }

        });

    }

    function enableSubscriber() {

        $("#btnSubmit").show();
        $("#statusSubscriber").hide();
    }
</script>