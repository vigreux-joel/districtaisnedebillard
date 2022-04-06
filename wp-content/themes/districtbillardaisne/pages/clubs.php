<?php
/* Template Name: Clubs */
?>
<?php get_header()?>
<?php $fields = get_field('clubs') ?>
	<main>
		<div id="info" class="container">
            <h1><?=get_the_title()?></h1>
            <img src="<?= $fields['intro']['illustration']['url'] ?>"
                 alt="<?= $fields['intro']['illustration']['alt']?:'Photo du club' ?>">
            <div class="col">
                <div class="coordonnees">
                    <h2>Coordonnées</h2>
                    <div>
                        <img src="<?=get_template_directory_uri()?>/src/lieu.svg" alt="Rechercher">
                        <p><span><?= $fields['coordonnees']['rue']?></span>
                            <?= $fields['coordonnees']['ville']?></p>
                    </div>
                    <a href="mailto:<?= $fields['coordonnees']['email']?>">
                        <img src="<?=get_template_directory_uri()?>/src/mail2.svg" alt="Mail:" class="icone">
                        <p><?= $fields['coordonnees']['email']?></p>
                    </a>
                    <?php
                    $tel = $fields['coordonnees']['telephone'];
                    $telFormat = str_replace(' ', '', substr($tel, 1));
                    ?>
                    <a href="tel:+33<?= $telFormat?>">
                        <img src="<?=get_template_directory_uri()?>/src/tel2.svg" alt="tel:" class="icone">
                        <p><?= $fields['coordonnees']['telephone']?></p>
                    </a>
                </div>
                <div>
                    <h2>Présentation</h2>
                    <p><?= $fields['intro']['description']?></p>
                </div>
            </div>
            <div class="col">
                <h2>Carte</h2>
                <?= $fields['iframe_google_map']?>
            </div>
		</div>
		<?php
		$slug = strtolower(str_replace(' ', '-',get_the_title()));
		$articles = new WP_Query( array(
			//'showposts' => 4, //nombre de poste par page
			//'numberposts'   => 4,
			'post_type'     => 'post',
			'post_status'   => 'publish',
			'category_name' => $slug,
		) );

        if($articles->have_posts()):?>
        <div id="actualites" class="container">



			<div>
				<h2>Les dernières actualités</h2>
				<a href="accueil.php" title="Voir toutes les actualitées" class="all">Tout voir</a>
			</div>
			<div class="articles">
				<?php $nombreArticle = 0; ?>

				<?php while ($articles->have_posts()) : $articles->the_post();?>
					<?php //var_dump(get_the_category()); ?>
					<article>
						<?php $image = get_the_post_thumbnail_url(null,'medium');
						if($image):?>
							<div data-src="<?=$image?>" data-alt="<?=get_the_title()?>" class="preview"></div>
						<?php else:
							$default = 0;
							foreach (get_field('accueil', 2)['image_default'] as $field){
								if($field)
									$default++;
							}
							$default = random_int( 1, $default );

							$src = get_field('accueil', 2)['image_default'][$default]['sizes']['medium'];
							?>
							<div data-src="<?=$src?>" data-alt="<?=get_the_title()?>" class="preview"></div>
						<?php endif;?>
						<div class="col">
							<h3><?php the_title()?></h3>
							<h4><?= get_the_date( 'l, j F, Y' )?></h4>

							<?php
							ob_start();
							the_content();
							$text = ob_get_clean();
							$text = str_replace( "<br />", '</p><p>', $text );

							echo $text;

							$document = get_field('document');

							if($document):
								$document = "<a href='{$document['url']}' class='document'>{$document['title']}</a>";
								$text .= $document;
								?>

								<br>
								<p>Document:</p>
								<ul>
									<li><?=$document?></li>
								</ul>

							<?php endif;
							?>



						</div>

						<?php
						$total = 0;
						foreach(['a','p','ul'] as $balise){
							$total += substr_count($text, "<$balise");
						}
						if($total > 1):?>
							<?php $nombreArticle++?>
							<div class="display">
								<p>En savoir plus</p>
								<div></div>
							</div>
						<?php endif; ?>
					</article>
				<?php endwhile; ?>
			</div>
            <?php if($nombreArticle === 4):?>
			<a href="accueil.php" title="Voir toutes les actualitées" class="all">Tout voir</a>
	        <?php endif;?>
		</div>
        <?php endif;?>
	</main>

	<script src="<?=get_template_directory_uri().'/js/clubs.js'?>"></script>
<?php get_footer()?>