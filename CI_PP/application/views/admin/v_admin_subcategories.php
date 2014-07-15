<!-- content -->
<div id="content">
    <div class="content_wrapper">
        <div class="container">
            <!-- Title -->
            <h1>
                Subcategories administration
                <?php echo anchor('c_admin/components_admin', '<-go back', array('class' => 'text_light smaller pp_dark_gray red_on_hover inunderlined upper_cased')); ?>                 
            </h1>
            <div class="blue_line">
            </div>                    
            <div class="half_container">

                <?php echo validation_errors(); ?>
                <?php if (isset($error)) echo $error; ?>
                <?php if (isset($successful)) echo $successful; ?>

                <?php echo form_open_multipart('c_admin/add_subcategory'); ?>

                <h3 class="black">Add new subcategory</h3>
                <h4 class="black">New subcategory name:</h4>
                <?php
                $data = array(
                    'name' => 'nsf_name',
                    'id' => 'nsf_name',
                    'value' => set_value('nsf_name', 'Zips special'),
                    'maxlength' => '32',
                    'size' => '32',
                    'style' => 'width:100%'
                );
                echo form_input($data);
                ?>
                
                <h4 class="black">New subcategory description:</h4>
                <?php
                $data = array(
                    'name' => 'nsf_description',
                    'id' => 'nsf_description',
                    'value' => set_value('nsf_description', 'Standard winter hoodies zip pockets'),
                    'rows' => '6',
                    'style' => 'max-width:100%; width:100%;'
                );
                echo form_textarea($data);
                ?>                
                <!--<div class="line pp_dark_gray"></div>-->
                
                <h4 class="black" >Assigned category:</h4>
                <?php echo form_dropdown('nsf_category', $category_select_options, key($category_select_options)); ?>
                
                <h4 class="black" >SVG subcategory representation:</h4>
                <input type="file" name="userfile" size="20" />
                
                <div>
                    <input type="submit" id="save" class="pp_button_active" value="Create subcategory" />                
                </div>
                </form>
  
                <div class="line pp_dark_gray"></div>   

                 <h3 class="black">Existing subcategories</h3>
                <?php if (isset($subcategories_table)) echo $subcategories_table; ?>

            </div>        
        </div>
    </div><!-- end of content-->