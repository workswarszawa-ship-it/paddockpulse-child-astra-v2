<?php
/**
 * Footer Template for paddockpulse-child-astra-v2
 */
?>
<footer class="site-footer">
  <div class="footer-inner" style="max-width:1200px;margin:0 auto;padding:30px 20px;">
    <p style="text-align:center;color:#555;font-size:14px;">
      © <?php echo date('Y'); ?> Paddock Pulse. Усі права захищено.
    </p>
  </div>
</footer>

<!-- === CART MODAL (совместимо с pp-modal-cart.js / pp-modal-cart.css) === -->
<div id="pp-modal-cart" class="ppm is-hidden" aria-hidden="true">
  <div class="ppm__backdrop" data-ppm-close></div>

  <div class="ppm__dialog" role="dialog" aria-modal="true" aria-labelledby="ppmCartTitle">
    <button class="ppm__close" type="button" data-ppm-close aria-label="Закрити">×</button>

    <h3 id="ppmCartTitle" class="ppm__title">Товар додано до кошика</h3>

    <div class="ppm__body">
      <!-- мини-корзина WooCommerce (фрагмент) -->
      <div class="widget_shopping_cart_content">
        <!-- будет заменяться фрагментом get_refreshed_fragments -->
      </div>
    </div>

    <div class="ppm__footer">
      <div class="ppm__subtotal">
        <span>Разом:</span>
        <strong class="ppm-subtotal">
          <?php echo WC()->cart ? wc_price( WC()->cart->get_cart_contents_total() ) : ''; ?>
        </strong>
      </div>
      <div class="ppm__actions">
        <a class="ppm-btn ppm-btn--light" href="<?php echo esc_url( wc_get_page_permalink('shop') ); ?>">Повернутися до покупок</a>
        <a class="ppm-btn ppm-btn--light" href="<?php echo esc_url( wc_get_cart_url() ); ?>">Перейти в кошик</a>
        <a class="ppm-btn ppm-btn--accent" href="<?php echo esc_url( wc_get_checkout_url() ); ?>">Оформити замовлення</a>
      </div>
    </div>
  </div>
</div>

<!-- === WISHLIST CONFIRMATION === -->
<div id="pp-modal-wishlist" class="ppm is-hidden" aria-hidden="true">
  <div class="ppm__backdrop" data-ppm-close></div>
  <div class="ppm__dialog ppm__dialog--sm" role="dialog" aria-modal="true" aria-labelledby="ppmWishlistTitle">
    <button class="ppm__close" type="button" data-ppm-close aria-label="Закрити">×</button>
    <h3 id="ppmWishlistTitle" class="ppm__title">Додано в обране</h3>
    <div class="ppm__body">
      <p>Товар додано у ваш список обраного.</p>
    </div>
    <div class="ppm__footer">
      <a class="ppm-btn ppm-btn--light" href="<?php echo esc_url( wc_get_page_permalink('shop') ); ?>">Продовжити покупки</a>
      <?php if ( function_exists('yith_wcwl_object_id') ) : ?>
        <a class="ppm-btn ppm-btn--accent" href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>">Відкрити обране</a>
      <?php endif; ?>
    </div>
  </div>
</div>


<?php wp_footer(); ?>


