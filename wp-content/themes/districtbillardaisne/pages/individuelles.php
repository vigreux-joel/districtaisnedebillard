<?php
/* Template Name: Individuelles */
?>

<?php $fields = get_field('competition') ?>
<?php
    if(isset($_GET['api'])){

        if($_GET['api'] === 'getCompetition'){
            $arr = [];

            require_once dirname(__DIR__).'/calendarAPI/GoogleCalendar.php';

            $interval = $fields['date_de_debut_de_saisons'];
            if(isset($_POST['year'])){
                $year = $_POST['year'];
            }
            if(!$year) {
                DateTime::createFromFormat('d/m', $interval);
                $year = date('Y');
                if(DateTime::createFromFormat('d/m', $interval)->getTimestamp() >= time()){
                    $year--;
                }
            }
            
            $timeStampDebut = DateTime::createFromFormat('Y/d/m-H:i:s', $year.'/'. $interval.'-00:00:00')->getTimestamp();
            $timeStampFin = DateTime::createFromFormat('Y/d/m-H:i:s', ($year+1).'/'.$interval.'-00:00:00')->getTimestamp()-1;
            //var_dump(date('c', $timeStampDebut));
            //var_dump(date('c', $timeStampFin));
    
            foreach(googleCalendar::getItems([
                //'maxResults' => 4,
                'orderBy' => 'startTime',
                'singleEvents' => true,
                'q' => get_the_title(),
                'timeMin' => date('c', $timeStampDebut),
                'timeMax' => date('c', $timeStampFin),
            ]) as $event){
                $title = str_replace('- '.get_the_title(), '', $event->getSummary());
                $date = $event->getStart()->dateTime;
                $date = date("dmY", strtotime($date));
                //récupérer la date en format: xx(jour) mois(écrit en francais grace au local) 20xx(année)
                $date = ucfirst(strftime('%d %B %Y', DateTime::createFromFormat('dmY', $date)->format('U')));
                $description = $event->getDescription();

	            $arr['year'] = $year;
                $arr['etape'][] = [
                    'year' => $year,
                    'titre'=> $title,
                    'date'=> $date,
                    'description'=> $description,
                ];
            }
            echo json_encode($arr);
    
            return;
        }
        
    }
?>

<?php get_header()?>
<main>
	<div id="intro" class="container">
        <div class="background">
            <img src="<?= $fields['illustration']['url'] ?>" alt="<?= $fields['illustration']['alt'] ?>">
        </div>
        <div class="row">
            <div class="left">
                <div class="col">
                    <h1><?php the_title()?></h1>
                    <?= $fields['description']?>
                    <div class="button">

                    </div>
                </div>
            </div>
        </div>
        <svg width="100%" height="40" viewBox="0 0 1920 40" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 40L80 33.9785C160 27.957 320 15.914 480 9.89249C640 3.87099 800 0 960 0C1120 0 1280 3.87099 1440 9.89249C1600 15.914 1760 27.957 1840 33.9785L1920 40L1840 40C1760 40 1600 40 1440 40C1280 40 1120 40 960 40C800 40 640 40 480 40C320 40 160 40 80 40L0 40Z" fill="white"/>
        </svg>



    </div>
    <div id="competition" class="container">
        <div>
            <h2></h2>
        </div>
        <div class="articles">
        </div>
        <div class="next">
            <img src="<?= get_template_directory_uri().'/src/suite.svg'?>" alt="saisons précédente">
            <p></p>
        </div>
    </div>
</main>
<script src="<?=get_template_directory_uri().'/js/individuelles.min.js'?>"></script>

<?php get_footer()?>
