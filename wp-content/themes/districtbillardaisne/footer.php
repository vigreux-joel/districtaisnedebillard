<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package districtBillardAisne
 */

$coordonnees = get_field('coordonnees_du_district', '122');
$siege = get_field('siege_social', '122');
$annexes = get_field('instances_annexes', '122');
?>
<footer>
    <svg width="100%" height="55" viewBox="0 0 1920 54" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="wave"  id="wave-footer">
        <path d="M1920 30.1565V54.0074V54.5014H0V18.2311C0 18.2311 56.5001 23.1765 167 30.1565C277.5 37.1364 361.455 42.2087 475.228 42.6498C589 43.0908 800 36.971 960 30.1565C1020.95 27.5605 1200 11 1200 11C1200 11 1338.5 0.156999 1440 0.00184796C1541.5 -0.153303 1680 11 1680 11L1920 30.1565Z" fill="url(#paint0_linear_708:519)"/>
            <defs>
            <linearGradient id="paint0_linear_708:519" x1="1920" y1="0" x2="0" y2="0" gradientUnits="userSpaceOnUse">
                <stop stop-color="#34A58A"/>
                <stop offset="50%" stop-color="#34A58A"/>
                <stop offset="50%" stop-color="#345765"/>
            </linearGradient>
        </defs>
    </svg>
    <div class="row">
        <div class="left">
            <div class="col" id="footer-first">
                <h4>coordonnées du District:</h4>
                <ul>
                    <li>
                        <?php
                        $tel = $coordonnees['telephone'];
                        $telFormat = str_replace(' ', '', substr($tel, 1));
                        ?>
                        <img src="<?=get_template_directory_uri()?>/src/tel.svg" alt="tel:" class="icone">
                        <a href="tel:+33<?= $telFormat?>"><?= $coordonnees['telephone']?></a>
                    </li>
                    <li>
                        <img src="<?=get_template_directory_uri()?>/src/mail.svg" alt="Mail:" class="icone">
                        <a href="mailto:<?= $coordonnees['email']?>"><?= $coordonnees['email']?></a>
                    </li>
                </ul>
                <h4>siège social:</h4>
                <ul>
                    <li>
                        <img src="<?=get_template_directory_uri()?>/src/siege.svg" alt="Siege:" class="icone">
                        <p><span><?= $siege['rue']?></span> <?= $siege['ville']?></p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="right">
            <div class="col" id="footer-second">
                <h4>instances annexes:</h4>
                <p><a href="<?= $annexes['clubs']['umb']?>" target="_blank" title="rediredtion le site de l'UMB">UMB</a>|<a href="<?= $annexes['clubs']['ceb']?>" target="_blank" title="redirection vers le site du CEB">CEB</a>|<a href="<?= $annexes['clubs']['ffb']?>" target="_blank" title="redirection vers le site de la fédération française de billard">FFB</a>|<a href="<?= $annexes['clubs']['hdf']?>" target="_blank" title="redirection vers le site des haut de france de billard">HDF</a></p>
                <p>Commités : <a href="<?= $annexes['commites']['59']?>" target="_blank" title="redirection vers le site hdf billard ">59</a>|<a href="<?= $annexes['commites']['60']?>" target="_blank" title="redirection vers le site du comite de l'oise de billard"> 60</a>|<a href="<?= $annexes['commites']['62']?>" target="_blank" title="redirection vers le groupe facebook">62</a>|<a href="<?= $annexes['commites']['80']?>" target="_blank" title="redirection vers le groupe facebook">80</a></p>
                <h4>juridique:</h4>
                <p><a href="#" title="redirection vers les mentions legal" target="_blank">Mentions légales</a></p>
                <p><a href="#" title="redirection vers le plan du site" target="_blank">Plan du site</a></p>
                <div class="logos">
                    <a href="https://aisne.com/" title="redirection vers le site de l'aisne" target="_blank"><img src="http://districtaisnebillard.fr/wp-content/uploads/2021/10/aisne-1-1.png" alt="Logo Aisne" class="logo" loading="lazy"></a>
                    <a href="http://districtaisnebillard.fr/" title="redirection le site du district de l'aisne de billard" target="_blank"><img src="http://districtaisnebillard.fr/wp-content/uploads/2021/10/logo-1.png" alt="Logo District Aisne de Billard" class="logo"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <p class>© 2021 - District Aisne de Billard | Réalisé par ...</p>
    </div>
    </footer>
<?php //wp_footer(); ?>
    <script src="<?=get_template_directory_uri().'/js/index.js'?>"></script>
    <script src="<?=get_template_directory_uri().'/js/footer.js'?>"></script>
</body>
</html>
