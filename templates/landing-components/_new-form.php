<section class="new-form-module background-black">
    <div class="container">        
        <div class="column-container background-red">
            <div class="column info-column">
               <h2 class="white-text"><?php echo get_sub_field( 'title' ); ?></h2>               
			    <span class="text white-text p-large"><?php echo get_sub_field( 'text' ); ?></span>
            </div>
            <div class="column form-column">
                <span class="form-embed">
                    <?php echo get_sub_field( 'form_embed' ); ?>
                </span>
            </div>			
        </div>
    </div>
</section>