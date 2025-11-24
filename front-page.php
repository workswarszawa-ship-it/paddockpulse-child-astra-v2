<?php
/** Front page template (child theme) */
defined('ABSPATH') || exit;
get_header();

$theme_uri = get_stylesheet_directory_uri();

/** Ссылка на категорию по одному/нескольким слагам */
function pp_link_by_slugs($slugs){
  foreach ((array)$slugs as $slug){
    $t = get_term_by('slug', $slug, 'product_cat');
    if ($t && !is_wp_error($t)) return get_term_link($t);
  }
  return '#';
}

/** Универсальный вывод UL c product LI (для рекомендуем/акции/резерв) */
function pp_render_products_ul($args){
  $q = new WP_Query($args);
  if ($q->have_posts()){
    echo '<ul class="products">';
    while ($q->have_posts()){ $q->the_post(); wc_get_template_part('content','product'); }
    echo '</ul>';
    wp_reset_postdata();
    return true;
  }
  return false;
}
?>

<main class="site-main">

  <!-- ===== 1) Верхние 4 карточки ===== -->
  <section class="home-section home-top-cats">
    <div class="ast-container">
      <div class="cards-container">

        <div class="main-category-card">
          <a href="<?php echo esc_url(pp_link_by_slugs('vse-dlya-vershnyka-uk')); ?>">
            <img src="<?php echo esc_url($theme_uri.'/images/rider.jpg'); ?>" alt="Все для вершника">
            <h3>Все для вершника</h3>
            <span class="pp-cta">В магазин</span>
          </a>
        </div>

        <div class="main-category-card">
          <a href="<?php echo esc_url(pp_link_by_slugs('vse-dlya-konya-uk')); ?>">
            <img src="<?php echo esc_url($theme_uri.'/images/horse.jpg'); ?>" alt="Все для коня">
            <h3>Все для коня</h3>
            <span class="pp-cta">В магазин</span>
          </a>
        </div>

        <div class="main-category-card">
          <a href="<?php echo esc_url(pp_link_by_slugs(['vse-dlya-stayni-uk','vse-dlya-stajni-uk'])); ?>">
            <img src="<?php echo esc_url($theme_uri.'/images/stable.jpg'); ?>" alt="Все для стайні">
            <h3>Все для стайні</h3>
            <span class="pp-cta">В магазин</span>
          </a>
        </div>

        <div class="main-category-card">
          <a href="<?php echo esc_url(pp_link_by_slugs('vse-dlya-sobak-uk')); ?>">
            <img src="<?php echo esc_url($theme_uri.'/images/dog.jpg'); ?>" alt="Все для собак">
            <h3>Все для собак</h3>
            <span class="pp-cta">В магазин</span>
          </a>
        </div>

      </div>
    </div>
  </section>

  <!-- ===== 2) Преимущества ===== -->
  <section class="home-section home-benefits">
    <div class="ast-container">
      <div class="info-row">

        <div class="info-item">
          <img src="<?php echo esc_url($theme_uri.'/images/icon-phone.png'); ?>" alt="Ми на зв’язку">
          <h3>Ми на зв’язку</h3>
          <p>Щодня з 8.00 до 22.00</p>
        </div>

        <div class="info-item">
          <img src="<?php echo esc_url($theme_uri.'/images/icon-helmet-brand.png'); ?>" alt="Працюємо з найкращими брендами">
          <h3>Працюємо з найкращими брендами</h3>
          <p>Професійна екіпіровка</p>
        </div>

        <div class="info-item">
          <img src="<?php echo esc_url($theme_uri.'/images/icon-trust.png'); ?>" alt="Нам довіряють">
          <h3>Нам довіряють</h3>
          <p>Працюємо з 2015 року</p>
        </div>

      </div>
    </div>
  </section>

  <!-- ===== 3) Одежда ===== -->
  <section class="home-section home-clothes">
    <div class="ast-container">
      <div class="clo-row">

        <a class="clo-card"
           href="<?php echo esc_url(pp_link_by_slugs('zhinochyy-odyah-uk')); ?>"
           style="--bg:url('<?php echo esc_url($theme_uri.'/images/woman.jpg'); ?>')">
          <div class="clo-left">
            <h3>Женская одежда</h3>
            <span class="clo-btn">Купить</span>
          </div>
        </a>

        <a class="clo-card"
           href="<?php echo esc_url(pp_link_by_slugs('dytyachyy-odyah-uk')); ?>"
           style="--bg:url('<?php echo esc_url($theme_uri.'/images/kids.jpg'); ?>')">
          <div class="clo-left">
            <h3>Детская одежда</h3>
            <span class="clo-btn">Купить</span>
          </div>
        </a>

        <a class="clo-card"
           href="<?php echo esc_url(pp_link_by_slugs('cholovichyy-odyah-uk')); ?>"
           style="--bg:url('<?php echo esc_url($theme_uri.'/images/men.jpg'); ?>')">
          <div class="clo-left">
            <h3>Мужская одежда</h3>
            <span class="clo-btn">Купить</span>
          </div>
        </a>

      </div>
    </div>
  </section>

  <!-- ===== 4) Новинки ===== -->
  <section class="home-section linegrid home-new">
    <div class="ast-container">
      <h2 class="home-title">Новинки</h2>
      <?php echo do_shortcode('[products limit="5" columns="5" orderby="date" order="DESC"]'); ?>
    </div>
  </section>

  <!-- ===== 5) Рекомендуем (featured, запасной вариант — последние) ===== -->
  <section class="home-section linegrid home-recommended">
    <div class="ast-container">
      <h2 class="home-title">Рекомендуем</h2>
      <?php
      $shown = pp_render_products_ul([
        'post_type'      => 'product',
        'posts_per_page' => 5,
        'tax_query'      => [[
          'taxonomy' => 'product_visibility',
          'field'    => 'name',
          'terms'    => 'featured',
          'operator' => 'IN',
        ]],
        'orderby'        => 'date',
        'order'          => 'DESC',
      ]);
      if (!$shown){
        echo do_shortcode('[products limit="5" columns="5" orderby="date" order="DESC"]');
      }
      ?>
    </div>
  </section>

  <!-- ===== 6) Акции (если пусто — последние со скидкой отсутствуют, то просто новые) ===== -->
  <section class="home-section linegrid home-sale">
    <div class="ast-container">
      <h2 class="home-title">Акции</h2>
      <?php
      $sale_ids = wc_get_product_ids_on_sale();
      if (!empty($sale_ids)){
        pp_render_products_ul([
          'post_type'      => 'product',
          'posts_per_page' => 5,
          'post__in'       => $sale_ids,
          'orderby'        => 'date',
          'order'          => 'DESC',
        ]);
      } else {
        echo do_shortcode('[products limit="5" columns="5" orderby="date" order="DESC"]');
      }
      ?>
    </div>
  </section>

</main>

<?php get_footer(); ?>
