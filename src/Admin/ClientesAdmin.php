<?php
// src/App/Admin/CambiosseiAdmin.php
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
#use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
 *   class="App\Entity\Clientes"
 * )
 */
class ClientesAdmin extends AbstractAdmin
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
                     ->add('nombre', TextType::class, ['label' => 'Nombre'])
                     ->add('direccion', TextType::class, ['label' => 'Dirección'])
                     ->add('alta', ChoiceType::class, [
                      'choices'  => [
                          'no' => 'no',
                          'si' => 'si',
                    ],
                     'label' => 'Dado de alta',
                ])
                ->end()

                ->with('Datos extra',
                    array(
                        'class'       => 'col-md-6',
                        'box_class'   => 'box box-primary')
                    )
                   ->add('email', EmailType::class, ['label' => 'Email', 'required' => false])
                   ->add('telefono', TextType::class, ['label' => 'Telefono',                              'empty_data' => '', 'required' => false])
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
        '_sort_by' => 'nombre',
    );


    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        //Campos para filtrar y ordenar la lista
        $datagridMapper
            ->add('nombre')
            ->add('direccion')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        //Campos mostrados en el Listado inicial
        $listMapper
            // el archivo que modifica el formato de fecha en el ListMapper es:
            // ./vendor/sonata-project/admin-bundle/src/Resources/views/CRUD/list_date.html.twig
            ->addIdentifier('nombre')
            ->addIdentifier('email')
            ->addIdentifier('telefono')
            ->addIdentifier('direccion')
            ->addIdentifier('alta')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Clientes
            ? 'Cliente: '.$object->getNombre()
            : 'Cliente: '.$object->getNombre(); // shown in the breadcrumb on the create view
    }

    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Clientes')
            ->add('id')
            ->add('nombre', TextType::class)
            ->add('direccion', TextType::class)
            ->add('email', EmailType::class)
            ->end()
        ;
    }   

}
