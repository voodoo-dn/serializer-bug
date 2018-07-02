<?php

namespace Tests;

use App\Entity\AbstractDummyA;
use App\Entity\DummyC;
use App\Entity\DummyD;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\ClassDiscriminatorFromClassMetadata;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\YamlFileLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerTest extends TestCase
{
    public function testExpectsNotFilledFullObjectDummyB(): void
    {
        $classMetadataFactory = new ClassMetadataFactory(new YamlFileLoader(__DIR__.'/../src/Resources/config/serializer.yaml'));

        $normalizer = new ObjectNormalizer(
            $classMetadataFactory,
            null,
            null,
            null,
            new ClassDiscriminatorFromClassMetadata($classMetadataFactory)
        );

        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);

        /**
         * @var DummyB $dummyB
         */
        $dummyB = $serializer->deserialize('{"type": "b", "a": "a", "b": "b"}', AbstractDummyA::class, 'json', [
            'groups' => ['test']
        ]);

        $this->assertEquals('b', $dummyB->getB(), 'must return "b" string value');
    }

    public function testExpectsFilledObjectDummyBIfSerializationGroupsNotPassedToContext(): void
    {
        $classMetadataFactory = new ClassMetadataFactory(new YamlFileLoader(__DIR__.'/../src/Resources/config/serializer.yaml'));

        $normalizer = new ObjectNormalizer(
            $classMetadataFactory,
            null,
            null,
            null,
            new ClassDiscriminatorFromClassMetadata($classMetadataFactory)
        );

        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);

        /**
         * @var DummyB $dummyB
         */
        $dummyB = $serializer->deserialize('{"type": "b", "a": "a", "b": "b"}', AbstractDummyA::class, 'json');

        $this->assertEquals('a', $dummyB->getA());
        $this->assertEquals('b', $dummyB->getB());
    }

    public function testExpectsSerializationObjectDummyC(): void
    {
        $classMetadataFactory = new ClassMetadataFactory(new YamlFileLoader(__DIR__.'/../src/Resources/config/serializer.yaml'));

        $normalizer = new ObjectNormalizer(
            $classMetadataFactory,
            null,
            null,
            null,
            new ClassDiscriminatorFromClassMetadata($classMetadataFactory)
        );

        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);

        $object = (new DummyC())
            ->setA('a')
            ->setC('c')
        ;

        $data = $serializer->serialize($object, 'json', [
            'groups' => ['test']
        ]);

        $this->assertEquals(json_encode([
            'a' => 'a',
            'c' => 'c'
        ]), $data);
    }

    public function testExpectsDeserializationObjectDummyD(): void
    {
        $classMetadataFactory = new ClassMetadataFactory(new YamlFileLoader(__DIR__.'/../src/Resources/config/serializer.yaml'));

        $normalizer = new ObjectNormalizer(
            $classMetadataFactory,
            null,
            null,
            null,
            new ClassDiscriminatorFromClassMetadata($classMetadataFactory)
        );

        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);

        $actualObject = $serializer->deserialize(json_encode([
            'type' => 'd',
            'a' => 'a',
            'd' => 'd',
            'dummyC' => [
                'a' => 'a',
                'c' => 'c'
            ]
        ]), AbstractDummyA::class, 'json', [
            'groups' => ['test']
        ]);

        $dummyC = (new DummyC())
            ->setA('A')
            ->setC('C')
        ;

        $expectedObject = (new DummyD())
            ->setA('A')
            ->setD('D')
            ->setDummyC($dummyC)
        ;

        $this->assertEquals($expectedObject, $actualObject);
    }
}