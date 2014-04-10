<script type="text/javascript">
    //    $(document).ready(function(){    
    //
    //        var formerShippingMethodPrice = parseFloat( <?php //echo $shipping_methods[0]->sm_price;  ?> );
    //
    //        $(".add_one_item_wrapper").click( function(){
    //                    
    //            var updatedSpanObject = $(this).closest(".product_detail_line").find("span.value_wrapper").find("span");
    //
    //            // adding item count
    //            var newItemsCount = parseInt( updatedSpanObject.html() ) + 1;
    //            updatedSpanObject.html(newItemsCount);
    //            
    //            // updating subtotal value
    //            var valuePerItem = parseFloat($(this).closest(".cart_list_item").find("input[name=ordered_product_item_price]").val());
    //            
    //            // updating first section
    //            var actualSubtotal = parseFloat($("#subtotal_first_section_sum").html());
    //
    //            actualSubtotal += valuePerItem;
    //            
    //            $("#subtotal_first_section_sum").html(new Number(actualSubtotal).toFixed(2));
    //            
    //            // updating second section
    //            var actualSubtotalSecondSection = parseFloat( $('#subtotal_second_section_sum').html());
    //            
    //            actualSubtotalSecondSection += valuePerItem;
    //            $("#subtotal_second_section_sum").html(new Number(actualSubtotalSecondSection).toFixed(2));
    //        });
    //
    //  
    //        $(".subtract_one_item_wrapper").click( function(){
    //                                    
    //            var updatedSpanObject = $(this).closest(".product_detail_line").find("span.value_wrapper").find("span");
    //
    //            var newItemsCount = parseInt( updatedSpanObject.html() ) - 1;  
    //            if( newItemsCount <= 0)
    //                return;  
    //            updatedSpanObject.html(newItemsCount);
    //                    
    //            // updating subtotal value
    //            var valuePerItem = parseFloat($(this).closest(".cart_list_item").find("input[name=ordered_product_item_price]").val());
    //            
    //            var actualSubtotal = parseFloat($("#subtotal_first_section_sum").html());
    //
    //            actualSubtotal -= valuePerItem;
    //            
    //            $("#subtotal_first_section_sum").html(new Number(actualSubtotal).toFixed(2));
    //
    //
    //            // updating second section
    //            var actualSubtotalSecondSection = parseFloat( $('#subtotal_second_section_sum').html());
    //            
    //            actualSubtotalSecondSection -= valuePerItem;
    //            $("#subtotal_second_section_sum").html(new Number(actualSubtotalSecondSection).toFixed(2));
    //        });
    //        
    //        $("label[for^=shipping_method_]").click( function(){
    //                               
    //            var actualSubtotalSecondSection = parseFloat( $('#subtotal_second_section_sum').html());
    //            var newSubtotalSecondSection;
    //                                    
    //            var selected_shipping_method_price = parseFloat($(this).parent('li').children(".shipping_method_price_wrapper").children(".shipping_method_price").html());
    //            
    //            // newSubtotalSecondSection = add new shipping method price, subtract old shipping method price
    //            newSubtotalSecondSection = actualSubtotalSecondSection + selected_shipping_method_price - formerShippingMethodPrice;
    //            
    //            // store for next call
    //            formerShippingMethodPrice = selected_shipping_method_price;
    //            
    //            $("#subtotal_second_section_sum").html(new Number(newSubtotalSecondSection).toFixed(2));
    //        });   
    //        
    //        $("label[for=address_other]").click( function(){
    //            $("li.hidable").css('visibility', 'visible');
    //        });
    //        
    //        $("label[for=address_same]").click( function(){
    //            $("li.hidable").css('visibility', 'hidden');
    //        });
    //        
    //        $("label[for^=payment_method_]").click( function(){
    //            $("#final_payment_method").html($(this).siblings( "input" ).val());
    //        });        
    //        
    //        $("html .pp_button_active:not(.pp_button_active:last)").click( function(){
    //            $("div.content_wrapper").animate({
    //                left: ("-=" + 815)
    //            }, 2000);
    //        });          
    //                
    //        $(".pp_button_passive").click( function(){
    //            $("div.content_wrapper").animate({
    //                left: ("+=" + 815)
    //            }, 2000);
    //        });                
    //                
    //        $(".cart_list").mCustomScrollbar();
    //    });
</script>


<div class="gallery_gradient_wrapper">
    <div class="gallery_gradient right">
    </div>
    <div class="gallery_gradient left">
    </div>             
</div> 

<!-- content -->
<div id="content">
    <div class="content_wrapper">
        <!-- ******************* order section ******************* -->
        <div class="container">
            <!-- Title -->
            <!--<div class="title upper_cased black">-->
            <h1>
                order details
            </h1>
            <!--</div>-->
            <div class="red_line">
            </div>

            <div class="text_fields_wrapper">

                <div class="text_field_wrapper left">
                    <!--<div class="text_medium upper_cased bold">items</div>-->
                    <h2>
                        variable symbol (invoice id):
                    </h2>
                    <div>
                        <div class="text_light upper_cased"><?php echo $invoice_id; ?></div>
                    </div>   
                    <h2>
                        total sum:
                    </h2>
                    <div>
                        <div class="text_light upper_cased"><?php echo $total; ?></div>
                    </div>                      
                </div>
                <div class="text_field_wrapper right">
                    <!--<div class="text_medium upper_cased bold">items</div>-->                            
                </div>
            </div>

            <div style="clear:both;"></div>
<!--            <div class="bottom_wrapper">
                <div class="bottom_wrapper left">
                    <div class="left_pp_button_wrapper">
                        <button class="pp_button_passive fl_left" type="submit" name="submit">BACK</button>
                        <?php echo anchor('c_shopping_cart/index', 'BACK', array('class' => 'pp_button_passive fl_left')); ?>
                        <a href="" class="pp_button_passive fl_left">BACK</a>
                    </div>
                </div>
                <div class="bottom_wrapper right">
                    <input type="button" value="SIGN UP"/>
                    <div class="fl_right">
                        <div class="text_medium upper_cased bold">total&nbsp;&nbsp;&nbsp;<span class="pp_red"><?php echo $total; ?>&nbsp;&euro;</span></div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="right_pp_button_wrapper">
                        <button id="buy_button" class="pp_button_active" type="submit" name="submit">BUY!</button>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div>-->
        </div>      
        <!--</form>-->
    </div>

</div><!-- end of content-->
<!--<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>-->
