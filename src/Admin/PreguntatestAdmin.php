<?php
// src/App/Admin/PreguntatestAdmin.php
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

use App\Entity\Preguntatest;
use App\Entity\Categoria;

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
 *   class="App\Entity\Preguntatest"
 * )
 */
class PreguntatestAdmin extends AbstractAdmin
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
        ->add('categoria', EntityType::class, [ 
          'placeholder' => 'Seleccionar Categoría',
          'class' => Categoria::class,
          'query_builder' => function (EntityRepository $er) {
            return $er->createQueryBuilder('c')
                      ->orderBy('c.categoria', 'ASC');
          },	
          'label' => 'Categoria',
        ])
        ->add('subcategoria', ChoiceType::class, [
          'placeholder' => 'Seleccionar Subcategoría',
          'choices'  => [
            // archivo relacionado: vendor/sonata-project/admin-bundle/src/Resources/views/standard_layout.html.twig

            // Categoría: Coche
            'Recambios' => 'Recambios',
            'ITV' => 'ITV',

            // Categoría: Compras
            'Alimentacion' => 'Alimentación',
            'Limpieza' => 'Limpieza',
            'LeroyMerlin-Bricodepo' => 'LeroyMerlin-Bricodepo',
            'Libros-Cultura' => 'Libros-Cultura',
            'Centro Eguzkilore' => 'Centro Eguzkilore',
            'Otras compras' => 'Otras compras',

            // Categoría: Doméstica
            'Limpiar casa' => 'Limpiar casa',
            'Ordenar casa' => 'Ordenar casa',

            // Categoría: Eguzkilore
            'Facturas' => 'Facturas',
            'Hacienda' => 'Hacienda',
            'Instalaciones' => 'Instalaciones',
            'Material de Oficina' => 'Material de Oficina',
            'Material Didáctico' => 'Material Didáctico',

            // Categoría: Facturas
            'Luz-Agua-Gas' => 'Luz-Agua-Gas',
            'Movil' => 'Movil',
            'Otras facturas' => 'Otras facturas',

            // Categoría: Gastos
            'Casa' => 'Casa',
            'Eguzkilore' => 'Eguzkilore',
            'Coche' => 'Coche',
            'Viajes' => 'Viajes',
            'Hegoalde' => 'Hegoalde',                        
            'Otros gastos' => 'Otros gastos',

            // Categoría: Gurasoak
            'Compras' => 'Compras',
            'Transporte' => 'Transporte',
            'Otros' => 'Otros',

            // Categoría: Informática
            'Copias de Seguridad' => 'Copias de Seguridad',
            'MySql-Doctrine' => 'MySql-Doctrine',
            'Php' => 'Php',
            'Symfony' => 'Symfony', 
            'Twig' => 'Twig',
            'Otras tareas' => 'Otras tareas',

            // Categoría: Ocio
            'Planes' => 'Planes',
            'Música' => 'Música',
            'Lectura' => 'Lectura',

            // Categoría: Seieas
            'Administración' => 'Administración',
            'Bolsa-Horas Extras' => 'Bolsa-Horas Extras',
            'Cursos de formación' => 'Cursos de formación',
            'Permisos' => 'Permisos',
            'Ropa' => 'Ropa',
            'Vacaciones' => 'Vacaciones',
            'Ropa' => 'Ropa',

            // Categoría: Viajes
            'Mapas-GPS' => 'Mapas-GPS',
            'Alojamiento' => 'Alojamiento',
            'Vuelos' => 'Vuelos',
            'Otras actividades' => 'Otras actividades',

          ],
                      /*  'group_by' => function($choiceValue, $key, $value) {
        if ($choiceValue > 20 && $choiceValue < 30 ) {
            return 'Coche';
        } else if ($choiceValue > 90 && $choiceValue < 100 ) {
            return 'Compras';
         } else if ($choiceValue > 10 && $choiceValue < 20 ) {
            return 'Doméstica';
        } else if ($choiceValue > 50 && $choiceValue < 60 ) {
            return 'Eguzkilore';
        } else if ($choiceValue > 70 && $choiceValue < 80 ) {
            return 'Facturas';
        } else if ($choiceValue > 110 && $choiceValue < 120 ) {
            return 'Gastos';
        } else if ($choiceValue > 100 && $choiceValue < 110 ) {
            return 'Gurasoak';
        } else if ($choiceValue > 40 && $choiceValue < 50 ) {
            return 'Informática';
        } else if ($choiceValue > 80 && $choiceValue < 90 ) {
            return 'Ocio';
        } else if ($choiceValue > 30 && $choiceValue < 40 ) {
            return 'Seieas';
        } else if ($choiceValue > 60 && $choiceValue < 70 ) {
            return 'Viajes';
        }
                      },*/
          'label' => 'Subcategoria',
        ])
        ->add('testtipo', ChoiceType::class, [
          'choices'  => [
            'Aptitud' => 'Aptitud',
            'Gustos' => 'Gustos',
          ],
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
    '_sort_order' => 'DESC',

    // name of the ordered field (default = the model's id field, if any)
    '_sort_by' => 'subcategoria',
  );


  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
    //Campos para filtrar y ordenar la lista
    $datagridMapper
      ->add('pregunta')
    //->add('categoria')
    ;
  }

  protected function configureListFields(ListMapper $listMapper)
  {
    //Campos mostrados en el Listado inicial
    $listMapper
      // el archivo que modifica el formato de fecha en el ListMapper es:
      // ./vendor/sonata-project/admin-bundle/src/Resources/views/CRUD/list_date.html.twig
      ->addIdentifier('pregunta')
      ->addIdentifier('categoria')
      ->addIdentifier('subcategoria')
    ;
  }

  public function toString($object)
  {
    return $object instanceof Preguntatest
      ? 'Tarea: '
      : 'Tarea: '; // shown in the breadcrumb on the create view
  }

  public function configureShowFields(ShowMapper $showMapper)
  {
    $showMapper
      ->with('Tareas Pendientes')
      ->add('id')
      ->add('pregunta', TextType::class)
      ->add('categoria', TextType::class)
      ->add('subcategoria', TextType::class)
      ->end()
    ;
  }   

}
