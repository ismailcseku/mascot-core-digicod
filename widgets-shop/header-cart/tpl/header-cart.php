<div class="woocommerce top-nav-mini-cart-icon-container">
	<div class="top-nav-mini-cart-icon-contents">
		<a class="mini-cart-icon" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'mascot-core-digicod' ); ?>"><i class="lnr lnr-icon-cart1"></i>
			<?php if(WC()->cart){?>
			<span class="items-count"><?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'mascot-core-digicod' ), WC()->cart->get_cart_contents_count() ); ?></span> <span class="cart-quick-info"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'mascot-core-digicod' ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></span>
			<?php }?>
		</a>

		<div class="dropdown-content">
			<?php if(WC()->cart){?>
			<?php woocommerce_mini_cart(); ?>
			<?php }?>
		</div>
	</div>
</div>