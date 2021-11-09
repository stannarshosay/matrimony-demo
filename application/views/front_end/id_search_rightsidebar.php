<div class="mega-box-new">
    <p class="calibri-Bold-font f-22 color-31 t-transform-ue text-center ab-t1">Profile id  
    <span class="color-d">SEARCH</span></p>
    <hr class="search-hr">
    <div class="row">
        <form action="<?php echo $base_url; ?>search/search_now" method="post">
            <div class="col-md-7 col-xs-12 col-sm-5">
                <div class="">
                    <input type="text" class="form-control ni-input" name="txt_id_search" required placeholder="Enter Profile ID">
                </div>
            </div>
            <div class="col-md-5 col-xs-12 col-sm-5 gen-m-top">
                <div class="add-ad-btn">
                    <button type="submit" class="add-w-btn new-id-s Poppins-Medium color-f f-18"><i class="fas fa-search"></i> Search</button>
                </div>
                
            </div>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" class="hash_tocken_id" />
        </form>
    </div>
</div>