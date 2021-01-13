<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Validator\Constraint;

use Symfony\Component\Validator\Constraints as Assert;

class TestintaptitudesFormType extends AbstractType
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add(
        'nombre',
        TextType::class,
        [
          'label' => 'Nombre',
          'constraints' => [new NotBlank()],
          "mapped" => false,
          'attr' => ['class' => 'mb-3 ml-2']
        ]
      )
      ->add('sexo', ChoiceType::class, [
        'placeholder' => 'Seleccionar Sexo',
        'choices'  => [
          'Femenino' => 'Femenino',
          'Masculino' => 'Masculino',
        ],
       'attr' => ['class' => 'mb-3 ml-2'],        
        'label' => 'Sexo',
        'constraints' => [new NotBlank()],
        "mapped" => false,
      ])
      ->add('edad', IntegerType::class,
        [
        'attr' => ['class' => 'mb-3 ml-2'],
        'label' => 'Edad',
     'constraints' => [
         new NotBlank(), 
         new Regex([
             'pattern' => '/^[0-9]\d*$/',
             'message' => 'Por favor, utilice solo números positivos.'
           ]),
         new Length(['max' => 2])
         ],        
        "mapped" => false,
      ])                        
      ->add(
        'create',
        SubmitType::class,
        [
          'attr' => ['class' => 'form-control btn-primary pull-right'],
          'label' => 'Enviar Test!'
        ]
      );
  }

  /**
   * {@inheritdoc}
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => 'App\Entity\Testintaptitudes'
    ]);
  }

}
