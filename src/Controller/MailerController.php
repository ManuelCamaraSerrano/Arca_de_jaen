<?php
        namespace App\Controller;
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
        $email = (new Email())
            ->from('manuelcs160@gmail.com')
            ->to('manuelcs160@gmail.com')          
            ->subject('Tutorial Symfony 5 Mailer!')
            ->text('Tutoriales Cursos y Más Contenido')
            ->html('Integrar Twig para mejorar la funcionalidad');

        $mailer->send($email);

        return $this->redirectToRoute('admin');

    }


}