<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registration</title>
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

        <!-- Do NOT move to php section because it won't work !!! --> 
        <?php
        echo link_tag('assets/javascript/validate.min.js');
        ?>
<!--        <script src="../assets/javascript/validate.min.js" type="text/javascript"></script>-->

        <script type="text/javascript">
            $(document).ready(function(){
                
                $('#login_result_message').hide();
                
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
                        url: "<?php echo site_url('registration/ajax_check'); ?>",
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
                <li id="m_login">
                    <?php echo anchor('shopping_cart', 'log in', array('class' => 'text_light smaller  pp_dark_gray red_on_hover upper_cased')); ?>
                    <div id="login_wrapper"><?php echo form_open('registration/ajax_check'); ?>
                        <div class="login_wrapper_single_row">
                            <span class="text_light smaller bold upper_cased black">name/email</span>
                            <input id="login_nick_or_email" name="login_nick_or_email" type="text" placeholder="your nick or email"/>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="login_wrapper_single_row">
                            <span class="text_light smaller bold upper_cased black">password</span>
                            <input id="login_password" name="login_password" type="text" placeholder="your password"/>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="login_wrapper_single_row">
                            <span class="text_light smaller bold black">forgot your password?</span>
                            <?php echo anchor('registration', 'new registration', array('class' => 'text_light smaller pp_dark_gray bold pp_red upper_cased right')); ?>
                        </div>
                        <div style="clear:both;"></div>

                        <div id="login_result_message">
                        </div>
                        <?php echo form_close(); ?>
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

                <div class="container">
                    <!-- Title -->
                    <div class="title upper_cased black">
                        Registration
                    </div>
                    <div id="error_output_section" class="text_medium capitalized_first_only pp_red">
                    </div>

                    <?php echo validation_errors('<p class="error">'); ?>                    
                    <!--<form name="pp_form_name" action="#" method="POST">-->
                    <!--                    $attributes = array('class' => 'email', 'id' => 'myform');
                    echo form_open('email/send', $attributes);-->
                    <?php
                    $attributes = array('name' => 'pp_form_name');
                    echo form_open("registration/register", $attributes);
                    ?>
                    <div class="text_fields_wrapper">

                        <div class="text_field_wrapper left">
                            <ul>
                                <li>
                                    <label for="tf_nick" class="required">nick</label>
                                    <input type="text" id="tf_nick" name="tf_nick" placeholder="Nick" value="<?php echo set_value('tf_nick'); ?>" size="32" maxlength="32" />
                                </li>
                                <li>
                                    <label for="tf_first_name" class="required">first name</label>
                                    <input type="text" id="tf_first_name" name="tf_first_name" placeholder="First name" value="<?php echo set_value('tf_first_name', ''); ?>" size="32" maxlength="32" />
                                </li>
                                <li>
                                    <label for="tf_last_name" class="required">last name</label>
                                    <input type="text" id="tf_last_name" name="tf_last_name" placeholder="Last name" value="<?php echo set_value('tf_last_name'); ?>" size="32" maxlength="32" />
                                </li>
                                <li>
                                    <label for="tf_email_address" class="required">email address</label>
                                    <input type="email" id="tf_email_address" name="tf_email_address" placeholder="john_doe@example.com" value="<?php echo set_value('tf_email_address'); ?>" size="32" maxlength="64" />
                                </li>
                                <li>
                                    <label for="tf_password_base" class="required">password</label>
                                    <input type="password" id="tf_password_base" name="tf_password_base" value="" size="32" maxlength="32" />
                                </li>
                                <li>
                                    <label for="tf_password_confirm" class="required">confirm password</label>
                                    <input type="password" id="tf_password_confirm" name="tf_password_confirm" value="" size="32" maxlength="32" />
                                </li>                                 
                            </ul>
                        </div>
                        <div class="text_field_wrapper right">
                            <ul>
                                <li>
                                    <label for="tf_gender" class="required">gender</label>
                                    <input type = "radio"
                                           class="css-checkbox"
                                           name = "tf_gender"
                                           id = "male"
                                           value = "male" />
                                    <label for = "male" class="css-label">male</label>
                                    <input type = "radio"
                                           class="css-checkbox"
                                           name = "tf_gender"
                                           id = "female"
                                           value = "female"
                                           checked = "checked" />
                                    <label for = "female" class="css-label">female</label>                                    
                                </li>
                                <li>
                                    <label for="tf_delivery_addres" >delivery address</label>
                                    <input type="text" id="tf_delivery_addres" name="tf_delivery_addres" value="<?php echo set_value('tf_delivery_addres'); ?>" size="32" maxlength="256" />
                                </li>
                                <li>
                                    <label for="tf_address" class="required">address</label>
                                    <input type="text" id="tf_address" name="tf_address" value="<?php echo set_value('tf_address'); ?>" size="32" maxlength="256"/>
                                </li>
                                <li>
                                    <label for="tf_city" class="required">city</label>
                                    <input type="text" id="tf_city" name="tf_city" value="<?php echo set_value('tf_city'); ?>" size="32" maxlength="32" />
                                </li>
                                <li>
                                    <label for="tf_zip" class="required">zip</label>
                                    <input type="number" id="tf_zip" name="tf_zip" value="<?php echo set_value('tf_zip'); ?>" size="32" maxlength="16" />
                                </li>
                                <li>
                                    <label for="tf_country" class="required">country</label>
                                    <input type="text" id="tf_country" name="tf_country" value="<?php echo set_value('tf_country'); ?>" size="32" maxlength="32" />
                                </li>                                 
                            </ul>                            
                        </div>

                    </div>
                    <div style="clear:both;"></div>
                    <div class="bottom_wrapper">
                        <div class="bottom_wrapper left">
                            <span class="text_light smaller pp_light_gray">By clicking SIGN UP, you are agreeing to <a href="../policy.html" target="_blank">POWPORN Policy</a> and <a href="../terms.html" target="_blank">Terms &amp; Conditions</a></span>
                        </div>
                        <div class="bottom_wrapper right">
                            <!--<input type="button" value="SIGN UP"/>-->
                            <div class="right_pp_button_wrapper">
                                <button class="pp_button_active" type="submit" name="submit">SIGN UP</button>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <!--                    </form>-->
                    <?php echo form_close(); ?>
                </div>
            </div>

        </div><!-- end of content-->

        <div class="overlay-bg">
            <div class="overlay-content">
                <h1 class="upper_cased text_medium pp_red">thank you!</h1>
                <p class="text_regular smaller">You will recieve registration mail on address <span id="user_email">@</span></p>
                <button class="pp_button_active upper_cased">login</button>
            </div>
        </div> 


        <!--                 footer -->
        <div id="footer" class="f_active">
            <div class="colmask threecol">
                <div class="colmid">
                    <div class="colleft">
                        <div class="col1">
                            <!--Column 1 start--> 
                            <div class="text_wrapper_middle_part">
                                <div class="text_light smaller white">Copyright &copy; 2013 Powporn. All rights reserved.</div>
                            </div>
                            <!--Column 1 end--> 
                        </div>
                        <div class="col2">
                            <!--Column 2 start--> 
                            <ul class="footer_l">
                                <li><a href="./whatisrealpp.html" class="text_light red_on_hover capitalized" >rules</a></li>
                                <li><a href="./ucreate.html" class="text_light red_on_hover capitalized">payment</a></li>
                                <li><a href="./finalproducts.html" class="text_light red_on_hover capitalized">shipping services</a></li>
                                <li><a href="./finalproducts.html" class="text_light red_on_hover capitalized">CLIENT SERVICES</a></li>
                            </ul>
                            <!--Column 2 end--> 
                        </div>
                        <div class="col3">
                            <!--Column 3 start--> 
                            <div id="footer_switcher_wrapper">
                                <div id="footer_switcher" class="active"> 
                                </div>
                            </div>
                            <!--Column 3 end--> 
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
                
        if (errors.length > 0) {

            var errorString = '';
         
            for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
                errorString += errors[i].message;
            }
        
            var errorOutputDiv = document.getElementById("error_output_section");
            errorOutputDiv.innerHTML = errorString;
            alert(errorString);
            if (evt && evt.preventDefault) {
                evt.preventDefault();
            } else if (event) {
                event.returnValue = false;
            }
        }else{
            //everything ok
            //                    var validUserEmailElement = document.getElementById("user_email");
            //                    var emailAddressElement = document.getElementById("tf_email_address");
            //
            //                    validUserEmailElement.innerHTML =  emailAddressElement.value;
            //                    
            //                    $('.overlay-bg').show();
        }
    });
            
        </script>

    </body>
</html>
