<?php

  namespace App\EventSubscriber;

use App\Controller\AppointmentCalendarController;
use App\Entity\Appointment;
  use Doctrine\ORM\EntityManagerInterface;
  use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
  use Symfony\Component\EventDispatcher\EventSubscriberInterface;
  use Symfony\Component\Mailer\MailerInterface;
  use App\Controller\ResetPasswordController;
  use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;

  class EasyAdminAppointment implements EventSubscriberInterface
  {

      private $entityManager;
      private $passwordEncoder;
      private $mailer;

      public function __construct(EntityManagerInterface $entityManager,MailerInterface $mailer)
      {
          $this->entityManager = $entityManager;
          $this->mailer = $mailer;
      }

      public static function getSubscribedEvents()
      {
          return [
              BeforeEntityPersistedEvent::class => ['crearCita'],
          ];
      }

      public function crearCita(BeforeEntityPersistedEvent $event)
      {
          $entity = $event->getEntityInstance();

          if (!($entity instanceof Appointment)) {
              return;
          }

        
          $this->entityManager->persist($entity);
          $this->entityManager->flush();


          $appointment = new AppointmentCalendarController();

          $appointment->citaCalendar($entity->getDate(),"LUCAS");
          
          //$gmail->enviarEmail($entity->getEmail(),$this->mailer);

          













          
      }

  }