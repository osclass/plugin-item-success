<?php
$item = Session::newInstance()->_get('inserted_item');
Session::newInstance()->_drop('inserted_item');
if($item!="") {
    View::newInstance()->_exportVariableToView('item', $item);
}
?>
<div style="text-align: center;line-height: 25px;">

    <div style="display: inline-block;">
        <div style="float:left;">
            <img style="width: 64px;" src="<?php echo osc_base_url().'oc-content/plugins/'.osc_plugin_folder(__FILE__).('images/ok.png');?>">
        </div>

        <div style="float:left;padding-left: 35px;padding-top: 10px;"><?php _e('Thank you! Your listing has been published successfully.<br/>If you are not a registered user, you can edit it from the link we\'ve just sent you.', 'item_success'); ?></div>
    </div>

    <div style="clear:both"></div>

    <p style="margin:2em;">
        <?php _e('Share your listing and increase visibility!', 'item_success'); ?><br/>
    </p>
    <?php if($item!="") { ?>
    <?php item_success_share_buttons( osc_item_url(), $item['pk_i_id'] );  ?>
    <?php } ?>

    <div style="margin:2em;">
        <p><?php _e('Want to publish more listings?', 'item_success'); ?><br/><?php _e('Go ahead, it\'s free!','item_success');?></p>
    </div>

    <a class="ui-button ui-button-main" href="<?php echo osc_item_post_url_in_category() ; ?>"><?php _e("Publish another listing", 'item_success');?></a>
    <a class="ui-button ui-button-blacktext" href="<?php echo osc_base_url() ; ?>"><?php _e('Continue browsing', 'item_success'); ?></a>

</div>
