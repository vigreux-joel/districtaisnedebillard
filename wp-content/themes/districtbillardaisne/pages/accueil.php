<?php
/* Template Name: Accueil */
?>
<?php get_header()?>
<?php $fields = get_field('accueil') ?>
<main>
    <div id="intro" class="container">
        <div class="background">
            <img src="<?= $fields['intro']['illustration']['url'] ?>"
                 alt="<?= $fields['intro']['illustration']['alt']?:'background' ?>">
        </div>

        <div class="col">
            <h1><?= $fields['intro']['titre'] ?></h1>
			<?= $fields['intro']['description'] ?>
        </div>
    </div>

	<?php
	$articles = new WP_Query( array(
		'showposts' => 4, //nombre de poste par page
		//'numberposts'   => 4,
		'post_type'     => 'post',
		'post_status'   => 'publish',
		'category_name' => 'actualite',
	) ); ?>


    <div id="actualites" class="container">
        <div>
            <h2>Dernières actualités</h2>
            <a href="accueil.php" title="Voir toutes les actualitées" class="all">Tout voir</a>
        </div>
        <div class="articles">
        <?php $nombreArticle = 0?>
		<?php while ($articles->have_posts()) : $articles->the_post();?>
		<?php //var_dump(get_the_category()); ?>
            <article>
                <?php $image = get_the_post_thumbnail_url(null,'medium');

                if($image):?>
                <div data-src="<?=$image?>" data-alt="<?=get_the_title()?>" class="preview"></div>

                <?php else:
                    $default = 0;
                    foreach ($fields['image_default'] as $field){
                        if($field)
                            $default++;
                    }
                    $default = random_int(1, $default);
                    $src = $fields['image_default'][$default]['sizes']['medium'];
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
        <a href="accueil.php" title="Voir toutes les actualitées" class="all">Tout voir</a>
    </div>
    <div id="competitions" class="container">
        <h2>Compétitions à venir</h2>
        <div class="row">
            <?php
            require_once dirname(__DIR__).'/calendarAPI/GoogleCalendar.php';
            foreach(googleCalendar::getItems([
		            'maxResults' => 4,
		            'orderBy' => 'startTime',
		            'singleEvents' => true,
                    'q' => 'compétition',
		            'timeMin' => date('c'),
                ]) as $event):


            setlocale(LC_ALL, "fr_fr");
            $title = $event->getSummary();
            $discipline = explode('-', $title);
            if(!isset($discipline[1])){
                continue;
            }


            $discipline = trim($discipline[1]);

	        $fields = get_field( 'competition', get_page_by_title($discipline)->ID);
	        if(!$fields){
		        continue;
	        }
	        $date = $event->getStart()->dateTime;
            $date = date("dmY", strtotime($date));
            //récupérer la date en format: xx(jour) mois(écrit en francais grace au local) 20xx(année)
            $date = ucfirst(strftime('%d %B %Y', DateTime::createFromFormat('dmY', $date)->format('U')));
            $description = $event->getDescription();


            $inscription = $fields['inscription'];
            $textInscription = $fields['texte_si_indisponible'];

            //$loc = $event->getLocation();
            ?>

            <article>
                <a href="<?= get_page_by_title($discipline)->guid?>" title="Redirection vers <?= $discipline?>">
	            <?="<img src='{$fields['illustration']['sizes']['medium_large']}' alt='Illustration de $discipline'>"?>
	            <?="<h3>$title</h3>"?>
	            <?="<h4>$date</h4>"?>
	            <?= "<p>{$fields['description']}</p>"?>
                </a>
	            <?php if($inscription):?>
                    <button>S'inscire</button>
	            <? endif;
	            /*
	            if($inscription || $textInscription){
                    $contenu = ($inscription)? '>Inscription': "disabled>$textInscription";
                    echo "<button ".$contenu."</button>";
                }
                */
                ?>
            </article>
            <?php endforeach;?>
        </div>
        <a class="calendar">
            <h3>Prochaines compétitions</h3>
            <img src="<?= get_template_directory_uri()?>/src/calendar.svg" alt="Calendar">
        </a>
    </div>
</main>

    <script src="<?=get_template_directory_uri().'/js/accueil.min.js'?>"></script>
<?php get_footer()?>