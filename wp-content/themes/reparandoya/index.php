<?php get_header(); ?>

<!-- Hero Section -->
<?php if (is_home() || is_front_page()): ?>
<section class="hero-section bg-gradient-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Encuentra el Profesional Perfecto</h1>
                <p class="lead mb-4">Conectamos usuarios con profesionales cualificados para todos tus servicios del hogar</p>
                <div class="hero-buttons">
                    <a href="<?php echo home_url('/servicios'); ?>" class="btn btn-light btn-lg me-3">Ver Servicios</a>
                    <a href="<?php echo home_url('/como-funciona'); ?>" class="btn btn-outline-light btn-lg">Cómo Funciona</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image text-center">
                    <i class="fas fa-tools" style="font-size: 8rem; opacity: 0.8;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="services-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Nuestros Servicios Principales</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="service-card text-center p-4 border rounded">
                    <i class="fas fa-wrench fa-3x text-primary mb-3"></i>
                    <h4>Fontanería</h4>
                    <p>Reparaciones, instalaciones y emergencias de fontanería</p>
                    <a href="<?php echo home_url('/servicios/fontaneria'); ?>" class="btn btn-primary">Ver Más</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="service-card text-center p-4 border rounded">
                    <i class="fas fa-bolt fa-3x text-warning mb-3"></i>
                    <h4>Electricidad</h4>
                    <p>Instalaciones eléctricas y reparaciones certificadas</p>
                    <a href="<?php echo home_url('/servicios/electricidad'); ?>" class="btn btn-primary">Ver Más</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="service-card text-center p-4 border rounded">
                    <i class="fas fa-key fa-3x text-success mb-3"></i>
                    <h4>Cerrajería</h4>
                    <p>Apertura de puertas, cambio de cerraduras y seguridad</p>
                    <a href="<?php echo home_url('/servicios/cerrajeria'); ?>" class="btn btn-primary">Ver Más</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Blog Posts -->
<section class="blog-section py-5 <?php echo (is_home() || is_front_page()) ? 'bg-light' : ''; ?>">
    <div class="container">
        <?php if (is_home() || is_front_page()): ?>
            <h2 class="text-center mb-5">Últimas Noticias y Consejos</h2>
        <?php endif; ?>
        
        <div class="row">
            <?php if (have_posts()): ?>
                <?php while (have_posts()): the_post(); ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <article class="blog-card card h-100">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="card-img-top">
                                    <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="card-body d-flex flex-column">
                                <div class="post-meta mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i> <?php echo get_the_date(); ?>
                                        <i class="fas fa-user ms-2"></i> <?php the_author(); ?>
                                    </small>
                                </div>
                                
                                <h3 class="card-title h5">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a>
                                </h3>
                                
                                <div class="card-text flex-grow-1">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <div class="post-categories mb-3">
                                    <?php 
                                    $categories = get_the_category();
                                    foreach ($categories as $category): 
                                    ?>
                                        <span class="badge bg-primary me-1"><?php echo $category->name; ?></span>
                                    <?php endforeach; ?>
                                </div>
                                
                                <div class="mt-auto">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary">Leer Más</a>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <h3>No hay publicaciones disponibles</h3>
                    <p>Vuelve pronto para ver nuevos contenidos.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Paginación -->
        <?php if (get_next_posts_link() || get_previous_posts_link()): ?>
            <div class="row mt-4">
                <div class="col-12">
                    <nav class="pagination-nav">
                        <div class="d-flex justify-content-between">
                            <div>
                                <?php previous_posts_link('&laquo; Anteriores'); ?>
                            </div>
                            <div>
                                <?php next_posts_link('Siguientes &raquo;'); ?>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>