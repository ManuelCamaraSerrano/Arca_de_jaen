<?php
        namespace App\Controller;

        use Mpdf\Mpdf;
        use Mpdf\HTMLParserMode;
        use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
        use Symfony\Component\HttpFoundation\Response;
        use Symfony\Component\Routing\Annotation\Route;

class PdfController extends AbstractController
{

    /**
    * @Route("/generatePdf", name="generatePdf")
    */
    public function generatePdf($adopcion)
    {
        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
        $stylesheet = file_get_contents('estilos/assets/css/stylePdf.css');
        $mpdf->WriteHTML($stylesheet,HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML('
                        <div class="container">
                            <div class="cabecera-pdf">
                                <img src="estilos/assets/images/logo_white_large.png" alt="">
                                <h1>Contrato de Adopción</h1>
                            </div> 
                            <img src="estilos/assets/images/fondo_contrato.jpg" alt="" class="image">
                        </div> 
                        <p class="nombre">'.$adopcion->getAnimal()->getName().'</p>
                        <p class="color">'.$adopcion->getAnimal()->getColour().'</p>
                        <p class="especie">'.$adopcion->getAnimal()->getType()->getName().'</p> 
                        <p class="sexo">'.$adopcion->getAnimal()->getSex().'</p>
                        <p class="fechanac">'.$adopcion->getAnimal()->getBirthDate()->format('d/m/20y').'</p> 
                        <p class="chip">243526372516253'.$adopcion->getAnimal()->getChip().'</p>
                        <p class="raza">'.$adopcion->getAnimal()->getRace()->getName().'</p>
                        <p class="peso">'.$adopcion->getAnimal()->getWeigth().' g</p> 
                        <p class="peligroso">-No-</p>
                        <p class="nombreUsu">'.$adopcion->getUsuario()->getName().' '.$adopcion->getUsuario()->getAp1().' '.$adopcion->getUsuario()->getAp2().'</p>
                        <p class="dni">'.$adopcion->getUsuario()->getDni().'</p>
                        <p class="fechanacUsu">16/06/2002</p>
                        <p class="correo">'.$adopcion->getUsuario()->getEmail().'</p>
                        <p class="telefono">'.$adopcion->getUsuario()->getPhone().'</p>
                        ');
                        $mpdf->WriteHTML('
                        <div class="container">
                            <div class="cabecera-pdf">
                                <img src="logo_white_large.png" alt="">
                                <h1>Contrato de Adopción</h1>
                            </div> 
                            <img src="fondo_contrato.jpg" alt="" class="image">
                        </div> 
                        <p class="nombre">Yogui</p>
                        <p class="color">Blanco</p>
                        <p class="especie">Perro</p> 
                        <p class="sexo">Macho</p>
                        <p class="fechanac">16/06/2002</p> 
                        <p class="chip">243526372516253</p>
                        <p class="raza">Labrador</p>
                        <p class="peso">2000 g</p> 
                        <p class="peligroso">-No-</p>
                        <p class="nombreUsu">Manuel Cámara Serrano</p>
                        <p class="dni">77694654X</p>
                        <p class="fechanacUsu">16/06/2002</p>
                        <p class="correo">manuelcs160@gmail.com</p>
                        <p class="telefono">657 44 33 23</p>
                        ');
        $mpdf->Output("Contrato-Adopcion".$adopcion->getAnimal()->getName().".pdf","D");

    }


}