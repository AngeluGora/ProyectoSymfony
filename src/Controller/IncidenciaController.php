<?php

namespace App\Controller;

use App\Entity\Incidencia;
use DateTime;
use App\Form\IncidenciaType;
use App\Entity\Usuario;
use App\Entity\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class IncidenciaController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/incidencias', name: 'app_incidencias')]
    public function index(): Response
    {
        $incidencias = $this->entityManager->getRepository(Incidencia::class)->findAll();

        return $this->render('incidencia/index.html.twig', [
            'incidencias' => $incidencias,
        ]);
    }

    #[Route('/incidencias/{id}', name: 'app_incidencia_show')]
    public function show(Incidencia $incidencia): Response
    {
        return $this->render('incidencia/show.html.twig', [
            'incidencia' => $incidencia,
        ]);
    }

    #[Route('/incidencia/new', name: 'app_incidencia_new')]
    public function new(Request $request): Response
    {
        $incidencia = new Incidencia();
        

        $form = $this->createForm(IncidenciaType::class, $incidencia);
        $fechaCreacion = new \DateTime(); // Corregido aquí
        //$idUsuario= $this->getUser()->getId(); 
        $usu=New Usuario();
        $usu->setNombre("default");
        $usu->setApellidos("default");
        $usu->setEmail("default");
        $usu->setPassword("default");
        $usu->setTelefono("default");
        $usu->setFoto("default");
        $usu->setRol("ADMIN");
        $cli=New Cliente();
        $cli->setNombre("default");
        $cli->setTelefono("default");
        $cli->setApellidos("default");
        $cli->setDireccion("default");
        $incidencia->setUsuario($usu);
        $incidencia->setCliente($cli);
        $incidencia->setFechaCreacion($fechaCreacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Guardar la incidencia en la base de datos u otras operaciones necesarias
            $this->entityManager->persist($incidencia);
            $this->entityManager->flush();

            // Redirigir a la página de inicio u otra página deseada después de guardar la incidencia
            return $this->redirectToRoute('app_incidencias'); // Cambiar 'app_home' por la ruta deseada
        }

        return $this->render('incidencia/addIncidencia.html.twig', [
            'formularioIncidencia' => $form->createView(),
        ]);
    }



    #[Route('/incidencias/{id}/delete', name: 'app_incidencia_delete')]
    public function delete(Request $request, Incidencia $incidencia, EntityManagerInterface $entityManager): Response
    {
        // Obtiene el EntityManager

        // Elimina la incidencia
        $entityManager->remove($incidencia);
        $entityManager->flush();

        // Redirige a la página de listado de incidencias
        return $this->redirectToRoute('app_incidencias');
    }

    #[Route('/incidencias/{id}/edit', name: 'app_incidencia_edit')]
    public function edit(Request $request, Incidencia $incidencia): Response
    {
        // Aquí deberías manejar la lógica para editar una incidencia
        // y redirigir a la página de detalles de la incidencia.

        return $this->redirectToRoute('app_incidencia_show', ['id' => $incidencia->getId()]);
    }
}
