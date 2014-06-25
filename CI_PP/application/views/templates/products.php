        <div  class="gallery_row_wrapper">
            <?php
            for ($i = 0; $i < count($products_representations_list); ++$i):
                ?>
                <div class="gallery_item">
                    <div id="background_image_effect" style="position: absolute; width: 120px; height: 175px; text-align: initial;">
                        <?php
                        $image_properties_basic_effect = array(
                            'id' => 'basic_image_effect',
                            'src' => 'assets/css/images/bottomshadow.png',
                            'alt' => 'Image bottom effect',
                            'style' => 'z-index: -1; position: absolute; width: 120px; height: 175px; text-align: initial;'
                        );
                        echo img($image_properties_basic_effect);
                        ?>
                    </div>                     
                    <div class="gallery_item_imgs_wrapper">
                        <?php
                        $representation_urls = $products_representations_list[$i]->getUrls();
                        foreach ($representation_urls as $representation_url_item) {
                            $image_properties = array(
                                'src' => $representation_url_item,
                                'alt' => $products_representations_list[$i]->getProductName(),
                                'class' => 'product_image'
                            );
                            echo img($image_properties);
                        }
                        ?>
                    </div>
                    <div class="gallery_item_desc">
                        <div class="gallery_item_name text_light bold upper_cased"><?php echo $products_representations_list[$i]->getProductName(); ?></div>
                        <?php echo anchor('preview/show/' . $products_representations_list[$i]->getProductId(), 'preview', array('class' => 'gallery_item_option_items text_light smaller upper_cased pp_red')); ?>                        
                        <?php echo anchor('ucreate/' . $products_representations_list[$i]->getProductId(), 'edit', array('class' => 'gallery_item_option_items text_light smaller upper_cased pp_red')); ?>
                        <!--<span class="gallery_item_option_items text_light smaller upper_cased pp_red">preview</span>-->
                        <!--<span class="gallery_item_option_items text_light smaller upper_cased pp_red">order</span>-->                           
                    </div>
                </div>
            <?php endfor; ?>  
        </div>