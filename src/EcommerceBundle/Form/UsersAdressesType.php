<?php

namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersAdressesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',NULL,[
            'label'  => 'Last Name',
        ])->add('prenom',NULL,[
            'label'  => 'First Name',
        ])->add('telephone',NULL,[
            'label'  => 'Phone',
        ])->add('adresse',NULL,[
            'label'  => 'Address',
        ])->add('cp',NULL,[
            'label'  => 'Postal Code',
        ])->add('pays',NULL,[
            'label'  => 'Country',
        ])->add('ville',NULL,[
            'label'  => 'Town',
        ])
                ->add('complement',null,(array('required' => false,'label'  => 'Additional' )));


    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EcommerceBundle\Entity\UsersAdresses'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ecommercebundle_usersadresses';
    }


}
