<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Cart</title>
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
                    
                    $('.text_light.smaller').toggleClass("black");
                    $('.text_light.smaller').toggleClass("pp_dark_gray");
                    
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

        <div class="gallery_gradient_wrapper">
            <div class="gallery_gradient right">
            </div>
            <div class="gallery_gradient left">
            </div>             
        </div> 

        <!-- content -->
        <div id="content">



            <div class="content_wrapper">

                <!-- ******************* shopping cart section ******************* -->
                <div class="container">
                    <!-- Title -->
                    <!--<div class="title upper_cased black">-->
                    <h1>
                        1. shopping cart
                    </h1>
                    <!--</div>-->
                    <div class="red_line">
                    </div>                    
                    <!--<form name="pp_form_name" action="#" method="POST">-->

                    <div class="cart_list">
                        <div class="cart_list_item">
                            <div class="product_view_section">
                                <a href="images/klematis_big.htm">
                                    <?php echo img('assets/images/jacket.jpg'); ?>
                                </a>
                            </div>
                            <div class="product_details_section">
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased">name:</span>
                                    <span class="text_light upper_cased bold">nyankina</span>
                                </div>
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased">author:</span>
                                    <span class="text_light upper_cased bold">kajsiboy</span>
                                </div>
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased">size:</span>
                                    <span class="text_light upper_cased bold">xxxl</span>
                                </div>
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased">count:</span>
                                    <span class="value_wrapper"><span class="text_light upper_cased bold">1</span></span>
                                    <span class="add_one_item_wrapper"><span class="text_light upper_cased">+</span></span>
                                    <span class="text_light upper_cased">/</span>
                                    <span class="subtract_one_item_wrapper"><span class="text_light upper_cased">-</span></span>
                                </div>
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased italic red_on_hover">remove</span>
                                    <span class="text_light italic">/</span>
                                    <span class="text_light upper_cased italic red_on_hover">edit</span>
                                </div>                                       
                            </div>
                            <div class="product_price_section">
                                <div class="product_price_line">
                                    <span class="text_light upper_cased">price/</span>
                                    <span class="text_light">ks:</span>
                                    <span class="text_light upper_cased bold">500&euro;</span>
                                    <span class="text_light bold">dph</span>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <div class="cart_list_item">
                            <div class="product_view_section">
                                <a href="images/klematis_big.htm">
                                    <?php echo img('assets/images/jacket.jpg'); ?>
                                </a>
                            </div>
                            <div class="product_details_section">
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased">name:</span>
                                    <span class="text_light upper_cased bold">nyankina</span>
                                </div>
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased">author:</span>
                                    <span class="text_light upper_cased bold">kajsiboy</span>
                                </div>
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased">size:</span>
                                    <span class="text_light upper_cased bold">xxxl</span>
                                </div>
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased">count:</span>
                                    <span class="value_wrapper"><span class="text_light upper_cased bold">1</span></span>
                                    <span class="add_one_item_wrapper"><span class="text_light upper_cased">+</span></span>
                                    <span class="text_light upper_cased">/</span>
                                    <span class="subtract_one_item_wrapper"><span class="text_light upper_cased">-</span></span>
                                </div>
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased italic red_on_hover">remove</span>
                                    <span class="text_light italic">/</span>
                                    <span class="text_light upper_cased italic red_on_hover">edit</span>
                                </div>                                       
                            </div>
                            <div class="product_price_section">
                                <div class="product_price_line">
                                    <span class="text_light upper_cased">price/</span>
                                    <span class="text_light">ks:</span>
                                    <span class="text_light upper_cased bold">500&euro;</span>
                                    <span class="text_light bold">dph</span>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <div class="cart_list_item">
                            <div class="product_view_section">
                                <a href="images/klematis_big.htm">
                                    <?php echo img('assets/images/jacket.jpg'); ?>
                                </a>
                            </div>
                            <div class="product_details_section">
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased">name:</span>
                                    <span class="text_light upper_cased bold">nyankina</span>
                                </div>
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased">author:</span>
                                    <span class="text_light upper_cased bold">kajsiboy</span>
                                </div>
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased">size:</span>
                                    <span class="text_light upper_cased bold">xxxl</span>
                                </div>
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased">count:</span>
                                    <span class="value_wrapper"><span class="text_light upper_cased bold">1</span></span>
                                    <span class="add_one_item_wrapper"><span class="text_light upper_cased">+</span></span>
                                    <span class="text_light upper_cased">/</span>
                                    <span class="subtract_one_item_wrapper"><span class="text_light upper_cased">-</span></span>
                                </div>
                                <div class="product_detail_line">
                                    <span class="text_light upper_cased italic red_on_hover">remove</span>
                                    <span class="text_light italic">/</span>
                                    <span class="text_light upper_cased italic red_on_hover">edit</span>
                                </div>                                      
                            </div>
                            <div class="product_price_section">
                                <div class="product_price_line">
                                    <span class="text_light upper_cased">price/</span>
                                    <span class="text_light">ks:</span>
                                    <span class="text_light upper_cased bold">500&euro;</span>
                                    <span class="text_light bold">dph</span>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>                        
                    </div>

                    <div style="clear:both;"></div>
                    <div class="bottom_wrapper">
                        <div class="bottom_wrapper left">
                            <!--<div class="text_medium upper_cased bold">subtotal&nbsp;&nbsp;&nbsp;500 &euro;</div>-->
                            <h2>subtotal 500 &euro;</h2>
                        </div>
                        <div class="bottom_wrapper right">
                            <!--<input type="button" value="SIGN UP"/>-->
                            <div class="fl_right">
                                <!--<div class="text_medium upper_cased bold">subtotal&nbsp;&nbsp;&nbsp;-->
                                <h2 style="display:inline-block">subtotal</h2>    <span class="text_medium upper_cased bold pp_red">500 &euro;</span>
                                <!--</div>-->
                            </div>
                            <div style="clear:both;"></div>
                            <div class="right_pp_button_wrapper">
                                <button class="pp_button_active" type="submit" name="submit">NEXT STEP <span class="pp_red">&gt;</span></button>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <!--</form>-->
                </div>

                <!-- ******************* shipping and payment section ******************* -->
                <div class="container">
                    <!-- Title -->
                    <!--<div class="title upper_cased black">-->
                    <h1>
                        2. shipping & payment
                    </h1>
                    <!--</div>-->
                    <div class="red_line">
                    </div>                    
                    <!--<form name="pp_form_name" action="#" method="POST">-->

                    <div class="text_fields_wrapper">

                        <div class="text_field_wrapper left">
                            <!--<div class="text_medium upper_cased bold">shipping address</div>-->
                            <h2>
                                shipping address
                            </h2>
                            <ul class="shipping_list">
                                <li>
                                    <span class="text_light upper_cased">same as the registration address</span>
                                    <input type = "radio"
                                           class="css-checkbox"
                                           name = "address_type"
                                           id = "address_same"
                                           value = "same"
                                           checked = "checked" />
                                    <label for="address_same" class="css-label">&nbsp;</label>
                                    <div style="clear:both;"></div>
                                    <span class="text_light upper_cased">other address</span>
                                    <input type = "radio"
                                           class="css-checkbox"
                                           name = "address_type"
                                           id = "address_other"
                                           value = "other"/>
                                    <label for="address_other" class="css-label">&nbsp;</label>
                                    <div style="clear:both;"></div>
                                </li>                               
                                <li>
                                    <label for="tf_name" class="required">name</label>
                                    <input type="text" id="tf_nick" name="tf_nick" placeholder="Nick" />
                                    <div style="clear:both;"></div>
                                </li>
                                <li>
                                    <label for="tf_address" class="required">address</label>
                                    <input type="text" id="tf_address" name="tf_address" value="" size="32" />
                                    <div style="clear:both;"></div>
                                </li>
                                <li>
                                    <label for="tf_city" class="required">city</label>
                                    <input type="text" id="tf_city" name="tf_city" value="" size="32" />
                                    <div style="clear:both;"></div>
                                </li>
                                <li>
                                    <label for="tf_zip" class="required">zip</label>
                                    <input type="number" id="tf_zip" name="tf_zip" />
                                    <div style="clear:both;"></div>
                                </li>
                                <li>
                                    <label for="tf_country" class="required">country</label>
                                    <input type="text" id="tf_country" name="tf_country" value="" size="32" />
                                    <div style="clear:both;"></div>
                                </li>                                
                                <li>
                                    <label for="tf_phone_number" class="required">phone number</label>
                                    <input type="text" id="tf_phone_number" name="tf_phone_number" placeholder="Phone number" size="32" />
                                    <div style="clear:both;"></div>
                                </li>
                                <li>
                                    <label for="tf_email_address" class="required">email address</label>
                                    <input type="email" id="tf_email_address" name="tf_email_address" placeholder="john_doe@example.com" size="32" />
                                    <div style="clear:both;"></div>
                                </li>
                                <li>
                                    <span class="text_light upper_cased">shipping method 1&nbsp;</span>
                                    <span class="text_light">22.5</span>
                                    <input type = "radio"
                                           class="css-checkbox"
                                           name = "shippin_method"
                                           id = "shipp_meth_1"
                                           value = "1"
                                           checked = "checked" />
                                    <label for="shipp_meth_1" class="css-label">&nbsp;</label>
                                    <div style="clear:both;"></div>
                                    <span class="text_light upper_cased">shipping method 1&nbsp;</span>
                                    <span class="text_light">22.5</span>
                                    <input type = "radio"
                                           class="css-checkbox"
                                           name = "shippin_method"
                                           id = "shipp_meth_2"
                                           value = "2"/>
                                    <label for="shipp_meth_2" class="css-label">&nbsp;</label>
                                    <div style="clear:both;"></div>
                                    <span class="text_light upper_cased">shipping method 1&nbsp;</span>
                                    <span class="text_light">22.5</span>
                                    <input type = "radio"
                                           class="css-checkbox"
                                           name = "shippin_method"
                                           id = "shipp_meth_3"
                                           value = "3"/>
                                    <label for="shipp_meth_3" class="css-label">&nbsp;</label>
                                    <div style="clear:both;"></div>
                                </li>                                 
                            </ul>
                        </div>
                        <div class="text_field_wrapper right">
                            <!--<div class="text_medium upper_cased bold">payment method</div>-->
                            <h2>
                                payment method
                            </h2>
                            <ul class="shipping_list">
                                <li>
                                    <span class="text_light upper_cased">credit card</span>
                                    <input type = "radio"
                                           class="css-checkbox"
                                           name = "payment_method"
                                           id = "payment_credit_card"
                                           value = "credit_card"
                                           checked = "checked" />
                                    <label for="payment_credit_card" class="css-label">&nbsp;</label>
                                    <div style="clear:both;"></div>
                                    <span class="text_light upper_cased">cash in advance</span>
                                    <input type = "radio"
                                           class="css-checkbox"
                                           name = "payment_method"
                                           id = "payment_cash"
                                           value = "cash"/>
                                    <label for="payment_cash" class="css-label">&nbsp;</label>
                                    <div style="clear:both;"></div>
                                </li>
                            </ul>                            
                        </div>
                    </div>

                    <div style="clear:both;"></div>
                    <div class="bottom_wrapper">
                        <div class="bottom_wrapper left">
                            <div class="left_pp_button_wrapper">
                                <button class="pp_button_passive fl_left" type="submit" name="submit">BACK</button>
                            </div>
                        </div>
                        <div class="bottom_wrapper right">
                            <!--<input type="button" value="SIGN UP"/>-->
                            <div class="fl_right">
                                <!--<div class="text_medium upper_cased bold">subtotal&nbsp;&nbsp;&nbsp;<span class="pp_red">520 &euro;</span></div>-->
                                <h2 style="display:inline-block">subtotal</h2>    <span class="text_medium upper_cased bold pp_red">500 &euro;</span>
                            </div>
                            <div style="clear:both;"></div>
                            <div class="right_pp_button_wrapper">
                                <button class="pp_button_active" type="submit" name="submit">NEXT STEP <span class="pp_red">&gt;</span></button>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <!--</form>-->
                </div> 

                <!-- ******************* final preview section ******************* -->
                <div class="container">
                    <!-- Title -->
                    <!--<div class="title upper_cased black">-->
                    <h1>
                        3. final preview
                    </h1>
                    <!--</div>-->
                    <div class="red_line">
                    </div>                    
                    <!--<form name="pp_form_name" action="#" method="POST">-->

                    <div class="text_fields_wrapper">

                        <div class="text_field_wrapper left">
                            <!--<div class="text_medium upper_cased bold">items</div>-->
                            <h2>
                                items
                            </h2>
                            <div class="final_items_list">
                                <div class="final_item">
                                    <span class="text_light smaller upper_cased bold">nyankina</span>
                                    <span class="text_light smaller upper_cased">by:<span class="text_light upper_cased bold">kajsiboy</span></span>
                                    <span class="text_light smaller upper_cased bold">xxxl</span>
                                    <span class="text_light smaller">1 pc.</span>
                                    <span class="text_light smaller upper_cased">price<span class="text_light lower_cased">/ks:</span><span class="text_light lower_cased bold">500&euro; dph</span></span>                                
                                </div>
                                <div class="final_item">
                                    <span class="text_light smaller upper_cased bold">nyankina</span>
                                    <span class="text_light smaller upper_cased">by:<span class="text_light upper_cased bold">kajsiboy</span></span>
                                    <span class="text_light smaller upper_cased bold">xxxl</span>
                                    <span class="text_light smaller">1 pc.</span>
                                    <span class="text_light smaller upper_cased">price<span class="text_light lower_cased">/ks:</span><span class="text_light lower_cased bold">500&euro; dph</span></span>                                
                                </div>
                                <div class="final_item">
                                    <span class="text_light smaller upper_cased bold">nyankina</span>
                                    <span class="text_light smaller upper_cased">by:<span class="text_light upper_cased bold">kajsiboy</span></span>
                                    <span class="text_light smaller upper_cased bold">xxxl</span>
                                    <span class="text_light smaller">1 pc.</span>
                                    <span class="text_light smaller upper_cased">price<span class="text_light lower_cased">/ks:</span><span class="text_light lower_cased bold">500&euro; dph</span></span>                                
                                </div>                                
                            </div>
                            <!--<div class="text_medium upper_cased bold">shipping address</div>-->
                            <h2>
                                shipping address
                            </h2>
                            <div class="address">
                                <div class="text_light upper_cased">martin juhas</div>
                                <div class="text_light upper_cased">sladkovica hajtkovica 23</div>
                                <div class="text_light upper_cased">075 01 secovce</div>
                                <div class="text_light upper_cased">slovakia</div>
                                <div class="text_light upper_cased">info@436.sk +432 984 500 500</div>
                            </div>
                            <!--<div class="text_medium upper_cased bold">payment method</div>-->
                            <h2>
                                payment method
                            </h2>                            
                            <div class="final_payment_method">
                                <div class="text_light upper_cased">credit card</div>
                            </div>
                        </div>
                        <div class="text_field_wrapper right">
                            <!--<div class="text_medium upper_cased bold">items</div>-->                            
                        </div>
                    </div>

                    <div style="clear:both;"></div>
                    <div class="bottom_wrapper">
                        <div class="bottom_wrapper left">
                            <div class="left_pp_button_wrapper">
                                <button class="pp_button_passive fl_left" type="submit" name="submit">BACK</button>
                            </div>
                        </div>
                        <div class="bottom_wrapper right">
                            <!--<input type="button" value="SIGN UP"/>-->
                            <div class="fl_right">
                                <div class="text_medium upper_cased bold">total&nbsp;&nbsp;&nbsp;<span class="pp_red">520 &euro;</span></div>
                            </div>
                            <div style="clear:both;"></div>
                            <div class="right_pp_button_wrapper">
                                <button id="buy_button" class="pp_button_active" type="submit" name="submit">BUY!</button>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <!--</form>-->
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


        <script type="text/javascript">
            //TODO: do a callback to check if such a nick or email adress already exists for example
            var validator = new FormValidator('pp_form_name', [{
                    name: 'tf_nick',
                    display: '\"Nick\"',    
                    rules: 'required'
                }, {
                    name: 'tf_first_name',
                    display: '\"First Name\"',    
                    rules: 'required'
                }, {
                    name: 'tf_last_name',
                    display: '\"Last Name\"',    
                    rules: 'required'
                }, {
                    name: 'tf_email_address',
                    display: '\"Email Address\"',
                    rules: 'valid_email'
                }, {
                    name: 'tf_password_base',
                    display: '\"Password\"',
                    rules: 'required'
                }, {
                    name: 'tf_password_confirm',
                    display: '\"Confirm Password\"',
                    rules: 'required|matches[tf_password_base]'
                }, {
                    name: 'tf_address',
                    display: '\"Address\"',
                    rules: 'required'
                }, {
                    name: 'tf_city',
                    display: '\"City\"',
                    rules: 'required'
                },{
                    name: 'tf_zip',
                    display: '\"ZIP\"',
                    rules: 'required'
                },{
                    name: 'tf_country',
                    display: '\"Country\"',
                    rules: 'required'
                }], function(errors, event) {
                
                if (errors.length < 0) {
                    
                    var errorString = '';
         
                    for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
                        errorString += errors[i].message;
                    }
        
                    var errorOutputDiv = document.getElementById("error_output_section");
                    errorOutputDiv.innerHTML = errorString;
                    //                    alert(errorString);
                    //                    if (evt && evt.preventDefault) {
                    //                        evt.preventDefault();
                    //                    } else if (event) {
                    //                        event.returnValue = false;
                    //                    }
                }else{
                    //everything ok
                    var validUserEmailElement = document.getElementById("user_email");
                    var emailAddressElement = document.getElementById("tf_email_address");

                    validUserEmailElement.innerHTML =  emailAddressElement.value;
                    
                    $('.overlay-bg').show();
                }
            });
            
        </script>
        <script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
    </body>
</html>
