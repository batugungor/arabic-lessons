<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TextExplanationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('texts', CollectionType::class, [
            'entry_type' => ExplanationType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
        ]);
    }
}