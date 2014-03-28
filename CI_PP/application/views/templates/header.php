<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo ( empty($title) ? 'PowPorn' : $title) ?></title>
        <?php
        // css
        echo link_tag('assets/css/menu.css');
        echo link_tag('assets/css/footer.css');
        echo link_tag('assets/css/finalproducts.css');
        echo link_tag('assets/css/socialsidebar.css');
        echo link_tag('assets/css/jquery.mCustomScrollbar.css');
        echo link_tag('assets/css/checkbox.css');
        //js
        ?>

        <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js' type='text/javascript'></script>
        <script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

        <script src="<?php echo base_url();?>assets/javascript/validate.min.js" text='text/javascript'></script>

        <script type="text/javascript">
            $(document).ready(function(){
                
                $('#login_result_message').hide();
                
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
                
                
                $('#login_wrapper').bind('keypress', function(e) {
                    if(e.keyCode!=13){
                        // Enter NOT pressed... ignore
                        return;
                    }
                    
                    var form_data = {
                        login_nick_or_email : $('#login_nick_or_email').val(),
                        login_password : $('#login_password').val(),
                        ajax : '1'
                    };
                    $.ajax({
                        url: "<?php echo site_url('user/login'); ?>",
                        type: 'POST',
                        async : false,
                        data: form_data,
                        success: function(result) {
                            
                            $('#login_result_message').show();
                            
                            $('#login_result_message').css("display","block");
                            
                            if( result == 0){
                                $('#login_result_message').html('User not found!');
                            }else{
                                $('#login_result_message').html('Login successful.');
                                window.location.href = "<?php echo site_url('welcome/index'); ?>";
                            };                            
                        }
                    });
                    return false;
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
                    <?php echo anchor('shopping_cart', 'en / sk', array('class' => 'text_light smaller pp_dark_gray red_on_hover upper_cased')); ?>
                </li>
                <li id="m_cart">
                    <?php echo anchor('shopping_cart', 'shopping cart', array('class' => 'text_light smaller pp_dark_gray red_on_hover upper_cased')); ?>
                </li>
                
                <?php 
                /* dynamicaly added <LI> element either to log in or log out according to the status of user */
                echo $login_or_logout_template 
                ?>
                
                <li id="m_contact">
                    <?php echo anchor('contact', 'contact', array('class' => 'text_light smaller pp_dark_gray red_on_hover upper_cased')); ?>
                </li>
            </ul>
        </div>