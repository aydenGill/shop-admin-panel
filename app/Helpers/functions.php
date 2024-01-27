<?php

function storeUploadedFile($file, $directory): string
{
    $extension = $file->getClientOriginalExtension();
    $randomName = uniqid('image_', true).'.'.$extension;

    return $file->storeAs($directory, $randomName, 'public');
}
