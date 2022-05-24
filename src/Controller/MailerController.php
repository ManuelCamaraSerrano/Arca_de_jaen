<?php
        namespace App\Controller;

        use DateTime;
        use Symfony\Component\Mime\Address;
        use Symfony\Bridge\Twig\Mime\TemplatedEmail;
        use Symfony\Component\Mailer\MailerInterface;
        use Symfony\Component\Mime\Email;
        use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
        use Symfony\Component\HttpFoundation\Response;
        use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{

    /**
    * @Route("/email")
    */
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new TemplatedEmail())
            ->from(new Address('manuelcs160@gmail.com', 'Arca de Jaén'))
            ->to("manuelcs160@gmail.com")
            ->subject('Your password reset request')
            ->htmlTemplate('reset_password/email.html.twig')
            ->context([
                'animalname' =>"sxsa",
            ])
        ;

        $mailer->send($email);

        return $this->redirectToRoute('admin');

    }


    public function sendEmailCite(MailerInterface $mailer, $cita)
    {

        $email = (new TemplatedEmail())
            ->from(new Address('manuelcs160@gmail.com', 'Arca de Jaén'))
            ->to($cita->getRequest()->getUsuario()->getEmail())
            ->subject('Cita para el proceso de adopción')
            ->htmlTemplate('emailCite.html.twig')
            ->context([
                'animalName' => $cita->getRequest()->getAnimal()->getName(),
                'userName' => $cita->getRequest()->getUsuario()->getName(),
                'date' => date_format($cita->getDate(),'d/m/20y'),
                'hour' =>  date_format($cita->getDate(),'h:i'),
            ])
        ;

        $mailer->send($email);

        return true;

    }


}