<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Contact us</title>
        <?php
        // css
        echo link_tag('assets/css/menu.css');
        echo link_tag('assets/css/footer.css');
        echo link_tag('assets/css/finalproducts.css');
        echo link_tag('assets/css/socialsidebar.css');
        echo link_tag('assets/css/checkbox.css');
        echo link_tag('assets/css/jquery.mCustomScrollbar.css');

        //js
        ?>

        <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js' type='text/javascript'></script>
        <script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
        <script src="./js/validate.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).ready(function(){

                $("#footer_switcher_wrapper").click( function(){
                                    
                    $('#footer').toggleClass( "f_active" );
                    $('.footer_l').toggleClass("active");
                    $('#footer').toggleClass( "f_inactive" );
                    $('.footer_l').toggleClass("inactive");
    
                    $('#footer .text_wrapper_middle_part').toggleClass("active");
                    $('#footer .text_wrapper_middle_part').toggleClass("inactive");
    
                    $('#footer_switcher').toggleClass("active");
                    $('#footer_switcher').toggleClass("inactive");
                });
                
                //                                <div class="product_detail_line">
                //                                    <span class="text_light upper_cased">count:</span>
                //                                    <span class="value_wrapper"><span class="text_light upper_cased bold">1</span></span>
                //                                    <span class="add_one_item_wrapper"><span class="text_light upper_cased">+</span></span>
                //                                    <span class="text_light upper_cased">/</span>
                //                                    <span class="subtract_one_item_wrapper"><span class="text_light upper_cased">-</span></span>
                //                                </div>
                
                
                $(".add_one_item_wrapper").click( function(){
                    
                    var updatedSpanObject = $(this).closest(".product_detail_line").find("span.value_wrapper").find("span");

                    var newValue = parseInt( updatedSpanObject.html() ) + 1;
                    
                    updatedSpanObject.html(newValue);
                    
                    //TODO: subtotal changes and so on... ajax call..
                });   

  
                $(".subtract_one_item_wrapper").click( function(){
                                    
                    var updatedSpanObject = $(this).closest(".product_detail_line").find("span.value_wrapper").find("span");

                    var newValue = parseInt( updatedSpanObject.html() ) - 1;
                    
                    if( newValue <= 0)
                        return;
                        
                    updatedSpanObject.html(newValue);
                    
                    //TODO: subtotal changes and so on... ajax call..
                });

                $("html .pp_button_active:not(.pp_button_active:last)").click( function(){
                    $("div.content_wrapper").animate({
                        left: ("-=" + 815)
                    }, 2000);
                });  

                //                $( "#address_same" ).change(function() {
                //                    $("#address_same")
                //                });
                //                $( "#address_other" ).change(function() {
                //                    alert( "Handler for .change() called." );
                //                });               
                
                $(".pp_button_passive").click( function(){
                    $("div.content_wrapper").animate({
                        left: ("+=" + 815)
                    }, 2000);
                });                
                
                $(".cart_list").mCustomScrollbar();

            });
        </script>
    </head>
    <body>
        <!--  menu -->
        <div id="menu_wrapper">

            <ul class="menu_l">
                <li>
                    <?php echo anchor('whatisrealpp', ' ', array('class' => 'upper_cased')); ?>
                </li>
                <li>
                    <?php echo anchor('ucreate', 'u create', array('class' => 'text_light smaller pp_dark_gray red_on_hover upper_cased')); ?>
                </li>
                <li>
                    <?php echo anchor('finalproducts', 'final products', array('class' => 'text_light smaller pp_dark_gray red_on_hover upper_cased')); ?>
                </li>
            </ul>
            <ul class="menu_r">
                <li id="m_language">
                    <?php echo anchor('login', 'en / sk', array('class' => 'text_light smaller pp_dark_gray red_on_hover upper_cased')); ?>
                </li>
                <li id="m_cart">
                    <?php echo anchor('shopping_cart', 'shopping cart', array('class' => 'text_light smaller pp_dark_gray red_on_hover upper_cased')); ?>
                </li>
                <li id="m_login">
                    <?php echo anchor('login', 'log in', array('class' => 'text_light smaller pp_dark_gray red_on_hover upper_cased')); ?>
                    <div id="login_wrapper">
                        <div class="login_wrapper_single_row">
                            <span class="text_light smaller bold upper_cased black">name/email</span>
                            <input type="text" placeholder="your nick or email"/>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="login_wrapper_single_row">
                            <span class="text_light smaller bold upper_cased black">password</span>
                            <input type="text" placeholder="your password"/>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="login_wrapper_single_row">
                            <span class="text_light smaller bold black">forgot your password?</span>
                            <?php echo anchor('registration', 'new registration', array('class' => 'text_light smaller pp_dark_gray bold pp_red upper_cased right')); ?>
                        </div>
                        <div style="clear:both;"></div>
                    </div>                    
                </li>
                <li id="m_contact">
                    <?php echo anchor('contact', 'contact', array('class' => 'text_light smaller pp_dark_gray red_on_hover upper_cased')); ?>
                </li>
            </ul>
        </div>
        <!-- end of menu-->
        <!--red line-->
        <!--        <div class="red_line">
                </div>-->
        <!--end of red line-->

        <!-- content -->
        <div id="content">
            <div class="content_wrapper">
                <!-- ******************* shopping cart section ******************* -->
                <div class="container">


                    <!-- Title -->
                    <!--<div class="title upper_cased black">-->
                    <h1>
                        about us
                    </h1>
                    <!--</div>-->
                    <div class="red_line">
                    </div>                    
                    <!--<form name="pp_form_name" action="#" method="POST">-->
                    <div class="half_container">
                        <!--<div class="text_medium upper_cased bold">-->
                        <h2>
                            rules
                        </h2>
                        <!--</div>-->
                        <div class="text_light">
                            <?php echo $company->cmpn_rules ?>
                        </div>
                        <div id="video_section">
                            <div id="video_section_container" class="full_video_container">
                                <div class="video_item_wrapper">
                                    <div class="video_item_screen"></div>
                                    <div class="video_item_title text_light smaller upper_cased pp_dark_gray">choose</div>
                                </div>
                                <div class="video_item_wrapper">
                                    <div class="video_item_screen"></div>
                                    <div class="video_item_title text_light smaller upper_cased pp_dark_gray">create</div>
                                </div>
                                <div class="video_item_wrapper">
                                    <div class="video_item_screen"></div>
                                    <div class="video_item_title text_light smaller upper_cased pp_dark_gray">create</div>
                                </div>
                                <div class="video_item_wrapper">
                                    <div class="video_item_screen"></div>
                                    <div class="video_item_title text_light smaller upper_cased pp_dark_gray">create</div>
                                </div>
                            </div>
                        </div> 
                        <div style="clear:both;"></div>
                        <!--<div class="text_medium upper_cased bold">-->
                        <h2>
                            contact
                        </h2>
                        <!--</div>-->
                        <div class="address">
                            <div class="text_light upper_cased"><?php echo $company->cmpn_provider_firstname ?>&nbsp;<?php echo $company->cmpn_provider_lastname ?></div>
                            <div class="text_light upper_cased"><?php echo $company->cmpn_provider_street ?>&nbsp;<?php echo $company->cmpn_provider_street_number ?></div>
                            <div class="text_light upper_cased"><?php echo $company->cmpn_provider_city ?></div>
                            <div class="text_light upper_cased"><?php echo $company->cmpn_provider_country ?></div>
                            <div class="text_light upper_cased"><?php echo $company->cmpn_provider_email ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $company->cmpn_provider_phone_number ?></div>
                        </div>                   
                    </div>
                </div>
            </div>

        </div><!-- end of content-->

        <!--<div style="clear:both;"></div>-->


        <!-- footer -->
        <div id="footer" class="f_inactive">
            <div class="colmask threecol">
                <div class="colmid">
                    <div class="colleft">
                        <div class="col1">
                            <!-- Column 1 start -->
                            <div class="text_wrapper_middle_part inactive">
                                <div class="text_light smaller black">Copyright &copy; 2013 Powporn. All rights reserved.</div>
                            </div>
                            <!-- Column 1 end -->
                        </div>
                        <div class="col2">
                            <!-- Column 2 start -->
                            <ul class="footer_l inactive">
                                <li><a href="./whatisrealpp.html" class="text_light red_on_hover upper_cased">rules</a></li>
                                <li><a href="./ucreate.html" class="text_light red_on_hover upper_cased">payment</a></li>
                                <li><a href="./finalproducts.html" class="text_light red_on_hover upper_cased">shipping services</a></li>
                                <li><a href="./finalproducts.html" class="text_light red_on_hover upper_cased">CLIENT SERVICES</a></li>
                            </ul>
                            <!-- Column 2 end -->
                        </div>
                        <div class="col3">
                            <!-- Column 3 start -->
                            <div id="footer_switcher_wrapper">
                                <div id="footer_switcher" class="inactive"> 
                                </div>
                            </div>
                            <!-- Column 3 end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>
