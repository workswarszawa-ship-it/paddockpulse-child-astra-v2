<?php
defined('ABSPATH') || exit;
get_header('shop');
?>

<div class="pp-shop-content">
  <?php if (is_active_sidebar('sidebar-shop')) : ?>
    <aside class="pp-sidebar widget-area">
      <button class="pp-sidebar-close">&times;</button>
      <?php dynamic_sidebar('sidebar-shop'); ?>
    </aside>
  <?php endif; ?>

  <main class="pp-products-area">
    <?php
    // === Показати підкатегорії (як картки) ===
    $subcategories = woocommerce_get_product_subcategories();
    if (!empty($subcategories)) : ?>
      <ul class="pp-categories-list">
        <?php foreach ($subcategories as $cat) :
          $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
          $img = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'medium') : wc_placeholder_img_src();
        ?>
          <li class="pp-category-card">
            <a href="<?php echo esc_url(get_term_link($cat)); ?>">
              <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($cat->name); ?>">
              <div class="pp-category-title"><?php echo esc_html($cat->name); ?></div>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if (woocommerce_product_loop()) : ?>
      <ul class="pp-products-list">
        <?php while (have_posts()) : the_post();
          wc_get_template_part('content', 'product');
        endwhile; ?>
      </ul>
      <?php woocommerce_pagination(); ?>
    <?php else :
      do_action('woocommerce_no_products_found');
    endif; ?>
  </main>
</div>

<?php get_footer('shop'); ?>
