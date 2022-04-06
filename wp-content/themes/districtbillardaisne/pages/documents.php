<?php
/* Template Name: Documents */

get_header()?>

<?php $fields = get_field('accueil') ?>
	<main>


		<?php

		$slug = strtolower(str_replace(' ', '-',get_the_title()));

		$articles = new WP_Query( array(
			'post_type'     => 'post',
			'post_status'   => 'publish',
			'category_name' => $slug,
            /*
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'include_children' => false,
					'field' => 'name',
					'terms'    => array('document', $slug)
				)
			)
            */
		) );
		?>

        <h1><?php the_title()?></h1>
        <div>
            <?php if($articles->have_posts()):?>
                <p>Ici vous trouverez tous les comptes rendus de réunion, les procès-verbaux d’assemblée générale, bilan financier etc.</p>
            <?php else:?>
                <p>Aucun fichier trouvé</p>
            <?php endif;?>
            <div>
                <input type="text" placeholder="Commencer votre recherche">
                <img src="<?=get_template_directory_uri()?>/src/search.svg" alt="Rechercher">
            </div>
        </div>



        <div>
        <?php $nbArticle = 0?>
        <?php while ($articles->have_posts()) : $articles->the_post();?>
            <?php $document = get_field('document');?>
            <article>
                <a href='<?=$document['url']?>' class='document' target="_blank">
                <div>
                    <h3><?=$document['title']?></h3>
                    <h4><?= get_the_date( ' d/m/Y' )?></h4>
                </div>
                    <?php
                    if($nbArticle === 0):?>
                        <svg width="30" height="30" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" id="download">
                            <path d="M10 13V1M10 13L5 8M10 13L15 8M19 13V17C19 17.5304 18.7893 18.0391 18.4142 18.4142C18.0391 18.7893 17.5304 19 17 19H3C2.46957 19 1.96086 18.7893 1.58579 18.4142C1.21071 18.0391 1 17.5304 1 17V13" stroke="#34A58A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php else:?>
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use xlink:href="#download"/>
                        </svg>
                    <?php endif;
                    $nbArticle++;
                    ?>
                </a>

            </article>
        <?php endwhile; ?>
        </div>
	</main>
	<script src="<?=get_template_directory_uri().'/js/documents.js'?>"></script>
<?php get_footer()?>