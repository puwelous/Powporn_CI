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
            <!--<div class="title upper_cased black">-->
            <h1>
                4. payment for order
            </h1>
            <!--</div>-->
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
                    <h2>
                        shipping method
                    </h2>                            
                    <div>
                        <div id="final_shipping_method" class="text_light upper_cased"><?php echo $shipping_method->sm_name; ?>(+<?php echo $shipping_method->sm_price; ?>&euro;)</div>
                    </div>
                </div>
                <div class="text_field_wrapper right">
                    <h2>
                        payment method
                    </h2>                            
                    <div>
                        <div id="final_payment_method" class="text_light upper_cased"><?php echo $payment_method->pm_name; ?>(+<?php echo $payment_method->pm_cost; ?>&euro;)</div>
                    </div> 
                    <?php if ( $payment_method->pm_name == 'paypal' ): ?>
                    <h2>
                        pay with paypal
                    </h2>
                    <div>
                        <form action='expresscheckout' METHOD='POST'>
                            <input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' align='top' alt='Check out with PayPal'/>
                        </form> 
                    </div> 
                    <?php endif; ?>
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
                    <!--<div style="clear:both;"></div>-->
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>      
        </form>
    </div>

</div>




