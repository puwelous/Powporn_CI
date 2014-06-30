<!-- content -->
<script>
    $(document).ready(function(){
        
        $( ".applied_component_item" ).on( "click", function() {

            // turn all strokes on SVG paths
            $('#ucreate_vector_section svg path').css("stroke", "none");

            var existing_vector = $('#ucreate_vector_section svg path[data-id="'+$(this).data("identity")+'"]'); 
            if( existing_vector.length ){
                existing_vector.css( "stroke", "black" );
                existing_vector.css( "stroke-dasharray", "5,5" );
            }   

            $('.applied_component_item').css("color","black");
            $(this).css("color","red");
            $('.applied_component_colour_possibilities').hide();

            var existing_colour_possibilities = $('.applied_component_colour_possibilities[data-identity="'+$(this).data("identity")+'"]'); 
            if( existing_colour_possibilities.length ){
                //                    existing_vector.css( "stroke", "black" );
                //                    existing_vector.css( "stroke-dasharray", "5,5" );
                existing_colour_possibilities.show();
            }                 
        });        
        
        
        var rasterCanvas = document.getElementById('raster_canvas');
        var vectorCanvas = document.getElementById('svg_canvas');
        var rasterCanvasContext = null;
        var vectorCanvasContext = null;
        
        if( rasterCanvas.getContext && vectorCanvas.getContext){
            rasterCanvasContext = rasterCanvas.getContext('2d');
            vectorCanvasContext = vectorCanvas.getContext('2d');
        }else{
            alert('Your browser does not support HTML5!');
        }

        // TODO: delete me later!
        $(".component_add").click( function(){

            var component = $(this).parent();

            var cmp_identity = component.data("identity").toString();

            var cmp_is_allowed_multiple = ( component.data("multiple").toString() === 'true' );

            if ( !cmp_is_allowed_multiple ){

                var already_existing_obj = $('#ucreate_image_section img[data-id="'+cmp_identity+'"]');
                //alert(obj.html());
                if( already_existing_obj.length ){
                    alert('Component has been already used in composition :)');
                    return;
                }
            }
            
            // add image to ucreate section
            var cmp_src = component.data("src");

            var img = $('<img class="ucreate_image">'); //Equivalent: $(document.createElement('img'))

            img.attr('src', cmp_src);
            img.attr('data-id', cmp_identity);
            img.attr('style', 'z-index: 3');


            img.appendTo('#ucreate_image_section');
            
            // add price to current price
            var cmp_price = parseFloat(component.data("price"));
            var actual_price = parseFloat($("#ucreate_price").html());
            actual_price += cmp_price;
            
            $("#ucreate_price").html(new Number(actual_price).toFixed(2));
            
            
            // append new element to applied components list
            const applied_components_list_item_id = "applied_components_list_item_" + cmp_identity;
            var new_applied_component_item = $('<div id=' + applied_components_list_item_id + ' class="ucreate_left_section_list_item vertical applied_component_item">' + component.data("name") +'</div>');
            new_applied_component_item.attr('data-identity', cmp_identity);
            new_applied_component_item.attr('data-price', cmp_price);
            
            //new_applied_component_item.appendTo("#applied_components_list");
            
            // apply to left section - my adds
            new_applied_component_item.appendTo("#my_adds_section .ucreate_left_section_list");
             
            $( "#" + applied_components_list_item_id ).on( "click", function() {

                // turn all strokes on SVG paths
                $('#ucreate_vector_section svg path').css("stroke", "none");

                var existing_vector = $('#ucreate_vector_section svg path[data-id="'+$(this).data("identity")+'"]'); 
                if( existing_vector.length ){
                    existing_vector.css( "stroke", "black" );
                    existing_vector.css( "stroke-dasharray", "5,5" );
                }                 

                $('.applied_component_item').css("color","black");
                $(this).css("color","red");
                $('.applied_component_colour_possibilities').hide();

                var existing_colour_possibilities = $('.applied_component_colour_possibilities[data-identity="'+$(this).data("identity")+'"]'); 
                if( existing_colour_possibilities.length ){
                    //                    existing_vector.css( "stroke", "black" );
                    //                    existing_vector.css( "stroke-dasharray", "5,5" );
                    existing_colour_possibilities.show();
                }                 
            });
            
            // check if vector representation exists
            var existing_vector = $('#ucreate_vector_section svg path[data-id="'+$(this).data("identity")+'"]'); 
            if( existing_vector.length ){
                //                existing_vector.css( "stroke", "black" );
                //                existing_vector.css( "stroke-dasharray", "5,5" );
            }
            
            // display remove button
            component.children('.component_remove').show();
            
            // hide self
            $(this).hide();
            //$('#loading_gif').hide();
        }); 
        
        
        $(".component_remove").click( function(){
            //$('#loading_gif').show();

            var component = $(this).parent();

            var cmp_identity = component.data("identity").toString();
            
            // substract price
            var cmp_price_removing = parseFloat(component.data("price"));
            var actual_price = parseFloat($("#ucreate_price").html());
            actual_price -= cmp_price_removing;
            $("#ucreate_price").html(new Number(actual_price).toFixed(2));
                
            // remove img from ucreate center panel
            var already_existing_obj = $('#ucreate_image_section img[data-id="'+cmp_identity+'"]'); 
            if( already_existing_obj.length ){
                already_existing_obj.remove();
            }
                
            // change colour of related vector object to none
            var already_existing_vector = $('#ucreate_vector_section svg path[data-id="'+cmp_identity+'"]'); 
            if( already_existing_vector.length ){
                //already_existing_obj.remove();
                //alert('Exists!');
                already_existing_vector.css( "stroke", "none" );
                already_existing_vector.css( "fill", "none" );
            }                
                
            // remove from applied components list
            const applied_components_list_item_id = "applied_components_list_item_" + cmp_identity;
            $( "#" + applied_components_list_item_id ).remove();
           
            // hide colour range if exists
            var colour_range_section = $('.applied_component_colour_possibilities[data-identity="'+cmp_identity+'"]');            
            if( colour_range_section.length ){
                // unset selected style of selected colour
                var selected_colour = colour_range_section.children('.selected');
                if ( selected_colour.length ){
                    selected_colour.removeClass('selected');
                    selected_colour.addClass('notselected');
                }
                colour_range_section.hide();
            }
                
            // check if vector representation exists
            //            var existing_vector = $('#ucreate_vector_section svg path[data-id="'+$(this).data("identity")+'"]'); 
            //            if( existing_vector.length ){
            //                //already_existing_obj.remove();
            //                //alert('Exists!');
            //                existing_vector.css( "fill", "red" );
            //            }
            
            // display remove button
            component.children('.component_add').show();
            
            // hide self
            $(this).hide();            
            
            //$('#loading_gif').hide();
        });        
        
        $(".applied_component_colour").click( function(){
            
            // set borders aka active element :P
            $(this).parent().children(".applied_component_colour").removeClass("selected");
            $(this).parent().children(".applied_component_colour").addClass("notselected");
            $(this).removeClass("notselected");
            $(this).addClass("selected");
            
            const colour = $(this).data('colour');
            const cmp_id = $(this).parent().data('identity');
            // check if vector representation exists
            var vector_representation = $('#ucreate_vector_section svg path[data-id="'+cmp_id+'"]'); 
            if( vector_representation.length ){
                vector_representation.css( "fill", colour );
            }
        });       
        
        $(".product_size").click( function(){
            $('.product_size').css("color","black");
            $(this).css("color","red");
        });
        
        
        $("#create_button").click( function(e){
            $('#loading_gif').show();
            
            e.preventDefault();
            
            // set borders aka active element :P

            // basic product data
            var product_data = {
                product_id : $('input[name=edited_product_id]').val(),
                name : $("#ucreate_product_name").html(),
                price : parseFloat($("#ucreate_price").html()),
                description : $("#ucreate_description").html(),
                sex: $("#ucreate_sex").html(),
                creator_nick: $("#ucreate_creator_nick").html()
            };
            
            var applied_components_value_pairs = new Array();
            
            //var applied_components = $("#applied_components_list").children();
            $('#applied_components_list').children('div').each(function () {
                //alert($(this).data('identity')); // "this" is the current element in the loop
                //applied_component_ids.push($(this).data('identity'));
                var single_value_pair = {};
                // identity of the component
                single_value_pair['component_id'] = $(this).data('identity');
                
                // colour id of the component
                var component_colours_wrapper = $('.applied_component_colour_possibilities[data-identity="'+single_value_pair['component_id'].toString()+'"]');
                if( component_colours_wrapper.length ){
                    var selected_colour_element = component_colours_wrapper.children('.applied_component_colour.selected');
                    if( selected_colour_element.length ){
                        single_value_pair['component_colour_id'] = selected_colour_element.data('colour_id');
                    }else{
                        single_value_pair['component_colour_id'] = null;
                    }
                }else{
                    single_value_pair['component_colour_id'] = null;
                }
                
                applied_components_value_pairs.push( single_value_pair );
            });

            // applied components data
            var applied_components_data = {
                applied_components_value_pairs : applied_components_value_pairs
            };

            var picture;


            
            //TODO: .... render basic image 
            const basic_image_src = $('#basic_image').attr('src');
            var newBasicImage = new Image();
            newBasicImage.src = basic_image_src;
            newBasicImage.onload = function() {
                vectorCanvasContext.drawImage( newBasicImage , 0, 0);
            };
            
            setTimeout(function(){
                // draw svg
                var xml = (new XMLSerializer).serializeToString( document.getElementById("svg_element") ); 
                canvg(vectorCanvas, svgfix(xml), {  ignoreMouse: true, ignoreAnimation: true, ignoreClear: true, ignoreDimensions: true  });            

                // render components rasters
                $('#applied_components_list').children('div').each(function () {
                    //alert($(this).data('identity')); // "this" is the current element in the loop
                    //applied_component_ids.push($(this).data('identity'));
                    var single_value_pair = {};
                    // identity of the component
               
                    const component_id = $(this).data('identity');

                    var applied_component = $('#components').children('.component[data-identity="' + component_id.toString() +'"]');
                
                    const applied_component_img_src = applied_component.data('src');
                
                    var newComponentImage = new Image();
                    newComponentImage.src = applied_component_img_src;
                    newComponentImage.onload = function() {
                        rasterCanvasContext.drawImage( newComponentImage , 0, 0);
                    };                
                });
                
                setTimeout(function(){
                    vectorCanvasContext.drawImage(rasterCanvas,0,0);
                    picture = vectorCanvas.toDataURL();
                    //window.open( picture );  
                
                    var ucreate_data = {
                        product_data: product_data,
                        applied_components_data : applied_components_data,
                        picture_data: picture
                    };
 
                    $.ajax({
                        url: "<?php echo site_url('c_ucreate/create'); ?>",
                        type: 'POST',
                        async : false,
                        dataType : 'json',
                        data: ucreate_data,
                        success: function(response) {
                            
                            $('#loading_gif').hide();
                            if( response.error ){
                                alert( response.msg );
                            }else{
                                alert( response.msg );
                                window.location.href = "<?php echo site_url('/c_customer/products_customer'); ?>";
                            };
                           
                        }, error : function(XMLHttpRequest, textStatus, errorThrown) {     
                            $('#loading_gif').hide();
                            alert('error occured! contact administrator!');
                            //possibly propagate error message
                        }
                    });                
                
                },1000);                

            },1000);
            return false;            
        });  
        
        $(".category").click( function(){
            //$('.product_size').css("color","black");
            //$(this).css("color","red");
            const category_id = $(this).data('identity');
            //alert(category_id);
            var $category_components_block = $('.category_components[data-identity="'+category_id+'"]');
            $('.category_components').hide();
            $category_components_block.show();
        });
        
        $(".category_single_component").click( function(){

            var component = $(this);

            var cmp_identity = component.data("identity").toString();

            var cmp_is_allowed_multiple = ( component.data("multiple").toString() === 'true' );

            if ( !cmp_is_allowed_multiple ){

                var already_existing_obj = $('#ucreate_image_section img[data-id="'+cmp_identity+'"]');
                //alert(obj.html());
                if( already_existing_obj.length ){
                    alert('Component has been already used in composition :)');
                    return;
                }
            }
            
            // add image to ucreate section
            var cmp_src = component.data("src");

            var img = $('<img class="ucreate_image">'); //Equivalent: $(document.createElement('img'))

            img.attr('src', cmp_src);
            img.attr('data-id', cmp_identity);
            img.attr('style', 'z-index: 3');


            img.appendTo('#ucreate_image_section');
            
            // add price to current price
            var cmp_price = parseFloat(component.data("price"));
            var actual_price = parseFloat($("#ucreate_price").html());
            actual_price += cmp_price;
            
            $("#ucreate_price").html(new Number(actual_price).toFixed(2));
            
            
            // append new element to applied components list
            const applied_components_list_item_id = "applied_components_list_item_" + cmp_identity;
            var new_applied_component_item = $('<div id=' + applied_components_list_item_id + ' class="ucreate_left_section_list_item vertical applied_component_item">' + component.data("name") +'</div>');
            new_applied_component_item.attr('data-identity', cmp_identity);
            new_applied_component_item.attr('data-price', cmp_price);
            
            //new_applied_component_item.appendTo("#applied_components_list");
            
            // apply to left section - my adds
            new_applied_component_item.appendTo("#my_adds_section .ucreate_left_section_list");
             
            $( "#" + applied_components_list_item_id ).on( "click", function() {

                // turn all strokes on SVG paths
                $('#ucreate_vector_section svg path').css("stroke", "none");

                var existing_vector = $('#ucreate_vector_section svg path[data-id="'+$(this).data("identity")+'"]'); 
                if( existing_vector.length ){
                    existing_vector.css( "stroke", "black" );
                    existing_vector.css( "stroke-dasharray", "5,5" );
                }                 

                $('.applied_component_item').css("color","black");
                $(this).css("color","red");
                $('.applied_component_colour_possibilities').hide();

                var existing_colour_possibilities = $('.applied_component_colour_possibilities[data-identity="'+$(this).data("identity")+'"]'); 
                if( existing_colour_possibilities.length ){
                    //                    existing_vector.css( "stroke", "black" );
                    //                    existing_vector.css( "stroke-dasharray", "5,5" );
                    existing_colour_possibilities.show();
                }                 
            });
            
            // check if vector representation exists
            var existing_vector = $('#ucreate_vector_section svg path[data-id="'+$(this).data("identity")+'"]'); 
            if( existing_vector.length ){
                //                existing_vector.css( "stroke", "black" );
                //                existing_vector.css( "stroke-dasharray", "5,5" );
            }
            
            // display remove button
            //            component.children('.component_remove').show();
            
            // hide self
            //            $(this).hide();
            //$('#loading_gif').hide();
        });        
        
        
        $(".control_icon").click( function(){
            var clickedControlIconClasses = this.classList;
            if( clickedControlIconClasses.length < 2 ){
                alert('Class names of control icons are incorrect! Contact administrator!');
                return;
            }
            
            const secondClassName = clickedControlIconClasses[1];
            
            var elementToBeManipulatedLeft = $(".ucreate_left_section_first_row_symbol." + secondClassName).parent().parent();

            if( elementToBeManipulatedLeft.length ){
                elementToBeManipulatedLeft.slideToggle();
            }else{
                
                var elementToBeManipulatedRight = $(".ucreate_right_section_first_row_symbol." + secondClassName).parent().parent();
                if( elementToBeManipulatedRight.length ){
                    elementToBeManipulatedRight.slideToggle();
                    
                    if( elementToBeManipulatedRight.is("#toolset_section") ){
                        $("#concrete_toolset_section").slideToggle();
                    }else{
                        
                    };
                }else{
                    alert('There is no element to be toggled found!');
                }
            }

        });
        //            <div id="control_icon_my_adds" class="control_icon icon_my_adds">
        //            </div>
        //            <div id="control_icon_layers" class="control_icon icon_layers">
        //            </div>
        //            <div id="control_icon_size_and_quantity" class="control_icon icon_size_and_quantity">
        //            </div>        
        
        
        // hide Add button per each applied components
<?php if ($applied_components_full_info) : ?>
    <?php foreach ($applied_components_full_info as $singleAppliedComponentFullInfo): ?>
                    //            $('.component_add[data-identity="' + <?php echo $singleAppliedComponentFullInfo->getComponentId(); ?> +'"]').hide();
                    //            $('.component_remove[data-identity="' + <?php echo $singleAppliedComponentFullInfo->getComponentId(); ?> +'"]').show();

        <?php if ($singleAppliedComponentFullInfo->getColourId() && $singleAppliedComponentFullInfo->getColourValue()): ?>
                            // paint SVG path
                            var already_existing_vector = $('#ucreate_vector_section svg path[data-id="'+<?php echo $singleAppliedComponentFullInfo->getComponentId(); ?>+'"]'); 
                            if( already_existing_vector.length ){
                                already_existing_vector.css( "fill", "<?php echo $singleAppliedComponentFullInfo->getColourValue(); ?>" );
                            }
                                                                                                                                                                                                                                                                                                                                    
                            // set colour from colour range to be selected
                            var colour_range_section = $('.applied_component_colour_possibilities[data-identity="'+<?php echo $singleAppliedComponentFullInfo->getComponentId(); ?>+'"]');            
                            if( colour_range_section.length ){
                                // unset selected style of selected colour
                                var selected_colour = colour_range_section.children('.applied_component_colour[data-colour="<?php echo $singleAppliedComponentFullInfo->getColourValue(); ?>"]');
                                if ( selected_colour.length ){
                                    selected_colour.removeClass('notselected');
                                    selected_colour.addClass('selected');
                                }
                            }                    
        <?php endif; ?>      
    <?php endforeach; ?>
<?php endif; ?>
        
    });
    
  
