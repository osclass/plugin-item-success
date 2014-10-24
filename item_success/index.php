<?php
/*
Plugin Name: Success page
Plugin URI: http://www.osclass.org/
Description: Success page
Version: 1.0
Author: Osclass
Author URI: http://www.osclass.org/
Short Name: Success page
Plugin update URI: item_success
*/

/*
* Success redirect
*/
osc_add_route('item-success', 'item-success$', 'item-success', 'item_success/item-success.php', false, 'custom', 'custom', __('Thank you', 'item_success') );


function item_success_redirect($item) {
    if( isset($item['pk_i_id']) ) {
        Session::newInstance()->_dropKeepForm();

        if($item['b_active']==0) {
            osc_add_flash_ok_message( _m('Check your inbox to validate your listing') );
        } else {
            // only if enabled and active can show item-success page
            if($item['b_active']==1 && $item['b_enabled']==1) {
                // item-success redirect
                Session::newInstance()->_set('inserted_item', $item);
                osc_redirect_to( osc_route_url('item-success') );
                exit;
            }
        }

        $itemId  = Params::getParam('itemId');

        $category = Category::newInstance()->findByPrimaryKey(Params::getParam('catId'));
        View::newInstance()->_exportVariableToView('category', $category);
        osc_redirect_to(osc_search_category_url());
    }
}
osc_add_hook('posted_item', 'item_success_redirect');


function item_success_share_buttons($url, $id) {
    ?>
    <style>

        #share-nav .share-buttons.v2 {
            float: none;
            padding-bottom: 0px !important;
            margin-bottom: 0px !important;
            padding-top: 0px !important;
            font-size: 14px;
        }

        #share-nav .share-buttons {
            display: inline-block;
        }

        .primary-shares {
            display: inline-block;
            width: 760px;
        }

        .share-buttons div, .share-buttons a {
            vertical-align: middle;
            text-decoration: none;
        }


        #share-nav .facebook, #share-nav .twitter, #share-nav .google_plus {
            margin-right: 8px !important;
            line-height: 34px;
            margin-top: 5px;
            height: 34px;
            width: 48px;
            color: #fff;
        }

        .share-buttons.v2 .facebook {
            background: #2d609b;
            color: transparent;
        }

        .share-buttons.v2 .facebook,
        .share-buttons.v2 .twitter,
        .share-buttons.v2 .google_plus {
            font-size: 14px;
            text-rendering: optimizeLegibility;
            margin-right: 2px;
            line-height: 41px;
            font-family: "ProximaNovaRegular";
            font-weight: 500;
            width: 30px;
        }

        .share-buttons.v2 .facebook,
        .share-buttons.v2 .twitter,
        .share-buttons.v2 .google_plus {
            border-radius: 2px;
            margin-right: 4px;
            background: #c5c5c5;
            position: relative;
            display: inline-block;
            cursor: pointer;
            height: 41px;
            width: 41px;
            color: #fff;
        }

        #share-nav .share-buttons.v2 .expanded-text, #share-nav .share-buttons.v2 .primary-text {
            display: inline;
            font-weight: bold;
        }

        .share-buttons.v2 span {
            vertical-align: top;
        }

        #share-nav .share-buttons.v2 .facebook {
            color: #fff;
        }
        #share-nav .facebook,
        #share-nav .google_plus,
        #share-nav .twitter {
            line-height: 34px;
            color: #fff;
        }

        .share-buttons.v2 .facebook,
        .share-buttons.v2 .twitter ,
        .share-buttons.v2 .google_plus {
            font-size: 14px;
            line-height: 41px;
            font-family: "ProximaNovaRegular";
            font-weight: 500;
        }

        #share-nav .share-buttons.v2 .twitter {
            width: 168px;
            color: #fff;
        }

        #share-nav .share-buttons.v2 .google_plus {
            width: 180px;
            color: #fff;

        }
        #share-nav .share-buttons.v2 .facebook {
            width: 183px;
            color: #fff;
        }

        .share-buttons.v2 .twitter {
            background: #00c3f3;
        }
        .share-buttons.v2 .facebook {
            background: #2d609b;
        }
        .share-buttons.v2 .google_plus {
            background: #eb4026;
        }
        .fa {
            font-size: 24px;
            line-height: 34px;
        }
    </style>

    <script>
        function shareTw() {
            var popUp = window.open("https://twitter.com/share?url=<?php echo $url.'&text='.urlencode(osc_item_title()); ?>", 'popupwindow', 'scrollbars=yes,width=800,height=400');
            popUp.focus();
            return false;
        }
        function shareFb() {
            var popUp = window.open("https://www.facebook.com/sharer.php?u=<?php echo $url; ?>&t=<?php echo urlencode(osc_item_title()); ?>", 'popupwindow', 'scrollbars=yes,width=800,height=400');
            popUp.focus();
            return false;
        }
        function shareGp() {
            var popUp = window.open("https://plus.google.com/share?url=<?php echo $url; ?>", 'popupwindow', 'scrollbars=yes,width=800,height=400');
            popUp.focus();
            return false;
        }
    </script>

    <div id="share-nav">
        <div class="share-buttons v2">
            <div class="primary-shares">
                <a class="social-share facebook" target="_blank" onclick="shareFb(); return false;" href="#">
                    <i class="fa fa-facebook-square"></i>
                    <span class="primary-text"><?php _e('Share on Facebook', 'item_success'); ?></span>
                </a>
                <a class="social-share twitter" onclick="shareTw(); return false;" href="#">
                    <i class="fa fa-twitter"></i>
                    <span class="primary-text"><?php _e('Share on Twitter', 'item_success'); ?></span>
                </a>
                <a class="social-share google_plus" onclick="shareGp(); return false;" href="#">
                    <i class="fa fa-google-plus"></i>
                    <span class="primary-text"><?php _e('Share on Google+', 'item_success'); ?></span>
                </a>
            </div>
        </div>
    </div>

    <?php
}


?>