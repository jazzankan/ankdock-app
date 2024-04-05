<?php

namespace App\Enums;

enum EatingOrder: string {
    case starter = 'starter';
    case main = 'main';
    case dessert = 'dessert';
    case baking = 'baking';
}
