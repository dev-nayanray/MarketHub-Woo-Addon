<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>
<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) {
        $product_permalink = $_product->is_visible() ? $_product->get_permalink() : '';
        ?>
        <!-- Display product details here -->
        <?php
    }
} ?>
<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
    $_product = $cart_item['data'];
    if ( empty( $_product ) ) {
        error_log('Product data is empty');
    } else {
        error_log('Product ID: ' . $_product->get_id());
    }
} ?>


<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
<?php do_action( 'woocommerce_before_cart_table' ); ?>

<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h2>
        
        <!-- Cart items are dynamically filled here -->
        <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
            <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                ?>
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    <div class="space-y-6">
                        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                            <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                <a href="<?php echo esc_url( $product_permalink ); ?>" class="shrink-0 md:order-1">
                                    <?php echo $_product->get_image(); // Display product image ?>
                                </a>
                                <div class="flex items-center justify-between md:order-3 md:justify-end">
                                    <?php
                                    // Product quantity
                                    if ( $_product->is_sold_individually() ) {
                                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1">', $cart_item_key );
                                    } else {
                                        $product_quantity = woocommerce_quantity_input( array(
                                            'input_name'   => "cart[{$cart_item_key}][qty]",
                                            'input_value'  => $cart_item['quantity'],
                                            'max_value'    => $_product->get_max_purchase_quantity(),
                                            'min_value'    => '0',
                                        ), $_product, false );
                                    }
                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                    ?>
                                    <div class="text-end md:order-4 md:w-32">
                                        <?php
                                        echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                        ?>
                                    </div>
                                </div>
                                <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                    <a href="<?php echo esc_url( $product_permalink ); ?>" class="text-base font-medium text-gray-900 hover:underline dark:text-white"><?php echo $_product->get_name(); ?></a>
                                    <?php
                                    // Remove product link
                                    echo apply_filters(
                                        'woocommerce_cart_item_remove_link',
                                        sprintf(
                                            '<a href="%s" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">%s</a>',
                                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                            __('Remove', 'woocommerce')
                                        ),
                                        $cart_item_key
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php do_action( 'woocommerce_cart_actions' ); ?>

<input type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>" />
<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_after_cart' ); ?>
