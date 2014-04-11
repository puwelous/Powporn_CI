<div class="gallery_gradient_wrapper">
    <div class="gallery_gradient right">
    </div>
    <div class="gallery_gradient left">
    </div>             
</div> 

<!-- content -->
<div id="content">
    <div class="content_wrapper">


        <!-- ******************* final preview section ******************* -->
        <div class="container">
            <!-- Title -->
            <h1>
                5. paypal payment method
            </h1>
            <div class="red_line">
            </div>

            <div class="text_fields_wrapper">

                <div class="text_field_wrapper left">
                    <!--<div class="text_medium upper_cased bold">items</div>-->
                    <h2>
                        items
                    </h2>
                    <div class="final_items_list">
                        <?php
                        for ($i = 0; $i < count($ordered_products); ++$i):
                            ?>
                            <div class="final_item">
                                <span class="text_light smaller upper_cased bold"><?php echo $ordered_products[$i]->pd_product_name; ?></span>
                                <span class="text_light smaller upper_cased">by:<span class="text_light upper_cased bold"><?php echo $ordered_products[$i]->u_nick; ?></span></span>
                                <span class="text_light smaller upper_cased bold"><?php echo $ordered_products[$i]->psfp_name; ?></span>
                                <span class="text_light smaller"><?php echo $ordered_products[$i]->op_amount; ?>&nbsp;pc.</span>
                                <span class="text_light smaller upper_cased">price<span class="text_light lower_cased">/ks:</span><span class="text_light lower_cased bold"><?php echo $ordered_products[$i]->pd_price; ?>&euro; dph</span></span>                                
                            </div>
                        <?php endfor; ?>
                    </div>
                    <!--<div class="text_medium upper_cased bold">shipping address</div>-->
                    <h2>
                        shipping address
                    </h2>
                    <div class="address">
                        <div class="text_light upper_cased">
                            <?php echo $order_address['oa_name']; ?>
                        </div>
                        <div class="text_light upper_cased">
                            <?php echo $order_address['oa_address']; ?>
                        </div>
                        <div class="text_light upper_cased">
                            <?php echo $order_address['oa_zip']; ?>&nbsp;<?php echo $order_address['oa_city']; ?>
                        </div>
                        <div class="text_light upper_cased">
                            <?php echo $order_address['oa_country']; ?>
                        </div>
                    </div>
                    <h2>
                        email address
                    </h2>     
                    <div class="final_email_address">
                        <div class="text_light upper_cased">
                            <?php echo $order_address['oa_email_address']; ?>
                        </div> 
                    </div>
                    <!--<div class="text_medium upper_cased bold">payment method</div>-->
                    <h2>
                        payment method
                    </h2>                            
                    <div>
                        <div id="final_payment_method" class="text_light upper_cased"><?php echo $payment_method->pm_name; ?>(<?php echo $payment_method->pm_cost; ?>&euro;)</div>
                    </div>
                    <h2>
                        shipping method
                    </h2>                            
                    <div>
                        <div id="final_shipping_method" class="text_light upper_cased"><?php echo $shipping_method->sm_name; ?>(<?php echo $shipping_method->sm_price; ?>&euro;)</div>
                    </div>                        
                </div>
                <div class="text_field_wrapper right">
                    <?php
                    $attributes = array('name' => 'pp_form_name', 'style' => 'height:100%;');
                    echo form_open("c_paypal/do_billing", $attributes);
                    ?>                    
                    <span class="text_light">PayPal direct</span>
                    <input type = "radio"
                           class="css-checkbox"
                           name = "paypal_or_card_type"
                           id = "paypal"
                           value = "paypal"
                           checked = "checked" />
                    <label for="paypal" class="css-label">&nbsp;</label>
                    <div style="clear:both;"></div>
                    <span class="text_light">PayPal Credit Card</span>
                    <input type = "radio"
                           class="css-checkbox"
                           name = "paypal_or_card_type"
                           id = "credit_card"
                           value = "credit_card"/>
                    <label for="credit_card" class="css-label">&nbsp;</label>
                    <div style="clear:both;"></div>  
                    <button id="buy_button" class="pp_button_active" type="submit" name="submit">Choose PayPal method and continue</button>
                    <?php echo form_close(); ?>
                </div>
            </div>

            <div style="clear:both;"></div>
            <div class="bottom_wrapper">
                <div class="bottom_wrapper left">
                    <div class="left_pp_button_wrapper">
                        <!--<button class="pp_button_passive fl_left" type="submit" name="submit">BACK</button>-->
                        <?php echo anchor('c_shopping_cart/index', 'BACK', array('class' => 'pp_button_passive fl_left')); ?>
                        <!--<a href="" class="pp_button_passive fl_left">BACK</a>-->
                    </div>
                </div>
                <div class="bottom_wrapper right">
                    <!--<input type="button" value="SIGN UP"/>-->                   
                    <div class="fl_right">
                        <div class="text_medium upper_cased bold">total&nbsp;&nbsp;&nbsp;<span class="pp_red"><?php echo $total; ?>&nbsp;&euro;</span></div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="right_pp_button_wrapper">
                        <!--<button id="buy_button" class="pp_button_active" type="submit" name="submit">Confirm billing!</button>-->
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>      
        </form>
    </div>

</div>



