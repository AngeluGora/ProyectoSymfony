<?php
namespace App\Form;

use App\Entity\Incidencia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class IncidenciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo', TextType::class)
            ->add('estado', ChoiceType::class, [
                'choices' => [
                    'Abierta' => 'Abierta',
                    'Cerrada' => 'Cerrada',
                    // Agrega más opciones según tus necesidades
                ],
            ])
            ->add('Insertar', SubmitType::class)
        ;
            // Agrega más campos según los atributos de la entidad Incidencia
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Incidencia::class,
        ]);
    }
}