<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Doctrine\ORM\EntityRepository;

//use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
//use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use App\Entity\Facturas;

use Symfony\Component\Validator\Constraint;

use Symfony\Component\Validator\Constraints as Assert;

class FacturasFormType extends AbstractType
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $builder
     ->add('numerofactura', ChoiceType::class, [
        'placeholder' => 'Seleccionar Número',
        'choices'  => [
          $options['ultimafactura'] => $options['ultimafactura'],
          $options['penultimafactura'] => $options['penultimafactura'],
          $options['terceraultimafactura'] => $options['terceraultimafactura'],
          $options['cuartaultimafactura'] => $options['cuartaultimafactura'],
          $options['quintaultimafactura'] => $options['quintaultimafactura'],
          $options['sextaultimafactura'] => $options['sextaultimafactura'],
          $options['septimaultimafactura'] => $options['septimaultimafactura'],
          $options['octavaultimafactura'] => $options['octavaultimafactura'],
          $options['novenaultimafactura'] => $options['novenaultimafactura'],
          $options['decimaultimafactura'] => $options['decimaultimafactura'],
        ],
       'attr' => ['class' => 'mb-3 ml-2'],
        'label' => 'Número de Factura a Imprimir',
        'constraints' => [new NotBlank()],
      ])     
      ->add(
        'create',
        SubmitType::class,
        [
          'attr' => ['class' => 'form-control btn-primary pull-right'],
          'label' => 'Ver Factura a Imprimir!'
        ]
      );
  }

  /**
   * {@inheritdoc}
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'ultimafactura' => null,
      'penultimafactura' => null,      
          'terceraultimafactura' => null,
          'cuartaultimafactura' => null,
          'quintaultimafactura' => null,
      'sextaultimafactura' => null,
      'septimaultimafactura' => null,      
          'octavaultimafactura' => null,
          'novenaultimafactura' => null,
          'decimaultimafactura' => null,
      'data_class' => 'App\Entity\Facturas'
    ]);
  }

}
