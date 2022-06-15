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
            ->attachFromPath('Contrato-Adopcionjose.pdf')
            ->html('<h1>JSSICNDE</h1>')
        ;

        $mailer->send($email);

        return $this->redirectToRoute('admin');

    }


    // Funcion que envia un correo con la cita para el proceso de adopcion
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


    /**
     * @Route("/emailContact/{array}", name="emailContact")
     */
    public function sendEmailContact(MailerInterface $mailer, $array):Response
    {

        $datosEmail = json_decode($array);

        $email = (new TemplatedEmail())
            ->from(new Address('manuelcs160@gmail.com', 'Arca de Jaén'))
            ->to('manuelcs160@gmail.com')
            ->subject($datosEmail[0])
            ->htmlTemplate('emailContact.html.twig')
            ->context([
                'name' => $datosEmail[1],
                'correo' => $datosEmail[2],
                'mensaje' => $datosEmail[3],
            ])
        ;

        $mailer->send($email);

        return new Response("ok");

    }


     // Función que envia un correo con la confirmación de que el animal ha sido adoptado y adjunta el pdf del contrato
    public function sendEmailAnimalAdopted(MailerInterface $mailer, $adoption)
    {

        $email = (new TemplatedEmail())
            ->from(new Address('manuelcs160@gmail.com', 'Arca de Jaén'))
            ->to($adoption->getUsuario()->getEmail())
            ->subject('Animal adoptado')
            ->attachFromPath('estilos/assets/pdf/'.$adoption->getContract())
            ->htmlTemplate('emailAnimalAdopted.html.twig')
            ->context([
                'animalName' => $adoption->getAnimal()->getName(),
            ])
        ;

        $mailer->send($email);

        return true;

    }


}