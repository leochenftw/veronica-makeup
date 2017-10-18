<?php

class ImageExt extends DataExtension
{

    public function getRatio()
    {
        $width = $this->owner->Width;
        $height = $this->owner->Height;

        // SaltedHerring\Debugger::inspect($width . ' : ' . $height);

        return (($height / $width) * 100) . '%';
    }
}
