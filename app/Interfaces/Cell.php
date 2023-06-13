<?php

namespace App\Interfaces;

use App\Vector;

interface Cell
{
    function getWidth(): int;
    function setWidth(int $width): void;
    function getHeight(): int;
    function setHeight(int $height): void;
    function getPosition(): Vector;
    function setPosition(Vector $position): void;
}
