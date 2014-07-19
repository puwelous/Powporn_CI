<!-- content -->
<script>
    $(document).ready(function(){

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

        $( ".applied_component_item" ).on( "click", function() {

            // turn all strokes on SVG paths off
            $('#ucreate_vector_section svg path').css("stroke", "none");

            var existing_vector = $('#ucreate_vector_section svg path[data-id="'+$(this).data("identity")+'"]');
            if( existing_vector.length ){
                existing_vector.css( "stroke", "black" );
                existing_vector.css( "stroke-dasharray", "5,5" );
            }

            $('.applied_component_item').removeClass("selected");
            $('.applied_component_item').addClass("notselected");
            $('.my_adds_component_item').removeClass("selected");
            $('.my_adds_component_item').addClass("notselected");
            
            $(this).removeClass("notselected");
            $(this).addClass("selected");

            
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
        /*
       
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
         */
        $(".applied_component_colour").click( function(){

            // set borders aka active element :P
            $(this).parent().children(".applied_component_colour").removeClass("selected");
            $(this).parent().children(".applied_component_colour").addClass("notselected");
            $(this).removeClass("notselected");
            $(this).addClass("selected");

            const cmp_id = $(this).parent().data('identity');
            const colour = $(this).data('colour');
            const colour_id = $(this).data('colour_id');
                        
            // take element for which the colour is being chosen
            var selected_component = null;
            
            if( $('.applied_component_item.selected').length ){
                // selected component is applied component
                selected_component = $('.applied_component_item.selected');
                selected_component.attr("data-selected-colour", colour);
                selected_component.attr("data-selected-colour-id", colour_id);                
            }else if ( $('.my_adds_component_item.selected').length ){
                selected_component = $('.my_adds_component_item.selected');
                selected_component.attr("data-selected-colour", colour);
                selected_component.attr("data-selected-colour-id", colour_id);
            }else{
                alert('Inconsistency!');
                return;
            }
            
            // check if vector representation exists and fullfil it with colour
            var vector_representation = $('#ucreate_vector_section svg path[data-id="'+cmp_id+'"]');
            if( vector_representation.length ){
                vector_representation.css( "fill", colour );
            };            
            
        });

        $(".category_single_component").click( function(){

            var component = $(this);

            var cmp_identity = component.data("identity").toString();
            var cmp_price = parseFloat(component.data("price"));

            // ask if representation already exists (ask whether component is already included)
            var found_component_representation = $('#ucreate_image_section img[data-id="'+cmp_identity+'"]');
            
            if( found_component_representation.length ){
                // representation already exists
                // check if multiple allowence is present
                var cmp_is_allowed_multiple = ( component.data("multiple").toString() === 'true' );
                if ( cmp_is_allowed_multiple ){
                    // add another same component to composition, so far no idea how to provide it, it will
                    // be probably deleted and substituted with different "subcategories" of components
                }else{
                    // component is not allowed to be multiplicit directly in composition, but might be in MY ADDS
                    if( confirm('Do you want to add this component additionaly to "MY ADDS"?') ){
                        // add component to my adds!
                        
                        // append new element to MY ADDS list
                        const my_adds_components_list_item_id = "my_adds_components_list_item_" + cmp_identity;
                        // check if such a MY ADD is already present
                        if( $('#'+my_adds_components_list_item_id).length ){
                            alert('Such a MY ADD is already present in MY ADDS list!');
                            return;
                        }
                        
                        var new_my_adds_component_item = $('<div id=' + my_adds_components_list_item_id + ' class="ucreate_left_section_list_item vertical my_adds_component_item notselected">' + component.data("name") +'</div>');
                        new_my_adds_component_item.attr('data-identity', cmp_identity);
                        new_my_adds_component_item.attr('data-price', cmp_price);

                        //new_applied_component_item.appendTo("#applied_components_list");

                        // apply to left section - my layers
                        new_my_adds_component_item.appendTo("#my_adds_section .ucreate_left_section_list");

                        $( "#" + my_adds_components_list_item_id ).on( "click", function() {
                            
                    // turn all strokes on SVG paths
                    $('#ucreate_vector_section svg path').css("stroke", "none");

                    var existing_vector = $('#ucreate_vector_section svg path[data-id="'+$(this).data("identity")+'"]');
                    if( existing_vector.length ){
                        existing_vector.css( "stroke", "black" );
                        existing_vector.css( "stroke-dasharray", "5,5" );
                    }                            

                            toggleSelectedNotselectedComponentItemsStatus(this);
                            
                            $('.applied_component_colour_possibilities').hide();
                            
                            var existing_colour_possibilities = $('.applied_component_colour_possibilities[data-identity="'+$(this).data("identity")+'"]');
                            if( existing_colour_possibilities.length ){
                                
                            // show colours range
                            existing_colour_possibilities.show();
                            
                            // paint SVG according to actual element's colour!
                            if( $(this).attr('data-selected-colour') === undefined ){
                                // first click
                                // do nothing, waiting for selecting a colour
                            }else{
                                // second+ click
                                // colour has been already chosen, paint SVG with already selected colour
                                var vector_representation_2 = $('#ucreate_vector_section svg path[data-id="'+cmp_identity+'"]');
                                if( vector_representation_2.length ){
                                    vector_representation_2.css( "fill", $(this).attr('data-selected-colour').toString() );
                                };
                            }
                        }
                        });                        
                        
                    }else{
                        // multiplicity not allowed, user also decided not to add it to MY ADDS, so ignore the click action!
                        return;
                    }
                }
            }else{
                // component has not been added to composition yet, let's add it!
                
                // add image to ucreate section
                var cmp_src = component.data("src"); 
                var img = $('<img class="ucreate_image">'); //Equivalent: $(document.createElement('img'))
                img.attr('src', cmp_src);
                img.attr('data-id', cmp_identity);
                img.attr('style', 'z-index: 3');
                img.appendTo('#ucreate_image_section');
                
                // append new element to applied components list
                const applied_components_list_item_id = "applied_components_list_item_" + cmp_identity;
                var new_applied_component_item = $('<div id=' + applied_components_list_item_id + ' class="ucreate_left_section_list_item vertical applied_component_item notselected">' + component.data("name") +'</div>');
                new_applied_component_item.attr('data-identity', cmp_identity);
                new_applied_component_item.attr('data-price', cmp_price);

                //new_applied_component_item.appendTo("#applied_components_list");

                // apply to left section - my layers
                new_applied_component_item.appendTo("#layers_section .ucreate_left_section_list");

                $( "#" + applied_components_list_item_id ).on( "click", function() {

                    // turn all strokes on SVG paths
                    $('#ucreate_vector_section svg path').css("stroke", "none");

                    var existing_vector = $('#ucreate_vector_section svg path[data-id="'+$(this).data("identity")+'"]');
                    if( existing_vector.length ){
                        existing_vector.css( "stroke", "black" );
                        existing_vector.css( "stroke-dasharray", "5,5" );
                    }
                            
                    toggleSelectedNotselectedComponentItemsStatus( this );             
                    
                    $('.applied_component_colour_possibilities').hide();

                    var existing_colour_possibilities = $('.applied_component_colour_possibilities[data-identity="'+$(this).data("identity")+'"]');
                    if( existing_colour_possibilities.length ){
                        existing_colour_possibilities.show();
                    }
                    
                    // paint SVG according to actual element's colour!
                    if( $(this).attr('data-selected-colour') === undefined ){
                        // first click
                        // do nothing, waiting for selecting a colour
                    }else{
                        // second+ click
                        // colour has been already chosen, paint SVG with already selected colour
                        var vector_representation_3 = $('#ucreate_vector_section svg path[data-id="'+cmp_identity+'"]');
                        if( vector_representation_3.length ){
                            vector_representation_3.css( "fill", $(this).attr('data-selected-colour').toString() );
                        };
                    }                    
                });                
            }

            // add price to current price
            var actual_price = parseFloat($("#ucreate_price").html());
            actual_price += cmp_price;
            $("#ucreate_price").html(new Number(actual_price).toFixed(2));




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

        function toggleSelectedNotselectedComponentItemsStatus( sth ){
            // turn off colour for all applied components in the list
            $('.applied_component_item').removeClass("selected");
            $('.applied_component_item').addClass("notselected");                            
            // turn off colour for all MY ADDS items in the list
            $('.my_adds_component_item').removeClass("selected");
            $('.my_adds_component_item').addClass("notselected");
            
            $(sth).removeClass("notselected");
            $(sth).addClass("selected");
        }


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

        $(".product_size").click( function(){
            $('.product_size').removeClass("selected");
            $('.product_size').addClass("notselected");
            $(this).addClass("selected");
        });

        $(".category").click( function(){
            const category_id = $(this).data('category-identity');
            
            // show whole subcategory section
            if( !$('#subcategories_section').is(':visible') ) {
                $("#subcategories_section").show();
            };
            // hide all subcategories
            $('.subcategory').hide();
            // show selected subcategory
            $('.subcategory[data-category-identity="'+category_id+'"]').show();
            
            // hide already open concrete component section
            if( $('#concrete_toolset_section').is(':visible') ) {
                $("#concrete_toolset_section").hide();
            };
            
        });

        $(".subcategory").click( function(){
            const subcategory_id = $(this).data('subcategory-identity');
            
            // show whole components section
            if( !$('#concrete_toolset_section').is(':visible') ) {
                $("#concrete_toolset_section").show();
            };
            // hide all components
            $('.component').hide();
            // show selected subcategory
            $('.component[data-subcategory-identity="'+subcategory_id+'"]').show();
        });         
        
        $(".product_size").click( function(){
            $('.product_size').removeClass("selected");
            $('.product_size').addClass("notselected");
            $(this).addClass("selected");
        });       
        
<?php if ($applied_components_full_info) : ?>
    <?php foreach ($applied_components_full_info as $singleAppliedComponentFullInfo): ?>
                    //            $('.component_add[data-identity="' + <?php echo $singleAppliedComponentFullInfo->getComponentId(); ?> +'"]').hide();
                    //            $('.component_remove[data-identity="' + <?php echo $singleAppliedComponentFullInfo->getComponentId(); ?> +'"]').show();

                    $( "#" + "applied_components_list_item_<?php echo $singleAppliedComponentFullInfo->getComponentId(); ?>" ).on( "click", function() {
                        //                        // turn off colour for all applied components in the list
                        //                        $('.applied_component_item').css("color","black");
                        //                        // turn off colour for all MY ADDS items in the list
                        //                        $('.my_adds_component_item').css("color","black");
                        //                        $(this).css("color","red");

                        //                        $('.applied_component_item').removeClass("selected");
                        //                        $('.applied_component_item').addClass("notselected");
                        //                    
                        //                        $(this).addClass("selected"); 
                    });

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
                                                                                                                                                                                                    
                            // add additional attributes to LAYERS items
                            $( "#" + "applied_components_list_item_<?php echo $singleAppliedComponentFullInfo->getComponentId(); ?>" ).attr("selected_colour", "<?php echo $singleAppliedComponentFullInfo->getColourValue(); ?>");
                            $( "#" + "applied_components_list_item_<?php echo $singleAppliedComponentFullInfo->getComponentId(); ?>" ).attr("selected_colour_id",  "<?php echo $singleAppliedComponentFullInfo->getColourId(); ?>");                            
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
        <div id="layers_section" class="ucreate_left_section" style="display:none">
            <div class="ucreate_left_section_first_row">
                <div class="ucreate_left_section_first_row_symbol icon_layers">
                </div>
                <div class="ucreate_left_section_first_row_title">
                    layers
                </div>
            </div>
            <div class="ucreate_left_section_list">
                <?php if ($applied_components_full_info) : ?>
                    <?php foreach ($applied_components_full_info as $singleAppliedComponentFullInfo): ?>
                        <div id="applied_components_list_item_<?php echo $singleAppliedComponentFullInfo->getComponentId(); ?>"
                             data-identity="<?php echo $singleAppliedComponentFullInfo->getComponentId(); ?>"
                             data-price="<?php echo $singleAppliedComponentFullInfo->getComponentPrice(); ?>"
                             class="ucreate_left_section_list_item vertical applied_component_item notselected">
                                 <?php echo $singleAppliedComponentFullInfo->getComponentName(); ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="line"></div>
        </div>
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
                <?php /* if ($applied_components_full_info) : ?>
                  <?php foreach ($applied_components_full_info as $singleAppliedComponentFullInfo): ?>
                  <div id="applied_components_list_item_<?php echo $singleAppliedComponentFullInfo->getComponentId(); ?>"
                  data-identity="<?php echo $singleAppliedComponentFullInfo->getComponentId(); ?>"
                  data-price="<?php echo $singleAppliedComponentFullInfo->getComponentPrice(); ?>"
                  class="ucreate_left_section_list_item vertical applied_component_item">
                  <?php echo $singleAppliedComponentFullInfo->getComponentName(); ?>
                  </div>
                  <?php endforeach; ?>
                  <?php endif; */ ?>
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
                <div class="ucreate_left_section_list_item horizontal product_size selected">
                    s
                </div>
                <div class="ucreate_left_section_list_item horizontal product_size notselected">
                    m
                </div>
                <div class="ucreate_left_section_list_item horizontal product_size notselected">
                    l
                </div>
                <div class="ucreate_left_section_list_item horizontal product_size notselected">
                    xl
                </div>
                <div class="ucreate_left_section_list_item horizontal product_size notselected">
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
                <?php if ($optimizedSingleCategoryComponentFullInfo->getSpecialSubcategories()): ?>
                    <?php foreach ($optimizedSingleCategoryComponentFullInfo->getSpecialSubcategories() as $specialSubcategoryObject): ?>
                        <?php if ($specialSubcategoryObject->getSpecialComponents()): ?>
                            <?php foreach ($specialSubcategoryObject->getSpecialComponents() as $specialComponentObject): ?>
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

        <!-- section 1. -->
        <!-- toolset(PDF) = categories -->
        <div id="categories_section" class="ucreate_right_section" style="display:none">
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
                        <div class="ucreate_right_section_list_item category" data-category-identity="<?php echo $optimizedSingleCategoryComponentFullInfo->getCategory()->getId(); ?>">
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


            <!--  "POCKET TYPES"  - aka subcategories -->
            <div id="subcategories_section" class="ucreate_right_section" style="display:none">
                <div class="ucreate_left_section_first_row">
                    <!--                <div class="ucreate_right_section_first_row_symbol icon_toolset">
                                    </div>-->
                    <div class="ucreate_right_section_first_row_title">
                        component subcategories
                    </div>
                </div>
                <div class="ucreate_right_section_list">
                    <?php foreach ($optimized_ucreate_components_full_info_array as $optimizedSingleCategoryComponentFullInfo): ?>
                        <?php if ($optimizedSingleCategoryComponentFullInfo->getCategory()): ?>
                            <?php if ($optimizedSingleCategoryComponentFullInfo->getSpecialSubcategories()): ?>
                                <?php foreach ($optimizedSingleCategoryComponentFullInfo->getSpecialSubcategories() as $specialSubcategoryObject): ?>

                                    <div class="ucreate_right_section_list_item subcategory" 
                                         data-subcategory-identity="<?php echo $specialSubcategoryObject->getSubcategoryObject()->getId(); ?>"
                                         data-category-identity="<?php echo $optimizedSingleCategoryComponentFullInfo->getCategory()->getId(); ?>"
                                         style="display:none"
                                         >
                                        <div class="ucreate_right_section_list_item_icon">
                                            <img src="<?php echo base_url($specialSubcategoryObject->getSubcategoryObject()->getURL()); ?>" >
                                        </div>
                                        <div class="ucreate_right_section_list_item_title">
                                            <?php echo $specialSubcategoryObject->getSubcategoryObject()->getName(); ?>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="line"></div>
            </div>


            <!-- concrete toolset aka concrete "POCKET" aka type aka real components -->
            <div id="concrete_toolset_section" class="ucreate_right_section" style="display:none">
                <?php for ($i = 0; $i < count($optimized_ucreate_components_full_info_array); $i++): ?>
                    <?php $optimizedSingleCategoryComponentFullInfo = $optimized_ucreate_components_full_info_array[$i] ?>
                    <?php if ($optimizedSingleCategoryComponentFullInfo->getSpecialSubcategories()): ?>
                        <?php foreach ($optimizedSingleCategoryComponentFullInfo->getSpecialSubcategories() as $specialSubcategoryObject): ?>
                            <div class="ucreate_left_section_category_unit component" 
                                 data-subcategory-identity="<?php echo $specialSubcategoryObject->getSubcategoryObject()->getId(); ?>" 
                                 style="display: none">
                                <div class="ucreate_left_section_first_row">
                                    <div class="ucreate_right_section_first_row_title">
                                        <?php echo $specialSubcategoryObject->getSubcategoryObject()->getName(); ?>
                                    </div>
                                </div>
                                <div class="ucreate_right_section_list">
                                    <?php if ($specialSubcategoryObject->getSpecialComponents()): ?>
                                        <?php foreach ($specialSubcategoryObject->getSpecialComponents() as $specialComponentObject): ?>
                                            <?php if ($specialComponentObject->getComponentObject()): ?>
                                                <div class="ucreate_right_section_list_item">
                                                    <div class="ucreate_right_section_list_item_icon">
                                                        <img src="<?php echo base_url($specialSubcategoryObject->getSubcategoryObject()->getURL()); ?>" >
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
                        <?php endforeach; ?>
                    <?php endif; ?>


                <?php endfor; ?>
                <div class="line"></div>
            </div>
        </div>

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
                    <?php if ($optimizedSingleCategoryComponentFullInfo->getSpecialSubcategories()): ?>
                        <?php foreach ($optimizedSingleCategoryComponentFullInfo->getSpecialSubcategories() as $specialSubcategoryObject): ?>
                            <?php if ($specialSubcategoryObject->getSpecialComponents()): ?>
                                <?php foreach ($specialSubcategoryObject->getSpecialComponents() as $specialComponentObject): ?>

                                    <div class="applied_component_colour_possibilities"  
                                         data-identity="<?php echo $specialComponentObject->getComponentObject()->getId(); ?>">

                                        <?php if (count($specialComponentObject->getColours()) > 0): ?>
                                            <?php //var_dump( $specialComponentObject->getColours()); ?>
                                            <?php foreach ($specialComponentObject->getColours() as $singleColour): ?>
                                                <div class="applied_component_colour notselected" 
                                                     data-colour_id="<?php echo $singleColour->getId() ?>" 
                                                     data-colour="<?php echo $singleColour->getValue() ?>" 
                                                     style="background-color: <?php echo '#' . $singleColour->getValue() ?>"></div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div><!-- end of content-->
