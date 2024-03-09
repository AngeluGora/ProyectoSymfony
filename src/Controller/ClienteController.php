<?php

namespace App\Controller;

use App\Entity\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClienteController extends AbstractController
{
    #[Route('/clientes', name: 'app_clientes')]
    public function index(): Response
    {
        $clientes = $this->getDoctrine()->getRepository(Cliente::class)->findAll();

        return $this->render('cliente/index.html.twig', [
            'clientes' => $clientes,
        ]);
    }

    #[Route('/clientes/{id}', name: 'app_cliente_show')]
    public function show(Cliente $cliente): Response
    {
        return $this->render('cliente/show.html.twig', [
            'cliente' => $cliente,
        ]);
    }

    #[Route('/cliente/new', name: 'app_cliente_new')]
    public function new(Request $request): Response
    {
        $cliente = new Cliente();
        // Aquí deberías crear un formulario para la creación de un nuevo cliente
        // y manejar su envío.

        return $this->render('cliente/new.html.twig', [
            'cliente' => $cliente,
        ]);
    }

    #[Route('/clientes/{id}/delete', name: 'app_cliente_delete')]
    public function delete(Request $request, Cliente $cliente): Response
    {
        // Aquí deberías manejar la lógica para eliminar un cliente
        // y redirigir a la página de listado de clientes.

        return $this->redirectToRoute('app_clientes');
    }
}
