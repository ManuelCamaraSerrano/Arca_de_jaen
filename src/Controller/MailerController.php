<?php
        namespace App\Controller;

use Google\Service\Compute\Address;
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
            ->from('fabien@example.com')
            ->to(new Address('ryan@example.com'))
            ->subject('Thanks for signing up!')

            // path of the Twig template to render
            ->htmlTemplate('resert_password/email.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => 'foo',
            ])
        ;

        $mailer->send($email);

        return $this->redirectToRoute('admin');

    }

    /**
    * @Route("/emailCita")
    */
    public function sendEmailCite(MailerInterface $mailer, $cita): Response
    {
        $email = (new Email())
            ->from('manuelcs160@gmail.com')
            ->to('manuelcs160@gmail.com')          
            ->subject('Cita para proceso de adopción')
            ->text('Tutoriales Cursos y Más Contenido')
            ->embed(fopen('C:\wamp64m\www\Arca_de_jaen\public\estilos\assets\images\logo.png', 'r'), 'footer-signature')
             // reference images using the syntax 'cid:' + "image embed name"
            ->html('<img src="cid:footer-signature">')
            ->html('');
        //dd($cita->getRequest()->getAnimal()->getName());

        $mailer->send($email);

        return $this->redirectToRoute('admin');

    }


}