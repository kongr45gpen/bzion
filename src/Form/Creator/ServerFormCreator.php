<?php
/**
 * This file contains a form creator for Servers
 *
 * @license    https://github.com/allejo/bzion/blob/master/LICENSE.md GNU General Public License Version 3
 */

namespace BZIon\Form\Creator;

use BZIon\Form\Type\AdvancedModelType;
use BZIon\Form\Type\ModelType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Form creator for servers
 */
class ServerFormCreator extends ModelFormCreator
{
    /**
     * {@inheritDoc}
     */
    protected function build($builder)
    {
        return $builder
            ->add('domain', 'text', array(
                'constraints' => array(
                    new NotBlank(), new Length(array(
                        'max' => 50,
                    )),
                ),
            ))
            ->add('port', 'integer', array(
                'constraints' => new NotBlank(),
                'data' => 5154
            ))
            ->add('name', 'text', array(
                'constraints' => array(
                    new NotBlank(), new Length(array(
                        'max' => 100,
                    )),
                ),
            ))
            ->add('country', new ModelType('Country'))
            ->add('owner', new AdvancedModelType('Player'), array(
                'constraints' => new NotBlank()
            ))
            ->add('enter', 'submit');
    }

    /**
     * {@inheritDoc}
     */
    public function fill($form, $server)
    {
        $form->get('name')->setData($server->getName());
        $form->get('domain')->setData($server->getDomain());
        $form->get('port')->setData($server->getPort());
        $form->get('country')->setData($server->getCountry());
        $form->get('owner')->setData($server->getOwner());
    }

    /**
     * {@inheritDoc}
     */
    public function update($form, $server)
    {
        $server->setName($form->get('name')->getData())
               ->setDomain($form->get('domain')->getData())
               ->setPort($form->get('port')->getData())
               ->setCountry($form->get('country')->getData()->getId())
               ->setOwner($form->get('owner')->getData()->getId())
               ->forceUpdate();
    }

    /**
     * {@inheritDoc}
     */
    public function enter($form)
    {
        return \Server::addServer(
            $form->get('name')->getData(),
            $form->get('domain')->getData(),
            $form->get('port')->getData(),
            $form->get('country')->getData()->getId(),
            $form->get('owner')->getData()->getId()
        );
    }
}
