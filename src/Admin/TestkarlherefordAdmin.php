<?php
// src/App/Admin/TestkarlherefordAdmin.php
namespace App\Admin;

#use Symfony\Component\Form\AbstractType;
# las siguientes clases se pueden modificar o extender: vendor/symfony/form/Extension/Core/Type/
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use App\Entity\Testkarlhereford;
use App\Entity\Intereseskarlhereford;

use Doctrine\ORM\EntityRepository;

use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Form\Type\ModelListType;
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
 *   class="App\Entity\Testkarlhereford"
 * )
 */
class TestkarlherefordAdmin extends AbstractAdmin
{
  public $supportsPreviewMode = true;

  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper
      ->with('Datos requeridos',
        array(
          'class'       => 'col-md-6',
          'box_class'   => 'box box-solid box-danger')      
        )           
        ->add('pregunta', TextType::class)
        ->add('intereseskarlhereford', EntityType::class, [ 
          'placeholder' => 'Seleccionar Interés',
          'class' => Intereseskarlhereford::class,
          'query_builder' => function (EntityRepository $er) {
            return $er->createQueryBuilder('c')
                      ->orderBy('c.interes', 'ASC');
          },	
          'label' => 'Interés',
        ])
        ->end()

        ->with('Datos opcionales',
          array(
            'class'       => 'col-md-6',
            'box_class'   => 'box box-solid box-primary')      
          )          
            /*->add('fecharealizada', DateType::class, [
              'format' => 'dMMMMyyyy',
              'label' => 'Fecha Realización',
              'required' => false
            ])*/
          ->end()

          ->with('Realizado',
            array(
              'class'       => 'col-md-6',
              'box_class'   => 'box box-solid box-success')      
            )          
            /*->add('realizado', ChoiceType::class, [
              'choices'  => [
                'no' => 'no',
                'si' => 'si',
              ],
            ])*/
            ->end()

          ;       
  }

  //Configuramos el orden de salida del listado de DatagridMapper
  protected $datagridValues = array(

    // display the first page (default = 1)
    '_page' => 1,

    // reverse order (default = 'ASC')
    //'_sort_order' => 'DESC',

    // name of the ordered field (default = the model's id field, if any)
    '_sort_by' => 'intereseskarlhereford.interes',
  );


  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
    //Campos para filtrar y ordenar la lista
    $datagridMapper
      ->add('pregunta')
      ->add('intereseskarlhereford.interes')
    ;
  }

  protected function configureListFields(ListMapper $listMapper)
  {
    //Campos mostrados en el Listado inicial
    $listMapper
      // el archivo que modifica el formato de fecha en el ListMapper es:
      // ./vendor/sonata-project/admin-bundle/src/Resources/views/CRUD/list_date.html.twig
      ->addIdentifier('pregunta')
      ->addIdentifier('intereseskarlhereford.interes', null, array('label' => 'Interés'), null, array())
                ->addIdentifier('url', 'url', [
                'url' => 'http://example.com'
            ], null, array())
    ;
  }

  public function toString($object)
  {
    return $object instanceof Testkarlhereford
      ? 'Tarea: '
      : 'Tarea: '; // shown in the breadcrumb on the create view
  }

  public function configureShowFields(ShowMapper $showMapper)
  {
    $showMapper
      ->with('Tareas Pendientes')
      ->add('id')
      ->add('pregunta', TextType::class)
      ->add('intereseskarlhereford')
      ->end()
    ;
  }   

}
