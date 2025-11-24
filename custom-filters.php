<?php
/**
 * Панель фільтрації WooCommerce (AJAX-ready)
 */
if (!defined('ABSPATH')) exit;
?>
<aside id="pp-filter-sidebar" class="pp-sidebar">
  <div class="pp-filters-header">
    <h3>Фільтри</h3>
    <button class="pp-close-filters" aria-label="Закрити фільтри">&times;</button>
  </div>

  <form method="get" action="">
    <?php
    $current_brand = isset($_GET['brand']) ? (array) $_GET['brand'] : [];
    $current_color = isset($_GET['color']) ? (array) $_GET['color'] : [];
    $current_size  = isset($_GET['size']) ? (array) $_GET['size'] : [];
    ?>

    <!-- 🏷️ Бренд -->
    <div class="pp-filter-group">
      <h4>Бренд</h4>
      <div class="pp-filter-options">
        <?php
        $brands = get_terms(['taxonomy' => 'pa_brand', 'hide_empty' => true]);
        if (!empty($brands) && !is_wp_error($brands)) {
          foreach ($brands as $brand) {
            $checked = in_array($brand->slug, $current_brand) ? 'checked' : '';
            echo '<label class="pp-tile"><input type="checkbox" name="brand[]" value="' . esc_attr($brand->slug) . '" ' . $checked . '> ' . esc_html($brand->name) . '</label>';
          }
        }
        ?>
      </div>
    </div>

    <!-- 🎨 Колір -->
    <div class="pp-filter-group">
      <h4>Колір</h4>
      <div class="pp-filter-options">
        <?php
        $colors = get_terms(['taxonomy' => 'pa_color', 'hide_empty' => true]);
        if (!empty($colors) && !is_wp_error($colors)) {
          foreach ($colors as $color) {
            $checked = in_array($color->slug, $current_color) ? 'checked' : '';
            echo '<label class="pp-tile"><input type="checkbox" name="color[]" value="' . esc_attr($color->slug) . '" ' . $checked . '> ' . esc_html($color->name) . '</label>';
          }
        }
        ?>
      </div>
    </div>

    <!-- 📏 Розмір -->
    <div class="pp-filter-group">
      <h4>Розмір</h4>
      <div class="pp-filter-options">
        <?php
        $sizes = get_terms(['taxonomy' => 'pa_size', 'hide_empty' => true]);
        if (!empty($sizes) && !is_wp_error($sizes)) {
          foreach ($sizes as $size) {
            $checked = in_array($size->slug, $current_size) ? 'checked' : '';
            echo '<label class="pp-tile"><input type="checkbox" name="size[]" value="' . esc_attr($size->slug) . '" ' . $checked . '> ' . esc_html($size->name) . '</label>';
          }
        }
        ?>
      </div>
    </div>

    <?php if (!empty($_GET)) : ?>
      <div class="pp-filter-reset">
        <a href="<?php echo esc_url(get_permalink()); ?>" class="pp-clear-filters">Скинути фільтри</a>
      </div>
    <?php endif; ?>
  </form>
</aside>

