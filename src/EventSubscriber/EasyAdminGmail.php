<?php

  namespace App\EventSubscriber;

use App\Controller\MailerController;
use App\Controller\PdfController;
use App\Entity\Usuario;
  use Doctrine\ORM\EntityManagerInterface;
  use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
  use Symfony\Component\EventDispatcher\EventSubscriberInterface;
  use Symfony\Component\Mailer\MailerInterface;
  use App\Controller\ResetPasswordController;
use App\Entity\Adoption;
use App\Entity\Appointment;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;

  class EasyAdminGmail implements EventSubscriberInterface
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
              BeforeEntityPersistedEvent::class => ['enviarGmail'],
              BeforeEntityPersistedEvent::class => ['enviarGmailCita'],
              BeforeEntityPersistedEvent::class => ['generarPdf']
          ];
      }

      public function enviarGmail(BeforeEntityPersistedEvent $event)
      {
          $entity = $event->getEntityInstance();

          if (!($entity instanceof Usuario)) {
              return;
          }
        
          $this->entityManager->persist($entity);
          $this->entityManager->flush();
          $gmail = new ResetPasswordController($this->resetPasswordHelper,$this->entityManager);
          $gmail->enviarEmail($entity->getEmail(),$this->mailer);
      }

      public function enviarGmailCita(BeforeEntityPersistedEvent $event)
      {
          $entity = $event->getEntityInstance();

          if (!($entity instanceof Appointment)) {
              return;
          }
        
          $this->entityManager->persist($entity);
          $this->entityManager->flush();
          $gmail = new MailerController($this->mailer);
          $gmail->sendEmailCite($this->mailer, $entity);
      }


      public function generarPdf(BeforeEntityPersistedEvent $event)
      {
          $entity = $event->getEntityInstance();

          if (!($entity instanceof Adoption)) {
              return;
          }
        
          $this->entityManager->persist($entity);
          $this->entityManager->flush();
          $gmail = new PdfController();
          $gmail->generatePdf($entity);
      }

  }