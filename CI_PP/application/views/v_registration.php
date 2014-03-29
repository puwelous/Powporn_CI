        <!-- content -->
        <div id="content">

            <div class="content_wrapper">

                <div class="container">
                    <div class="title upper_cased black">
                        Registration
                    </div>
                    <div id="error_output_section" class="text_medium capitalized_first_only">
                    </div>

                    <?php echo validation_errors('<p class="error" style="display:inline">'); ?>
                    <?php
                    $attributes = array('name' => 'pp_form_name');
                    echo form_open("c_user/register", $attributes);
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

<!--        <script type="text/javascript">
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
            
        </script>-->
