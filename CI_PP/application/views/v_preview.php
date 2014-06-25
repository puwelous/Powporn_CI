<!-- content -->
<div class="content_unextended">

    <div class="preview_left">

        <div>
            <?php
            $representation_urls = $previed_product_screen_representation->getUrls();
            foreach ($representation_urls as $representation_url_item) {

//                    $image_properties = array(
//                        'src' => $representation_url_item,
//                        'alt' => $previed_product_screen_representation->getProductName(),
//                        'class' => 'product_image'
//                    );
//                    echo img($image_properties);



                $element = '<a href="http://www.pinterest.com/pin/create/button/
        ?url=' . site_url('preview/show/' . $previed_product->getId()) . '/' . 
                        '&media=' . base_url($representation_url_item) .
                        '&description=' . $previed_product->getDescription() .'"
        data-pin-do="buttonPin"
        data-pin-shape="round"
        data-pin-height="32"
        data-pin-config="above">
        <img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" />
    </a>';
                echo $element;
            }
            ?>


            <script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>            
        </div>        
        
        <div class="line pp_blue"></div>

        <?php
        $attributes = array('name' => 'pp_add_product_to_cart_form');
        echo form_open("c_preview/add_to_cart/" . $previed_product->getId(), $attributes);
        echo form_hidden('product_id', $previed_product->getId());
        ?>

        <h2><?php echo $previed_product->getName(); ?></h2>
        <div class="line pp_dark_gray"></div>

        <h4 class="pp_dark_gray">design by</h4>
        <h4 class="black"><?php echo $previed_product_creator->getNick(); ?></h4>
        <div class="line pp_dark_gray"></div>

        <h4 class="pp_dark_gray">description</h4>
        <h5 class="lower_cased"><?php echo $previed_product->getDescription(); ?></h5>
        <div class="line pp_dark_gray"></div>
        <div class="pr_l_sex_icon"></div>
        <h4><?php echo $previed_product->getSex(); ?></h4>
        <h4>
            <?php
            echo form_dropdown('pdf_product_sizes', $previed_product_size_options, reset($previed_product_size_options));
            ?>
        </h4>
        <div class="line"></div>

        <h1><?php echo $previed_product->getPrice(); ?>&nbsp;&euro;</h1>

        <button id="add_to_cart_button" type="submit">ADD TO CART</button>
        <?php echo form_close(); ?>

    </div>

    <div class="preview_center">
        <div class="preview_item">           
            <div class="preview_item_imgs_wrapper" style="position:absolute;">
                <?php echo img('assets/css/images/bottomshadow.png'); ?>
                <?php
                $representation_urls = $previed_product_screen_representation->getUrls();
                foreach ($representation_urls as $representation_url_item) {
                    $image_properties = array(
                        'src' => $representation_url_item,
                        'alt' => $previed_product_screen_representation->getProductName(),
                        'class' => 'product_image'
                    );
                    echo img($image_properties);
                }
                ?>
            </div>
        </div>       
    </div> 

    <div class="preview_right">


    </div>

</div><!-- end of content-->
