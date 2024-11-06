<?php
namespace App\Form;

use App\Entity\Merci;
use App\Entity\Salarie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class MerciType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->security->getUser();
    
        if ($user && $user->getSalarie()) {
            // Pre-fill the author field if the user is logged in
            $builder->add('author', EntityType::class, [
                'class' => Salarie::class,
                'choice_label' => 'name',
                'disabled' => true,
                'data' => $user->getSalarie(),
                'label' => 'Auteur',
                'attr' => ['class' => 'form-control'],
            ]);
        } else {
            $builder->add('author', EntityType::class, [
                'class' => Salarie::class,
                'choice_label' => 'name',
                'label' => 'Auteur',
                'placeholder' => 'Sélectionnez un auteur',
                'attr' => ['class' => 'form-control'],
            ]);
        }
    
        $builder
            ->add('recipient', EntityType::class, [
                'class' => Salarie::class,
                'choice_label' => 'name',
                'label' => 'Destinataire',
                'placeholder' => 'Sélectionnez le collègue destinataire',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('reason', TextareaType::class, [
                'label' => 'Raison du merci',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Raison du merci...'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Merci::class,
        ]);
    }
}
