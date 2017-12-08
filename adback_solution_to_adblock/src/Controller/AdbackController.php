<?php

namespace Drupal\adback_solution_to_adblock\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;

/**
 * Class AdbackController
 */
class AdbackController implements ContainerInjectionInterface
{
    protected $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public static function create(ContainerInterface $container)
    {
        return new static($container->get('twig'));
    }

    public function statistics()
    {
        $path = __DIR__ . '/../templates/statistics.html.twig';
        $template = file_get_contents($path);
        $token = \Drupal::config('adback_solution_to_adblock.settings')->get('access_token');

        return [
            'statistics' => [
                '#type' => 'inline_template',
                '#template' => $template,
                '#context' => [
                    'access_token' => $token,
                ],
            ],
        ];
    }
}
