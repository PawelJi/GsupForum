<?php
 /**
 * Description
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
 */
 
namespace Gsup\ForumBundle\Tests\Form;

use Doctrine\Bundle\MongoDBBundle\Form\Type\DocumentType;
use Doctrine\ODM\MongoDB\UnitOfWork;
use Gsup\ForumBundle\Form\PostType;
use Gsup\ForumBundle\Document\Post;
use Gsup\ForumBundle\Document\Category;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\PreloadedExtension;


use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PostTypeTest extends TypeTestCase
{
    protected function setUp()
    {
        parent::setUp();

//        $this->factory = Forms::createFormFactoryBuilder()
//            ->addExtensions($this->getExtensions())
//            ->getFormFactory();
    }

//    protected function getExtensions()
//    {
//        // mock entity manager
//        $documentManager = $this->getMockBuilder('\Doctrine\ODM\MongoDB\DocumentManager')
//            ->disableOriginalConstructor()
//            ->setMethods(array('getClassMetadata', 'getRepository'))
//            ->getMock()
//        ;
//
//        // this method will be mocked specific to the class name when provided
//        // by the mocked repository below - this can be generic here
//        $documentManager->expects($this->any())
//            ->method('getClassMetadata')
//            ->will($this->returnValue(new ClassMetadata('document')))
//        ;
//
//        $parent = $this;
//
//        $documentManager->expects($this->any())
//            ->method('getRepository')
//            ->will($this->returnCallback(function($documentName) use ($parent) {
//
//                // if ever the Doctrine\ORM\Query\Parser is engaged, it will check for
//                // the existence of the fields used in the DQL using the class metadata
//                $classMetadata = new ClassMetadata($documentName);
//
//                if (preg_match('/[^a-z]MyClass$/i', $documentName)) {
//                    $classMetadata->addInheritedFieldMapping(array('fieldName' => 'someField', 'columnName' => 'some_field'));
//                    $classMetadata->addInheritedFieldMapping(array('fieldName' => 'anotherField', 'columnName' => 'another_field'));
//                }
//
//                // mock statement
//                $statement = $parent->getMockBuilder('\Doctrine\DBAL\Statement')
//                    ->disableOriginalConstructor()
//                    ->getMock()
//                ;
//
//                // mock connection
//                $connection = $parent->getMockBuilder('\Doctrine\DBAL\Connection')
//                    ->disableOriginalConstructor()
//                    ->setMethods(array('connect', 'executeQuery', 'getDatabasePlatform', 'getSQLLogger', 'quote'))
//                    ->getMock()
//                ;
//
//                $connection->expects($parent->any())
//                    ->method('connect')
//                    ->will($parent->returnValue(true))
//                ;
//
//                $connection->expects($parent->any())
//                    ->method('executeQuery')
//                    ->will($parent->returnValue($statement))
//                ;
//
////                $connection->expects($parent->any())
////                    ->method('getDatabasePlatform')
////                    ->will($parent->returnValue(new PostgreSqlPlatform()))
////                ;
//
//                $connection->expects($parent->any())
//                    ->method('quote')
//                    ->will($parent->returnValue(''))
//                ;
//
//                // mock unit of work
//                $unitOfWork = $parent->getMockBuilder('\Doctrine\ODM\MongoDB\UnitOfWork')
//                    ->disableOriginalConstructor()
//                    ->getMock()
//                ;
//
//                // mock entity manager
//                $documentManager = $parent->getMockBuilder('\Doctrine\ODM\MongoDB\DocumentManager')
//                    ->disableOriginalConstructor()
//                    ->setMethods(array('getClassMetadata', 'getConfiguration', 'getConnection', 'getUnitOfWork'))
//                    ->getMock()
//                ;
//
//                $documentManager->expects($parent->any())
//                    ->method('getClassMetadata')
//                    ->will($parent->returnValue($classMetadata))
//                ;
//
//                $documentManager->expects($parent->any())
//                    ->method('getConfiguration')
//                    ->will($parent->returnValue(new Configuration()))
//                ;
//
//                $documentManager->expects($parent->any())
//                    ->method('getConnection')
//                    ->will($parent->returnValue($connection))
//                ;
//
//                $documentManager->expects($parent->any())
//                    ->method('getUnitOfWork')
//                    ->will($parent->returnValue($unitOfWork))
//                ;
//
//                // mock repository
//                $repo = $parent->getMockBuilder('\Doctrine\ORM\EntityRepository')
//                    ->setConstructorArgs(array($documentManager, $classMetadata))
//                    ->setMethods(array('createQueryBuilder'))
//                    ->getMock()
//                ;
//
//                $repo->expects($parent->any())
//                    ->method('createQueryBuilder')
//                    ->will($parent->returnCallback(function($alias) use ($documentManager, $documentName) {
//                        $queryBuilder = new \Doctrine\ODM\MongoDB\Query\Builder($documentManager);
//                        return $queryBuilder;
//                    }))
//                ;
//
//                return $repo;
//            }))
//        ;
//
//        // mock registry
//        $registry = $this->getMockBuilder('\Doctrine\Bundle\DoctrineBundle\Registry')
//            ->disableOriginalConstructor()
//            ->setMethods(array('getManagerForClass'))
//            ->getMock()
//        ;
//
//        $registry->expects($this->any())
//            ->method('getManagerForClass')
//            ->will($this->returnValue($documentManager))
//        ;
//
//        // build the extensions
//        $extensions = new PreloadedExtension(
//            array(
//                'document' => new DocumentType($registry),
//            ),
//            array()
//        );
//
//        return array($extensions);
//    }

//    protected function getExtensions()
//    {
//        $mockDocumentManager = $this->getMockBuilder('Gsup\ForumBundle\Tests\DocumentManager')
//            ->setMethods(array('getRepository'))
//            ->getMock();
//
//        $mockRegistry = $this->getMockBuilder('Doctrine\Bundle\DoctrineBundle\Registry')
//            ->disableOriginalConstructor()
//            ->setMethods(array('getManagerForClass'))
//            ->getMock();
//
//        $mockRegistry->expects($this->any())->method('getManagerForClass')
//            ->will($this->returnValue($mockDocumentManager));
//
//        $mockDocumentType = $this->getMockBuilder('Doctrine\Bundle\MongoDBBundle\Form\Type\DocumentType')
//            ->setMethods(array('getName'))
//            ->setConstructorArgs(array($mockRegistry))
//            ->getMock();
//
//        $mockDocumentType->expects($this->any())->method('getName')
//            ->will($this->returnValue('document'));
//
//        return array(new PreloadedExtension(array(
//            $mockDocumentType->getName() => $mockDocumentType,
//        ), array()));
//    }

    public function testSubmitValidData()
    {
        $category = new Category();

        $formData = array(
            'title'     => 'test',
            'content'   => 'test2',
            'category'  => $category,
            'tags'      => ['common']
        );

        $object = new Post();
        $object->fromArray($formData);

//        $type = new PostType();
//        $form = $this->factory->create($type);
//
//        // submit the data to the form directly
//        $form->submit($formData);
//
//        $this->assertTrue($form->isSynchronized());
//        $this->assertEquals($object, $form->getData());
//
//        $view = $form->createView();
//        $children = $view->children;
//
//        foreach (array_keys($formData) as $key) {
//            $this->assertArrayHasKey($key, $children);
//        }
    }
} 