<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Final products</title>
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

        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>
        <script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).ready(function(){

                if (document.addEventListener) {
                    // IE9, Chrome, Safari, Opera
                    document.addEventListener("mousewheel", MouseWheelHandler, false);
                    // Firefox
                    document.addEventListener("DOMMouseScroll", MouseWheelHandler, false);
                }
                // IE 6/7/8
                else document.attachEvent("onmousewheel", MouseWheelHandler);

                var defaultAnimationStep = 100;
                //var animationStep = 100;

                function MouseWheelHandler(e) {

                    // cross-browser wheel delta
                    var e = window.event || e; // old IE support
                    //var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
                    //alert('e.wheelDelta = ' + e.wheelDelta + '-e.detail = ' + (-e.detail));
                    var delta = (e.wheelDelta || -e.detail);

                    //$(".gallery_row_wrapper").style.width = Math.max(50, Math.min(800, myimage.width + (30 * delta))) + "px";
                    //                    var x = $(".gallery_row_wrapper").offset().left;
                    //                    x = x + delta;
                    //                    $(".gallery_row_wrapper").css({left:x});
                    
                    // check actual position of a row wrapper, in case of attempt to move left
                    // further than gallery_wrapper' most left position, move it to the beginning
                    if( $(".gallery_row_wrapper").offset().left + delta > 0 ){
                        //alert( $(".gallery_row_wrapper").offset().left + ' ' + delta);
                        //return false;
                        delta = -$(".gallery_row_wrapper").offset().left ;
                    }else if( $(".gallery_row_wrapper").width() + $(".gallery_row_wrapper").offset().left + delta + 2 <  $( window ).width() ){
                        //delta = - 1 * ($(".gallery_row_wrapper").width() + $(".gallery_row_wrapper").offset().left - $( window ).width()) ;
                        //alert( $(".gallery_row_wrapper").width() + ", " + $(".gallery_row_wrapper").offset().left);
                        return false;
                    }
                   
                    if( $('.gallery_row_wrapper').is(':animated') ) {
                        // animation is already running, ingore mouse wheel event
                        //animationStep -= 50;
                    }else{
                        // animate wrapper
                        $(".gallery_row_wrapper").animate({
                            left: ("+=" + delta)
                        }, defaultAnimationStep);
                        //animationStep = defaultAnimationStep;
                    }
                    
                    return false;
                }



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
                    <?php echo anchor('login', 'log in', array('class' => 'text_light smaller  pp_dark_gray red_on_hover upper_cased')); ?>
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


            <!-- Title -->
            <div id="gallery_title" class="title upper_cased pp_light_gray">
                already made models
            </div>            

            <!-- products gallery -->
            <!-- image wrapper -->
            <div id="gallery_wrapper">

                <div  class="gallery_row_wrapper">

                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div> 
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">
                            <?php echo img('assets/images/jacket.jpg'); ?>
                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>         
                </div>
                <div class="gallery_row_wrapper">
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div>
                    <div class="gallery_item">
                        <a href="images/klematis_big.htm">                            <?php echo img('assets/images/jacket.jpg'); ?>                        </a>
                        <div class="gallery_item_desc">
                            <div class="gallery_item_name text_light bold upper_cased">sky chujas</div>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">edit</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>
                            <span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>                            
                        </div>
                    </div> 
                </div>                    
            </div>

            <!--             Pagination section 
                        <div class="gallery_paginagion">
                            <ul>  
                                <li><a href="#">Prev</a></li>  
                                <li class="active"><a href="#">1</a></li>  
                                <li><a href="#">2</a></li>  
                                <li><a href="#">3</a></li>  
                                <li><a href="#">4</a></li>  
                                <li><a href="#">Next</a></li>  
                            </ul>
                        </div> end of pagination section -->



        </div><!-- end of content-->


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
