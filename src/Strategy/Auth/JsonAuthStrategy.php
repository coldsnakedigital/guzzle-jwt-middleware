<?php

namespace Coldsnakedigital\GuzzleJwt\Strategy\Auth;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Guillaume Cavana <guillaume.cavana@gmail.com>
 */
class JsonAuthStrategy extends AbstractBaseAuthStrategy
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'json_fields' => ['_email', '_password'],
        ]);

        $resolver->setRequired(['json_fields']);
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestOptions()
    {
        return [
            \GuzzleHttp\RequestOptions::JSON => [
                $this->options['json_fields'][0] => $this->options['email'],
                $this->options['json_fields'][1] => $this->options['password'],
            ],
        ];
    }
}
