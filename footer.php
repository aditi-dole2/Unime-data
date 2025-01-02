<footer class="">
    <div class="container">
        <div class="row">
            </div>
            <div class="col-md-2.5">
            <?php 
                wp_nav_menu( 
                    array( 
                        'theme_location' => 'footer-menu',
                    )
                );
            ?>
            </div>
        </div>
    </div>

</footer>
<br>
<?php wp_footer()?>
</body>
</html>