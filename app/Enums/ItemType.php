<?php
namespace App\Enums;

enum ItemType: string
{
    case Ingrediente = 'Ingrediente';
    case Preenvasado = 'Preenvasado';

    // case INGREDIENT = 'ingredient';
    // case SUPPLY = 'supply';
    // case EQUIPMENT = 'equipment';
    // case TOOL = 'tool';
}
