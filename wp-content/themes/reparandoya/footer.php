</main>

<footer class="site-footer bg-dark text-light mt-5">
    <div class="container py-5">
        <div class="row">
            <!-- Columna 1: Información de la empresa -->
            <div class="col-md-3 mb-4">
                <h5>ReparandoYa</h5>
                <p>La plataforma líder para encontrar profesionales cualificados cerca de ti.</p>
                <div class="social-links">
                    <a href="https://facebook.com/reparandoya" class="text-light me-3" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/reparandoya" class="text-light me-3" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://instagram.com/reparandoya" class="text-light me-3" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://linkedin.com/company/reparandoya" class="text-light" target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            
            <!-- Columna 2: Servicios -->
            <div class="col-md-3 mb-4">
                <h5>Servicios</h5>
                <ul class="list-unstyled">
                    <li><a href="<?php echo home_url('/servicios/fontaneria'); ?>" class="text-light">Fontanería</a></li>
                    <li><a href="<?php echo home_url('/servicios/electricidad'); ?>" class="text-light">Electricidad</a></li>
                    <li><a href="<?php echo home_url('/servicios/cerrajeria'); ?>" class="text-light">Cerrajería</a></li>
                    <li><a href="<?php echo home_url('/servicios/limpieza'); ?>" class="text-light">Limpieza</a></li>
                    <li><a href="<?php echo home_url('/servicios/jardineria'); ?>" class="text-light">Jardinería</a></li>
                </ul>
            </div>
            
            <!-- Columna 3: Empresa -->
            <div class="col-md-3 mb-4">
                <h5>Empresa</h5>
                <ul class="list-unstyled">
                    <li><a href="<?php echo home_url('/sobre-nosotros'); ?>" class="text-light">Sobre Nosotros</a></li>
                    <li><a href="<?php echo home_url('/como-funciona'); ?>" class="text-light">Cómo Funciona</a></li>
                    <li><a href="<?php echo home_url('/profesionales'); ?>" class="text-light">Hazte Profesional</a></li>
                    <li><a href="<?php echo home_url('/ayuda'); ?>" class="text-light">Centro de Ayuda</a></li>
                    <li><a href="<?php echo home_url('/contacto'); ?>" class="text-light">Contacto</a></li>
                </ul>
            </div>
            
            <!-- Columna 4: Newsletter -->
            <div class="col-md-3 mb-4">
                <h5>Newsletter</h5>
                <p>Recibe las mejores ofertas y consejos</p>
                <form class="newsletter-form" id="newsletter-form">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Tu email" required>
                        <button class="btn btn-primary" type="submit">Suscribirse</button>
                    </div>
                </form>
                <small class="text-muted">Respetamos tu privacidad</small>
            </div>
        </div>
        
        <!-- Testimonios en footer -->
        <div class="row mt-4">
            <div class="col-12">
                <h5 class="text-center mb-4">Lo que dicen nuestros clientes</h5>
                <div class="row">
                    <div class="col-md-4 text-center mb-3">
                        <div class="testimonial-footer">
                            <div class="stars">⭐⭐⭐⭐⭐</div>
                            <p class="mb-1">"Servicio excelente"</p>
                            <small>- María G.</small>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-3">
                        <div class="testimonial-footer">
                            <div class="stars">⭐⭐⭐⭐⭐</div>
                            <p class="mb-1">"Muy profesionales"</p>
                            <small>- Carlos R.</small>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-3">
                        <div class="testimonial-footer">
                            <div class="stars">⭐⭐⭐⭐⭐</div>
                            <p class="mb-1">"Lo recomiendo 100%"</p>
                            <small>- Ana L.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Copyright -->
    <div class="bg-darker py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> ReparandoYa. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="<?php echo home_url('/privacidad'); ?>" class="text-light me-3">Política de Privacidad</a>
                    <a href="<?php echo home_url('/terminos'); ?>" class="text-light">Términos de Uso</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>