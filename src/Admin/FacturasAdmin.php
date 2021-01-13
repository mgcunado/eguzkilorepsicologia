<?php
namespace App\Admin;

#use Symfony\Component\Form\AbstractType;
# las siguientes clases se pueden modificar o extender: vendor/symfony/form/Extension/Core/Type/
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
#use Symfony\Component\Form\Extension\Core\Type\TextareaType;
#use Symfony\Component\Form\Extension\Core\Type\DateType;
#use Symfony\Component\Form\Extension\Core\Type\IntegerType;
#use Symfony\Component\Form\Extension\Core\Type\HiddenType;

use App\Entity\Facturas;
use App\Entity\Clientes;

use Doctrine\ORM\EntityRepository;

#use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
#use Symfony\Component\Form\FormBuilderInterface;
#use Symfony\Component\OptionsResolver\OptionsResolver;
#use Symfony\Component\Validator\Constraints\NotBlank;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Sonata\CoreBundle\Form\Type\DatePickerType;

//para mostrar el ShowMapper se utiliza la siguiente clase
use Sonata\AdminBundle\Show\ShowMapper;

use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;

use Sonata\AdminBundle\Annotation as Sonata;

/**
 * @Sonata\Admin(
 *   class="App\Entity\Facturas"
 * )
 */
class FacturasAdmin extends AbstractAdmin
{
  public $supportsPreviewMode = true;

  protected function configureFormFields(FormMapper $formMapper)
  {
    //Campos a Editar y Crear
    $formMapper
      ->with('Datos requeridos',
        array(
          'class'       => 'col-md-6',
          'box_class'   => 'box box-solid box-danger')      
        )           
        ->add('numerofactura', TextType::class, ['label' => 'Número de Factura'])
        ->add('fechafactura', DatePickerType::class, [
          'label' => 'Fecha de la factura',
          'format' => 'd MMMM yyyy',
          //'data' => new \DateTime(), // está incluido en el constructor de la entidad
        ])
       ->add('nombre', EntityType::class, [
          'placeholder' => 'Seleccionar Cliente',
          'class' => Clientes::class,
          'query_builder' => function (EntityRepository $er) {
            return $er->createQueryBuilder('b')
                      ->orderBy('b.nombre', 'ASC');
          },
          'label' => 'Nombre',
        ])
                 ->add('referencia', ChoiceType::class, [
                    'placeholder' => 'Seleccionar Referencia',
                    'choices'  => [
                        'Plan de Actuación' => '0',
                        'Asesoramiento Psicológico Individual' => '1',
                        'Asesoramiento Psicológico de Pareja' => '2',
                        'Servicio de Orientación Profesional' => '3',
                        'Anulación de cita con menos de 4 días' => '4',
                        'Ausencia de cita sin previo aviso' => '5',
                    ],
                     'label' => 'Referencia',
                ])
                  ->add('producto', ChoiceType::class, [
                    'placeholder' => 'Seleccionar Producto',
                    'choices'  => [
                        'Plan de Actuación' => 'Plan de Actuación',
                        'Asesoramiento Psicológico Individual' => 'Asesoramiento Psicológico Individual',
                        'Asesoramiento Psicológico de Pareja' => 'Asesoramiento Psicológico de Pareja',
                        'Servicio de Orientación Profesional' => 'Servicio de Orientación Profesional',
                        'Anulación de cita con menos de 4 días' => 'Anulación de cita con menos de 4 días',
                        'Ausencia de cita sin previo aviso' => 'Ausencia de cita sin previo aviso',
                    ],
                     'label' => 'Producto',
                ])
                   ->add('duracion', ChoiceType::class, [
                    'placeholder' => 'Seleccionar la duración del servicio',
                    'choices'  => [
                        60 => 60,
                        90 => 90,
                        120 => 120,
                        0 => 0,
                    ],
                     'label' => 'Duración',
                ])
                   ->add('importe', ChoiceType::class, [
                    'placeholder' => 'Seleccionar el Importe del servicio',
                    'choices'  => [
                        35 => 28.92,
                        50 => 41.32,
                        70 => 57.85,
                        15 => 12.39,
                    ],
                     'label' => 'Importe',
                ])
                       
        
        //->add('direccion', TextType::class, ['label' => 'Dirección'])

        ->end()

        ->with('Datos extra',
          array(
            'class'       => 'col-md-6',
            'box_class'   => 'box box-primary')
          )
          ->add('modopago', TextType::class, ['label' => 'Modo de Pago', 'data' => 'Metálico', 'required' => false])
          ->add('cobrado', TextType::class, ['label' => 'Cobrado', 'data' => 'si', 'required' => false])


          ->end()

        ;       

  }

  //Configuramos el orden de salida del listado de DatagridMapper
  protected $datagridValues = array(

    // display the first page (default = 1)
    '_page' => 1,

    // reverse order (default = 'ASC')
    '_sort_order' => 'DESC',

    // name of the ordered field (default = the model's id field, if any)
    '_sort_by' => 'numerofactura',
  );


  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
    //Campos para filtrar y ordenar la lista
    $datagridMapper
      ->add('numerofactura')
      ->add('nombre')
    ;
  }

  protected function configureListFields(ListMapper $listMapper)
  {
    //Campos mostrados en el Listado inicial
    $listMapper
      // el archivo que modifica el formato de fecha en el ListMapper es:
      // ./vendor/sonata-project/admin-bundle/src/Resources/views/CRUD/list_date.html.twig
      ->addIdentifier('numerofactura')
      ->addIdentifier('nombre')
    ;
  }

  public function toString($object)
  {
    return $object instanceof Clientes
      ? 'Factura: '.$object->getNumerofactura()
      : 'Factura: '.$object->getNumerofactura(); // shown in the breadcrumb on the create view
  }

  public function configureShowFields(ShowMapper $showMapper)
  {
    $showMapper
      ->with('Facturas')
      ->add('id')
      ->add('numerofactura', TextType::class)
      ->end()
    ;
  }   

}
