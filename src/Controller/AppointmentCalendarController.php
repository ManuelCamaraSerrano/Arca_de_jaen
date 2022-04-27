<?php
        namespace App\Controller;


        use DateInterval;
        use DateTime;
        use Exception;
        use Symfony\Component\Mailer\MailerInterface;
        use Symfony\Component\Mime\Email;
        use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
        use Symfony\Component\Routing\Annotation\Route;
        use Google_Client;
        use Google_Service_Exception;
        use Google_Service_Calendar_Resource_Events;
        use Google_Service_Calendar_Calendar;
        use Calendar;
        
        
        
        

class AppointmentCalendarController extends AbstractController
{

      /**
       * @Route("/citaCalendar")
       */
        public function citaCalendar($fecha, $nombre)
        {
            $m=''; //for error messages
            $id_event=''; //id event created 
            
                date_default_timezone_set('europe/madrid');

                //configurar variable de entorno / set enviroment variable
                putenv('GOOGLE_APPLICATION_CREDENTIALS=../../credenciales.json');


                $client = new Google_Client();
                $client->useApplicationDefaultCredentials();
                $client->setScopes(['https://www.googleapis.com/auth/calendar']);

                //define id calendario
                $id_calendar='arcadejaen16@gmail.com';
                
            
                $datetime_start = $fecha;
                $datetime_end = $fecha;
                
                //aumentamos una hora a la hora inicial/ add 1 hour to start date
                $time_end = $datetime_end->add(new DateInterval('PT1H'));
                
                //datetime must be format RFC3339
                $time_start =$datetime_start->format(\DateTime::RFC3339);
                $time_end=$time_end->format(\DateTime::RFC3339);

        
                try{
                    
                    //instanciamos el servicio
                $calendarService = new Google_Service_Calendar($client);
                
                    
                
                    //parámetros para buscar eventos en el rango de las fechas del nuevo evento
                    //params to search events in the given dates
                    $optParams = array(
                        'orderBy' => 'startTime',
                        'maxResults' => 20,
                        'singleEvents' => TRUE,
                        'timeMin' => $time_start,
                        'timeMax' => $time_end,
                    );

                    //obtener eventos 
                    $events=$calendarService->events->listEvents($id_calendar,$optParams);
                    
                    //obtener número de eventos / get how many events exists in the given dates
                    $cont_events=count($events->getItems());
                
                    //crear evento si no hay eventos / create event only if there is no event in the given dates
                    if($cont_events == 0){

                        $event = new Google_Service_Calendar_Event();
                        $event->setSummary('Cita con '.$nombre);
                        $event->setDescription('Solicitud de Adopción');
                    

                        //fecha inicio
                        $start = new Google_Service_Calendar_EventDateTime();
                        $start->setDateTime($time_start);
                        $event->setStart($start);

                        //fecha fin
                        $end = new Google_Service_Calendar_EventDateTime();
                        $end->setDateTime($time_end);
                        $event->setEnd($end);

                    
                        $createdEvent = $calendarService->events->insert($id_calendar, $event);

                        return true;
                    }else{
                        return $m = "Hay ".$cont_events." eventos en ese rango de fechas";
                    }


                }catch(Google_Service_Exception $gs){
                
                $m = json_decode($gs->getMessage());
                $m= $m->error->message;

                }catch(Exception $e){

                    $m = $e->getMessage();
                
                }
            

        }


    }