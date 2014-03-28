<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Preview</title>
        <?php
        // css
        echo link_tag('assets/css/menu.css');
        echo link_tag('assets/css/footer.css');
        echo link_tag('assets/css/finalproducts.css');
        echo link_tag('assets/css/socialsidebar.css');
        echo link_tag('assets/css/checkbox.css');
        echo link_tag('assets/css/preview.css');
        echo link_tag('assets/css/jquery.jqzoom.css');
        echo link_tag('assets/css/jquery.mCustomScrollbar.css');

        //js
        ?>

        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>
        <script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
        <script src="../assets/javascript/jquery-1.6.js" type="text/javascript"></script>  
        <script src="../assets/javascript/jquery.jqzoom-core.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                var options = {  
                    zoomType: 'standard',  
                    lens:true,  
                    preloadImages: true,  
                    alwaysOn:false,  
                    zoomWidth: 290,  
                    zoomHeight: 500,  
                    xOffset: 170,  
                    yOffset: 0,  
                    position:'left'  
                    //...MORE OPTIONS  
                };  
                $('.MYCLASS').jqzoom(options); 
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

        <!-- content -->
        <div class="content_unextended">

            <div class="preview_left">

                <div class="line pp_red"></div>

                <!--<div id="pr_l_title" class="text_medium upper_cased black">snowbitch xxx</div>-->
                <h2>snowbitch xxx</h2>
                <div class="line pp_dark_gray"></div>

                <!--<div class="text_medium upper_cased pp_dark_gray">design by</div>-->
                <h4 class="pp_dark_gray">design by</h4>
                <!--<div id="pr_l_creator" class="text_medium upper_cased black">kajsiman</div>-->
                <h4 class="black">kajsiman</h4>
                <div class="line pp_dark_gray"></div>

                <!--<div class="text_medium upper_cased pp_dark_gray">type</div>-->
                <h4 class="pp_dark_gray">type</h4>
                <h5 class="lower_cased">dslf nfbwf w wf iwfw eif wf bw fbwefwehbfiwebf wefb wihb fwe bwfbwihb fiwef ww fwef. bf bfsdbf ihw bwf bw ibwfbwe fw. U a9f f  faqf g wgf fa  rgfew4rfdgsf ewgfr fw ga d43r3f43fwf  wefe ew ffe, ef  fwe f ewrfwe f ewf.</h5>
                <div class="pr_l_sex_icon"></div>
                <h4>unisex</h4>
                <h4>xl</h4>
                <div class="line"></div>

                <h1>500 &euro;</h1>
                <button id="add_to_cart_button">ADD</button>
            </div>

            <div class="preview_center">
                
                <?php 
                
                  $anchor_url =  base_url('assets/images/jacket.jpg');
                  $image_properties = array(
                        'src' => 'assets/images/jacket.jpg',
                        'alt' => 'Sick hoodie',
                        'width' => '500',
                        'height' => '436',
                        'class' => 'MYCLASS',
                        'title' => 'SNOWBITCH XXX'
                    );                
                
                $img_data = img($image_properties);
                
                echo anchor( $anchor_url, $img_data, array('class' => 'MYCLASS', 'title'=> 'SNOWBITCH XXX')); 
                
                ?>             
            </div> 

            <div class="preview_right">


            </div>

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
