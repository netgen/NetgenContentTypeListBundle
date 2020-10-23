<?php

declare(strict_types=1);

namespace Netgen\Bundle\ContentTypeListBundle\Form\Type\FieldType;

use eZ\Publish\API\Repository\ContentTypeService;
use eZ\Publish\API\Repository\FieldTypeService;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ContentTypeListFieldType extends AbstractType
{
    /**
     * @var \eZ\Publish\API\Repository\ContentTypeService
     */
    private $contentTypeService;

    /**
     * @var \eZ\Publish\API\Repository\FieldTypeService
     */
    private $fieldTypeService;

    public function __construct(ContentTypeService $contentTypeService, FieldTypeService $fieldTypeService)
    {
        $this->contentTypeService = $contentTypeService;
        $this->fieldTypeService = $fieldTypeService;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired(['field_definition']);
        $resolver->setAllowedTypes('field_definition', FieldDefinition::class);

        $resolver->setDefault(
            'choices',
            function (Options $options): array {
                return $this->getContentTypes();
            }
        );

        $resolver->setDefault('choice_translation_domain', false);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addModelTransformer(
                new FieldValueTransformer(
                    $this->fieldTypeService->getFieldType('ngclasslist')
                )
            );
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    /**
     * Returns all content types from eZ Platform.
     *
     * @return array<string, string[]>
     */
    private function getContentTypes(): array
    {
        $allContentTypes = [];
        $groups = $this->contentTypeService->loadContentTypeGroups();

        foreach ($groups as $group) {
            $contentTypes = $this->contentTypeService->loadContentTypes($group);

            foreach ($contentTypes as $contentType) {
                $contentTypeName = $contentType->getName() ?? $contentType->identifier;
                $allContentTypes[$group->identifier][$contentTypeName] = $contentType->identifier;
            }
        }

        return $allContentTypes;
    }
}
