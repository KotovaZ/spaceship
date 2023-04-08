<?php

namespace App\Move;

use App\Vector;

interface Movable
{
    public function getVelocity(): Vector;
    public function setVelocity(Vector $vector): void;
    public function getPosition(): Vector;
    public function setPosition(Vector $vector): void;
}
