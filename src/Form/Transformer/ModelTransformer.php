<?php
namespace BZIon\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ModelTransformer implements DataTransformerInterface
{
    /**
     * @var string[]
     */
    private $type;

    /**
     * @param string[] $type The types of the models
     */
    public function __construct(array $types)
    {
        $this->types = $types;
    }

    /**
     * Transforms an object (model) to an integer (int) .
     *
     * @param  Model|null $model
     * @return int
     */
    public function transform($models)
    {
        if ($models === null) {
            return array();
        }

        // dump("REGULAR TANSFROM CALLED WITH $model!!!");
        if (!is_array($models)) {
            $models = array($models);
        }

        $data = array();
        foreach ($models as $model) {
            $data[$model->getType()][] = $model->getName();
        }

        foreach ($data as $type => &$value) {
            if ($type !== '???') {
                $value = implode(', ', $value);
            }
        }

        return $data;

        return ['player'=>'alezakos','team'=>'Fractious Disinclination'];

        return $model;

        if (null === $model) {
            return 0;
        }

        return $model->getID();
    }

    /**
     * Transforms an ID to an object
     *
     * @param  int                           $id
     * @return Model
     * @throws TransformationFailedException if the team is not found.
     */
    public function reverseTransform($data)
    {
        $models = array();

        foreach ($this->types as $type) {
            foreach (explode(',', $data[$type]) as $name) {
                $models[] = $this->getModelFromName(trim($name), $type);
            }
        }

        return $models;
    }

    /**
     * Get a model from its name
     * @param  NamedModel $name The name of the model
     * @param  string     $type The type of the model in lower case
     * @return NamedModel
     */
    private function getModelFromName($name, $type)
    {
        if ($type === 'player') {
            return \Player::getFromUsername($name);
        } elseif ($type === 'team') {
            return \Team::getFromName($name);
        } else {
            throw new \Exception('Unsupported model type');
        }
    }
}
