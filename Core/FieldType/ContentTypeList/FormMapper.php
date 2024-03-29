<?php

declare(strict_types=1);

namespace Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList;

use Ibexa\Contracts\ContentForms\Data\Content\FieldData;
use Ibexa\Contracts\ContentForms\FieldType\FieldValueFormMapperInterface;
use Netgen\Bundle\ContentTypeListBundle\Form\Type\FieldType\ContentTypeListFieldType;
use Symfony\Component\Form\FormInterface;

final class FormMapper implements FieldValueFormMapperInterface
{
    public function mapFieldValueForm(FormInterface $fieldForm, FieldData $data): void
    {
        $fieldForm
            ->add(
                $fieldForm->getConfig()->getFormFactory()->createBuilder()
                    ->create(
                        'value',
                        ContentTypeListFieldType::class,
                        [
                            'required' => $data->fieldDefinition->isRequired,
                            'label' => $data->fieldDefinition->getName(),
                            'field_definition' => $data->fieldDefinition,
                            'multiple' => true,
                        ]
                    )
                    ->setAutoInitialize(false)
                    ->getForm()
            );
    }
}
