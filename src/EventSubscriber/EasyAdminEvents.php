<?php

    namespace App\EventSubscriber;

    use App\Controller\MailerController;
    use App\Controller\PdfController;
    use App\Entity\Usuario;
    use Doctrine\ORM\EntityManagerInterface;
    use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
    use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
    use Symfony\Component\EventDispatcher\EventSubscriberInterface;
    use Symfony\Component\Mailer\MailerInterface;
    use App\Controller\ResetPasswordController;
    use App\Entity\Adoption;
    use App\Entity\Appointment;
    use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;
    use Symfony\Component\Routing\Annotation\Route;

  class EasyAdminEvents implements EventSubscriberInterface
  {

      private $entityManager;
      private $passwordEncoder;
      private $resetPasswordHelper;
      private $mailer;

      public function __construct(EntityManagerInterface $entityManager,ResetPasswordHelperInterface $resetPasswordHelper,MailerInterface $mailer)
      {
          $this->entityManager = $entityManager;
          $this->resetPasswordHelper = $resetPasswordHelper;
          $this->mailer = $mailer;
      }

      public static function getSubscribedEvents()
      {
          return [
              BeforeEntityPersistedEvent::class => ['persistedEvents'],
              BeforeEntityUpdatedEvent::class => ['updatedEvents']
          ];
      }

      public function persistedEvents(BeforeEntityPersistedEvent $event)  // Funcion que controla cuando se ha persistido una entidad
      {
          $entity = $event->getEntityInstance();

          if ($entity instanceof Usuario) {  // Controlamos cuando se inserta un usuario

            $this->entityManager->persist($entity);
            $this->entityManager->flush();
  
            $gmail = new ResetPasswordController($this->resetPasswordHelper,$this->entityManager);
            $gmail->enviarEmail($entity->getEmail(),$this->mailer);

          }

          if ($entity instanceof Appointment) {  // Controlamos cuando se inserta una cita

            $this->entityManager->persist($entity);
            $this->entityManager->flush();
            $gmail = new MailerController($this->mailer);
            $gmail->sendEmailCite($this->mailer, $entity);
   
          }
        
          
          if ($entity instanceof Adoption) {  // Controlamos cuando se inserta una adopción

            $this->entityManager->persist($entity);
            $this->entityManager->flush();
            $gmail = new PdfController();
            $gmail->generatePdf($entity);

          }
          
      }


      public function updatedEvents(BeforeEntityUpdatedEvent $event)  // Funcion que controla cuando se ha persistido una entidad
      {
         $entity = $event->getEntityInstance();

         if ($entity instanceof Adoption) {  // Controlamos cuando se actualiza una adopción


            if($entity->getState() == "Finalizada"){
                $animal = $entity->getAnimal();
                $animal->setAdopted("Si");

                $gmail = new MailerController($this->mailer);
                $gmail->sendEmailAnimalAdopted($this->mailer, $entity);
            }


          }

      }

  }