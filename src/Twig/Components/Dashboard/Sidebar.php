<?php

namespace App\Twig\Components\Dashboard;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Dashboard:Sidebar')]
class Sidebar
{
    public ?string $extraClass = null;

}