<?php
/* Template Name: Contact */
?>

<?php
get_header();
$coordonnees = get_field('coordonnees_du_district', '122');
$siege = get_field('siege_social', '122');
?>
<main>
	<div class="container">
		<div class="row">
			<div class="col" id="contact">
				<h1>Nous contacter</h1>
				<p>Besoin d'un renseignement, souhaitez-vous remonter une information ou recherchez-vous une information qui ne figure pas sur notre site internet ?</p>
				<?=do_shortcode( '[contact-form-7 id="58" title="Formulaire de contact 1"]' ); ?>
			</div>
			<div class="col" id="info">
                <div>
                    <h2>Carte</h2>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6176.36938759948!2d3.323282923820622!3d49.39295350374389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e85eafc0ac249f%3A0xd9a652b0bd2f6057!2sBillard%20Club%20de%20Soissons!5e0!3m2!1sfr!2sfr!4v1641546192538!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="coordonnees">
                    <h2>Coordonnées</h2>
                    <div>
                        <img src="<?=get_template_directory_uri()?>/src/siege2.svg" alt="Siege:" class="icone">
                        <p><span><?= $siege['rue']?></span> <?= $siege['ville']?></p>
                    </div>
                    <a href="mailto:<?= $coordonnees['email']?>">
                        <img src="<?=get_template_directory_uri()?>/src/mail2.svg" alt="Mail:" class="icone">
                        <p><?= $coordonnees['email']?></p>
                    </a>
				<?php
				$tel = $coordonnees['telephone'];
				$telFormat = str_replace(' ', '', substr($tel, 1));
				?>
                <a href="tel:+33<?= $telFormat?>">

                        <img src="<?=get_template_directory_uri()?>/src/tel2.svg" alt="tel:" class="icone">
                        <p><?= $coordonnees['telephone']?></p>
                </a>
                </div>
            </div>
		</div>
	</div>
</main>
<script src="<?=get_template_directory_uri().'/js/contact.js'?>"></script>
<?php get_footer()?>