</script>

<div class="content_unextended">

    <div id="ucreate_left">
        <input type="hidden" name="edited_product_id" value="<?php echo $product->getId() ?>" />        

        <!-- control icons -->
        <div class="ucreate_left_section">
            <div id="control_icon_my_adds" class="control_icon icon_my_adds">
            </div>
            <div id="control_icon_layers" class="control_icon icon_layers">
            </div>
            <div id="control_icon_size_and_quantity" class="control_icon icon_size_and_quantity">
            </div>
            <div style="clear: both"></div>
        </div>          

        <div class="line pp_red"></div>

        <?php
//        $attributes = array('name' => 'pp_add_product_to_cart_form');
//        echo form_open("c_preview/add_to_cart/" . $previewed_product->pd_id, $attributes);
//        echo form_hidden('product_id', $previewed_product->pd_id);
        ?>


        <!-- product name -->
        <div class="ucreate_left_section">
            <h2>
                <section id="ucreate_product_name" contenteditable="true">
                    <?php echo $product->getName(); ?>
                </section>
            </h2>
        </div>
        <div class="line"></div>

        <!-- layers -->
        <!-- empty ! -->

        <!-- my adds -->
        <div id="my_adds_section" class="ucreate_left_section" style="display:none">
            <div class="ucreate_left_section_first_row">
                <div class="ucreate_left_section_first_row_symbol icon_my_adds">
                </div>
                <div class="ucreate_left_section_first_row_title">
                    my adds
                </div>
            </div>
            <div class="ucreate_left_section_list">
                <?php if ($applied_components_full_info) : ?>
                    <?php foreach ($applied_components_full_info as $singleAppliedComponentFullInfo): ?>
                        <div id="applied_components_list_item_<?php echo $singleAppliedComponentFullInfo->getComponentId(); ?>"
                             data-identity="<?php echo $singleAppliedComponentFullInfo->getComponentId(); ?>"
                             data-price="<?php echo $singleAppliedComponentFullInfo->getComponentPrice(); ?>"
                             class="ucreate_left_section_list_item vertical applied_component_item">
                                 <?php echo $singleAppliedComponentFullInfo->getComponentName(); ?>
                        </div>              
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>  
            <div class="line"></div>            
        </div>


        <!-- size and quantity -->
        <div id="size_and_quantity_section" class="ucreate_left_section" style="display:none">
            <div class="ucreate_left_section_first_row">
                <div class="ucreate_left_section_first_row_symbol icon_size_and_quantity">
                </div>
                <div class="ucreate_left_section_first_row_title">
                    size &AMP; quantity
                </div>
            </div>
            <div class="ucreate_left_section_list">
                <div class="ucreate_left_section_list_item horizontal product_size">
                    s
                </div>
                <div class="ucreate_left_section_list_item horizontal product_size">
                    m
                </div>     
                <div class="ucreate_left_section_list_item horizontal product_size">
                    l
                </div>
                <div class="ucreate_left_section_list_item horizontal product_size">
                    xl
                </div> 
                <div class="ucreate_left_section_list_item horizontal product_size">
                    xxl
                </div>                
            </div>  
            <div class="line"></div>
        </div>


        <div id="size_and_quantity_section" class="ucreate_left_section">
            <h1>
                <span id="ucreate_price">
                    <?php echo $product->getPrice(); ?>
                </span>&euro;
            </h1>
        </div>

        <button id="create_button" type="button">CREATE !</button>
        <?php //echo form_close(); ?>
    </div>

    <div id="ucreate_center">  
        <div id="ucreate_vector_section"style="z-index: 2">
            <svg xmlns="http://www.w3.org/2000/svg" id="svg_element" title="test1" version="1.1" width="245" height="355" >
            <?php foreach ($optimized_ucreate_components_full_info_array as $optimizedSingleCategoryComponentFullInfo): ?>
                <?php if ($optimizedSingleCategoryComponentFullInfo->getSpecialComponents()): ?>
                    <?php foreach ($optimizedSingleCategoryComponentFullInfo->getSpecialComponents() as $specialComponentObject): ?>
                        <?php if ($specialComponentObject->getVectors()): ?>
                            <?php foreach ($specialComponentObject->getVectors() as $specialComponentObjectVector): ?>
                                <?php if ($specialComponentObjectVector): ?>
                                    <path data-id="<?php echo $specialComponentObject->getComponentObject()->getId(); ?>" 
                                          fill-rule="evenodd" 
                                          clip-rule="evenodd" 
                                          fill="none" 
                                          d="<?php echo $specialComponentObjectVector; ?>"/>
                                      <?php endif; ?>
                                  <?php endforeach; ?>
                              <?php endif; ?>
                          <?php endforeach; ?>
                      <?php endif; ?>
                  <?php endforeach; ?>
            </svg>
        </div>
        <div id="ucreate_image_section" >
            <!--basic image-->
            <?php
            $representation_urls = $product_representations->getUrls();
            if (!empty($representation_urls)) {
                $image_properties = array(
                    'id' => 'basic_image',
                    'src' => $representation_urls[0],
                    'alt' => $product_representations->getProductName(),
                    'title' => $product_representations->getProductName(),
                    'class' => 'ucreate_image',
                    'style' => 'z-index: 1'
                );
                echo img($image_properties);
            }
            ?>

            <!--applied components rasters-->
            <?php if ($applied_components_full_info) : ?>
                <?php foreach ($applied_components_full_info as $singleAppliedComponentFullInfo): ?>
                    <img class="ucreate_image"
                         src="<?php echo base_url($singleAppliedComponentFullInfo->getRasterURL()); ?>"
                         data-id="<?php echo $singleAppliedComponentFullInfo->getComponentId(); ?>"
                         style="z-index: 3"
                         >
                     <?php endforeach; ?> 
                 <?php endif; ?>
        </div>
        <div id="background_image_effect" style="position: absolute; width: 240px; height: 350px;">
            <?php
            $image_properties_basic_effect = array(
                'id' => 'basic_image_effect',
                'src' => 'assets/css/images/bottomshadow.png',
                'alt' => 'Image bottom effect',
                'style' => 'z-index: -1; position: absolute; width: 240px; height: 350px;'
            );
            echo img($image_properties_basic_effect);
            ?>
        </div>
    </div>
    <canvas id="svg_canvas" width="250" height="350" style="border: 1px solid black; display:none;">Your browser doesn't support canvas.</canvas>
    <canvas id="raster_canvas" width="250" height="350" style="border: 1px solid black; display:none;">Your browser doesn't support canvas.</canvas>            

    <div id="ucreate_right">
        <!-- control icons -->
        <div class="ucreate_right_section">
            <div id="control_icon_toolset" class="control_icon icon_toolset">
            </div>
            <div id="control_icon_materials_and_colors" class="control_icon icon_material">
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="line pp_red"></div>

        <!-- toolset aka component categories -->
        <div id="toolset_section" class="ucreate_right_section" style="display:none">
            <div class="ucreate_left_section_first_row">
                <div class="ucreate_right_section_first_row_symbol icon_toolset">
                </div>
                <div class="ucreate_right_section_first_row_title">
                    component categories
                </div>
            </div>
            <div class="ucreate_right_section_list">
                <?php foreach ($optimized_ucreate_components_full_info_array as $optimizedSingleCategoryComponentFullInfo): ?>
                    <?php if ($optimizedSingleCategoryComponentFullInfo->getCategory()): ?>
                        <div class="ucreate_right_section_list_item category" data-identity="<?php echo $optimizedSingleCategoryComponentFullInfo->getCategory()->getId(); ?>">
                            <div class="ucreate_right_section_list_item_icon">
                                <img src="<?php echo base_url($optimizedSingleCategoryComponentFullInfo->getCategory()->getURL()); ?>" >
                            </div>
                            <div class="ucreate_right_section_list_item_title">
                                <?php echo $optimizedSingleCategoryComponentFullInfo->getCategory()->getName(); ?>
                            </div>                 
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div> 
            <div class="line"></div>             
        </div>



        <!-- concrete toolset aka components -->
        <div id="concrete_toolset_section" class="ucreate_right_section" style="display:none">
            <?php for ($i = 0; $i < count($optimized_ucreate_components_full_info_array); $i++): ?>
                <?php $optimizedSingleCategoryComponentFullInfo = $optimized_ucreate_components_full_info_array[$i] ?>
                <?php if ($i != 0): ?>
                    <div class="ucreate_left_section_category_unit category_components" data-identity="<?php echo $optimizedSingleCategoryComponentFullInfo->getCategory()->getId(); ?>" style="display: none">
                    <?php else: ?>
                        <div class="ucreate_left_section_category_unit category_components" data-identity="<?php echo $optimizedSingleCategoryComponentFullInfo->getCategory()->getId(); ?>" style="display: block">
                        <?php endif; ?>                              
                        <div class="ucreate_left_section_first_row">
                            <div class="ucreate_right_section_first_row_title">
                                <?php echo $optimizedSingleCategoryComponentFullInfo->getCategory()->getName(); ?>
                            </div>
                        </div>
                        <div class="ucreate_right_section_list">
                            <?php if ($optimizedSingleCategoryComponentFullInfo->getSpecialComponents()): ?>
                                <?php foreach ($optimizedSingleCategoryComponentFullInfo->getSpecialComponents() as $specialComponentObject): ?>
                                    <?php if ($specialComponentObject->getComponentObject()): ?>
                                        <div class="ucreate_right_section_list_item">
                                            <div class="ucreate_right_section_list_item_icon">
                                            </div>
                                            <div class="ucreate_right_section_list_item_title category_single_component" 
                                                 data-identity="<?php echo $specialComponentObject->getComponentObject()->getId() ?>" 
                                                 data-price="<?php echo $specialComponentObject->getComponentObject()->getPrice(); ?>"
                                                 data-name="<?php echo $specialComponentObject->getComponentObject()->getName(); ?>"
                                                 data-src="<?php echo base_url(reset($specialComponentObject->getRasters())); ?>"
                                                 data-multiple="false">

                                                <?php echo $specialComponentObject->getComponentObject()->getName() ?>
                                            </div>                 
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>                    
                        </div>
                    </div>
                <?php endfor; ?>  
                <div class="line"></div> 
            </div>



            <!--        <h3>Categories</h3>
                    <div id="categories">
            <?php //foreach ($categories as $singleCategory): ?>
                                                            <div class="category"><?php //echo $singleCategory->getName();              ?>
                                                                <span class="tooltip"><?php //echo $singleCategory->getDescription();              ?></span>            
                                                            </div>
            <?php //endforeach; ?>
                    </div>
                    <div class="line pp_dark_gray"></div>-->

            <!--            <h3>Components</h3>
                        <div id="components">
            <?php //foreach ($ucreate_component_full_info_array as $singleComponentFullInfo): ?>
                                    <div class="component"
                                         data-src="<?php //echo base_url($singleComponentFullInfo->getRaster()->getPhotoUrl());              ?>"
                                         data-identity="<?php //echo $singleComponentFullInfo->getComponent()->getId();             ?>"
                                         data-price="<?php //echo $singleComponentFullInfo->getComponent()->getPrice();             ?>"
                                         data-name="<?php //echo $singleComponentFullInfo->getComponent()->getName();             ?>"
                                         data-multiple="false"
                                         >
                                        <span
                                            class="component_add"
                                            data-identity="<?php //echo $singleComponentFullInfo->getComponent()->getId();             ?>"
                                            >Add</span>
                                        <div class="component_name"><?php //echo $singleComponentFullInfo->getComponent()->getName();             ?>
                                            <span class="tooltip">Price: <?php //echo $singleComponentFullInfo->getComponent()->getPrice();             ?>&euro;</span>
                                        </div>
                                        <span
                                            class="component_remove"
                                            data-identity="<?php //echo $singleComponentFullInfo->getComponent()->getId();             ?>"
                                            >Remove</span>
                
                                    </div>
                                    <div style="clear: both"></div>
            <?php //endforeach; ?>
                        </div>
                        <div class="line pp_dark_gray"></div>-->

            <!--            <h3>Applied components</h3>
                        <div id="applied_components_list">
            <?php //foreach ($ucreate_applied_component_full_info_array as $singleAppliedComponent): ?>
                                    <div
                                        id="applied_components_list_item_<?php //echo $singleAppliedComponent->getComponent()->getId();             ?>"
                                        class="applied_component_item"
                                        data-identity="<?php //echo $singleAppliedComponent->getComponent()->getId();             ?>"
                                        data-price="<?php //echo $singleAppliedComponent->getComponent()->getPrice();             ?>"       
                                        >
            <?php //echo $singleAppliedComponent->getComponent()->getName(); ?>
                                    </div>
            <?php //endforeach; ?>            
                        </div>
                        <div class="line pp_dark_gray"></div>-->


            <!-- materials and colours -->
            <div class="ucreate_right_section" style="display:none">
                <div class="ucreate_left_section_first_row">
                    <div class="ucreate_right_section_first_row_symbol icon_material">
                    </div>
                    <div class="ucreate_right_section_first_row_title">
                        Materials &AMP; Colors
                    </div>
                </div>
                <div id="applied_component_colours">
                    <?php foreach ($optimized_ucreate_components_full_info_array as $optimizedSingleCategoryComponentFullInfo): ?>
                        <?php if ($optimizedSingleCategoryComponentFullInfo->getSpecialComponents()): ?>
                            <?php foreach ($optimizedSingleCategoryComponentFullInfo->getSpecialComponents() as $specialComponentObject): ?>
                                <div class="applied_component_colour_possibilities"  data-identity="<?php echo $specialComponentObject->getComponentObject()->getId(); ?>">
                                    <?php if (count($specialComponentObject->getColours()) > 0): ?>
                                        <?php //var_dump( $specialComponentObject->getColours()); ?>
                                        <?php foreach ($specialComponentObject->getColours() as $singleColour): ?>
                                            <div class="applied_component_colour notselected" data-colour_id="<?php echo $singleColour->getId() ?>" data-colour="<?php echo $singleColour->getValue() ?>" style="background-color: <?php echo '#' . $singleColour->getValue() ?>"></div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div> 
            </div>            
        </div>

    </div><!-- end of content-->
